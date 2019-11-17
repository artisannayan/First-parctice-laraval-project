<?php
   namespace App\Helpers;
    /**
     * Gavater  Helper
     */


     class GravaterHelper

     /*
     *Validate Gravater
     *
     * 
     * Chek if the Email is Exists in any gravter with image 
     */
     { 
         public static function validate_gravater($email)
         {

              $has = md5($email);
              $uri = 'http://wwww.gravater.com/avater/'.$has . '?d=80';
              $headers = @get_headers($uri);
              if(!preg_match("|200|", $headers[1]) ){
                  $has_valid_avater = FALSE;
              }else{
                  $has_valid_avater = TRUE;
              }
          return $has_valid_avater;
         }


         public static function gravater_image($email, $size=0,$d="")
         {
           $has = md5($email);
           $image_uri = 'http://wwww.gravater.com/avater/' .$has . '?s=' .$size .'&d=' . $d;
           return $image_uri;
         }

     }
?>