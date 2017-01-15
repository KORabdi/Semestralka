$("#search").on('click',function(){
	$(".row .panel").toggle(1000);
});

$("#searchForm").on('submit',function(event){
	$("#loading").show();
	event.preventDefault();
	var formData = {};
	var url = '/twitch/json';
    var form = $(this);
    form.find("input[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });
    $.get(url, formData).done(function (json) {
		$("tbody tr").remove();
		var string;
		$.each(json,function (index,response){
			var date = moment(response.date.date); 
			string = string+('<tr><th>'+response.id+'</td><td>'+response.name+'</td><td>'+escape(response.message)+'</td><td>'+date.format('YYYY-MM-DD HH:mm:ss')+'</td></tr>\r\n');
		});
		$("tbody").append(string);
		$("#loading").hide();
    }).error(function(){
    	//Ztrata spojeni, vypis alert
    	$("#loading").hide(1,function(){alert('Can\'t send data to server. Check your Internet connection.')});
    });
});


var typingTimer;                
var doneTypingInterval = 200;  
var $input = $('#twitch-name');

$input.on('keyup', function (e) {
	
	
    if(e.which === 13){
        return;
    }
    
    if(e.which === 38){
        return;
    }
    
    if(e.which === 40){
        return;
    }
	
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

$input.on('keydown', function () {
  clearTimeout(typingTimer);
});

function doneTyping () {
	var url = '/twitch/namesjson';
	var value = {'name' : $('#twitch-name').val(),
				'csrf-token' : $('input[name=csrf-token]').val()
	}
	$.get(url,value).done(function(json){
		$('#mylist').empty();
		$.each(json,function(i,item){
			$('#mylist').append('\t<option>'+item.name+'</option>\r\n');
		});
	});
}
