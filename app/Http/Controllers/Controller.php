<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use App\Models\Option;

abstract class Controller
{
    protected $cookieName = 'wi_creation'; // web info creation
    
    public function __construct(Request $request)
    {
      if (!$request->is('api/*')) {
        if ($request->hasCookie($this->cookieName)) { // Check if the specific cookie exists
            $cookieValue = $request->cookie($this->cookieName); // Retrieve the cookie value
            $wiCreation = Option::where('type','WEB_INFO_UPDATE')->first();
            if (@$wiCreation->value < $cookieValue) { // There is/are update/s in web infos
              $this->reset_home_cookie();
            }else{
              $cookieTimestamp = Carbon::createFromTimestamp($cookieValue); // Assuming the cookie value contains a timestamp of when it was set
              $cookieAgeInDays = Carbon::now()->diffInDays($cookieTimestamp); // You can then use these values to check the age
              if ($cookieAgeInDays > 30) {
                $this->reset_home_cookie();
              }
            }
        } else {
          $this->reset_home_cookie();
        }
        
      }
    }

    public function reset_home_cookie(){ // tdk boleh ada dump atau echo atau sejenisnya
      echo '<div class="alert alert-warning alert-dismissible fade show" id="reset-cookies-alert" role="alert" style="margin:0">
              <strong>Hello!</strong> Home cookies are ready...
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
      $data  = [
          'wi_creation'       =>Option::where('type','WEB_INFO_UPDATE')->first()['value'],
          'logo'              =>Option::where('type','WEB_LOGO')->first()['img_main'],
          'desc'              =>Option::where('type','WEB_DESC')->first()['description'],
          'schedule'          =>Option::where('type','WEB_SCHEDULE')->first()['description'],
          'contact_phone'     =>Option::where('type','WEB_CONTACT_PHONE')->first()['value'],
          'contact_email'     =>Option::where('type','WEB_CONTACT_EMAIL')->first()['value'],
          'contact_address'   =>Option::where('type','WEB_CONTACT_ADDRESS')->first()['description'],
          'socmed_fb'         =>Option::where('type','WEB_SOCMED_FB')->first()['value'],
          'socmed_twitter'    =>Option::where('type','WEB_SOCMED_TWITTER')->first()['value'],
          'socmed_ig'         =>Option::where('type','WEB_SOCMED_IG')->first()['value'],
      ];
      foreach ($data as $key => $value) {
        Cookie::queue($key, $value, 60); // 129600); // 90 days
      };
    }
    
    public function show_error_404($object_name = 'Berkas')
    {
      $error_details = array(
        'title' => 'Yaah...',
        'desc' => $object_name . ' yang Anda cari tidak ditemukan.'
      );
      return view('errors.404', $error_details);
    }

    public function show_error_401($object_name = 'Berkas')
    {
      $error_details = array(
        'title' => 'Oops,',
        'desc' => $object_name . ' ini tidak termasuk hak akses Anda.'
      );
      return view('errors.401', $error_details);
    }
}
