(function() {
	tinymce.PluginManager.add('bfn_button_plugin', function( editor, url ) {

		editor.addButton('bfn', {
			title: 'Reference note',
			tooltip: 'Reference note',
			image: url + '/note_id.png',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Reference note',
					body: [ {
						type: 'textbox',
						name: 'note_id',
						label: 'Insert number note',
						value: ''
					} ],
					onsubmit: function( e ) {
						note_id='[^' + e.data.note_id +']';
						editor.insertContent( note_id );
					}
				});
			}
		});
		
		editor.addButton('bfn_note', {
			title: 'Note',
			tooltip: 'Note',
			image: url + '/note_content.png',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Note',
					body: [ {
						type: 'textbox',
						name: 'note_id',
						label:'Insert number note',
						value: ''
					} ],
					onsubmit: function( e ) {
						note_id='[^' + e.data.note_id +']:';
						editor.insertContent( note_id );
					}
				});
			}
		});
			
	});
})();
