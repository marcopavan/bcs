
var modifyer = '<div class="modify"><img class="remove" src="img/close.png"/><img class="move_up" src="img/up.png"/><img class="move_down" src="img/down.png"/></div>';

function add(index, content, before){
        before = before && !(before == null);
        if(index < 0) index = 0;
        var max = $('.block').size();
        if(index > max - 1) index = max - 1;

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

$('.remove').live('click', function(){
	$(this).parent().parent().remove();
});

$('.move_up').live('click', function(){
	var cont = $(this).parent().parent();
	var myIndex = $('#blocks_content > .block').index(cont);
	myIndex--;
		add(myIndex, cont.clone(), true);
        cont.remove();
        return false;
});

$('.move_down').live('click', function(){
        var cont = $(this).parent().parent();
        var myIndex = $('#blocks_content > .block').index(cont);
        myIndex++;
        add(myIndex, cont.clone());
        cont.remove();
        return false;
});

$('.block').live('click', function(){
        $('#active').attr('id', '');
        $(this).attr('id', 'active');
});