<?php 
 function upload_an_image($max_size, $prefix, $valid_exts) {        
   
   $path ='user_uploads/'; // upload directory
   
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if( ! empty($_FILES['image']) ) {
        
           // get uploaded file extension
           $ext = strtolower(pathinfo($_FILES['image']['name'][0], PATHINFO_EXTENSION));
           // looking for format and size validity
           if (in_array($ext, $valid_exts) AND $_FILES['image']['size'][0] < $max_size*50) {
               $path = $path . uniqid(). $prefix.rand(0,100).'.' .$ext;
               // move uploaded file from temp to uploads directory
               if (move_uploaded_file($_FILES['image']['tmp_name'][0], $path)) {  
                   return $path;
               } //else echo $_FILES['image']['tmp_name'][0];
           } else {
               //echo 'Invalid file!';
           }
       } else{ 
           //echo 'File not uploaded!';
       }
   } else {
       //echo 'Bad request!';
   }
}
?>
