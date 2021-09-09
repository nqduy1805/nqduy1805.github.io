<!DOCTYPE html>
{{-- [082130QD]show driver's current location on map, show driver's orders on map, calculate ETA current location driver vs each order address and driver orders bar--}}
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://npmcdn.com/@turf/turf/turf.min.js"></script>


<style>
@media screen and (max-width: 455px) {
    .h3 {
        font-size:16px;
    }
}
</style>
{{-- map --}}
    <title>Driver Map</title>
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css' rel='stylesheet' />
    <style>

      body {
        margin: 0;
        padding: 0;
      }

      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
      }
      .marker {
background-image: url("{{URL::to('frontend/images/tovar/o1.png')}}");
  background-size: cover;
  width: 40px;
  height: 40px;
  cursor: pointer;
}
  .marker1 {
background-image: url("{{URL::to('frontend/images/tovar/icon.png')}}");
  background-size: cover;
  width: 40px;
  height: 40px;
  cursor: pointer;
}
.marker2 {
background-image: url("{{URL::to('frontend/images/tovar/1.png')}}");
  background-size: cover;
  width: 40px;
  height: 40px;
  cursor: pointer;
}
.marker3 {
background-image: url("{{URL::to('frontend/images/tovar/delivery.png')}}");
  background-size: cover;
  width: 40px;
  height: 40px;
  cursor: pointer;
}
.mapboxgl-popup {
  max-width: 200px;
}

.mapboxgl-popup-content {
  text-align: center;
  font-family: 'Open Sans', sans-serif;
}
#instructions {
  position: absolute;
  margin: 20px;
  width: 25%;
  top: 0;
  bottom: 20%;
  padding: 20px;
  background-color: #fff;
  overflow-y: scroll;
  font-family: sans-serif;
}
.cus_phone{
   text-decoration: none;
   border-collapse:collapse;
   color: red;
       border: none;
    outline:none;

 }
 .driver_w{
 	 text-decoration: none;
   border-collapse:collapse;
       border: none;
    outline:none;
 }
 .name_dr{   color: red;
}
  .cart_list {
   height: 110px;
  overflow-y: auto;
  scroll-snap-type: y;
     font-size: 13px;
}
.cart_list2 {
   height: 330px;
  overflow-y: auto;
  scroll-snap-type: y;
     font-size: 13px;
}
::-webkit-scrollbar { 
    display: none; 
}
.truck {
background-image: url("{{URL::to('frontend/images/tovar/delivery.png')}}");
  background-size: cover;
  width: 40px;
  height: 40px;
  cursor: pointer;
}
  </style>
  <script src="https://js.sentry-cdn.com/9c5feb5b248b49f79a585804c259febc.min.js" crossorigin="anonymous"></script>

</head>
<body>

<div id='map'></div>
<div id="instructions"></div>

