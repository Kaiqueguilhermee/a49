// touch-listener-inspect.js
// Versao ultra-simples para evitar qualquer erro de sintaxe ou codificacao.
(function(){
    if (window.location.search.indexOf('dbg_touch=1') === -1) return;
    var origAdd = EventTarget.prototype.addEventListener;
    var tipos = ['touchstart','touchmove','touchend','touchcancel','pointerdown','pointermove','pointerup','pointercancel','mousedown','mousemove','mouseup','click','dragstart','drag','dragend'];
    EventTarget.prototype.addEventListener = function(tipo, listener, opcoes){
        if(tipos.indexOf(tipo) !== -1){
            if(window.console && window.console.info){
                window.console.info('[touch-listener-inspect] tipo=' + tipo);
            }
        }
        return origAdd.apply(this, arguments);
    };
})();
