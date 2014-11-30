(function($) {
    'use strict';
    $.fn.autoSize = function(params) {
        params = $.extend({}, {minHeight: '2em', maxHeight: '10000px', callback: false, cloneClass: 'autosize-textarea-mirror'}, params);

        return this.each(function() {

            var $mirror = createMirror(this),
                mirror = $mirror[0],
                textarea = this,
                $textarea = $(this),
                maxHeight =  parseInt(params.maxHeight,10);

            mirror.style.padding    = $textarea.css('padding');
            mirror.style.width      = $textarea.css('width');
            mirror.style.fontFamily = $textarea.css('font-family');
            mirror.style.fontSize   = $textarea.css('font-size');
            mirror.style.lineHeight = $textarea.css('line-height');
            mirror.style.fontWeight = $textarea.css('font-weight');

            // Style the textarea
            textarea.style.overflow = "hidden";
            textarea.style.minHeight = params.minHeight;
            textarea.style.resize = "none";

            //Internet Explorer versions prior to 9 do not support the "input" event & addEventListener function.
            if(msieversion() < 9) {
                this.onkeyup = autoSize;
            } else {
                this.addEventListener('input', autoSize);
            }

            // Fire the event for text already present
            sendContentToMirror(this);



            function createMirror() {
                var element = $('<div style="display:none;white-space:pre-wrap;word-wrap:break-word;overflow:hidden;overflow-wrap:break-word;"></div>').addClass(params.cloneClass);
                $('body').append(element);
                return element;
            }

            function sendContentToMirror() {
                //Convert special characters, add extra line for padding.
                mirror.innerHTML =  htmlentities(textarea.value)+ '.<br/>.';
            }

            function autoSize() {
                sendContentToMirror();
                if ($textarea.height() != $mirror.height()) {
                    if($mirror.height() > maxHeight) {
                        textarea.style.overflow = 'auto';
                        textarea.style.height = params.maxHeight;
                    } else {
                        $textarea.height($mirror.height());
                        textarea.style.overflow = 'hidden';
                    }

                }
                if(typeof params.callback == 'function') {
                    params.callback();
                }
            }

        });
        function htmlentities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;')
                .replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\n/g, '<br />');
        }
        function msieversion()
        {
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf ("MSIE ");

            if (msie > 0)      // If Internet Explorer, return version number
                return parseInt (ua.substring (msie+5, ua.indexOf (".", msie )));
            else                 // If another browser, return 0
                return 0;

        }
    };

}(jQuery));