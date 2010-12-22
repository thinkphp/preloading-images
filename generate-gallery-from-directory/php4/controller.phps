<?php
  
/**
  @param $src (String) source images
  @param $dest (String) destination images
  @desired_width (Float) width of the photo
  @return generates thumbnail
  */
  function make_thumb($src,$dest,$desired_width) {
  
       //read the source image
       $source_image = imagecreatefromjpeg($src);
       $width = imagesx($source_image);
       $height = imagesy($source_image);

       //find the 'desired height' of this thumbnail, relative to the desired width
       $desired_height = floor($height*($desired_width/$width));

       //create a new virtual image
       $virtual_image = imagecreatetruecolor($desired_width,$desired_height);  

       //copy source image at a resized sise
       imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height); 
               
       //create the physical thumbnail image to its destination
       imagejpeg($virtual_image,$dest); 
  }

/**
  @param $file (String) filename
  @return file's extension 
  */

  function get_file_extension($filename) {

       return substr(strstr($filename,'.'),1);
  }

/**
   @param $images_dir (String) directory of images
   @param $exts (Array) desired extensions from folder
   @return files from folder
  */
  function get_files($images_dir,$exts = array('jpg','jpeg')) {
          
       $files = array();

       if($handle = opendir($images_dir)) {

             while(false !== ($file = readdir($handle))) {
 
                    $extension = strtolower(get_file_extension($file));

                    if($extension && in_array($extension,$exts)) {
   
                          $files[] = $file;
                    }
             }

          closedir($handle);   
       }    


     return $files;
  }

?>