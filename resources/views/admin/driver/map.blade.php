<!DOCTYPE html>
{{-- [082130QD]show driver's current location on map, show driver's orders on map, calculate ETA current location driver vs each order address and driver orders bar--}}
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
background-image: url("{{URL::to('frontend/images/tovar/icon.png')}}");
  background-size: cover;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
}
.marker2 {
background-image: url("{{URL::to('frontend/images/tovar/mapbox-icon.png')}}");
  background-size: cover;
  width: 40px;
  height: 40px;
  border-radius: 50%;
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
  </style>
  <script src="https://js.sentry-cdn.com/9c5feb5b248b49f79a585804c259febc.min.js" crossorigin="anonymous"></script>

</head>
<body>

<div id='map'></div>
<div id="instructions"></div>

<div class="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" style="width: 450px; display: block;" id="mySidebar">
  <form id="form_filter" action="" method="get">
    @csrf
  <div class="w3-bar w3-dark-grey">
  <span class="w3-bar-item w3-padding-16">Driver bar</span>
  <button onclick="w3_close()" class="w3-bar-item w3-button w3-right w3-padding-16" title="close Sidebar">×</button>
  </div>
  <div class="w3-bar-block">
  <a class="w3-bar-item w3-button w3-green" href="?show_all=<?php if(isset($_GET['show_all'])){ if($_GET['show_all']=='on') echo 'off'; else echo 'on';} else echo 'off'; ?>"><?php if(isset($_GET['show_all'])) { if($_GET['show_all']=='on') echo "Show"; else echo 'Hide'; } else echo 'Show';?> all orders</a>
  <a class="w3-bar-item w3-button " href="" style="background-color: #2ECCFA;">Driver</a>
  <div class="">
    <div class=" w3-bar-block w3-card-4 cart_list ">
  <table class="table " ui-jq="footable">
        <thead>
          <tr>
            <th data-breakpoints="xs">Show</th>
            <th data-breakpoints="xs">adress</th>  
         </tr>
        </thead>
        <tbody>
          <?php $checked=[]; if(isset($_GET['chbox'])) $checked=$_GET['chbox'];?>
           @foreach($order2 as $od)
          <tr>
           <td> <input class="filter_checkbox" type="checkbox" name="chbox[]" value={{$od->id}} @if(in_array($od->id, $checked)) checked @endif ></td>
            <td>{{$od->adress1}}</td>
          </tr>
          @endforeach
        </tbody>
      </table> 
    </div>
  </div>
      <a class="w3-bar-item w3-button" href=""  style="background-color: #F7819F;">Orders</a>
  </div>
  <div class="">
    <div class=" w3-bar-block w3-card-4 cart_list2 ">
 <table class="table " ui-jq="footable">
        <thead>
          <tr>
            <th data-breakpoints="xs">Show</th>
            <th data-breakpoints="xs">adress</th>  
         </tr>
        </thead>
        <tbody>
          <?php $checked=[]; if(isset($_GET['chbox'])) $checked=$_GET['chbox'];?>
           @foreach($order2 as $od)
          <tr>
           <td> <input class="filter_checkbox" type="checkbox" name="chbox[]" value={{$od->id}} @if(in_array($od->id, $checked)) checked @endif ></td>
            <td>{{$od->adress1}}</td>
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
  center: [{{$driver->loc}}],
  zoom: 14
});

