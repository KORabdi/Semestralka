<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/components/AdminHomeNavControl.latte

class Template0b02f4af88c3732fe1cdb94631de3232 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('21183cf9bf', 'html')
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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add article</button>

<!-- Modal -->
<div class="modal fade" id="addModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New article</h4>
      </div>
      <div class="modal-body">
        <form id="addForm" method="POST" action="homepage/add">
          <div class="form-group">
            <label for="article-name" class="control-label">Title:</label>
            <input placeholder="Put some title here" name="title" type="text" class="form-control" id="article-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea placeholder="Put the text here" name="body" class="form-control" id="message-text"></textarea>
          </div>
          <label for="message-text" class="control-label">Type:</label>
          <div class="checkbox">
          	<input name="labels[0][id]" value='2' type='hidden'>
          	<input name="labels[0][display]" value='0' type='hidden'>
			<label><input name="labels[0][display]" value="1" type="checkbox">web</label>
			<input name="labels[1][id]" value='1' type='hidden'>
			<input name="labels[1][display]" value='0' type='hidden'>
			<label><input name="labels[1][display]" value="1" type="checkbox">bot</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" form="addForm" class="btn btn-primary" value="Add article">
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
        <h4 class="modal-title">Edit article</h4>
      </div>
      <div class="modal-body">
      	<div id="loading">
      		<img alt="loading" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/include/images/loading.gif">
        </div>
        <form id="editForm" method="POST" action="homepage/edit">
          <div class="form-group">
            <label for="article-name" class="control-label">Title:</label>
            <input placeholder="Wait please..." name="title" type="text" class="form-control" id="article-name">
            <input name="id" id="id_post" type="hidden" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea placeholder="Wait please..." name="body" class="form-control" id="message-text"></textarea>
          </div>
          <label for="message-text" class="control-label">Type:</label>
          <div class="checkbox">
          	<input name="labels[0][id]" value='2' type='hidden'>
          	<input name="labels[0][display]" value='0' type='hidden'>
			<label><input name="labels[0][display]" id="label-2" value="1" type="checkbox">web</label>
			<input name="labels[1][id]" value='1' type='hidden'>
			<input name="labels[1][display]" value='0' type='hidden'>
			<label><input name="labels[1][display]" id="label-1" value="1" type="checkbox">bot</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" form="editForm" class="btn btn-primary" value="Edit article">
      </div>
    </div>
  </div>
</div>
<?php } 
}}