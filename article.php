<?php include(dirname(__FILE__).'/header.php'); ?>

<section role="main">
	<?php include(dirname(__FILE__).'/navbar.php'); ?>

	<div class="content page article">

			<article role="article">

				<h2 class="mirror">
					<span class="date"><?php $plxShow->artDate('#num_day #month #num_year(4)'); ?></span>
					<?php $plxShow->artTitle('link'); ?>
				</h2>

				<div class="article-info">
					<p>
						<?php $plxShow->lang('WRITTEN_BY') ?> <?php $plxShow->artAuthor() ?> -
						<?php $plxShow->artNbCom(); ?><br>
					</p>
				</div>

				<div class="article-content">
					<?php $plxShow->artContent(); ?>
				</div>

				<div class="article-info">
					<p>
						<span class="icon label"></span> <?php $plxShow->artTags('<a href="#tag_url" title="#tag_name" class="tag">#tag_name</a>', ''); ?>
					</p>
				</div>


			</article>

			<?php $plxShow->artAuthorInfos('<div class="author-infos">#art_authorinfos</div>'); ?>

			<?php include(dirname(__FILE__).'/commentaires.php'); ?>

	</div>

</section>

<?php include(dirname(__FILE__).'/sidebar.php'); ?>
<?php include(dirname(__FILE__).'/footer.php'); ?>
