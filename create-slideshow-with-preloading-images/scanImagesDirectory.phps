<?php

    header('content-type: text/javascript');

    //check if weather a callback has been specified
    if(!isset($_GET['callback']) ||!isset($_GET['directory'])) {
        exit();
    }

    $dir = $_GET['directory'];

    $dirContents = scandir($dir);

    $arrayContents = '';

    function isImageFile($img) {

          return preg_match('/^.+\.(gif|png|jp?g|bmp|tif)$/i',$img);
    }

    foreach($dirContents as $image) {

            if(isImageFile($image)) {
               $arrayContents .= !empty($arrayContents) ? ',' : '';
               $arrayContents .= '"'.$dir.'/' . $image . '"';
            } 
    }


    //prepare JSONP callback
    $output = $_GET['callback']. '({\'images\':['.$arrayContents.']})';

    echo$output;

?>