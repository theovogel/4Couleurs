<?php include(dirname(__FILE__).'/header.php'); ?>

<section role="main">
	<?php include(dirname(__FILE__).'/navbar.php'); ?>

	<div class="content page article cat">

			<?php while($plxShow->plxMotor->plxRecord_arts->loop()): ?>

			<article role="article">

				<h2 class="mirror">
					<span class="date"><?php $plxShow->artDate('#num_day #month #num_year(4)'); ?></span>
					<?php $plxShow->artTitle('link'); ?>
				</h2>

				<div class="article-info">
					<p>
						<?php $plxShow->lang('WRITTEN_BY') ?> <?php $plxShow->artAuthor() ?> -
						<?php $plxShow->artNbCom(); ?>
					</p>
				</div>

				<div class="article-content">
					<?php $plxShow->artChapo(); ?>
				</div>
				
				<div class="article-info mobileHide">
					<p>
						<span class="icon label"></span> <?php $plxShow->artTags('<a href="#tag_url" title="#tag_name" class="tag">#tag_name</a>', ''); ?>
					</p>
				</div>

			</article>

			<?php endwhile; ?>

			<div id="pagination">
				<?php $plxShow->pagination(); ?>
			</div>
	</div>

</section>

<?php include(dirname(__FILE__).'/sidebar.php'); ?>
<?php include(dirname(__FILE__).'/footer.php'); ?>
