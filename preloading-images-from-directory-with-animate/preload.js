/**
@description the below function uses JSONP to load the PHP file into a SCRIPT
             as if it were a js file itself, then the automatically generated function is fired
             which then executes the specified callback ('success') function which is specified
             when calling 'RequestJSON'. The callback then preloads the passed data (array of images).
@param dir(String) Name of the directory
@param callback (Function) This function is triggered when we receive a response from server.
                 It is passed one argument(array of images from dir)
*/
function preloadImagesFromDirectory(dir,callback) {

            if(!dir) {return;}
  
            function RequestJSON(url,success) {

                var uniqueID = 'jsoncallback'+((+new Date()));

                /* create a function within global namespace */
                window[uniqueID] = function(data) {
                   success && success(data);
                }

                document.getElementsByTagName('head')[0].appendChild(
                       (function(){
                             var s = document.createElement('script');
                                 s.type = "text/javascript";
                                 s.src = url.replace('callback=?','callback='+uniqueID);
                                 return s;  
                       })()
                );  
            };

            function preload(srcArray) {
                  if(typeof callback === 'function') {
                       callback(srcArray);  
                  }
            };

            RequestJSON('scanImagesDirectory.php?directory='+dir+'&callback=?',function(data){
                   
                   return data.images ? preload(data.images) : false;
            }); 
};