<div class="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" style="width: 450px; display: block;" id="mySidebar">
  <form id="form_filter" action="" method="get">
    @csrf
              					<input type="hidden" name="driver" value="<?php if(isset($_GET['driver'])) echo $_GET['driver']; ?>"/>
  <div class="w3-bar w3-dark-grey">
  <span class="w3-bar-item w3-padding-16">Driver bar</span>
  <button onclick="w3_close()" class="w3-bar-item w3-button w3-right w3-padding-16" title="close Sidebar">×</button>
  </div>
  <div class="w3-bar-block">
  <a class="w3-bar-item w3-button " <?php if(isset($_GET['show_driver'])){if($_GET['show_driver']=="on") $show_driver="off"; else  $show_driver="on";}else  $show_driver="off"  ?>href="{{ request()->fullUrlWithQuery(['show_driver' => $show_driver]) }} "  style="background-color: #2ECCFA;">Driver</a>
  <div class="">
    <div class=" w3-bar-block w3-card-4 cart_list ">
    	<table>
    		<thead>
    	    <th data-breakpoints="xs">Hide</th>
            <th data-breakpoints="xs">Driver</th>
       		</thead>
       		<tbody>          
       			<?php $checkeddr=[]; if(isset($_GET['cbdriver'])) $checkeddr=$_GET['cbdriver'];?>
       			           @foreach($driver3 as $dr)
       			<tr>
       				<td> <input class="filter_checkbox" type="checkbox" name="cbdriver[]" value={{$dr->web}} @if(in_array($dr->web, $checkeddr)) checked @endif ></td>
       				 <td><a class="driver_w <?php if(isset($_GET['driver'])){if($_GET['driver']==$dr->web) echo 'name_dr';}?>" href="{{ request()->fullUrlWithQuery(['driver' => $dr->web]) }} " >{{$dr->web}}</a></td>
       			</tr>
       			          @endforeach
       		</tbody>
    	</table>
    </div>
  </div>
      <a class="w3-bar-item w3-button" <?php if(isset($_GET['show_order'])){if($_GET['show_order']=="on") $show_order="off"; else  $show_order="on";}else  $show_order="off"  ?> href="{{ request()->fullUrlWithQuery(['show_order' => $show_order]) }} "  style="background-color: #F7819F;">Orders</a>
  </div>
  <div class="">
    <div class=" w3-bar-block w3-card-4 cart_list2 ">
 <table class="table " ui-jq="footable">
        <thead>
          <tr>
            <th data-breakpoints="xs">Hide</th>
            <th data-breakpoints="xs">adress</th>  
         </tr>
        </thead>
        <tbody>
          <?php $checked=[]; if(isset($_GET['chbox'])) $checked=$_GET['chbox'];?>
           @foreach($order3 as $od)
          <tr>
           <td> <input class="filter_checkbox" type="checkbox" name="chbox[]" value={{$od->id}} @if(in_array($od->id, $checked)) checked @endif ></td>
            <td class="  <?php if(isset($_GET['driver'])){if($_GET['driver']==$od->web) echo 'name_dr';}?>">{{$od->shipAddr}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>    </div>
  </div>
  </div>
</form>
</div>
<div id="main" style="margin-left: 450px;">

<div class="w3-container w3-display-container">
  <span title="open Sidebar" style="display: none;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
</div>

</div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoidG51MTgwNSIsImEiOiJja3N1YTdvcm8xZWx0MnBvNXYzeGFqYm93In0.kUcWi0oiwYzXWXtDXkaFvg';

const map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
  center: [{{$center}}],
  zoom: 12.5
});





const geojson = {
  type: 'FeatureCollection',
  features: [
    @foreach($order as $od)
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [{{$od->loc}}]
      },
      properties: {
        title: "{{$od->cusName}}",
        description: "{{$od->orderNote}}",
        phone: {{$od->cusPhone}}
      }
    },
    @endforeach
  ]
};
const geojson1 = {
  type: 'FeatureCollection',
  features: [
    @foreach($order2 as $od)
    @if($next_order!=$od->loc)
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [{{$od->loc}}]
      },
      properties: {
        title: "{{$od->cusName}}",
        description: "{{$od->orderNote}}",
        phone: {{$od->cusPhone}}
      }
    },
    @endif
    @endforeach
  ]
};
const geojson2 = {
  type: 'FeatureCollection',
  features: [
  @foreach($driver as $dr)
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [{{$dr->locID}}]
      },
      properties: {
        title: 'Driver',
        description: "{{$dr->web}}"
      }
    },
    @endforeach
  ]
};
@if($driver2)
const geojson3 = {
  type: 'FeatureCollection',
  features: [
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [{{$driver2->locID}}]
      },
      properties: {
        title: 'Driver',
        description: "{{$driver2->web}}"
      }
    },
  ]
};
@endif
//driver1 code from the next step will go here! 
for (const { geometry, properties } of geojson.features) {
  // create a HTML element for each feature
  const el = document.createElement('div');
  el.className = 'marker';

  // make a marker for each feature and add to the map
new mapboxgl.Marker(el)
  .setLngLat(geometry.coordinates)
  .setPopup(
    new mapboxgl.Popup({ offset: 25 }) // add popups
      .setHTML(`<h5><a class="cus_phone" href="tel:0${properties.phone}">Phone: 0${properties.phone}</a></h5><h6>Name: ${properties.title}</h6><h6>Note: ${properties.description}</h6>`)
  )
  .addTo(map);}
  //driver2 code from the next step will go here!
