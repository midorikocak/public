// Implement and register module
Quill.registerModule('counter', function(quill, options) {
  var container = document.querySelector('#counter');
  quill.on('text-change', function() {
    var text = quill.getText();
    // There are a couple issues with counting words
    // this way but we'll fix these later
    container.innerHTML = text.split(/\s+/).length;
  });
});

var editor = new Quill('#toolbar-editor', {
  modules: {
    toolbar: { container: '#toolbar-toolbar' },
    'link-tooltip': true,
    'image-tooltip': true
  },
  theme: 'snow'
});

$(window).load(function() {
  editor.setHTML($('input#body').val());
});

editor.on('text-change', function(delta, source) {
  $('input#body').val(editor.getHTML());
});
