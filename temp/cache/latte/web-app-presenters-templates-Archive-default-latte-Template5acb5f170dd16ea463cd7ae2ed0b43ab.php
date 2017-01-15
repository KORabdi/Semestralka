<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/presenters/templates/Archive/default.latte

class Template5acb5f170dd16ea463cd7ae2ed0b43ab extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('77a3e3865c', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf089f4095d_content')) { function _lbf089f4095d_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="col-md-7">
	<h1>Archive</h1>
<?php $iterations = 0; foreach ($archives as $year => $archive) { ?>
	<article>
		<h3><?php echo Latte\Runtime\Filters::escapeHtml($year, ENT_NOQUOTES) ?></h3>
<?php $iterations = 0; foreach ($archive as $arch) { ?>
		<div class="row">
			<div class="col-md-9">
			<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Article:default", array($arch['id'])), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($arch['title'], ENT_NOQUOTES) ?></a>
			</div>
			<div class="col-md-3 date">
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($arch['date'], '%d.%m.%Y'), ENT_NOQUOTES) ?>

			</div>
		</div>
<?php $iterations++; } ?>
	</article>
<?php $iterations++; } ?>
</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lba70b4881de_scripts')) { function _lba70b4881de_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacrosRuntime::callBlockParent($_b, 'scripts', get_defined_vars()) ;
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb8dae1dd733_title')) { function _lb8dae1dd733_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Archive<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb6a89208e77_head')) { function _lb6a89208e77_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/css/archive.css" rel="stylesheet">
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