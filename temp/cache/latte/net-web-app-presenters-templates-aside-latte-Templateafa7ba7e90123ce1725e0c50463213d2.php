<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/presenters/templates/@aside.latte

class Templateafa7ba7e90123ce1725e0c50463213d2 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('d64db1cc5d', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<div class="col-md-4 col-sm-12 col-xs-12 profile">
	<aside>
		<img width="150" height="150" alt="korandi image" src="https://scontent-mad1-1.xx.fbcdn.net/v/t1.0-9/13094273_974938549288393_3175650672515861634_n.jpg?oh=5984171c74daaaf094f7e150130b72d8&oe=58F151F4" class="img-circle">
		<h4>Konstantin "KORandi" Kožokar</h4>
		<p>PHP backend developer @Greendot.cz, CTU student</p>
		<hr>
		<p>Share this page:</p>
		<ul>
			<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>
" target="_blank"><img alt="facebook logo" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/images/social/fb.png"></a></li>
			<li><a href="http://twitter.com/share?url=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/images/social/twitter.png" alt="twitter logo"></a></li>
		</ul>
	</aside>
</div><?php
}}