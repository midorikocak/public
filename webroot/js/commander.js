function selectElement(element) {
    if (window.getSelection) {
        var sel = window.getSelection();
        sel.removeAllRanges();
        var range = document.createRange();
        range.selectNodeContents(element);
        sel.addRange(range);
    } else if (document.selection) {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(element);
        textRange.select();
    }
}

jQuery.fn.selectText = function(){
    var doc = document
        , element = $(this).get(0)
        , range, selection
    ;
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }
};

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
  selectImage();
});

function selectImage(){
  $('.ql-editor img').click(function(){
    //selectElement($( this ).get( 0 ));
    $( this ).selectText();
    editor.setSelection(editor.getSelection().start,editor.getSelection().start+1);
  });
}

editor.on('text-change', function(delta, source) {
  $('input#body').val(editor.getHTML());
  selectImage();
});

var fileDrop = new Dropzone(".preview", {
  url: "http://localhost/public/articles/addImage",
  init: function() {
    this.on("success", function(file,response) {
      $('.ql-image-tooltip input').val(response.response);

      editor.getModule('image-tooltip').insertImage();
      selectImage();
       });
  },
  previewTemplate: document.querySelector('#preview-template').innerHTML,
  createImageThumbnails: false,
  addRemoveLinks: false
  });
