
var modifyer = '<div class="modify"><img class="remove" src="img/close.png"/><div class="mod_controls"><img class="move_up" src="img/up.png"/><img class="move_down" src="img/down.png"/></div></div>';

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

// Function add new element block

function addText(){
        add('last', create_block('<textarea id="textarea' + (++textareaNum) + '" class="tinyMCETextArea"></textarea>'));
        createTextAreaTinyMCE('textarea'+textareaNum);
}
function addDocument(){add('last', create_block('<div class="drop_zone document"><p class="message" id="drop_document"></p></div>'))};
function addImage(){add('last', create_block('<div class="drop_zone image"><p class="message" id="drop_image"></p></div>'));}
function addVideo(){add('last', create_block('<div class="video"><input type="text" placeholder="Your video url ('+supportedVideoDomains.join(', ')+')" oninput="videoSearch($(this));"/></div>'));}
function addAudio(){add('last', create_block('audio'));}
function addLink(){add('last', create_block('<div class="webPage"><input type="text" placeholder="Insert an url" oninput="webIFrame($(this));"/></div>'));}
function addNotAvailable(){add('last', create_block('<p class="notAvailable">Not available yet...</p>'));}

function addMM(){add('last', create_block('<div class="medium"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div><div class="medium"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div>'));}
function addSSS(){add('last', create_block('<div class="small"><a class="new_add_menu"href="#hidden_menu"><p class="message_layout"></p></a></div><div class="small"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div><div class="small"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div>'));}
function addSL(){add('last', create_block('<div class="small"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div><div class="large"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div>'));}
function addLS(){add('last', create_block('<div class="large"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div><div class="small"><a class="new_add_menu" href="#hidden_menu"><p class="message_layout"></p></a></div>'));}

// End add new element

// Fuction add element

function appendText(){$('.select').html('<textarea id="textarea' + (++textareaNum) + '" class="tinyMCETextArea"></textarea>');createTextAreaTinyMCE('textarea'+textareaNum);$('.select').removeClass('select');}
function appendImage(){$('.select').html('<div class="drop_zone image"><p class="message" id="drop_image"></p></div>');$('.select').removeClass('select');}
function appendVideo(){$('.select').html('<div class="video"><input type="text" placeholder="Your video url ('+supportedVideoDomains.join(', ')+')" oninput="videoSearch($(this));"/></div>');$('.select').removeClass('select');}

// End function add element

$('.new_add_menu').live('click',function(){
        $(this).fancybox({'hideOnContentClick' : true});
        $(this).removeClass('new_add_menu');
        $(this).addClass('add_menu');
        $(this).parent().addClass('select');
        return(!$(this).click());
});

$('.remove').live('click', function(){
	$(this).parent().parent().remove();
});

$('.move_up').live('click', function(){
	var cont = $(this).parent().parent().parent();
	var myIndex = $('#blocks_content > .block').index(cont);
	myIndex--;
		add(myIndex, cont.clone(), true);
        cont.remove();

        if(cont.find('.tinyMCETextArea').size() == 1)
                updateTextAreaTinyMCE(cont.find('.tinyMCETextArea').attr('id'));

        return false;
});

$('.move_down').live('click', function(){
        var cont = $(this).parent().parent().parent();
        var myIndex = $('#blocks_content > .block').index(cont);
        myIndex++;
        add(myIndex, cont.clone());
        cont.remove();

        if(cont.find('.tinyMCETextArea').size() == 1)
                updateTextAreaTinyMCE(cont.find('.tinyMCETextArea').attr('id'));

        return false;
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
                        if(ui.item.find('.tinyMCETextArea').size() == 1)
                                updateTextAreaTinyMCE(ui.item.find('.tinyMCETextArea').attr('id'));
                }
        });

        tinyMCE.init(tinyconfig);
});

function createTextAreaTinyMCE(textAreaId){
        tinyMCE.settings = tinyconfig;
        tinyMCE.execCommand('mceAddControl', true, textAreaId);
}
function updateTextAreaTinyMCE(textAreaId){
        tinyMCE.execCommand('mceRemoveControl', true, textAreaId);
        createTextAreaTinyMCE(textAreaId)
}

var tinyconfig = {
       theme : "advanced",
       mode : "specific_textareas",
       editor_selector : "mceEditor",
       theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,undo,redo,|,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
       theme_advanced_buttons2: "",
       theme_advanced_buttons3: "",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left"
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
                                textfield.parent().append('<iframe src="'+pageurl+'" frameborder="0"></iframe><div class="iframeSelector">SELECT<br/>OR DRAG</div>');
                        }
                }
        });
}

var supportedVideoDomains = new Array('youtube');

function videoSearch(textfield){
        var pageurl = textfield.val();

        var i;
        var flag = true;
        for(i in supportedVideoDomains)
                if(pageurl.indexOf(supportedVideoDomains[i]) >= 0)
                        flag = false;
        if(flag) return;
        
        if(!(pageurl.indexOf('http://') == 0))
                pageurl = 'http://' + pageurl;

        $.ajax({
                type: "GET",
                url: pageurl,
                dataType: "jsonp",
                complete: function(){
                        var id = pageurl.replace(/^[^v]+v.(.{11}).*/,"$1");
                        pageurl = 'http://www.youtube.com/embed/'+id;

                        if(textfield.parent().find('iframe').size() > 0)
                                textfield.parent().find('iframe').attr('src', pageurl);
                        else
                        {
                                textfield.parent().css('height', '350px');
                                textfield.parent().append('<iframe src="'+pageurl+'" frameborder="0" allowfullscreen></iframe>');
                        }
                }
        });
}