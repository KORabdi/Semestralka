<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/presenters/templates/Article/default.latte

class Template36087b8cb37435ab5152e414bd27eb7c extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8141aed73c', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lba9fae7ed21_content')) { function _lba9fae7ed21_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="col-md-7">
	<article>
		<header><h1><?php echo Latte\Runtime\Filters::escapeHtml($post['title'], ENT_NOQUOTES) ?></h1></header>
		<div class="lead">
		<?php echo Latte\Runtime\Filters::escapeHtml($post['body'], ENT_NOQUOTES) ?>

		</div>
	</article>
	<div id="comments">
		<h2>Comments</h2>
		<div class="row">
<?php if (count($comments)) { $iterations = 0; foreach ($comments as $comment) { ?>
				<div class="col-md-1 comment-num"><?php echo Latte\Runtime\Filters::escapeHtml(++$counter, ENT_NOQUOTES) ?></div>
				<div class="col-md-11">
					<p>
					<?php echo Latte\Runtime\Filters::escapeHtml($comment['body'], ENT_NOQUOTES) ?>

					</p>
					<footer>
						<small><strong><?php echo Latte\Runtime\Filters::escapeHtml($comment['author'], ENT_NOQUOTES) ?>
</strong> Commented on: <?php echo Latte\Runtime\Filters::escapeHtml($template->date($comment['date'], '%d.%m.%Y'), ENT_NOQUOTES) ?></small>
					</footer>
					<hr>
				</div>
<?php $iterations++; } } else { ?>
				Nobody commented this article
<?php } ?>
		</div>
<?php if ($isLoggedIn) { ?>
		<form id="comment" action="add?articleId=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($post['id']), ENT_COMPAT) ?>" method="POST">
			<h3>What is in your mind?</h3>
			<p>
				<label class="sr-only">Message</label>
				<textarea name="body" class="form-control" placeholder="Message" id="message" required><?php echo Latte\Runtime\Filters::escapeHtml($postArray['body'], ENT_NOQUOTES) ?></textarea>
			</p>
			<input type="submit" name="commentSuc" class="btn btn-primary" value="Send Message">
		</form>			
<?php } else { ?>
		<form id="comment" action="addcommon?articleId=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($post['id']), ENT_COMPAT) ?>" method="POST">
			<h3>What is in your mind?</h3>
			<p>
				<label class="sr-only">Message</label>
				<textarea name="body" class="form-control" placeholder="Message" id="message" required><?php echo Latte\Runtime\Filters::escapeHtml($postArray['body'], ENT_NOQUOTES) ?></textarea>
			</p>
			<p>
				<input name="csrf-token" value="<?php echo Latte\Runtime\Filters::escapeHtml($csrf_token, ENT_COMPAT) ?>" type="hidden" class="form-control">
				<label class="sr-only">Full name</label>
				<input name="author" value="<?php echo Latte\Runtime\Filters::escapeHtml($postArray['author'], ENT_COMPAT) ?>" type="text" class="form-control" placeholder="Full name" required>
			</p>
			<p>
				<label class="sr-only">Email Adress</label>
				<input name="email" value="<?php echo Latte\Runtime\Filters::escapeHtml($postArray['email'], ENT_COMPAT) ?>" type="email" class="form-control" placeholder="Email Adress" required>
			</p>
			<input type="submit" name="commentSuc" class="btn btn-primary" value="Send Message">
		</form>
<?php } ?>
	</div>
</div>

<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb88de0f8d34_scripts')) { function _lb88de0f8d34_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacrosRuntime::callBlockParent($_b, 'scripts', get_defined_vars()) ?>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function () {
    $('#comment').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            author: {
                required: true,
                minlength: 3
            },
            body: {
            	required: true,
            	minlength: 3
            }
        }
    });
});
</script>
<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb8dec3fb859_title')) { function _lb8dec3fb859_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo Latte\Runtime\Filters::escapeHtml($post['title'], ENT_NOQUOTES) ;
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb680967b8da_head')) { function _lb680967b8da_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/css/article.css" rel="stylesheet">
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