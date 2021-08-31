<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Models\User;
use App\Models\Coupon;
use Mail;
use Illuminate\Support\Facades\Hash;

class MailController extends Controller
{
     public function contacts(Request $request)
    {        
      return view('pages.contacts')->with(get_defined_vars());
    }
     //[082125QD] Save information customer

     public function send_contacts(Request $request)
    {   
            $data = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'phone' => 'required|numeric|min:11',
                'message' => 'required',
          ],
        );  
        $contact = new Contacts();
        $contact->contact_name= $data['name'];
        $contact->contact_email= $data['email'];
        $contact->contact_phone= $data['phone'];
        $contact->contact_message= $data['message'];
        $contact->save();

        $to_name="Shop thoi trang";
        $to_email="tnu1805@gmail.com";
        $data= array("email"=>$contact->contact_email,"phone"=>$contact->contact_phone,"name"=>$contact->contact_name,"sendmessage"=>$contact->contact_message);
         Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Customer contacts');
            $message->from($to_email,$to_name);
        });
                 return redirect()->back();

    }
    //[082126QD]Create forget password
     public function send_code(Request $request)
    {   
            $data = $request->validate(
            [
                'email' => 'required|max:255|email',
          ],
        );  
        $user=User::where('email',$data['email'])->first();
        if($user)
        {
        $code=rand(100000,999999);
        session()->put('code',$code);
        session()->put('email_new_pw',$data['email']);
        $to_name="Shop thoi trang";
        $to_email=$data['email'];
        $data= array("email"=>$data['email'],'code'=> $code);
         Mail::send('pages.mail.send_mail_code',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Send code to create new password');
            $message->from($to_email,$to_name);
        });

      return view('auth.passwords.code')->with(get_defined_vars());
        }
        else
        {return redirect()->back();}

    }
    //[082126QD]Create forget password
     public function new_password(Request $request)
    {
        $data = $request->validate(
            [
                'code' => 'numeric|min:6',
          ],
        );  
        if($data['code']==session('code'))
                {return view('auth.passwords.new_password')->with(get_defined_vars());}
            else   {return redirect()->back();}

    }
         public function create_new_password(Request $request)
         {
          $data = $request->validate(
            [
                'password' => 'required|min:8,'
          ],
        ); 
          $user=User::where('email',session('email_new_pw'))->first();
           $user->password=Hash::make($data['password']);
           $user->save();
                 return   redirect('login');
         }
         //[082126QD]Create send mail coupon for customer
         public function send_coupon(Request $request)
         {
          $data = $request->validate(
            [
                'newsletter' => 'required|email',
          ],
        ); 

           $to_name="Shop thoi trang";
        $to_email=$data['newsletter'];
        $coupon=Coupon::orderBy("updated_at","DESC")->first();
        $data= array("coupon"=>$coupon->coupon_code);
         Mail::send('pages.mail.send_mail_coupon',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Send coupon code');
            $message->from($to_email,$to_name);
        });
         return redirect()->back();
         }
          public function map(Request $request)
    { 
        $adress='thanh thai quan 10 viet nam';
        $adress=str_replace(' ', '+', $adress);
           $url="https://api.mapbox.com/geocoding/v5/mapbox.places/".$adress.".json?limit=1&access_token=pk.eyJ1IjoidG51MTgwNSIsImEiOiJja3N1YTdvcm8xZWx0MnBvNXYzeGFqYm93In0.kUcWi0oiwYzXWXtDXkaFvg";
           $ch=curl_init($url);
               curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
           $data=curl_exec($ch);
           curl_close($ch); 

            $posi=strpos($data, '"coordinates":');
            $stringpo=substr($data, $posi+15); 
            $arr=explode(']',$stringpo);
            $vitri= $arr[0];
          return view('admin.driver.map')->with(get_defined_vars());
    }
}
