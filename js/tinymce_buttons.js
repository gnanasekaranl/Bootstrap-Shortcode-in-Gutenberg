(function() {
    tinymce.PluginManager.add( 'bootstrapshortcode', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('bootstrapshortcode', {
            title: 'Insert Column',
            cmd: 'bootstrapshortcode',
            image: url + '/icon-bootstrap.png',
        });
 
        editor.addCommand('bootstrapshortcode', function() {
            //trigger bootstrap shortcodes help modal
            jQuery('#bootstrap-shortcodes-help').modal('show');
            return;
        });
 
    });
})();
