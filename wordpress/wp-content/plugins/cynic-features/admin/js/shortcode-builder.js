(function($) {
    var formView = Backbone.View.extend({
        el: '#cc_shortcode_builder_form',
        shortcode: false,
	events: {
            'submit' : 'buildShortcode',
            'click #form_left_box a' : 'buildForm',
            'click .media_upload_button' : 'wpMediaLoad',
        },
        initialize: function(){
            this.render();
        },
        render: function(){
            var leftbox = this.$el.find('#form_left_box');
            if(leftbox.find('ul').length < 1){
                leftbox.append('<ul></ul>');
            }
            var list = leftbox.find('ul');
            $.each(cc_shortcodes_params, function(shortcodeid, params){
                var $html = '<li>';
                $html += '<a href="#" data-shortcode="'+shortcodeid+'">'+params.name+'</a>';
                list.append($html+'</li>');
            });
            
        },
        buildShortcode: function(e){
            e.preventDefault();
            var $formdata = this.$el.serializeArray();
            var $newshortcodestart = '['+this.shortcode;
            var $newshortcodeend = '[/'+this.shortcode+']';
            var $content = '';
            $.each($formdata, function(k, $input){
                if($input.name == 'content'){
                    // middle content between shortcode will generate from here.
                    $content = $input.value;
                }else{
                    $newshortcodestart += ' '+$input.name+'="'+$input.value+'"';
                }
            });
            $newshortcodestart += ']';
            var $finalshortcode = $newshortcodestart+$content+$newshortcodeend;
            parent.tinymce.activeEditor.selection.setContent($finalshortcode);
            parent.tinymce.activeEditor.windowManager.close();
            return false;
        },
        ucfirst: function(text){
            return text.charAt(0).toUpperCase() + text.slice(1);
        },
        buildForm: function(e){
            e.preventDefault();
            var key = e.target.getAttribute('data-shortcode');
            this.shortcode = key;
            var $shortcode = cc_shortcodes_params[key];
            var $this = this;
            if($shortcode != 'undefined'){
                var $html = '<h3>'+$shortcode.name+'</h3>';
                $.each($shortcode.fields, function(n, param){
                    //console.log($this.ucfirst(param.type))
                    $html += $this['build'+$this.ucfirst(param.type)].call($this, param);
                });
                $html += '<div class="form-group"><button type="submit" class="btn btn-primary">Insert Shortcode</button></div>';
                $this.$el.find('#form_cont_box').html($html);
                eval; // run custom script codes.
            }
            //console.log(this.$el.find('#form_left_box'));
        },
        buildAutosuggest: function(param){
            var $html = '<div class="form-group">';
            $html += '<label>'+param.label+'</label>';
            $html += '<div class="cc_autocomplete_main">';
            $html += '<div class="cc_autocomplete_holder">';
            $html += '<input type="text" class="cc_autocomplete form-control" data-min-chars="'+param.min_chars+'" data-multiple="'+param.multiple+'" data-type="post" data-types="'+param.items.post_types+'" placeholder="Type characters to get results" />';
            $html += '</div>';
            $html += '<input type="hidden" class="cc_autocomplete_hidden" name="'+param.name+'" id="'+param.name+'" value="'+param.value+'" />';
            $html += '</div>';
            $html += '</div>';
            return $html;
        },
        buildIconfonts: function(param){
            var $value = JSON.parse(cc_font_awesome);
            var $html = '<div class="form-group">';
            $html += '<label>'+param.label+'</label>';
            $html += '<select class="form-control" name="'+param.name+'" id="'+param.name+'">';
            if($value)
                $.each($value, function(key, val){
                    var $selected = '';
                    if(val == param.value && param.value){
                        $selected += ' selected="selected"';
                    }
                    $html += '<option'+$selected+' value="'+val+'">'+val+'</option>';
                });
            $html += '</select>';
            $html += '</div>';
            return $html;
        },
        buildText: function(param){
            var $html = '<div class="form-group">';
            $html += '<label>'+param.label+'</label>';
            $html += '<input type="text" class="form-control" name="'+param.name+'" id="'+param.name+'" value="'+param.value+'" />';
            $html += '</div>';
            return $html;
        },
        buildTextarea: function(param){
            var $html = '<div class="form-group">';
            $html += '<label>'+param.label+'</label>';
            $html += '<textarea class="form-control" name="'+param.name+'" id="'+param.name+'">'+param.value+'</textarea>';
            $html += '</div>';
            return $html;
        },
        wpMediaLoad: function(event){
            var $ = jQuery;

            // Set all variables to be used in scope
            var frame,
                metaBox = $(event.target), // Your meta box id here
                imgContainer = metaBox.closest( '.form-group'),
                imgIdInput = imgContainer.find('input[type="hidden"]');

            // ADD IMAGE LINK
            
            event.preventDefault();

              // If the media frame already exists, reopen it.
            if ( frame ) {
                frame.open();
                return;
            }

              // Create a new media frame
            frame = wp.media({
                title: 'Select or Upload Media Of Your Chosen Persuasion',
                button: {
                  text: 'Use this media'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });


              // When an image is selected in the media frame...
            frame.on( 'select', function() {
                
                imgContainer.find('img').remove();  

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                imgContainer.append( '<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );

                // Send the attachment id to our hidden input
                imgIdInput.val( attachment.id );

            });

            // Finally, open the modal on click
            frame.open();
            
  
        },
        buildImage: function(param){
            var $html = '<div class="form-group">';
            $html += '<label>'+param.label+'</label><br />';
            $html += '<input type="hidden" name="'+param.name+'" id="'+param.name+'" value="'+param.value+'" />';
            $html += '<button type="button" class="media_upload_button '+param.name+'_upload">Set Image</button>';
            $html += '</div>';
            return $html;
        },
        buildColor: function(param){
            var $html = '<div class="form-group">';
            $html += '<label>'+param.label+'</label><br />';
            $html += '<input type="text" data-default-color="'+param.value+'" placeholder="Hex Value" maxlength="7" class="color-picker-hex wp-color-picker" name="'+param.name+'" id="'+param.name+'" value="'+param.value+'" />';
            $html += '</div>';
            $html += '<script type="text/javascript">'+"\n"
            +'jQuery("#'+param.name+'").wpColorPicker();'+"\n"
            +'</script>';
            return $html;
        },
        buildSelect: function(param){
            var $html = '<div class="form-group">';
            $html += '<label>'+param.label+'</label>';
            $html += '<select class="form-control" name="'+param.name+'" id="'+param.name+'">';
            if(param.value)
                $.each(param.value, function(val, key){
                    $html += '<option value="'+key+'">'+val+'</option>';
                });
            $html += '</select>';
            $html += '</div>';
            return $html;
        }
    });
    $(document).ready(function(){
       var $fview = new formView;
    });
})(jQuery);