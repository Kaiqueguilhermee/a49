// touch-listener-inspect.js
// Log every addEventListener for touch/pointer/mouse events, with stack and options.

(function(){
    if (!window.location.search.includes('dbg_touch=1')) return;
    var origAdd = EventTarget.prototype.addEventListener;
    var types = [
        'touchstart','touchmove','touchend','touchcancel',
        'pointerdown','pointermove','pointerup','pointercancel',
        'mousedown','mousemove','mouseup','click','dragstart','drag','dragend'
    ];
    EventTarget.prototype.addEventListener = function(type, listener, options){
        if(types.includes(type)){
            var target = this;
            var stack = '';
            try{ throw new Error(); }catch(e){ stack = e.stack; }
            var msg = '[touch-listener-inspect] addEventListener: type=' + type + ' target=' + ((target && target.tagName)?target.tagName:target) +
                ' options=' + (typeof options === 'object' ? JSON.stringify(options) : String(options)) + '\n' + stack;
            if(window.console && console.info){
                console.info(msg);
            }
        }
        return origAdd.apply(this, arguments);
    };
})();
