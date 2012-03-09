var modifyer = '<div class="modify"><img class="remove" src="img/close.png"/><div class="mod_controls"><img class="move_up" src="img/up.png"/><img class="move_down" src="img/down.png"/></div></div><div class="edit_block"><p>edit</p><div></div></div>';

var shifter = '<div class="shift_remove_item"><div><img class="move_left" src="img/left.png"/><img class="reset_item" src="img/remove.png"/><img class="move_right" src="img/right.png"/></div></div>';
var onlyShift = '<div class="shift_item"><div><img class="move_left" src="img/left.png"/><img class="move_right" src="img/right.png"/></div></div>';
var remover = '<div class="remove_item"><img class="reset_item" src="img/remove.png"/></div>';

var resizeControls = '<div class="resize_controls"><p rel="small">S</p><p rel="medium">M</p><p rel="large">L</p><p class="selected" rel="largest">XL</p></div>';

var inputs = '<input type="hidden" name="component_position" class="element_data"/><input type="hidden" name="template_id" class="element_data"/><input type="hidden" name="resource_position" class="element_data"/><input type="hidden" name="resource_type" class="element_data"/><input type="hidden" name="resource" class="element_data"/>';

var small = '<div class="small">'+onlyShift+'<a class="new_add_menu"href="#hidden_menu"><p class="message_layout"></p></a>'+inputs+'</div>';
var medium = '<div class="medium">'+onlyShift+'<a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a>'+inputs+'</div>';
var large = '<div class="large">'+onlyShift+'<a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a>'+inputs+'</div>';
var largest = resizeControls+'<div class="largest resize"><a class="new_add_menu" href=""><p class="message_layout"></p></a>'+inputs+'</div>';

function add(index, content, before){
        before = before && !(before == null);
        if(index != null && index < 0) index = 0;
        var max = $('.block').size();
        if(index != null && index == 'first') index = 0;
        if(index != null && index == 'last') index = null;
        if(index != null && index > max - 1) index = max - 1;

        $('#active').attr('id', '');

      	if(content == null)
      		content = '<div class="block" id="active">'+modifyer+'</div>';
      	if(index == null)
      		$('#blocks_content').append(content);
      	else
        {
            if(before)
			        $('#blocks_content > .block').eq(index).before(content);
            else
              $('#blocks_content > .block').eq(index).after(content);
        }
}

function moveShifted(index, content, parent, before){
        before = before && !(before == null);
        if(index != null && index < 0) index = 0;
        var max = parent.find('.small, .medium, .large').size();
        if(index != null && index == 'first') index = 0;
        if(index != null && index == 'last') index = null;
        if(index != null && index > max - 1) index = max - 1;
        if(index == null)
          parent.append(content);
        else
        {
            if(before)
              parent.find('.small, .medium, .large').eq(index).before(content);
            else
              parent.find('.small, .medium, .large').eq(index).after(content);
        }
}

function removeActiveTiny(){
  var tinyTextareas = $('#active').find('.tinyMCETextArea');
  tinyTextareas.each(function(){removeTextAreaTinyMCE($(this).attr('id'));});
}

function create_block(content){
        if(content == null) content = '';
        var block = $('<div>');
        block.attr('id', 'active');
        block.addClass('block');
        block.append(modifyer);
        block.append(content);
        return block;
}

var textareaNum = 0;
var inputNumber = 0;
var maximumBlocks = 10;
var currentBlocks = 0;

var activeRequests = 0;

// Function add new element block
/*
function addText(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(largest+'<div class="fixed"></div>'));
  appendText();
}
function addDocument(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block('<div class="largest"><div class="drop_zone document"><p class="message" id="drop_document"></p></div>'+inputs+'</div>'));
}
function addImage(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(largest+'<div class="fixed"></div>'));
  appendImage();
}
function addVideo(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(largest+'<div class="fixed"></div>'));
  appendVideo();
}
function addLink(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block('<div class="largest"><div class="webPage"><input type="text" placeholder="Insert an url" oninput="webPageType($(this));"/></div>'+inputs+'</div>'));
}
function addGenericLink(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(largest+'<div class="fixed"></div>'));
  appendGenericLink();
}
*/

