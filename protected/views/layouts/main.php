<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	
	<?php Yii::app()->clientScript
		->registerMetaTag('width=device-width, initial-scale=1', 'viewport')
		->registerMetaTag('text/html; charset=UTF-8', 'Content-Type')
		->registerLinkTag('shortcut icon', 'image/x-icon', Yii::app()->request->baseUrl.'/images/icons/icon-72x72.png')
		->registerLinkTag('manifest', null, Yii::app()->request->baseUrl.'/manifest.json') // For Mobile app simulation
		->registerLinkTag('icon', null, Yii::app()->request->baseUrl.'/images/icons/icon-home-screen.png', null, array('sizes' => '256x256')) // Icon for home screnn
		->registerCssFile('https://fonts.googleapis.com/css?family=Pacifico') // Google Fonts
        ->registerCssFile('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css')
		->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css')
		->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js')
		->registerScriptFile('https://use.fontawesome.com/b860453c18.js')
		->registerScriptFile('//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js')
		->registerScriptFile(Yii::app()->request->baseUrl.'/js/scripts.js');
	?>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
</head>

<body>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<?php if(!Yii::app()->user->isGuest): ?>
					<a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl ?>/note/index">
						<img class="icon-brand" src="<?php echo Yii::app()->request->baseUrl ?>/images/icons/icon-72x72.png">
					</a>
				<?php endif ?>
				<a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl ?>/">
					<span>myNotes</span>
				</a>
			</div>
			<div class="pull-right">
				<div id="menu-button">
					<div class="icon-bar1"></div>
					<div class="icon-bar2"></div>
					<div class="icon-bar3"></div> 
				</div>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo Yii::app()->request->baseUrl ?>/about">About</a></li>
					<li><?php if(!Yii::app()->user->isGuest): ?>
							<a href="<?php echo Yii::app()->request->baseUrl ?>/note/index">Notes</a>
						<?php endif ?>
					</li> 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<?php if(Yii::app()->user->isGuest) echo '<a href="' . Yii::app()->request->baseUrl . '/user/create"><span class="glyphicon glyphicon-log-in"></span> Sign Up</a>' ?>
					</li>
					<?php if(Yii::app()->user->isGuest): ?>
					<li><a href="<?php echo Yii::app()->request->baseUrl ?>/site/login">Login</a></li>
					<?php else: ?>
					<li><a href="<?php echo Yii::app()->request->baseUrl ?>/user/view/<?php echo Yii::app()->user->id ?>">Account</a></li>
					<li><a href="<?php echo Yii::app()->request->baseUrl ?>/site/logout">Logout</a></li>
					<?php endif ?>
				</ul>
			</div>
		</div>
		<!-- Navigation for mobile -->
		<div id="mySidenav" class="sidenav">
			<h3 class="text-center"><i>Greetings, <?php if(Yii::app()->user->isGuest) echo 'Stranger'; else echo ucwords(User::model()->findByPk (Yii::app()->user->id)->fname); ?>!</i></h3>
			<a href="<?php echo Yii::app()->request->baseUrl ?>/about">About</a>
			<?php if(!Yii::app()->user->isGuest): ?>
				<a href="<?php echo Yii::app()->request->baseUrl ?>/note/index">Notes</a>
			<?php endif ?>
			<hr>
			<?php if(Yii::app()->user->isGuest) echo '<a href="' . Yii::app()->request->baseUrl . '/user/create">Sign Up</a>' ?>
			<?php if(Yii::app()->user->isGuest): ?>
				<a href="<?php echo Yii::app()->request->baseUrl ?>/site/login">Login</a>
			<?php else: ?>
				<a href="<?php echo Yii::app()->request->baseUrl ?>/user/view/<?php echo Yii::app()->user->id ?>">Account</a>
				<a href="<?php echo Yii::app()->request->baseUrl ?>/site/logout">Logout</a>
			<?php endif ?>
		</div>
		<!-- End Navigation for mobile -->
	</nav>

	<main>

		<?php echo $content; ?>

	</main>

	<footer></footer>
	
</body>
</html>

<!-- 

<a class="navbar-brand" href="<?php //echo Yii::app()->request->baseUrl ?>/"><?php //echo CHtml::encode(Yii::app()->name); ?></a>

-->