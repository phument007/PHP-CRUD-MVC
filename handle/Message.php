<?php 
   function message($status,$message){
       if($status === "success"){
          $_SESSION['message'] = $message;
       }else{
          $_SESSION['message'] = $message;
       }
   
   }
?>