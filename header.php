<?php session_start(); //SESSIONS START
if (!defined('PLX_ROOT')) exit;

//Détection d'un smartphone
$ua = $_SERVER['HTTP_USER_AGENT']; $browser = '';
$mobile = preg_match('#Android|BlackBerry|iPhone|iPod|iPad|HTC|Nokia|Opera Mobi|SonyEricsson|Symbian|webOS|Windows CE|WinWAP|YahooSeeker/M1A1-R2D2|LGE VX|phone#i', $ua);
if(preg_match('#Android#', $ua) && preg_match('#Chrome#', $ua)) {$mobileBrowser = 'Chrome';}
if(preg_match('#iPhone|iPad#', $ua)) {$mobileBrowser = 'iOS';}
if(preg_match('#MSIE#', $ua)) {$browser = 'IE';}
if(isset($_SESSION['mobile'])) { $mobile = $_SESSION['mobile']; }
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title><?php $plxShow->pageTitle(); ?></title>
	<?php $plxShow->meta('description') ?>
	<?php $plxShow->meta('keywords') ?>
	<?php $plxShow->meta('author') ?>
	<link rel="icon" href="<?php $plxShow->template(); ?>/img/favicon.png" />
	<link rel="stylesheet" href="<?php $plxShow->template(); ?>/css/style.css" media="screen"/>
	<?php if($mobile){ ?><link rel="stylesheet" href="<?php $plxShow->template(); ?>/css/mobile.css" media="screen"/><?php } ?>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>

	<?php if($mobile){ ?>
	<!--MOBILE-->
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes" /> 
		<meta name="apple-touch-fullscreen" content="yes">
		<link rel="apple-touch-icon" href="favicon.png"/>
	<?php } else { ?>
		<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php $plxShow->template(); ?>/css/styleIE.css" />
		<script src="<?php $plxShow->template(); ?>/js/html5ie.js"></script>
		<script src="<?php $plxShow->template(); ?>/js/respond.min.js"></script>
		<![endif]-->
	<?php } ?>

	<?php if($mobileBrowser == 'Chrome' || $mobile == false): ?>
	<!--CHROME-->
		<style type="text/css">
			.mirror {
				-webkit-box-reflect: below 0
				-webkit-gradient(linear,0 0,0 100%,
				from(transparent),color-stop(.6,transparent),
				to(rgba(255, 255, 255, 0.3)));
			}
		</style>
	<?php endif; ?>

	<?php if($mobileBrowser == 'iOS') : ?>
	<!--iPhone-->
		<script src="<?php $plxShow->template(); ?>/js/add2home.js"></script>
		<link rel="stylesheet" href="<?php $plxShow->template(); ?>/css/add2home.css">
	<?php endif; ?>
</head>

<body id="top"> <?php if($mobile): ?><div id="viewport"><?php endif; ?>
	<?php if(!$mobile){ ?><div id="smartphone">Vous avez une résolution inférieur à 640px, souhaitez-vous utiliser la version mobile pour une navigation optimale ? <br> <a href="#" class="cancel">Annuler</a> <a href="#" class="switchMob">Utiliser la version Mobile</a></div><?php } ?>