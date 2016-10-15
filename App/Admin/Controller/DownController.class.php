<?php
namespace Admin\Controller;
class DownController extends AuthController
{

   public function downfile ($filename){
       if (isset($filename))
       {
           Header("HTTP/1.1 303 See Other");
           Header("Location: $filename");
           exit;
       }
   }
}