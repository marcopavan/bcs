
  function handleFileSelect(evt, actual_drop_zone) {
    evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.

    // files is a FileList of File objects. List some properties.

    for (var i = 0, f; f = files[i]; i++) {
      if (!f.type.match('image.*')) {
        actual_drop_zone.find('.message').html('<p class="warning_img">Only image file can be uploaded!<strong>');
        break;
      }
      var reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
          // Render dropped image.
          var dropArea = actual_drop_zone;
          dropArea.html(['<div class="dropped_div"><img class="dropped_img" src="', e.target.result, '" title="', escape(theFile.name), '"/></div>'].join(''));
          actual_drop_zone.addClass('img_added');
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  function handleDragOver(evt, actual_drop_zone) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
  }

  // Setup the drag and drop listeners.
  var dropZone = $('.drop_zone');
  dropZone.live('dragover', function(event){
    handleDragOver(event.originalEvent, $(this));
  });
  dropZone.live('drop', function(event){
    handleFileSelect(event.originalEvent, $(this));
  });

  