<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/presenters/templates/Gallery/default.latte

class Template5d1c98377a0ee8f1511e30592d441d39 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('f1b4ec09ca', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb86a809efe2_content')) { function _lb86a809efe2_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="col-md-7">
	<h1>Gallery</h1>
<?php $_l->tmp = $_control->getComponent("galleryAdminControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	<div class="gallery">
		<div class="row">
<?php $iterations = 0; foreach ($images as $image) { ?>
			<div class="col-sm-4 images">
<?php if ($admin) { ?>
				<div class="row">
					<div class="col-sm-12">
						<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/www/images/gallery/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($image['name']), ENT_COMPAT) ?>
" data-title="<?php echo Latte\Runtime\Filters::escapeHtml($image['description'], ENT_COMPAT) ?>" data-lightbox="gallery">
							<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/www/images/gallery/small/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($image['name']), ENT_COMPAT) ?>
" alt="<?php echo Latte\Runtime\Filters::escapeHtml($image['description'], ENT_COMPAT) ?>">
						</a>
					</div>
					<div class="col-sm-12">
						<small>
							<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>
/gallery/remove?id=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($image['id']), ENT_COMPAT) ?>
">Remove</a> | <a href="#" data-id="<?php echo Latte\Runtime\Filters::escapeHtml($image['id'], ENT_COMPAT) ?>
" data-desc="<?php echo Latte\Runtime\Filters::escapeHtml($image['description'], ENT_COMPAT) ?>" data-toggle="modal" data-target="#editModal">Edit</a>
						</small>
					</div>
				</div>
<?php } else { ?>
					<div class="col-sm-12">
						<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/www/images/gallery/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($image['name']), ENT_COMPAT) ?>
" data-title="<?php echo Latte\Runtime\Filters::escapeHtml($image['description'], ENT_COMPAT) ?>" data-lightbox="gallery">
							<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/www/images/gallery/small/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($image['name']), ENT_COMPAT) ?>
" alt="<?php echo Latte\Runtime\Filters::escapeHtml($image['description'], ENT_COMPAT) ?>">
						</a>
					</div>
<?php } ?>
			</div>
<?php $iterations++; } ?>
		</div>
	</div>
</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb11cbcc71de_scripts')) { function _lb11cbcc71de_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacrosRuntime::callBlockParent($_b, 'scripts', get_defined_vars()) ?>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/include/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/js/modalgallery.js"></script>
<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lba522a92b68_title')) { function _lba522a92b68_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Archive<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbb5aba5502d_head')) { function _lbb5aba5502d_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/include/lightbox/lightbox.css" rel="stylesheet">
<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/css/gallery.css" rel="stylesheet">
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start(function () {});}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>


<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 
}}