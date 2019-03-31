tinymce.PluginManager.add('mediapicker', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('add', {
      text: 'Add',
      icon: 'fa fa-plus-o',
      onclick: function() {
        // Open window
        editor.windowManager.open({
          title: 'Example plugin',
          body: [
            {type: 'textbox', name: 'title', label: 'Title'}
          ],
          onsubmit: function(e) {
            // Insert content when the window form is submitted
            editor.insertContent('Title: ' + e.data.title);
          }
        });
      }
    });
  
    // Adds a menu item to the tools menu
    editor.addMenuItem('mediapicker', {
      text: 'Add Media',
      icon : 'fa fa-plus',
      context: 'tools',
      onclick: function() {
        // Open window with a specific url
        editor.windowManager.open({
          title: 'TinyMCE site',
          url: 'https://www.tinymce.com',
          width: 800,
          height: 600,
          buttons: [{
            text: 'Close',
            onclick: 'close'
          }]
        });
      }
    });
  
    return {
      getMetadata: function () {
        return  {
          name: "Mediapicker",
          url: "http://exampleplugindocsurl.com"
        };
      }
    };
  });
  