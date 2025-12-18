// touch-listener-inspect.js
// Minimal version to avoid encoding issues and syntax errors.
(function(){
    if (window.location.search.indexOf('dbg_touch=1') === -1) return;
    var origAdd = EventTarget.prototype.addEventListener;
    var types = [
        'touchstart','touchmove','touchend','touchcancel',
        'pointerdown','pointermove','pointerup','pointercancel',
        'mousedown','mousemove','mouseup','click','dragstart','drag','dragend'
    ];
    EventTarget.prototype.addEventListener = function(type, listener, options){
        if(types.indexOf(type) !== -1){
            var info = '[touch-listener-inspect] addEventListener: type=' + type;
            if(window.console && window.console.info){
                window.console.info(info);
            }
        }
        return origAdd.apply(this, arguments);
    };
})();
