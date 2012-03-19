var spinner = '<div class="spinner"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div><div class="bar7"></div><div class="bar8"></div><div class="bar9"></div><div class="bar10"></div><div class="bar11"></div><div class="bar12"></div></div>';
var spinner_create = '<div class="spinner_create"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div><div class="bar7"></div><div class="bar8"></div><div class="bar9"></div><div class="bar10"></div><div class="bar11"></div><div class="bar12"></div></div>';
var jPlayer_id = 0;

function onAjaxStart(){
  if(activeRequests <= 0){
    $('#submit_bottol').attr('disabled', 'disabeld');
    $('#submit_bottol').css('color', '#888');
    $('#loading_resources').html(spinner_create);
  }
  activeRequests++;
}

function onAjaxEnd(){
  activeRequests--;
  if(activeRequests <= 0){
    $('#submit_bottol').removeAttr('disabled');
    $('#submit_bottol').css('color', 'green');
    $('#loading_resources').html('');
  }
}


function handleFileSelect(evt, actual_drop_zone) {
  evt.stopPropagation();
  evt.preventDefault();

  if(evt.dataTransfer==undefined) {
    var files = evt.target.files;
  } else {
    var files = evt.dataTransfer.files;
  }

  for (var i = 0, f; f = files[i]; i++) {

    // IMPORT IMAGE

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
              onAjaxStart();
              actual_drop_zone.html('<div class="uploading_status">'+spinner + '<div class="percentLoaded"></div></div>');
              actual_drop_zone.find('.percentLoaded').html('Creating preview...');
            },
            success: function(data){
              actual_drop_zone.html(['<div class="submenu_image"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" title="Add these image formats: jpeg, jpg, png, gif, bmp, tiff. Max size 5 MB." class="show_image_types"/></div><div class="dropped_div"><img class="dropped_img" src="', 'data:image/', f.type, ';base64,', data, '" title="', f.name, '"/></div>'].join(''));
              actual_drop_zone.addClass('content_inserted');
              actual_drop_zone.find('.show_image_types').tooltip({effect: 'slide'});
              saveImage(f, actual_drop_zone);
            },
            statusCode: {
              200: function() {
                onAjaxEnd();
              }
            }
        });
        break;
      }

      // If browser supports FileReader

      var reader = new FileReader();
      //shows a spinner
      reader.onloadstart = function(e) {
        //actual_drop_zone.find('.message').html(spinner + '<div class="percentLoaded"></div>');
        onAjaxStart();
        actual_drop_zone.html(spinner + '<div class="percentLoaded"></div>');
      };
      reader.onprogress = function(e) {
        actual_drop_zone.find('.percentLoaded').html(Math.round((e.loaded / e.total) * 100) + '%');
      };
      reader.onload = (function(theFile) {
        return function(e) {
          var dropArea = actual_drop_zone;
          dropArea.html(['<div class="submenu_image"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" title="Add these image formats: jpeg, jpg, png, gif, bmp, tiff. Max size 5 MB." class="show_image_types"/></div></div><div class="dropped_div"><img class="dropped_img" src="', e.target.result, '" title="', escape(theFile.name), '"/></div>'].join(''));
          actual_drop_zone.addClass('content_inserted');
          actual_drop_zone.find('.show_image_types').tooltip({effect: 'slide'});
          onAjaxEnd();
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);

      saveImage(f, actual_drop_zone);
    }

    // IMPORT DOCUMENT

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
          url: 'saveTemp.php',
          data: form,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          beforeSend: function(){
            onAjaxStart();
            actual_drop_zone.html('<div class="uploading_status">'+spinner + '<div class="percentLoaded"></div></div>');
            actual_drop_zone.find('.percentLoaded').html('Creating preview...');
          },
          success: function(urlToGDocs){
            actual_drop_zone.html('<div class="submenu_document"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" title="Add these document types: pdf, doc, docx, ppt, pptx, pps. Max size 5 MB." class="show_document_types"/></div><div class="dropped_div"><input type="hidden" class="document_path" value="'+urlToGDocs+'"/><iframe id="document_frame" src="http://docs.google.com/gview?url='+escape(urlToGDocs)+'&embedded=true" style="width:100%; height:600px;" frameborder="0"></iframe></div>');
            actual_drop_zone.addClass('content_inserted');
            actual_drop_zone.find('.show_document_types').tooltip({effect: 'slide'});
          },
          statusCode: {
            200: function() {
              onAjaxEnd();
            }
          }
      });
    }

    // IMPORT AUDIO FILE

    if (actual_drop_zone.hasClass("audio")) {
      if (!f.type.match('audio\/(mpeg|mp4|x-m4a|mp3)')) {
        actual_drop_zone.find('.message').html('<p class="warning_img">Only MP3 and M4A can be uploaded!<strong>');
        break;
      }
      if (f.size > 10485760) {
        actual_drop_zone.find('.message').html('<p class="warning_img">Max audio file size: 10MB<strong>');
        break;
      }

      var form = new FormData();
      form.append('file', f);
      form.append('name', f.name);
      $.ajax({
          url: 'saveTemp.php',
          data: form,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          beforeSend: function(){
            onAjaxStart();
            actual_drop_zone.html('<div class="uploading_status">'+spinner + '<div class="percentLoaded"></div></div>');
            actual_drop_zone.find('.percentLoaded').html('Creating preview...');
          },
          success: function(urlToSend){
            jPlayer_id++;
            var menu_audio = '<div class="submenu_audio"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" title="Add these audio formats: mp3, m4a. Max size 10 MB." class="show_audio_types"/></div>';
            var jplayer_audio = '<div id="jquery_jplayer_'+jPlayer_id+'" class="jp-jplayer"></div><div id="jp_container_'+jPlayer_id+'" class="jp-audio"><div class="jp-type-single"><div class="jp-gui jp-interface"><ul class="jp-controls"><li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li><li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li><li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li><li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li><li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li><li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li></ul><div class="jp-progress"><div class="jp-seek-bar"><div class="jp-play-bar"></div></div></div><div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div><div class="jp-time-holder"><div class="jp-current-time"></div><div class="jp-duration"></div><ul class="jp-toggles"><li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li><li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li></ul></div></div><div class="jp-title"><ul><li>'+f.name+'</li></ul></div><div class="jp-no-solution"><span>Update Required</span>To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.</div></div></div>'; 
            actual_drop_zone.html(menu_audio+'<div class="dropped_div"><input type="hidden" class="audio_path" value="'+urlToSend+'"/>'+jplayer_audio+'</div>');
                        
            actual_drop_zone.addClass('content_inserted');
            actual_drop_zone.find('.show_audio_types').tooltip({effect: 'slide'});

            var extAudioArray = urlToSend.split('.');
            var extAudio = extAudioArray[extAudioArray.length-1];

            $("#jquery_jplayer_"+jPlayer_id).jPlayer({
              ready: function () {
              switch (extAudio) {
                case 'mp3':
                  $(this).jPlayer("setMedia", {
                    mp3: urlToSend
                  });
                  break;
                case 'm4a':
                  $(this).jPlayer("setMedia", {
                    m4a: urlToSend
                  });
                  break;
              }
              },
              cssSelectorAncestor: "#jp_container_"+jPlayer_id,
              swfPath: "js/jQuery.jPlayer.2.1.0",
              solution: 'html, flash', 
              supplied: "mp3, m4a",
              wmode: "window"
            });
            $("#jquery_jplayer_"+jPlayer_id).bind($.jPlayer.event.play, function() {
              $(this).jPlayer("pauseOthers");
            });
          },
          statusCode: {
            200: function() {
              onAjaxEnd();
            }
          }
      });
      break;
    }

    // IMPORT FILE ATTACHMENT

    if (actual_drop_zone.hasClass("file")) {
      if (!f.type.match('application.*')) {
        actual_drop_zone.find('.message').html('<p class="warning_img">You can\'t upload this file type!<strong>');
        break;
      }
      if (f.size > 10485760) {
        actual_drop_zone.find('.message').html('<p class="warning_img">Max file size: 10MB<strong>');
        break;
      }

      var extArray = f.name.split('.');
      var ext = extArray[extArray.length-1];

      var form = new FormData();
      form.append('file', f);
      form.append('name', f.name);
      $.ajax({
          url: 'saveTemp.php',
          data: form,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          beforeSend: function(){
            onAjaxStart();
            actual_drop_zone.html('<div class="dropped_div"><div class="attachment_info"><p class="extension">'+ext+'</p><img class="file_icon" src="img/file_icon_lightblue.png"/></div><p><strong>'+escape(f.name)+'</strong> - '+format_bytes(f.size)+'</p>'+spinner_create+'</div>');
          },
          success: function(urlToSend){
            actual_drop_zone.html('<div class="submenu_file"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" title="Attach whatever you want! zip, rar, pdf, doc, xls, ppt, etc. Max size 10 MB." class="show_file_types"/></div><div class="dropped_div"><input type="hidden" class="file_path" value="'+urlToSend+'"/><div class="attachment_info"><p class="extension">'+ext+'</p><img class="file_icon" src="img/file_icon_lightblue.png"/></div><p><strong>'+escape(f.name)+'</strong> - '+format_bytes(f.size)+'</p></div>');
            actual_drop_zone.addClass('content_inserted');
            actual_drop_zone.find('.show_file_types').tooltip({effect: 'slide'});
          },
          statusCode: {
            200: function() {
              onAjaxEnd();
            }
          }
      });
      break;
    }
  }
}

