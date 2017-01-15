<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/presenters/templates/Homepage/default.latte

class Templateef34e66e7b82d9ecf09b9196018deaa2 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('ebc5c0cff8', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb4816812a45_content')) { function _lb4816812a45_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="col-md-7">
<?php $_l->tmp = $_control->getComponent("homenav"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;if (count($posts)) { $iterations = 0; foreach ($posts as $post) { ?>
	<article>
		<header><h2><?php echo Latte\Runtime\Filters::escapeHtml($post['title'], ENT_NOQUOTES) ?></h2></header>
		<footer><small>Posted on <?php echo Latte\Runtime\Filters::escapeHtml($template->date($post['date'], '%d.%m.%Y'), ENT_NOQUOTES) ?>
 <?php if ($admin) { ?>| <a href="#" data-id="<?php echo Latte\Runtime\Filters::escapeHtml($post['id'], ENT_COMPAT) ?>
" data-toggle="modal" data-target="#editModal">Edit</a> | <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:remove", array($post['id'])), ENT_COMPAT) ?>
">Remove</a>	<?php } ?></small></footer>		
		<div class="lead">
	 	<?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post['body'], 250), ENT_NOQUOTES) ?>

	 	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Article:default", array($post['id'])), ENT_COMPAT) ?>
">Read more</a>
		</div>		
		<footer>
<?php $iterations = 0; foreach ($showLabels($post['id']) as $label) { if ($label['id'] == 1) { ?>
				<span class="label label-default"><?php echo Latte\Runtime\Filters::escapeHtml($label['discription'], ENT_NOQUOTES) ?></span>
<?php } else { ?>
				<span class="label label-primary"><?php echo Latte\Runtime\Filters::escapeHtml($label['discription'], ENT_NOQUOTES) ?></span>
<?php } $iterations++; } ?>
		</footer>		
		<hr>		
	</article>
<?php $iterations++; } } else { ?>
    	<p>Zatím nebyl napsán žádný článek.</p>
<?php } ?>
	<nav>
	  <ul class="pagination">
<?php if ($page > 1) { ?>
	    <li>
	      <a href="?page=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($page - 1), ENT_COMPAT) ?>" aria-label="Previous">
	        <span aria-hidden="true">&laquo;</span>
	      </a>
	    </li>
<?php } for ($i=1;$i<$pages+1;$i++) { ?>
	    <li class=<?php echo '"', Latte\Runtime\Filters::escapeHtml($page==$i?'active' : NULL, ENT_COMPAT), '"' ?>
><a href="?page=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($i), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($i, ENT_NOQUOTES) ?></a></li>
<?php } if ($page < $pages) { ?>
	    <li>
	      <a href="?page=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($page + 1), ENT_COMPAT) ?>" aria-label="Next">
	        <span aria-hidden="true">&raquo;</span>
	      </a>
	    </li>
<?php } ?>
	  </ul>
	</nav>			
</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbee8395686c_scripts')) { function _lbee8395686c_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacrosRuntime::callBlockParent($_b, 'scripts', get_defined_vars()) ?>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/js/modal.js"></script>
<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb4ef7d3ddf9_title')) { function _lb4ef7d3ddf9_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Posts<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbf6c55aceeb_head')) { function _lbf6c55aceeb_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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