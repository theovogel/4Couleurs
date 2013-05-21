<?php include(dirname(__FILE__) . '/header.php'); ?>

<section role="main">
	<?php include(dirname(__FILE__).'/navbar.php'); ?>

	<div class="content page static " id="static-<?php echo $plxShow->staticId(); ?>">

			<article role="article">

				<?php if($mobile == false): ?>
					<h1 class="mirror">
						<?php $plxShow->staticTitle(); ?>
					</h1>
				<?php endif; ?>

				<?php $plxShow->staticContent(); ?>

			</article>
	</div>

</section>

<?php include(dirname(__FILE__).'/sidebar.php'); ?>
<?php include(dirname(__FILE__) . '/footer.php'); ?>