const start = [{{$driver->locID}}];
const end=[{{$next_order}}];
// create a function to make a directions request
async function getRoute(end) {
  // make a directions request using cycling profile
  // an arbitrary start will always be the same
  // only the end or destination will change
  const query = await fetch(
    `https://api.mapbox.com/directions/v5/mapbox/cycling/${start[0]},${start[1]};${end[0]},${end[1]}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`,
    { method: 'GET' }
  );
  const json = await query.json();
  const data = json.routes[0];
  const route = data.geometry.coordinates;
  const geojson = {
    type: 'Feature',
    properties: {},
    geometry: {
      type: 'LineString',
      coordinates: route
    }
  };
  // if the route already exists on the map, we'll reset it using setData
  if (map.getSource('route')) {
    map.getSource('route').setData(geojson);
  }
  // otherwise, we'll make a new request
  else {
    map.addLayer({
      id: 'route',
      type: 'line',
      source: {
        type: 'geojson',
        data: geojson
      },
      layout: {
        'line-join': 'round',
        'line-cap': 'round'
      },
      paint: {
        'line-color': '#3887be',
        'line-width': 5,
        'line-opacity': 0.75
      }
    });
  }
          // get the sidebar and add the instructions
        const instructions = document.getElementById('instructions');
        const steps = data.legs[0].steps;

        let tripInstructions = '';
        for (const step of steps) {
          tripInstructions += `<li>${step.maneuver.instruction}</li>`;
        }
        instructions.innerHTML = `<p><strong>Trip duration: ${Math.floor(
          data.duration / 60
        )} min 🚴 </strong></p><ol>${tripInstructions}</ol>`;
  // add turn instructions here at the end
}

map.on('click', ({ lngLat }) => {
  const coords = Object.keys(lngLat).map((key) => lngLat[key]);
  const end = {
    type: 'FeatureCollection',
    features: [
      {
        type: 'Feature',
        properties: {},
        geometry: {
          type: 'Point',
          coordinates: coords
        }
      }
    ]
  };
  if (map.getLayer('end')) {
    map.getSource('end').setData(end);
  } else {
    map.addLayer({
      id: 'end',
      type: 'circle',
      source: {
        type: 'geojson',
        data: {
          type: 'FeatureCollection',
          features: [
            {
              type: 'Feature',
              properties: {},
              geometry: {
                type: 'Point',
                coordinates: coords
              }
            }
          ]
        }
      },
      paint: {
        'circle-radius': 10,
        'circle-color': '#f30'
      }
    });
  }
  getRoute(coords);
});


map.on('load', () => {
  // make an initial directions request that
  // starts and ends at the same location
  getRoute(start);

  // Add starting point to the map
  map.addLayer({
    id: 'point',
    type: 'circle',
    source: {
      type: 'geojson',
      data: {
        type: 'FeatureCollection',
        features: [
          {
            type: 'Feature',
            properties: {},
            geometry: {
              type: 'Point',
              coordinates: start
            }
          }
        ]
      }
    },
    paint: {
      'circle-radius': 10,
      'circle-color': '#3887be'
    }
  });

  getRoute(end);

  // Add starting point to the map
  map.addLayer({
    id: 'end',
    type: 'circle',
    source: {
      type: 'geojson',
      data: {
        type: 'FeatureCollection',
        features: [
          {
            type: 'Feature',
            properties: {},
            geometry: {
              type: 'Point',
              coordinates: end
            }
          }
        ]
      }
    },
    paint: {
      'circle-radius': 4,
      'circle-color': '#3887be'
    }
  });
  // this is where the code from the next step will go
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
        title: {{$od->distance}},
        description: {{$od->duration}},
        phone: {{$od->phone}}
      }
    },
    @endforeach
  ]
};
const geojson2 = {
  type: 'FeatureCollection',
  features: [
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [{{$driver->loc}}]
      },
      properties: {
        title: 'driver',
        description: 'glammy'
      }
    }
  ]
};
// code from the next step will go here!
for (const { geometry, properties } of geojson.features) {
  // create a HTML element for each feature
  const el = document.createElement('div');
  el.className = 'marker';

  // make a marker for each feature and add to the map
new mapboxgl.Marker(el)
  .setLngLat(geometry.coordinates)
  .setPopup(
    new mapboxgl.Popup({ offset: 25 }) // add popups
      .setHTML(`<h3><a class="cus_phone" href="tel:0${properties.phone}">Phone: 0${properties.phone}</a></h3><h3>Distance: ${properties.title}m</h3><h3>Duration: ${properties.description}s</h3>`)
  )
  .addTo(map);}

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

</body>
</html>