function addMM(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(medium+medium+'<div class="fixed"></div>'));
}
function addSSS(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(small+small+small+'<div class="fixed"></div>'));
}
function addSL(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(small+large+'<div class="fixed"></div>'));
}
function addLS(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(large+small+'<div class="fixed"></div>'));
}
function addXL(){
  if(!checkNumberOfBlocksInserted()) return;
  removeActiveTiny();
  add('last', create_block(largest+'<div class="fixed"></div>'));
}

// End add new element

// Fuction add element

function appendText() {
  var currentItem = $('.select');
  if(currentItem.hasClass('resize'))
    currentItem.html(remover + '<textarea id="textarea' + (++textareaNum) + '" class="tinyMCETextArea"></textarea><div class="tinyMCETextAreaDisplay"></div>'+inputs);
  else
    currentItem.html(shifter + '<textarea id="textarea' + (++textareaNum) + '" class="tinyMCETextArea"></textarea><div class="tinyMCETextAreaDisplay"></div>'+inputs);
  createTextAreaTinyMCE('textarea'+textareaNum);
  currentItem.removeClass('select');
}
function appendImage() {
  var currentItem = $('.select');
  if(currentItem.hasClass('resize'))
    currentItem.html(remover + '<div class="drop_zone image"><div class="message"></div><div class="submenu_image"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" title="Add these image formats: jpeg, jpg, png, gif, bmp, tiff. Max size 5 MB." class="show_image_types"/></div></div>'+inputs);
  else
    currentItem.html(shifter + '<div class="drop_zone image"><div class="message"></div><div class="submenu_image"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" title="Add these image formats: jpeg, jpg, png, gif, bmp, tiff. Max size 5 MB." class="show_image_types"/></div></div>'+inputs);
  currentItem.find('.show_image_types').tooltip({effect: 'slide'});
  currentItem.removeClass('select');
}
function appendVideo() {
  var currentItem = $('.select');
  if(currentItem.hasClass('resize'))
    currentItem.html(remover + '<div class="video"><input type="text" rel="'+(inputNumber++)+'" placeholder="Enter a Video link ('+supportedVideoDomains.join(', ')+')" oninput="videoType($(this));"/></div>'+inputs);
  else
    currentItem.html(shifter + '<div class="video"><input type="text" rel="'+(inputNumber++)+'" placeholder="Enter a Video link ('+supportedVideoDomains.join(', ')+')" oninput="videoType($(this));"/></div>'+inputs);
  currentItem.removeClass('select');
}
function appendGenericLink() {
  var currentItem = $('.select');
  if(currentItem.hasClass('resize'))
    currentItem.html(remover + '<div class="generic_link"><input type="text" rel="'+(inputNumber++)+'" placeholder="Enter a link to embed" oninput="embedType($(this));"/><img src="img/questionmark.png" class="show_providers" title="Embed whatever you want! Try Google maps, Soundcloud, Grooveshark, Rdio, Flickr, Instagram, Twitter, Amazon, etc."/><a class="hidden_link" href=""></a></div>'+inputs);
  else
    currentItem.html(shifter + '<div class="generic_link"><input type="text" rel="'+(inputNumber++)+'" placeholder="Enter a link to embed" oninput="embedType($(this));"/><img src="img/questionmark.png" class="show_providers" title="Embed whatever you want! Try Google maps, Soundcloud, Grooveshark, Rdio, Flickr, Instagram, Twitter, Amazon, etc."/><a class="hidden_link" href=""></a></div>'+inputs);
  currentItem.find('.show_providers').tooltip({effect: 'slide'});
  currentItem.removeClass('select');
}
function appendDocument() {
  var currentItem = $('.select');
  currentItem.html(remover + '<div class="drop_zone document"><div class="message"></div><div class="submenu_document"><p class="or">or</p><div class="input_container"><input type="file" class="input_file" name="input_file"/></div><img src="img/questionmark.png" class="show_document_types" title="Add these document types: pdf, doc, docx, ppt, pptx, pps. Max size 5 MB."/></div></div>'+inputs);
  currentItem.find('.show_document_types').tooltip({effect: 'slide'});
  currentItem.removeClass('select');
  $('.resize_controls').remove();
}
function appendWebPage() {
  var currentItem = $('.select');
  currentItem.html(remover + '<div class="webPage"><input type="text" rel="'+(inputNumber++)+'" placeholder="Enter a Web Page link" oninput="webPageType($(this));"/></div>'+inputs);
  currentItem.removeClass('select');
  $('.resize_controls').remove();
}
// End function add element

