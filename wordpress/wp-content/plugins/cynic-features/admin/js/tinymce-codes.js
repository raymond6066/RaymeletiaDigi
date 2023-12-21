(function() {
     /* Register the buttons */
     tinymce.create('tinymce.plugins.Hoper', {
          init : function(ed, url) {
               /**
               * Inserts shortcode content
               */
               ed.addButton( 'hoper_button', {
                    title : 'Insert shortcode',
                    icon : 'wp_code',
                    onclick : function() {
                         
                        ed.windowManager.open({
                           url : ajaxurl+'?action=century_load_shortcodes',
                           width : jQuery(window).width(),
                           height : jQuery(window).height()
                        }, {
                           custom_param : 1
                        });

                    }
               });
          },
          createControl : function(n, cm) {
               return null;
          },
     });
     /* Start the buttons */
     tinymce.PluginManager.add( 'hoper_shortcodes', tinymce.plugins.Hoper );
})();