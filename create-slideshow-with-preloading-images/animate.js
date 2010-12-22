   /**
     * @constructor Animate
     * @param (HTMLElement) el the element we want to animate
     * @param (String) prop the CSS property we will be animating
     * @param (Object) opt a configuration object
     * object properties include
     * from (Int)
     * to (Int) 
     * time (Int) time in milliseconds.
     * callback (Function)
     */
     function Animate(el, prop, opts) {
       this.el = el;
       this.prop = prop;
       this.from = opts.from; 
       this.to = opts.to;
       this.time = opts.time;
       this.callback = opts.callback;
       this.animDiff = this.to - this.from;   
     };

     /**
       * @private
       * @param (String) val the CSS value will set on the property
       */  
       Animate.prototype._setStyle = function(val) {
            switch(this.prop) {
                 case 'opacity': 
                      this.el.style[this.prop] = val;
                      this.el.style.filter = 'alpha(opacity=' + val * 100 + ')';
                      break;

                  default: 
                      this.el.style[this.prop] = val + 'px';
                      break; 
            };
       };
     /**
       * @private
       * this is a tweening function
       */  
       Animate.prototype._animate = function() {

           var that = this;
           this.now = new Date();
           this.diff = this.now - this.startTime;

           if(this.diff > this.time) {
                 this._setStyle(this.to);
 
                 if(this.callback) {
                       this.callback(this);
                 }

                 clearInterval(this.timer);
                 return;  
           }

           this.percentage = (Math.floor((this.diff / this.time) * 100) / 100);
           this.val = (this.animDiff * this.percentage) + this.from;
           this._setStyle(this.val); 
       };

     /**
       * @public
       * begins the animation
       */  
       Animate.prototype.start = function(){
           var that = this;
           this.startTime = new Date();
           
           this.timer = setInterval(function() {
                that._animate.call(that);
           }, 4);  
         
       };

     /**
       * @static
       * @boolean
       * Allows us to check if native CSS transitions are possible;
       */  
       Animate.canTransition = function() {
           var el = document.createElement('twitter');
               el.style.cssText = '-webkit-transition: all .5s linear;'; 
           return !!el.style.webkitTransitionProperty;     
       }();
