<?php
// source: /home/users/konstantinkozoka/doge.jecool.net/web/app/components/NavControl.latte

class Templateb327583f34dd25926a14d83da6cbc4d7 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('f84c21f5c0', 'html')
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
<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img class="navbar-logo" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/images/doge.jpg" alt="doge">
      <a class="navbar-brand" href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Homepage:default"), ENT_COMPAT) ?>">Shiba doge bot v0.1</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if ($_presenter->isLinkCurrent("Homepage:default")) { ?> class="active" <?php } if ($_presenter->isLinkCurrent("Article:default")) { ?>
 class="active" <?php } ?>><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Homepage:default"), ENT_COMPAT) ?>">Posts</a></li>
        <li <?php if ($_presenter->isLinkCurrent("About:default")) { ?> class="active" <?php } ?>
><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("About:default"), ENT_COMPAT) ?>">About</a></li>
        <li <?php if ($_presenter->isLinkCurrent("Archive:default")) { ?> class="active" <?php } ?>
><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Archive:default"), ENT_COMPAT) ?>">Archive</a></li>
        <li <?php if ($_presenter->isLinkCurrent("Gallery:default")) { ?> class="active" <?php } ?>
><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Gallery:default"), ENT_COMPAT) ?>">Gallery</a></li>
        <li <?php if ($_presenter->isLinkCurrent("Contact:default")) { ?> class="active" <?php } ?>
><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Contact:default"), ENT_COMPAT) ?>">Contact</a></li>
        <?php if ($status) { ?><li <?php if ($_presenter->isLinkCurrent("Twitch:default")) { ?>
 class="active" <?php } ?>><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Twitch:default"), ENT_COMPAT) ?>
">Twitch log chat</a></li><?php } ?>

      </ul>
<?php if (!$status) { ?>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("User:default"), ENT_COMPAT) ?>" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret nojs"></span></a>
			<ul id="login-dp" class="dropdown-menu nojs">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 <form class="form" method="post" action="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>/user/login" accept-charset="UTF-8" id="signin">
										<div class="form-group">
											 <input name="csrf-token" value="<?php echo Latte\Runtime\Filters::escapeHtml($csrf_token, ENT_COMPAT) ?>" type="hidden" class="form-control">
											 <label class="sr-only" for="inputName">Name</label>
											 <input name="name" type="text" class="form-control" id="inputName" placeholder="Name" required>
										</div>
										<div class="form-group">
											 <label class="sr-only" for="inputPassword">Password</label>
											 <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block" id="send">Sign in</button>
											 <button type="submit" class="btn btn-primary btn-block" id="loading"><img alt="loading" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/www/include/images/loading.gif"></button>
										</div>
								 </form>
							</div>
							<div class="bottom text-center">
								New here ? <a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>/user/register"><b>Join Us</b></a>
							</div>
					 </div>
				</li>
			</ul>
        </li>
      </ul>
<?php } else { ?>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>/user/logout"><b>Logout</b></a></li>
      </ul>
<?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><?php
}}