
  function handleFileSelect(evt, actual_drop_zone) {
    evt.stopPropagation();
    evt.preventDefault();

    var files = evt.dataTransfer.files; // FileList object.

    // files is a FileList of File objects. List some properties.

    for (var i = 0, f; f = files[i]; i++) {
      if (actual_drop_zone.hasClass("image")) {
        if (!f.type.match('image.*')) {
        actual_drop_zone.find('.message').html('<p class="warning_img">Only images can be uploaded!<strong>');
        break;
        }
        if (f.size > 5242880) {
          actual_drop_zone.find('.message').html('<p class="warning_img">Max image size: 5MB<strong>');
          break;
        }

        if(!window.FileReader){
          var form = new FormData();
          form.append('file', f);
          $.ajax({
              url: 'getBase64.php',
              data: form,
              cache: false,
              contentType: false,
              processData: false,
              type: 'POST',
              beforeSend: function(){
                //actual_drop_zone.find('.message').html(spinner);
                actual_drop_zone.html(spinner);
                actual_drop_zone.html(spinner + '<div class="percentLoaded"></div>');
                actual_drop_zone.find('.percentLoaded').html('Creating preview...');
              },
              success: function(data){
                var dropArea = actual_drop_zone;
                dropArea.html(['<div class="dropped_div"><img class="dropped_img" src="', 'data:image/', f.type, ';base64,', data, '" title="', f.name, '"/></div>'].join(''));
                actual_drop_zone.addClass('img_added');
              }
          });
          break;
        }
        var reader = new FileReader();
        //shows a spinner
        reader.onloadstart = function(e) {
          //actual_drop_zone.find('.message').html(spinner + '<div class="percentLoaded"></div>');
          actual_drop_zone.html(spinner + '<div class="percentLoaded"></div>');
        };
        //change percentage
        reader.onprogress = function(e) {
          actual_drop_zone.find('.percentLoaded').html(Math.round((e.loaded / e.total) * 100) + '%');
        };
        //loads image anteprima
        reader.onload = (function(theFile) {
          return function(e) {
            // Render dropped image.
            var dropArea = actual_drop_zone;
            //dropArea.html('pippa');
            dropArea.html(['<div class="dropped_div"><img class="dropped_img" src="', e.target.result, '" title="', escape(theFile.name), '"/></div>'].join(''));
            actual_drop_zone.addClass('img_added');
          };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
      }

      if (actual_drop_zone.hasClass("document")) {
        if (!f.type.match('application.*')) {
        actual_drop_zone.find('.message').html('<p class="warning_img">Only documents can be uploaded!<strong>');
        break;
        }
        if (f.size > 5242880) {
          actual_drop_zone.find('.message').html('<p class="warning_img">Max document size: 5MB<strong>');
          break;
        }
      

        var form = new FormData();
        form.append('file', f);
        form.append('name', f.name);
        $.ajax({
            url: 'tmp/saveTemp.php',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            beforeSend: function(){
              actual_drop_zone.html(spinner);
              actual_drop_zone.html(spinner + '<div class="percentLoaded"></div>');
              actual_drop_zone.find('.percentLoaded').html('Creating preview...');
            },
            success: function(urlToGDocs){
              actual_drop_zone.html('<div class="dropped_div"><iframe id="document_frame" src="http://docs.google.com/gview?url='+escape(urlToGDocs)+'&embedded=true" style="width:100%; height:600px;" frameborder="0"></iframe></div>');
              actual_drop_zone.addClass('img_added');
            }
        });
      }
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


var spinner = '<div class="spinner"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div><div class="bar7"></div><div class="bar8"></div><div class="bar9"></div><div class="bar10"></div><div class="bar11"></div><div class="bar12"></div></div>';
  