if(!/MSIE/i.test(navigator.userAgent)) {
HTMLElement.prototype.fade = function(type) {
        if(type == 'in') { 
                       new Animate(this,'opacity',{
                                    from: 0,
                                    to: 1,
                                    time: 500}
                       ).start();    
        } else if(type == 'out') {
                       new Animate(this,'opacity',{
                                    from: 1,
                                    to: 0,
                                    time: 500}
                       ).start();    
        }                            
};
}