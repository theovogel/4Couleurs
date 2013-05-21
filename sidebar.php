<?php if(!defined('PLX_ROOT')) exit; ?>

<aside>
	<h1 class="title mirror"><?php $plxShow->mainTitle('link'); ?></h1>

	<nav id="menu">
		<?php $plxShow->staticList('', '<a href="#static_url" class="#static_status" title="#static_name">#static_name</a>'); ?>
		<?php $plxShow->catList('','<a class="#cat_status" href="#cat_url" title="#cat_name">#cat_name (#art_nb)</a>'); ?>
	</nav>


	<div class="aside-title">
		<?php $plxShow->lang('TAGS') ?>
	</div>

	<div class="aside-content">
		<?php $plxShow->tagList('<span class="tag #tag_size"><a class="#tag_status" href="#tag_url" title="#tag_name">#tag_name</a></span>', 20); ?>
	</div>

	<div class="aside-title">
		<?php $plxShow->lang('ARCHIVES') ?>
	</div>

	<div class="aside-content">
			<?php $plxShow->archList('<a class="#archives_status" href="#archives_url" title="#archives_name">#archives_name</a> (#archives_nbart)<br>'); ?>
	</div>

	<div id="footer">
		<a rel="nofollow" href="<?php $plxShow->urlRewrite('core/admin/') ?>" title="<?php $plxShow->lang('ADMINISTRATION') ?>"><?php $plxShow->lang('ADMINISTRATION') ?></a>
		| <a href="<?php $plxShow->racine(); ?>" class="theEnd">Mentions</a>
		<?php if(!$mobile && $browser != 'IE'): ?>| <a href="<?php $plxShow->racine(); ?>" class="fullScreen"></a><?php endif; ?><br>
		<a href="http://www.pluxml.org" title="<?php $plxShow->lang('PLUXML_DESCRIPTION') ?>">PluXml</a> <?php $plxShow->lang('IN') ?> <?php $plxShow->chrono(); ?><br>
		<?php if($mobile){ ?><a href="#" class="switchDesktop">Version Desktop</a><?php } ?>
	</div>

</aside>