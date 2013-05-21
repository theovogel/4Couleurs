<?php include(dirname(__FILE__) . '/header.php'); ?>

<section role="main">
	<?php include(dirname(__FILE__).'/navbar.php'); ?>

	<div class="content page static " id="static-<?php echo $plxShow->staticId(); ?>">

			<article role="article">

				<h2 class="mirror">
					<?php $plxShow->lang('ERROR') ?>
				</h2>

				<p>
					<?php $plxShow->erreurMessage(); ?>
				</p>
				
			</article>

	</div>

</section>

<?php include(dirname(__FILE__).'/sidebar.php'); ?>
<?php include(dirname(__FILE__) . '/footer.php'); ?>