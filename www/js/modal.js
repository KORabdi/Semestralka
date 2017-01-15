$('#editModal').on('show.bs.modal', function (event) {
  $('#loading').show();
  $('#editForm').hide();
  var button = $(event.relatedTarget); // Button that triggered the modal
  var id = button.data('id'); // Extract info from data-* attributes
  var modal = $(this);
  modal.find('.modal-body #id_post').val(id);
  $.getJSON("/article/json",{'articleId':id}, function(result){
    modal.find('.modal-body #article-name').val(result.title);
  	modal.find('.modal-body textarea').val(result.body);
  	$('#loading').hide();
  	$('#editForm').show();
  });
  $.getJSON("/article/labelsjson",{'articleId':id}, function(result){
	  $.each(result, function(i, field){
          modal.find('.modal-body .checkbox #label-'+field.id).prop('checked', true);
      });
  });
  
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
});

$('#editModal').on('hide.bs.modal', function (event) {
	$('#editModal').find('.modal-body textarea').empty();
	$('#editForm')[0].reset();
});