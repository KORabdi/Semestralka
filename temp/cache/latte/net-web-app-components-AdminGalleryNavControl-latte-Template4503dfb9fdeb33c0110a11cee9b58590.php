<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/components/AdminGalleryNavControl.latte

class Template4503dfb9fdeb33c0110a11cee9b58590 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('b2455b8287', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($status) { ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add photo</button>

<!-- Modal -->
<div class="modal fade" id="addModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New photo</h4>
      </div>
      <div class="modal-body">
        <form id="addForm" method="POST" enctype="multipart/form-data" action="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>/gallery/add">
          <div class="form-group">
            <label for="article-name" class="control-label">Description:</label>
            <input name="description" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label for="article-name" class="control-label">File:</label>
            <input name="pic" type="file" accept="image/*" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" form="addForm" class="btn btn-primary" value="Add photo">
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit photo</h4>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST" action="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>/gallery/edit">
          <div class="form-group">
            <label for="article-name" class="control-label">Description:</label>
            <input placeholder="Put some description here" name="description" type="text" class="form-control" id="article-name">
          	<input id="id_photo" type="hidden" name="id" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" form="editForm" class="btn btn-primary" value="Edit photo">
      </div>
    </div>
  </div>
</div>

<?php } 
}}