function saveImage(file, actual_drop_zone){
  var sendForm = new FormData();
  sendForm.append('file', file);
  sendForm.append('name', file.name);
  $.ajax({
    url: 'saveTemp.php',
    data: sendForm,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    beforeSend: onAjaxStart(),
    success: function(urlToSend){
      actual_drop_zone.find('.img_path').remove();
      actual_drop_zone.append('<input type="hidden" class="img_path" value="'+urlToSend+'"/>');
    },
    statusCode: {
      200: function() {
        onAjaxEnd();
      }
    }
  });
}

function handleDragOver(evt, actual_drop_zone) {
  evt.stopPropagation();
  evt.preventDefault();
  evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
}

function format_bytes(size) {
    if (size < 1024) {
        return size +' Bytes';
    } else if (size < 1048576) {
        return Math.round(size / 1024, 2) +' KB';
    } else if (size < 1073741824) {
        return Math.round(size / 1048576, 2) +' MB';
    } else if (size < 1099511627776) {
        return Math.round(size / 1073741824, 2) +' GB';
    } else if (size < 1125899906842624) {
        return Math.round(size / 1099511627776, 2) +' TB';
    } else if (size < 1152921504606846976) {
        return Math.round(size / 1125899906842624, 2) +' PB';
    } else if (size < 1180591620717411303424) {
        return Math.round(size / 1152921504606846976, 2) +' EB';
    } else if (size < 1208925819614629174706176) {
        return Math.round(size / 1180591620717411303424, 2) +' ZB';
    } else {
        return Math.round(size / 1208925819614629174706176, 2) +' YB';
    }
}

// Setup the drag and drop and input button listeners.

var dropZone = $('.drop_zone');
dropZone.live('dragover', function(event){
  handleDragOver(event.originalEvent, $(this));
});
dropZone.live('drop', function(event){
  handleFileSelect(event.originalEvent, $(this));
});
$('.input_file').live('change', function(event){
  handleFileSelect(event.originalEvent , $(this).parent().parent().parent());
});