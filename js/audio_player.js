  var actual_audio = -1;

  var manualSeek , loaded, player, audio;

  function audioInit(){
    actual_audio = player.attr('rel');
    audio = player.find('audio').get(0);
    loadingIndicator = player.find('.loading');
    positionIndicator = player.find('.handle');
    timeleft = player.find('.timeleft');


    if ((audio.buffered != undefined) && (audio.buffered.length != 0)) {
      $(audio).bind('progress', function() {
      var loaded = parseInt(((audio.buffered.end(0) / audio.duration) * 100), 10);
      loadingIndicator.css({width: loaded + '%'});
      });
    }
    else {
      loadingIndicator.remove();
    }

    $(audio).bind('timeupdate', function() {
    
      var rem = parseInt(audio.duration - audio.currentTime, 10),
      pos = (audio.currentTime / audio.duration) * 100,
      mins = Math.floor(rem/60,10),
      secs = rem - mins*60;

      timeleft.text('-' + mins + ':' + (secs > 9 ? secs : '0' + secs));
      if (!manualSeek) { positionIndicator.css({left: pos + '%'}); }
      if (!loaded) {
        loaded = true;

        $('.player .gutter').slider({
          value: 0,
          step: 0.01,
          orientation: 'horizontal',
          range: 'min',
          max: audio.duration,
          animate: true,          
          slide: function() {             
            manualSeek = true;
          },
          stop:function(e,ui) {
            manualSeek = false;         
            audio.currentTime = ui.value;
          }
        });
      }

    });



    $(audio).bind('play',function() {
      player.find('.playtoggle').addClass('playing');
      player.find('.playtoggle').css('background-image', "url('img/pause.png')"); 
    }).bind('pause ended', function() {
      player.find('.playtoggle').removeClass('playing');    
      player.find('.playtoggle').css('background-image', "url('img/play.png')");
    });
  } 

  $('.playtoggle').live('click', function() {
    if($(this).closest('.player').attr('rel') != actual_audio){
      if(audio != undefined && !audio.paused){
        audio.pause();
        player.find('.playtoggle').removeClass('playing');    
        player.find('.playtoggle').css('background-image', "url('img/play.png')");
      }
      player = $(this).closest('.player');
      audioInit();
    }
    if(audio.paused) audio.play();
    else audio.pause();
  });