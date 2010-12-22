<?php

    //prepare header content type
    header('content-type: text/javascript');

    //check if weather a callback has been specified
    //otherwise exit
    if(!isset($_GET['callback']) ||!isset($_GET['directory'])) {
        exit();
    }

    //store in variable $dir the content of the $_GET['directory'] 
    $dir = $_GET['directory'];

    //use PHP's scandir function
    //to scan all the images directory  
    $dirContents = scandir($dir);

    //define a variable
    $arrayContents = '';

    //define a function to confirm each filename is 
    // a valid image name/extension
    function isImageFile($img) {

          return preg_match('/^.+\.(gif|png|jp?g|bmp|tif)$/i',$img);
    }


    //loop through directory and
    //add valid file to $arrayContents 
    //on each iteration
    foreach($dirContents as $image) {

            if(isImageFile($image)) {
               $arrayContents .= !empty($arrayContents) ? ',' : '';
               $arrayContents .= '"'.$dir.'/' . $image . '"';
            } 
    }


    //prepare JSONP callback
    $output = $_GET['callback']. '({\'images\':['.$arrayContents.']})';

    //output the output
    echo$output;

?>