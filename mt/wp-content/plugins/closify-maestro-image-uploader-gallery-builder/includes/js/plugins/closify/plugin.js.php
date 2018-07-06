<?php
  
// Act as a javascript file
header('Content-Type: application/javascript');

?>

var my_editor = null;
console.log(my_plugin.url);
tinymce.PluginManager.add('closify', function(editor) {

    my_editor = editor;

	my_editor.addCommand('OpenClosifyWindow', function() {
		// editor.execCommand('mceInsertContent', false, '<div>hello</div>');
        my_editor.windowManager.open({
            title: 'Generate Closify Shortcode',
            url: my_plugin.url,
            width: 650,
            height: 500,
            buttons: [{
                text: 'Close',
                onclick: 'close',
            }]
            },{
              post_type: 'closify'
          });
	});

	my_editor.addButton('closify', {
		icon: 'closify icon dashicons-wordpress',
		tooltip: 'Closify Gallary Builder',
		cmd: 'OpenClosifyWindow'
	});

	my_editor.addMenuItem('closify', {
		icon: 'closify icon dashicons-wordpress',
		text: 'Closify Gallary Builder',
		cmd: 'OpenClosifyWindow',
		context: 'insert'
	});
});

function insert_data(data){

    my_editor.selection.setContent(data);
}