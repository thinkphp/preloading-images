<?php require('controller.php'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Generate automatically a Photo Gallery From a Directory of Images</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <style type="text/css">
   .photo{float: left;border: 1px solid #ccc;padding: 4px;margin: 4px;}
   .clear{clear: both}
   #ft{font-size:120%;text-align:left;margin:2em 0;}
   #ft p a{color: #393}
   #ft p {color: #111}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Generate automatically a Photo Gallery From a Directory of Images</h1></div>
   <div id="bd" role="main">
	<div class="yui-g">
<?php

  /* settings */
  $images_dir = 'images/';
  $thumbs_dir = 'thumbs/';
  $thumbs_width = 200;
  $images_per_row = 3;

  /* generate photo gallery */
  $images_file = get_files($images_dir);

  if(count($images_file)>0) {

     $index = 0;

     //for each image execute
     foreach($images_file as $index=>$file) {

           $index++;

           $thumbnail_image = $thumbs_dir.$file;

           //if the file not exists then create it on thumb folder
           if(!file_exists($thumbnail_image)) {

               $extension = get_file_extension($thumbnail_image);
 
               if($extension) {
 
                   make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);

               }//endif

           }//endif

           echo'<a href="'.$images_dir.$file.'" class="photo"><img src="'.$thumbnail_image.'" alt="photo"></a>';

           if( ($index % $images_per_row)  == 0) {echo'<div class="clear"></div>';} 
 
     }//endforeach

     echo'<div class="clear"></div>';

  //otherwise
  } else {

     echo'<p>There are no images in this gallery.</p>';  
  }
  
?>
	</div>
	</div>
   <div id="ft" role="contentinfo"><p>Written By @<a href="http://twitter.com/thinkphp">thinkphp</a> | <a href="source.phps">source</a> | <a href="controller.phps">controller</a></p></div>
</div>
</body>
</html>