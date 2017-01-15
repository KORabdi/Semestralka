$('#name').on('blur',function(event){ //check on send!!!
	event.preventDefault();
	$('#send').hide();
	$('#loading').show();
	$("#message-error").remove();
	var formData = {};
	var url = '/user/namejson';
    var form = $('#register');
    form.find("input[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });
    $.post(url, formData).done(function (data) {
        if(data.status != "OK"){
        	var err;
        	if(data.error == 1){
        		err = 'name';
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