for (const { geometry, properties } of geojson1.features) {
  // create a HTML element for each feature
  const el = document.createElement('div');
  el.className = 'marker1';

  //  make a marker for each feature and add to the map
new mapboxgl.Marker(el)
  .setLngLat(geometry.coordinates)
  .setPopup(
    new mapboxgl.Popup({ offset: 25 }) // add popups
      .setHTML(`<h5><a class="cus_phone" href="tel:0${properties.phone}">Phone: 0${properties.phone}</a></h5><h6>Name: ${properties.title}</h6><h6>Note: ${properties.description}</h6>`)
  )
  .addTo(map);}
  //order1 code from the next step will go here!

  for (const { geometry, properties } of geojson2.features) {
  // create a HTML element for each feature
  const el2 = document.createElement('div');
  el2.className = 'marker2';

  // make a marker for each feature and add to the map
new mapboxgl.Marker(el2)
  .setLngLat(geometry.coordinates)
  .setPopup(
    new mapboxgl.Popup({ offset: 25 }) // add popups
      .setHTML(`<h3>${properties.title}</h3><p>${properties.description}</p>`)
  )
  .addTo(map);}
  @if($driver2)
  //driver2 code from the next step will go here!
 for (const { geometry, properties } of geojson3.features) {
  // create a HTML element for each feature
  const el2 = document.createElement('div');
  el2.className = 'marker3';

  // make a marker for each feature and add to the map
new mapboxgl.Marker(el2)
  .setLngLat(geometry.coordinates)
  .setPopup(
    new mapboxgl.Popup({ offset: 25 }) // add popups
      .setHTML(`<h3>${properties.title}</h3><p>${properties.description}</p>`)
  )
  .addTo(map);}
  @endif
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "450px";
  document.getElementById("mySidebar").style.width = "450px";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
  $('.filter_checkbox').on('input',function(){$('#form_filter').submit();})

</script>
@if($driver2)
<script>
const truckLocation = [{{$driver2->locID}}];
const warehouseLocation = [{{$next_order}}];
const lastAtRestaurant = 0;
let keepTrack = [];
const pointHopper = {};
 
const warehouse = turf.featureCollection([turf.point(warehouseLocation)]);
 
// Create an empty GeoJSON feature collection for drop off locations
const dropoffs = turf.featureCollection([]);
 
// Create an empty GeoJSON feature collection, which will be used as the data source for the route before users add any new data
const nothing = turf.featureCollection([]);
 
map.on('load', () => {
const marker = document.createElement('div');
marker.classList = 'truck';
 
// Create a new marker
new mapboxgl.Marker(marker).setLngLat(truckLocation).addTo(map);
 
// Create a circle layer
map.addLayer({
id: 'warehouse',
type: 'circle',
source: {
data: warehouse,
type: 'geojson'
},
paint: {
'circle-radius': 12,
'circle-color': 'white',
'circle-stroke-color': '#3887be',
'circle-stroke-width': 3
}
});
 
// Create a symbol layer on top of circle layer
map.addLayer({
id: 'warehouse-symbol',
type: 'symbol',
source: {
data: warehouse,
type: 'geojson'
},
layout: {
'icon-image': 'grocery-15',
'icon-size': 1
},
paint: {
'text-color': '#3887be'
}
});
 
map.addLayer({
id: 'dropoffs-symbol',
type: 'symbol',
source: {
data: dropoffs,
type: 'geojson'
},
layout: {
'icon-allow-overlap': true,
'icon-ignore-placement': true,
'icon-image': 'marker-15'
}
});
 
map.addSource('route', {
type: 'geojson',
data: nothing
});
 
map.addLayer(
{
id: 'routeline-active',
type: 'line',
source: 'route',
layout: {
'line-join': 'round',
'line-cap': 'round'
},
paint: {
'line-color': '#3887be',
'line-width': ['interpolate', ['linear'], ['zoom'], 12, 3, 22, 12]
}
},
'waterway-label'
);
 
map.addLayer(
{
id: 'routearrows',
type: 'symbol',
source: 'route',
layout: {
'symbol-placement': 'line',
'text-field': '▶',
'text-size': [
'interpolate',
['linear'],
['zoom'],
12,
24,
22,
60
],
'symbol-spacing': [
'interpolate',
['linear'],
['zoom'],
12,
30,
22,
160
],
'text-keep-upright': false
},
paint: {
'text-color': '#3887be',
'text-halo-color': 'hsl(55, 11%, 96%)',
'text-halo-width': 3
}
},
'waterway-label'
);
 
// Listen for a click on the map
map.on('click', ({ point }) => {
// When the map is clicked, add a new drop off point
// and update the `dropoffs-symbol` layer
newDropoff(map.unproject(point));
updateDropoffs(dropoffs);
});
});
 
