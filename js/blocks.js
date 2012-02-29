
var modifyer = '<div class="modify"><img class="remove" src="img/close.png"/><div class="mod_controls"><img class="move_up" src="img/up.png"/><img class="move_down" src="img/down.png"/></div></div><div class="edit_block"><p>Edit</p></div>';
var small = '<div class="small"><a class="new_add_menu"href="#hidden_menu"><p class="message_layout"></p></a></div>';
var medium = '<div class="medium"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div>';
var large = '<div class="large"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div>';
var resizeControls = '<div class="resize_controls"><p rel="small">S</p><p rel="medium">M</p><p rel="large">L</p><p class="selected" rel="largest">XL</p></div>';

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
var maximumBlocks = 10;
var currentBlocks = 0;

// Function add new element block

function addText(){if(checkNumberOfBlocksInserted())add('last', create_block(resizeControls+'<div class="largest resize select"></div><div class="fixed"></div>')); appendText();}
function addDocument(){if(checkNumberOfBlocksInserted())add('last', create_block('<div class="largest"><div class="drop_zone document"><p class="message" id="drop_document"></p></div></div>'))};
function addImage(){if(checkNumberOfBlocksInserted())add('last', create_block(resizeControls+'<div class="largest resize select"></div><div class="fixed"></div>')); appendImage();}
function addVideo(){if(checkNumberOfBlocksInserted())add('last', create_block(resizeControls+'<div class="largest resize select"></div><div class="fixed"></div>')); appendVideo();}
function addLink(){if(checkNumberOfBlocksInserted())add('last', create_block('<div class="largest"><div class="webPage"><input type="text" placeholder="Insert an url" oninput="webPageType($(this));"/></div></div>'));}
function addGenericLink(){if(checkNumberOfBlocksInserted())add('last', create_block(resizeControls+'<div class="largest resize select"></div><div class="fixed"></div>')); appendGenericLink();}


function addMM(){if(checkNumberOfBlocksInserted())add('last', create_block(medium+medium+'<div class="fixed"></div>'));}
function addSSS(){if(checkNumberOfBlocksInserted())add('last', create_block(small+small+small+'<div class="fixed"></div>'));}
function addSL(){if(checkNumberOfBlocksInserted())add('last', create_block(small+large+'<div class="fixed"></div>'));}
function addLS(){if(checkNumberOfBlocksInserted())add('last', create_block(large+small+'<div class="fixed"></div>'));}

// End add new element

// Fuction add element

function appendText(){$('.select').html('<textarea id="textarea' + (++textareaNum) + '" class="tinyMCETextArea"></textarea>');createTextAreaTinyMCE('textarea'+textareaNum);$('.select').removeClass('select');}
function appendImage(){$('.select').html('<div class="drop_zone image"><p class="message" id="drop_image"></p></div>');$('.select').removeClass('select');}
function appendVideo(){$('.select').html('<div class="video"><input type="text" placeholder="Your video url ('+supportedVideoDomains.join(', ')+')" oninput="videoType($(this));"/></div>');$('.select').removeClass('select');}
function appendGenericLink(){$('.select').html('<div class="generic_link"><input type="text" placeholder="Enter a link" oninput="embedType($(this));"/><a class="hidden_link" href=""></a></div>');$('.select').removeClass('select');}
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

$('.resize_controls > *').live('click', function(){
  var resizer = $(this).parent();
  var selected = resizer.find('.selected');
  var size = selected.attr('rel');
  selected.removeClass('selected');
  $(this).addClass('selected');
  var toResize = resizer.siblings('.resize');
  toResize.removeClass(size);
  toResize.addClass($(this).attr('rel'));

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

$('.block').live('mousedown', function(){
        $('#active').attr('id', '');
        $(this).attr('id', 'active');
});

$(function(){
        $('#blocks_content').sortable({
                revert: true,
                distance: 10,
                stop: function(event, ui){
                        var tinyTextareas = ui.item.find('.tinyMCETextArea');
                        tinyTextareas.each(function(){updateTextAreaTinyMCE($(this).attr('id'));});
                }
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
        tinyMCE.execCommand('mceRemoveControl', true, textAreaId);
        createTextAreaTinyMCE(textAreaId);
}

var tinyconfigXL = {
       theme : "advanced",
       mode : "specific_textareas",
       editor_selector : "mceEditor",
       theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,undo,redo,|,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
       theme_advanced_buttons2: "",
       theme_advanced_buttons3: "",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left",
       width: '100%',
       height: '203'
}
var tinyconfigM = {
       theme : "advanced",
       mode : "specific_textareas",
       editor_selector : "mceEditor",
       theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,undo,redo,|,forecolor,backcolor",
       theme_advanced_buttons2: "formatselect,fontselect,fontsizeselect",
       theme_advanced_buttons3: "",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left",
       width: '100%',
       height: '200'
}
var tinyconfigL = tinyconfigM;
var tinyconfigS = {
       theme : "advanced",
       mode : "specific_textareas",
       editor_selector : "mceEditor",
       theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist",
       theme_advanced_buttons2: "undo,redo,|,forecolor,backcolor,formatselect",
       theme_advanced_buttons3: "fontselect,fontsizeselect",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left",
       width: '100%',
       height: '197'
}

var lastTyped = 0;

function webPageType(textfield){
  var now = new Date();
  lastTyped = now;
  setTimeout(function(){if(now == lastTyped) webIFrame(textfield);}, 2000);
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
                                textfield.parent().append('<iframe src="'+pageurl+'" frameborder="0"></iframe><div class="overlay"></div>');
                        }
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
  lastTyped = now;
  setTimeout(function(){if(now == lastTyped) videoSearch(textfield);}, 2000);
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
                                textfield.parent().append('<iframe src="'+pageurl+'" frameborder="0" allowfullscreen></iframe><div class="overlay"></div>');
                }
        });
}


function embedType(textfield){
  var now = new Date();
  lastTyped = now;
  setTimeout(function(){if(now == lastTyped) embedURL(textfield);}, 2000);
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
              //key: 'abb3e3165efb11e195364040d3dc5c07',
              wmode: 'transparent',
              method: 'after'
            });
          }
        });
}