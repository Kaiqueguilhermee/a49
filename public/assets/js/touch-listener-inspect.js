// touch-listener-inspect.js
// Log every addEventListener for touch/pointer/mouse events, with stack and options.
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
            var target = this;
            var stack = '';
            try { throw new Error(); } catch(e) { stack = e.stack; }
            var info = '[touch-listener-inspect] addEventListener:';
            info += ' type=' + type;
            info += ' target=' + (target && target.tagName ? target.tagName : String(target));
            info += ' options=' + (typeof options === 'object' ? JSON.stringify(options) : String(options));
            if(window.console && window.console.info){
                window.console.info(info);
                if(stack) window.console.info(stack);
            }
        }
        return origAdd.apply(this, arguments);
    };
})();
