<?php if(!defined('PLX_ROOT')) exit; ?>

	<?php if($plxShow->plxMotor->plxRecord_coms): ?>

	<div id="comments">

	<h2>
		<?php echo $plxShow->artNbCom() ?>
	</h2>

		<?php while($plxShow->plxMotor->plxRecord_coms->loop()): # On boucle sur les commentaires ?>

		<div id="<?php $plxShow->comId(); ?>" class="comment">
			<span class="infoComment">
					<strong><?php $plxShow->comAuthor('link'); ?></strong>
					<span class="right"><a class="num-com" href="<?php $plxShow->ComUrl() ?>" title="#<?php echo $plxShow->plxMotor->plxRecord_coms->i+1 ?>">#<?php echo $plxShow->plxMotor->plxRecord_coms->i+1 ?></a> <?php $plxShow->comDate('#day #num_day #month #num_year(4) | #hour:#minute'); ?></span>
				</span>
			<p class="content_com type-<?php $plxShow->comType(); ?>"><?php $plxShow->comContent() ?> </p>
		</div>

		<?php endwhile; # Fin de la boucle sur les commentaires ?>

	</div>

	<?php endif; ?>

	<?php if($plxShow->plxMotor->plxRecord_arts->f('allow_com') AND $plxShow->plxMotor->aConf['allow_com']): ?>

	<div id="form">

		<h2>
			<?php $plxShow->lang('WRITE_A_COMMENT') ?>
		</h2>

		<form action="<?php $plxShow->artUrl(); ?>#form" method="post" id="formComment">
			<fieldset>
				<p><?php $plxShow->comMessage('<p class="com-alert" style="display: block;">#com_message</>'); ?></p>
				<p class="com-alert">Vous n'avez pas remplis tous les champs.</p>

				<p><input id="id_name" name="name" type="text" size="20" value="<?php $plxShow->comGet('name',$plxShow->getlang('NAME')); ?>" maxlength="30" /></p>
				<p><input id="id_site" name="site" type="text" size="20" value="<?php $plxShow->comGet('site',$plxShow->getlang('WEBSITE')); ?>" /></p>
				<p><input id="id_mail" name="mail" type="text" size="20" value="<?php $plxShow->comGet('mail',$plxShow->getlang('EMAIL')); ?>" /></p>
				<p><textarea id="id_content" name="content" cols="35" rows="6"><?php $plxShow->comGet('content',$plxShow->getlang('COMMENT')); ?></textarea></p>
				
				<p><?php if($plxShow->plxMotor->aConf['capcha']): ?></p>
				<p>
					<?php $plxShow->capchaQ(); ?>&nbsp;:&nbsp;<input id="id_rep" name="rep" type="text" size="10" />
					<?php endif; ?>
				</p>

				<p>
					<input type="submit" value="<?php $plxShow->lang('SEND') ?>" />
				</p>
			</fieldset>
		</form>

	</div>

	<?php else: ?>

		<p>
			<?php $plxShow->lang('COMMENTS_CLOSED') ?>.
		</p>

	<?php endif; # Fin du if sur l'autorisation des commentaires ?>