function checkNumberOfBlocksInserted() {
  if (currentBlocks < maximumBlocks) {
    currentBlocks++;
    return true;
  }else{
    $('#counter_blocks').html('<p>'+'You can add only 10 blocks</p>');
    return false;
  }
}

$('.new_add_menu').live('click',function(){
  if ($(this).parent().hasClass('largest')) {
    $(this).attr('href','#hidden_menu_largest');
  } else {
    $(this).attr('href','#hidden_menu');
  }
  $(this).fancybox({
    'hideOnContentClick' : true,
    'onClosed' : function(){
      $('.select').removeClass('select');
    }
  });
  $(this).removeClass('new_add_menu');
  $(this).addClass('add_menu');
  $(this).parent().addClass('select');
  return(!$(this).click());
});

$('.add_menu').live('click',function(){
  $(this).parent().addClass('select');
});


$('.remove').live('click', function(){
	$(this).parent().parent().remove();
  currentBlocks--;
  $('#counter_blocks').html('<p></p>');
});

$('.move_up').live('click', function(){
      	var cont = $(this).parent().parent().parent();
      	var myIndex = $('#blocks_content > .block').index(cont);
      	myIndex--;
      	add(myIndex, cont.clone(), true);
        cont.remove();
              
        var tinyTextareas = cont.find('.tinyMCETextArea');
        tinyTextareas.each(function(){updateTextAreaTinyMCE($(this).attr('id'));});

        return false;
});

$('.move_down').live('click', function(){
        var cont = $(this).parent().parent().parent();
        var myIndex = $('#blocks_content > .block').index(cont);
        myIndex++;
        add(myIndex, cont.clone());
        cont.remove();

        var tinyTextareas = cont.find('.tinyMCETextArea');
        tinyTextareas.each(function(){updateTextAreaTinyMCE($(this).attr('id'));});

        return false;
});

$('.move_left').live('click', function(){
        var cont = $(this).parent().parent().parent();
        var myIndex = cont.parent().find('.small, .medium, .large').index(cont);
        myIndex--;
        moveShifted(myIndex, cont.clone(), cont.parent(), true);
        cont.remove();

        var tinyTextareas = cont.find('.tinyMCETextArea');
        tinyTextareas.each(function(){updateTextAreaTinyMCE($(this).attr('id'));});

        return false;
});

$('.move_right').live('click', function(){
        var cont = $(this).parent().parent().parent();
        var myIndex = cont.parent().find('.small, .medium, .large').index(cont);
        myIndex++;
        moveShifted(myIndex, cont.clone(), cont.parent());
        cont.remove();

        var tinyTextareas = cont.find('.tinyMCETextArea');
        tinyTextareas.each(function(){updateTextAreaTinyMCE($(this).attr('id'));});

        return false;
});

$('.reset_item').live('click', function(){
        var cont = $(this).parents('.small, .medium, .large, .largest');
        if(cont.hasClass('small'))
          cont.html($(small).html());
        if(cont.hasClass('medium'))
          cont.html($(medium).html());
        if(cont.hasClass('large'))
          cont.html($(large).html());
        if(cont.hasClass('largest'))
          cont.html('<a class="new_add_menu" href=""><p class="message_layout"></p></a>'+inputs);
        return false;
});

