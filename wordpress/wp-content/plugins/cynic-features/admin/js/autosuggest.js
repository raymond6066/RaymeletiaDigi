/**
 * @abstract autosuggest field script
 */

(function($){
    $(document).ready(function(){
        $(document.body).on('keyup', '.cc_autocomplete_main .cc_autocomplete', function(e){
            e.preventDefault();
            //console.log(e.type);
            var elem = $(this);
            var minchars = parseInt(elem.attr('data-min-chars'));
            var multiple = elem.attr('data-multiple');
            var type = elem.attr('data-type');
            var types = elem.attr('data-types');
            setTimeout(function(){
                if(elem.val().length >= minchars){
                    var data = {action: "cc_autocomplete_search", q: elem.val(), type: type, types: types};
                    $.ajax({
                        url: ajaxurl,
                        data: data,
                        dataType: "json",
                        method: "POST",
                        success: function(response){
                            var listarea = elem.closest('.cc_autocomplete_holder').find('ul.cc-query-list');
                            if(listarea.length > 0){
                                listarea.remove();
                            }
                            if(response.length > 0){   
                                listarea = $('<ul class="cc-query-list"/>').appendTo(elem.closest('.cc_autocomplete_holder'));
                                $.each(response, function(k,v){
                                    listarea.append('<li data-id="'+v.id+'">'+v.title+'</li>');
                                });
                            }
                        }
                    });
                }
            },300);  
        });
        //$(document.body).on('mouseleave blur', '.cc_autocomplete_holder', function(){
        $(document.body).on('mouseleave', '.cc_autocomplete_holder', function(e){
            
            var y = e.clientY;
            
//            var boxsize = $(this).offset().top - $(this).closest('.media-modal.wp-core-ui').offset().top;
            var boxsize = $(this).offset().top - $(this).closest('.form-group').offset().top;
            boxsize += $(this).outerHeight(true);
            
            if(y > boxsize){
                $(this).find('.cc-query-list').remove();
            }
        });
        $(document.body).on('click', '.cc-query-list li', function(){
            var elem = $(this);
            var id   = elem.attr('data-id');
            var title= elem.html();
            var main = elem.closest('.cc_autocomplete_main');
            var multiple = main.find('.cc_autocomplete').attr('data-multiple');
            var maininput = main.children('input.cc_autocomplete_hidden');
            if(multiple == 1){
                var newval = handleMultiple(maininput.val().split(','), id);
                maininput.val(newval.join(','));
                main.append('<span class="cc_autocomplete_item" data-id="'+id+'">'+title+'<span class="cc_autocomplete_close">&times;</span></span>');
            }else{
                maininput.val(id);
                main.find('span.cc_autocomplete_item').remove();
                main.append('<span class="cc_autocomplete_item" data-id="'+id+'">'+title+'<span class="cc_autocomplete_close">&times;</span></span>');
            }
            elem.closest('.cc-query-list').remove();
        });
        $(document.body).on('click', '.cc_autocomplete_close', function(){
            var elem = $(this).parent();
            var main = elem.closest('.cc_autocomplete_main');
            var maininput = main.children('input.fw-option-type-autosuggest');
            var vals = maininput.val().split(',');
            var selected = elem.attr('data-id');
            if(typeof vals[vals.indexOf(selected)] != 'undefined'){
                var $index = vals.indexOf(selected);
                vals.splice($index, 1);
                maininput.val(vals.join(','));
            }
            elem.remove();
        });
        var handleMultiple = function(arr, val){
            arr.push(val);
            return arr;
        };
    }); 
})(jQuery);