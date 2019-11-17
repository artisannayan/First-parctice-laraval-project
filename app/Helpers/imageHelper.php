<?php
  namespace App\Helpers;
  /**
   * Image Helpers
   * 
   */
 use App\Models\User;
 use App\Helpers\GravaterHelper;

   class ImageHelper
   {
        public static function getUserImage($id)
        {
          $user = User::find($id);
          $avater_url = "";
          if(!is_null($user) ){

             if($user->avater == null){
                  if(GravaterHelper::validate_gravater($user->email) ){
                    $avater_url = GravaterHelper::gravater_image($user->email,35);
                  }else{
                    //  No gravater image not Found
                         $avater_url = url('image/users/gravter.png');
                  }
             }else{
               //return the iamge if the Profile is upload by user
               $avater_url = url('image/users/'.$user->avater);
             }
          }else{
            // return redirect('/');
          }
          return $avater_url;
        }
   }