$('.resize_controls > *').live('click', function(){
  var resizer = $(this).parent();
  var selected = resizer.find('.selected');
  var size = selected.attr('rel');
  selected.removeClass('selected');
  $(this).addClass('selected');
  var toResize = resizer.siblings('.resize');
  toResize.removeClass(size);
  $.fancybox.close();
  toResize.addClass($(this).attr('rel'));
  if ($(this).attr('rel')=='largest') {
    toResize.find('a').attr('href','#hidden_menu_largest');
  } else {
    toResize.find('a').attr('href','#hidden_menu');
  }
  toResize.find('a').fancybox({
    'hideOnContentClick' : true,
    'onClosed' : function(){
      $('.select').removeClass('select');
    }
  });
  toResize.find('a').removeClass('add_menu');
  toResize.find('a').addClass('new_add_menu');

  var tinyTextareas = toResize.find('.tinyMCETextArea');
  tinyTextareas.each(function(){updateTextAreaTinyMCE($(this).attr('id'), $(this).attr('rel'));});


  var max = toResize.width();
  $(toResize.find('.embed')).remove();
  $(toResize.find('.hidden_link')).embedly({
    maxWidth: max,
    //key: 'abb3e3165efb11e195364040d3dc5c07',
    wmode: 'transparent',
    method: 'after'
  });
});

$('.tinyMCETextAreaDisplay').live('mousedown', function(){return false;})

$('.block').live('mousedown', function(){
        if($(this).attr('id') == 'active')
          return;

        removeActiveTiny();
        $('#active').attr('id', '');

        $(this).attr('id', 'active');

        var tinyTextareas = $(this).find('.tinyMCETextArea');
        tinyTextareas.each(function(){createTextAreaTinyMCE($(this).attr('id'));});
});

var elementId = 0;
$(function(){
        $('#blocks_content').sortable({
                revert: true,
                distance: 10,
                stop: function(event, ui){
                        var tinyTextareas = ui.item.find('.tinyMCETextArea');
                        tinyTextareas.each(function(){updateTextAreaTinyMCE($(this).attr('id'));});
                }
        });

        $('#forum-topic-form').submit(function(){
          removeActiveTiny();
          $('#active').attr('id', '');

          $(this).find('.small, .medium, .large, .largest').each(function(){
            elementId++;
            var blockNumber = $('#blocks_content > .block').index($(this).parent());
            blockNumber++;
            var resourceNumber = $($(this).parent().find('.small, .medium, .large, .largest')).index($(this));
            resourceNumber++;
            var template = '4';
            if($(this).hasClass('resize')){
              if($(this).hasClass('small')) template = 1;
              if($(this).hasClass('medium')) template = 2;
              if($(this).hasClass('large')) template = 3;
            }
            if($(this).siblings('.medium').size() == 1)
              template = 5;
            if($(this).siblings('.small').size() == 2)
              template = 6;
            if($(this).siblings('.small').size() == 1){
              if(resourceNumber == 0)
                template = 8;
              else
                template = 7;
            }
            if($(this).siblings('.large').size() == 1){
              if(resourceNumber == 0)
                template = 7;
              else
                template = 8;
            }

            var resourceType = '';
            if($(this).find('.document').size() > 0) resourceType = 'd';
            if($(this).find('.webPage').size() > 0) resourceType = 'w';
            if($(this).find('.tinyMCETextArea').size() > 0) resourceType = 't';
            if($(this).find('.image').size() > 0) resourceType = 'i';
            if($(this).find('.video').size() > 0) resourceType = 'v';
            if($(this).find('.generic_link').size() > 0) resourceType = 'e';
            if($(this).find('.new_add_menu').size() > 0) resourceType = 'x';
            if($(this).find('.add_menu').size() > 0) resourceType = 'x';


            var resourceContent = '';
            switch(resourceType){
              case 'd': resourceContent = $(this).find('.document .document_path').val(); break;
              case 'w': resourceContent = $(this).find('.webPage iframe').attr('src'); break;
              case 't': resourceContent = $(this).find('.tinyMCETextArea').val(); break;
              case 'i': resourceContent = $(this).find('.image .img_path').val(); break;
              case 'v': resourceContent = $(this).find('.video iframe').attr('src'); break;
              case 'e': resourceContent = $(this).find('.generic_link .embed').html(); break;
              case 'x': resourceContent = ''
              break;
            }

            var actualInputName;
            $(this).find('.element_data').each(function(){
              actualInputName = $(this).attr('name');

              if(actualInputName == 'component_position')
                $(this).val(blockNumber);
              if(actualInputName == 'resource_position')
                $(this).val(resourceNumber);
              if(actualInputName == 'template_id')
                $(this).val(template);
              if(actualInputName == 'resource_type')
                $(this).val(resourceType);
              if(actualInputName == 'resource')
                $(this).val(resourceContent);

              $(this).attr('name', 'element' + elementId + '_' + actualInputName);
            });
          });
        return true;
        $('#submit_bottol').attr('disabled', 'disabled');
        $('#submit_bottol').css('color', '#888');
        });
});

