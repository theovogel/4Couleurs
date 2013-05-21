<?php if (!defined('PLX_ROOT')) exit; ?>

	<?php if(!$mobile): ?>
	<!--DESKTOP-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="<?php $plxShow->template(); ?>/js/jquery.nicescroll.min.js"></script>
		<script src="<?php $plxShow->template(); ?>/js/jquery.fittext.js"></script>
		<script src="<?php $plxShow->template(); ?>/js/main.js"></script>
	<?php endif; ?>

	<?php if($mobile): ?>
	<!--MOBILE-->
		<script src="<?php $plxShow->template(); ?>/js/zepto.min.js"></script>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<div class="popup">
			<h2>Partager</h2>
			<a class="facebook" href="https://www.facebook.com/dialog/feed?app_id=458358780877780&link=https://developers.facebook.com/docs/reference/dialogs/&picture=http://fbrell.com/f8.jpg&name=Facebook%20Dialogs&caption=Reference%20Documentation&description=Using%20Dialogs%20to%20interact%20with%20users.&redirect_uri=https://mighty-lowlands-6381.herokuapp.com/"></a>
			<a class="twitter" href="https://twitter.com/share" data-lang="fr" data-url="<?php $plxShow->racine(); ?>"></a>
			<a class="googlePlus" href="javascript:void(window.open('https://plus.google.com/share?url='+encodeURIComponent(location), 'Share to Google+','width=600,height=460,menubar=no,location=no,status=no'));"></a>
		</div>
	</div> <!--FIN VIEWPORT-->
	<?php endif; ?>

	<script>
		$(document).ready(function() {
			var firstTime = true;
			var racine = '<?php $plxShow->racine(); ?>';
			racine = racine.replace('http://', '');
			
			$('a.cancel').click(function(){ {$('#smartphone').fadeOut();} }); //Fermer le calque lors de la dimension à moins de 640px

			<?php if($mobile): ?>
			//=====================================MOBILE=======================================
			//Hauteur de la page
			function coolResize() { $('section').css({height: $(window).height() - $('.navbar').height()}) }
			$(window).resize(function(){coolResize();}); coolResize();

			//MENU ASIDE
			function toggleMenu() {
				if($('section').hasClass('panelIn')) { $('section').toggleClass('panelIn'); } else {$('aside').css('display', 'block');  $('section').toggleClass('panelOut');} 
			};
			$('section').on('touchstart touchmove touchend', '.page', function() {if($('section').hasClass('panelOut')) {toggleMenu();}});
			$('.page').on('touchstart touchmove touchend', function(){if($('section').hasClass('panelOut')) {toggleMenu();}});
			$('.menu').click(function(e){e.preventDefault(); toggleMenu();});
			$('aside a').not('#footer a, navbar a').click(function(e){e.preventDefault(); toggleMenu();});

			//PARTAGE
			$('.share').click(function(e){e.preventDefault(); toggleOverlay();});

			//POPUP
			function toggleOverlay() {
				$('body').append($('<div id="overlay"></div>'));
				$('.popup').toggle();
				var left = $(window).width()/2 - $('.popup').width()/2;
				var top = $(window).height()/2 - $('.popup').height()/2;
				$('.popup').css({opacity:1, left: left+'px', top: top+'px'});
				$('#overlay').on('touchmove', function(e) { e.preventDefault(); }); //Bloque le scroll mobile 
				$('#overlay').on('touchend click', function(){
					$('.popup').animate({opacity:0, top: '-'+top+'px'}, {complete: function(){ $(this).css('display', 'none');}})
					$(this).animate({opacity:0}, {complete: function(){ $(this).remove();}})
				});
			}

		<?php endif; ?>

		//=====================================MENU AJAX=======================================		
		if(typeof history.pushState !== 'undefined') { //Si l'API HISTORY est géré

			//AJAX FADEIN
			function ajaxLoad(url) {
		   		$.ajax({
					url: url,
					<?php if($mobile): ?> beforeSend: function() {$('.navbar img').attr('src', '<?php $plxShow->template(); ?>/img/ajax-loader.gif'); },<?php endif; ?>
					success: function(data) {
						$('.navbar img').attr('src', '<?php $plxShow->template(); ?>/img/favicon.png');
						firstTime = false;

						//Traitement dans un dom séparé
						var tempDiv = $('<div>');
						tempDiv.html(data.replace(/<script(.|\s)*?\/script>/g, ''));
						<?php if($mobile): ?> 
							var title = $(tempDiv.find('.navbar h1')[0]).text(); 
							title = title.replace('- <?php $plxShow->mainTitle() ?>', ''); 
						<?php endif; ?>
						var result = tempDiv.find('.page'); 

						//Ajout au dom
						result.css({display: 'none'});
						<?php if($mobile): ?>
						$('aside').css('display', 'none');
						$('.navbar h1').text(title);
						<?php endif; ?>

						<?php if(!$mobile): ?>
							if($('iframe').length > 0) {
								$('iframe').remove(0); $('section').append(result); 
								$('.page').css({width: $(window).width() - $('aside').width()+'px'}); result.animate({opacity: 'show'});
								eval("$('.page').niceScroll({cursorborder :\"1px solid #2289A1\", cursorcolor: '#2289A1', cursorborderradius: '0px'}); $('.page h1, #credits article h1').fitText(0.9);");


							} else { <?php endif; ?>
								$('.page').animate({opacity: 0}, {
								duration: 'normal', 
								complete: function() {
									$(this).remove();
									$('section').append(result);
									initVerifForm();

									<?php if(!$mobile): ?>
										$('.page').css({width: $(window).width() - $('aside').width()+'px'});
										 result.animate({opacity: 'show'});
										eval("$('.page').niceScroll({cursorborder :\"1px solid #2289A1\", cursorcolor: '#2289A1', cursorborderradius: '0px'}); $('.page h1, #credits article h1').fitText(0.9);");
									<?php endif; ?>

									<?php if($mobile): ?> result.animate({display: 'block', opacity: 1}, {duration: 'slow'}); <?php endif; ?>
									}
								});
							<?php if(!$mobile): ?> } <?php endif; ?>
					
						//URL Bouton Switch
						$('.switchMob').attr('href', '<?php $plxShow->template(); ?>/switchMob.php?url=' + document.location.href);
						$('.switchDesktop').attr('href', '<?php $plxShow->template(); ?>/switchDesktop.php?url=' + document.location.href);
					}

				})
			}

			$('aside a').not('#footer a, navbar a').click(function(e){
			    var url = this.href;
			    var self = $(this);

			    //Si c'est une page statique
				if(url.match(/static/) != null) {
					var i = url.match(/static[0-9]/)[0].substr(6, 1);
					changeColor(self, i, 'menu');
				} else {
					var menu = self.parent().get(0).id;
					changeColor(self, 1, menu);
				}

				//Si la page demandé n'est pas une url externe
				if(!url.match('^http://www')) {
					console.log(url);
					e.preventDefault();
				    if(url != document.location.href) { //Si la page demandé n'est pas la page actuelle
						if(! document.webkitIsFullScreen) { history.pushState({key: 'value'}, 'titre', url); } //Ajout dans l'historique // Chrome bug with pushState & fullscreen
						ajaxLoad(url); //Chargement en ajax
					}
				} else {
					<?php if($mobile): ?> document.location.href = url; <?php endif; ?>
					<?php if(!$mobile): //Ouverture d'une iframe pour les liens externes en desktop ?>
						e.preventDefault();
						document.location.hash = url
						if($('iframe').length > 0) {$('iframe').remove(0);}
						var iframe = document.createElement("iframe") ;
						iframe.src = url; iframe.seamless = 1; iframe.width = $(window).width() - $('aside').width()+'px';  iframe.height = $(window).height() +'px'; iframe.setAttribute('frameborder', 0);
						$(iframe).css({display: 'none'});
						$('.page').remove();
						$('section').append(iframe); $('iframe').fadeIn();
						$(window).resize(function(){iframe.width = $(window).width() - $('aside').width()+'px';  iframe.height = $(window).height() +'px';});
					<?php endif; ?>
				}
			});


			window.onpopstate = function(event) {

				if(event.state == null) { //Page d'Accueil ou un Rafraichissement

					//URL Bouton Switch
					$('.switchMob').attr('href', '<?php $plxShow->template(); ?>/switchMob.php?url=' + document.location.href);
					$('.switchDesktop').attr('href', '<?php $plxShow->template(); ?>/switchDesktop.php?url=' + document.location.href);

					//Page d'accueil
					if(document.location.href.replace('http://', '') == racine) {

						//Si ce n'est pas la première arrivé
						if(!firstTime) {ajaxLoad(document.location.pathname);} 
					}

				} else {
					if($('section').hasClass('panelOut')) { $('section').toggleClass('panelOut'); }
					ajaxLoad(document.location.pathname);
				}

			}


		} //FIN IF HISTORY

		//Couleur du menu adapté au fond de la page
		function changeColor(self, i, menu) {
			var colorsMenu = new Array('#2289A1', '#ECB032', '#F56545', '#409467'); if(i > colorsMenu.length) {i=1;}
			$('aside a').not('h1 a').css('color', colorsMenu[i-1]);
			$('#menu').css({borderBottom: '1px solid '+colorsMenu[i-1]});
			if(menu === 'menu') {self.css({backgroundColor: colorsMenu[i-1], color: 'black'});}
			$('#menu a').mouseover(function(){$(this).css({backgroundColor: colorsMenu[i-1], color: 'black'}); });
			$('#menu a').mouseout(function(){$(this).css({backgroundColor: 'black', color: colorsMenu[i-1]}); });
		}

		//=====================================CREDITS=======================================
		function globalEval(data) {
			( window.execScript || function( data ) {
				window["eval"].call( window, data );
			} )( data );
		}

		$.get("<?php str_replace('www', '' , $plxShow->template()); ?>/js/light.credits.min.js", function(data) {
			globalEval(data);

			$('.theEnd').credits({
				url: '<?php $plxShow->racine(); ?>/static5/mentions article', 
				imgDirectory: '<?php $plxShow->template(); ?>/img/controls.png'
			});

		});
	

		//=====================================VERIF FORM=======================================	
		
		//Constructeur Object Field
		function Field(id, o, require, regex, defaut) {
			this.id = id;
			this.o = o;
			this.require = require;
			this.regex = regex;
			this.defaut = defaut;
		}

		//Constructeur Object VerifForm
		function VerifForm(idForm) {
			this.id = idForm;
			this.fields= [];

			this.addField = function(id, require, regex, defaut) {
				if($(idForm).length > 0) {
					this.fields.push(new Field (id,	$(idForm).find(id), require, regex, defaut));
				}
			}
		}

		VerifForm.prototype = {
			_init: function() {
				this._initEvent();
			},

			_initEvent: function() {
				var fields = this.fields;
				var idForm = this.id;

				//Pour chaque Champs
				for (var i in fields) {
					var fieldDom = fields[i].o;
					var field = fields[i];

					(function(i){

						//Event FOCUS/BLUR : Non égal à la valeur par défaut
						$('section').on({
							focus: function(){ if(this.value === fields[i].defaut) {this.value = '';}},
							blur: function(){ 
								if(this.value === '') {this.value = fields[i].defaut; $(this).addClass('require')} else {$(this).removeClass('require')}
									if(fields[i].regex === 'email') {
										if(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(this.value)) {$(this).removeClass('require')} else {$(this).addClass('require')}
									}
								}
						}, fields[i].id);
					})(i);
				}

				//Event SUBMIT : Vérification global
				$('section').on('submit', idForm, function(){
					var result = true;

					//CHECK
					for (var i in fields) {
						var value = fields[i].o.val();

						if(fields[i].require) {
							if(value === fields[i].defaut || value === '') {result = false; fields[i].o.addClass('require');}

							if(fields[i].regex === 'email') {
								if(!/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(value)) {result = false; fields[i].o.addClass('require');}
							}
						} 

					}

					if(!result) { $('p.com-alert').css('display', 'block'); return false;} else { return result; }
				});

			}
		}

		function initVerifForm(){
			//VERIF FORM COMMENTAIRE
			var formCom = new VerifForm('#formComment');
			formCom.addField('#id_name', true, '', "<?php $plxShow->comGet('name',$plxShow->lang('NAME')); ?>");
			formCom.addField('#id_site', true, '', "<?php $plxShow->comGet('site',$plxShow->lang('WEBSITE')); ?>");
			formCom.addField('#id_mail', true, 'email', "<?php $plxShow->comGet('mail',$plxShow->lang('EMAIL')); ?>");
			formCom.addField('#id_content', true, '', "<?php $plxShow->comGet('content',$plxShow->lang('COMMENT')); ?>");
			formCom.addField('#id_rep', true, '', '');
			formCom._init();
		};
		initVerifForm();

	});

	</script>

</body>

</html>