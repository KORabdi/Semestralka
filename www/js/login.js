$('#signin').on('submit',function(event){ //check on send!!!
	event.preventDefault();
	$('#send').hide();
	$('#loading').show();
	$("#message-error").remove();
	var formData = {};
    var form = $(this);
    form.find("input[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });   
    $.ajax({
    	  type: "POST",
    	  url: '/user/loginjson',
    	  headers: {'X-Csrf-Token': 'xD'},
    	  data: formData,
    }).done(function (data) {
        if(data.status == "OK"){
        	$('#signin').unbind('submit').trigger('submit');
        }else{
        	var err;
        	if(data.error == 1){
        		err = 'name';
        	}else if(data.error == 2){
        		err = 'password';
        	}
        	form.find('input[name='+err+']')
        	.after('<label id="message-error" class="error">'+data.message+'</label>');
        	$('#send').show();
        	$('#loading').hide();
        }
    }).error(function(){
    	//Ztrata spojeni, vypis alert
    	$('#send').show(1,function(){$('#loading').hide(1,function(){alert('Can\'t send data to server. Check your Internet connection.')})});
    });
    
});