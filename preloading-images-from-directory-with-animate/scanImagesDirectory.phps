<?php

    header('content-type: text/javascript');
    
    /**
      Description:
        This is a very handy script which will scan through a directory of images, form an array of the contents of 
        that directory and then return the array as JSON format to the client-side where the images will be preloaded into 
        the user's cache.  
      */ 

    /* check if weather a callback has been specified */
    if(!isset($_GET['callback']) ||!isset($_GET['directory'])) {
        exit();
    }

    $dir = $_GET['directory'];

    $dirContents = scandir($dir);

    $arrayContents = '';

    /** 
        @description function to validate the image - will stop any file from being listed 
        @param $img (String) the image to inspect 
     */
    function isImageFile($img) {

          return preg_match('/^.+\.(gif|png|jp?g|bmp|tif)$/i',$img);
    }

    //for every content from directory execute
    foreach($dirContents as $image) {

            //if the file is image then go ahead
            if(isImageFile($image)) {
               $arrayContents .= !empty($arrayContents) ? ',' : '';
               $arrayContents .= '"'.$dir.'/' . $image . '"';
            } 
    }


    //prepare JSONP callback
    $output = $_GET['callback']. '({\'images\':['.$arrayContents.']})';

    echo$output;

?>