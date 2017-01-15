$('#editModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var id = button.data('id'); // Extract info from data-* attributes
  var description = button.data('desc');
  var modal = $(this);
  modal.find('.modal-body #id_photo').val(id);
  modal.find('.modal-body input[name=description]').val(description);
});

$('#editModal').on('hide.bs.modal', function (event) {
	$('#editForm')[0].reset();
});