async function newDropoff({ lng, lat }) {
// Store the clicked point as a new GeoJSON feature with
// two properties: `orderTime` and `key`
const pt = turf.point([lng, lat], {
orderTime: Date.now(),
key: Math.random()
});
dropoffs.features.push(pt);
pointHopper[pt.properties.key] = pt;
 
// Make a request to the Optimization API
const query = await fetch(assembleQueryURL(), { method: 'GET' });
const data = await query.json();
 
// Create a GeoJSON feature collection
let routeGeoJSON = turf.featureCollection([
turf.feature(data.trips[0].geometry)
]);
 
// If there is no route provided, reset
if (!data.trips[0]) {
routeGeoJSON = nothing;
} else {
// Update the `route` source by getting the route source
// and setting the data equal to routeGeoJSON
map.getSource('route').setData(routeGeoJSON);
}
 
if (data.waypoints.length === 12) {
window.alert(
'Maximum number of points reached. Read more at https://docs.mapbox.com/api/navigation/optimization/.'
);
}
}
 
function updateDropoffs(geojson) {
map.getSource('dropoffs-symbol').setData(geojson);
}
 
// Here you'll specify all the parameters necessary for requesting a response from the Optimization API
function assembleQueryURL() {
// Store the location of the truck in a variable called coordinates
const coordinates = [truckLocation];
const distributions = [];
let restaurantIndex;
keepTrack = [truckLocation];
 
// Create an array of GeoJSON feature collections for each point
const restJobs = Object.keys(pointHopper).map(
(key) => pointHopper[key]
);
 
// If there are actually orders from this restaurant
if (restJobs.length > 0) {
// Check to see if the request was made after visiting the restaurant
const needToPickUp =
restJobs.filter((d) => d.properties.orderTime > lastAtRestaurant)
.length > 0;
 
// If the request was made after picking up from the restaurant,
// Add the restaurant as an additional stop
if (needToPickUp) {
restaurantIndex = coordinates.length;
// Add the restaurant as a coordinate
coordinates.push(warehouseLocation);
// push the restaurant itself into the array
keepTrack.push(pointHopper.warehouse);
}
 
for (const job of restJobs) {
// Add dropoff to list
keepTrack.push(job);
coordinates.push(job.geometry.coordinates);
// if order not yet picked up, add a reroute
if (needToPickUp && job.properties.orderTime > lastAtRestaurant) {
distributions.push(
`${restaurantIndex},${coordinates.length - 1}`
);
}
}
}
 
// Set the profile to `driving`
// Coordinates will include the current location of the truck,
return `https://api.mapbox.com/optimized-trips/v1/mapbox/driving/${coordinates.join(
';'
)}?distributions=${distributions.join(
';'
)}&overview=full&steps=true&geometries=geojson&source=first&access_token=${
mapboxgl.accessToken
}`;
}
</script>
@endif

</body>
</html>