function createTextAreaTinyMCE(textAreaId){
        var ta = $('#'+textAreaId);

        if(ta.parents('.small').size() > 0)
                tinyMCE.settings = tinyconfigS;
        if(ta.parents('.medium').size() > 0)
                tinyMCE.settings = tinyconfigM;
        if(ta.closest('.large').size() > 0)
                tinyMCE.init(tinyconfigL);
        if(ta.parents('.largest').size() > 0)
                tinyMCE.settings = tinyconfigXL;

        tinyMCE.execCommand('mceAddControl', true, textAreaId);
}
function updateTextAreaTinyMCE(textAreaId){
        removeTextAreaTinyMCE(textAreaId);
        createTextAreaTinyMCE(textAreaId);
}
function removeTextAreaTinyMCE(textAreaId){
        tinyMCE.execCommand('mceRemoveControl', true, textAreaId);

        var textArea = $('#'+textAreaId);

        var newHTML = '<div class="emptyTiny"></div>';
        var newMin = '150px';
        var regex = /<[^>]*>/gi;

        if(textArea.val().replace(regex,"") != ''){
          newHTML = textArea.val();
          newMin = '0';
        }

        var textDisplay = textArea.siblings('.tinyMCETextAreaDisplay');
        textDisplay.html(newHTML);
        textDisplay.parent().css('min-height', newMin);
        textDisplay.parent().parent().css('min-height', newMin);
}

//manage max char number
var lastTinyMCEEdited;
function onTinyMCEChange() {
    var maxChars = 10000;
    var x = tinymce.activeEditor.getContent();
    var regex = /<[^>]*>/gi;
    var outputstr = x.replace(regex,"");
    if(outputstr.length > maxChars){
      tinymce.activeEditor.setContent(lastTinyMCEEdited);
      $('#maxCharsReach').fancybox();
      $('#maxCharsReach').attr('id', 'maxCharsReachFancy');
      $('#maxCharsReachFancy').click();
    }
    else
      lastTinyMCEEdited = x;
}

var tinyconfigXL = {
       theme : "advanced",
       mode : "specific_textareas",
       editor_selector : "mceEditor",
       theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,undo,redo,|,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,|,link,unlink",
       theme_advanced_buttons2: "",
       theme_advanced_buttons3: "",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left",
       width: '100%',
       height: '203',
       handle_event_callback: "onTinyMCEChange"
}
var tinyconfigM = {
       theme : "advanced",
       mode : "specific_textareas",
       editor_selector : "mceEditor",
       theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,undo,redo,|,forecolor,backcolor",
       theme_advanced_buttons2: "formatselect,fontselect,fontsizeselect,|,link,unlink",
       theme_advanced_buttons3: "",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left",
       width: '100%',
       height: '200',
       handle_event_callback: "onTinyMCEChange"
}
var tinyconfigL = tinyconfigM;
var tinyconfigS = {
       theme : "advanced",
       mode : "specific_textareas",
       editor_selector : "mceEditor",
       theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist",
       theme_advanced_buttons2: "undo,redo,|,forecolor,backcolor,formatselect",
       theme_advanced_buttons3: "fontselect,fontsizeselect,|,link,unlink",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left",
       width: '100%',
       height: '197',
       handle_event_callback: "onTinyMCEChange"
}

var lastTyped = new Array();

function webPageType(textfield){
  var now = new Date();
  var txtN = textfield.attr('rel');
  lastTyped[txtN] = now;
  setTimeout(function(){if(now == lastTyped[txtN]) webIFrame(textfield);}, 2000);
}

function webIFrame(textfield){
        var pageurl = textfield.val();
        if(pageurl == '' || pageurl == 'http://')
                return;
        if(!(pageurl.indexOf('http://') == 0))
                pageurl = 'http://' + pageurl;

        $.ajax({
                type: "GET",
                url: pageurl,
                dataType: "jsonp",
                complete: function(){
                        if(textfield.parent().find('iframe').size() > 0)
                                textfield.parent().find('iframe').attr('src', pageurl);
                        else
                        {
                                textfield.parent().css('height', '600px');
                                textfield.parent().append('<iframe src="'+pageurl+'" frameborder="0"></iframe>');
                        }
                        textfield.parent().addClass('content_inserted');
                }
        });
}

var supportedVideoDomains = new Array('youtube', 'vimeo');

var regexVideoDomains = new Array(
  /*youtube*/ Array((/(\=|\/|\&)?[a-zA-Z0-9-_]{11}(\&|$)/), (/[a-zA-Z0-9-_]{11}/)),
  /*vimeo*/   Array(/\d{8}?$/)
);

var theEmbedUrl = new Array('http://www.youtube.com/embed/', 'http://player.vimeo.com/video/');

function videoType(textfield){
  var now = new Date();
  var txtN = textfield.attr('rel');
  lastTyped[txtN] = now;
  setTimeout(function(){if(now == lastTyped[txtN]) videoSearch(textfield);}, 2000);
}

function videoSearch(textfield){
        var pageurl = textfield.val();

        var i;
        var domain = -1;
        for(i in supportedVideoDomains)
                if(pageurl.indexOf(supportedVideoDomains[i]) >= 0)
                        domain = i;
        if(domain == -1) return;
        
        if(!(pageurl.indexOf('http://') == 0))
                pageurl = 'http://' + pageurl;

        $.ajax({
                type: "GET",
                url: pageurl,
                dataType: "jsonp",
                complete: function(){
                        var id = pageurl;
                        for(i in regexVideoDomains[domain])
                          id = regexVideoDomains[domain][i].exec(id);

                        pageurl = theEmbedUrl[domain]+id;

                        if(textfield.parent().find('iframe').size() > 0)
                                textfield.parent().find('iframe').attr('src', pageurl);
                        else
                                textfield.parent().append('<iframe src="'+pageurl+'" frameborder="0" allowfullscreen></iframe>');
                        $(textfield.parent()).addClass('content_inserted');
                }
        });
}


function embedType(textfield){
  var now = new Date();
  var txtN = textfield.attr('rel');
  lastTyped[txtN] = now;
  setTimeout(function(){if(now == lastTyped[txtN]) embedURL(textfield);}, 2000);
}

function embedURL(textfield) {
        var genericUrl = textfield.val();
        if(!(genericUrl.indexOf('http://')  == 0) && !(genericUrl.indexOf('https://')  == 0)) {
          genericUrl = 'http://' + genericUrl;
        }

        $.ajax({
          type: "GET",
          url: genericUrl,
          dataType: "jsonp",
          complete: function(){
            textfield.parent().find('.hidden_link').attr('href',genericUrl);
            var max = textfield.parent().width();
            $(textfield.parent().find('.embed')).remove();
            $(textfield.parent().find('.hidden_link')).embedly({
              maxWidth: max,
              key: 'abb3e3165efb11e195364040d3dc5c07',
              wmode: 'transparent',
              method: 'after'
            });
            $(textfield.parent()).addClass('content_inserted');
          }
        });
}
//prevent send from input text
$('#forum-topic-form input[type=text]').live('keydown', function(e){if(e.keyCode == 13) return false;});
