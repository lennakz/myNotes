<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	
	<?php Yii::app()->clientScript
		->registerMetaTag('width=device-width, initial-scale=1', 'viewport')
		->registerMetaTag('text/html; charset=UTF-8', 'Content-Type')
		->registerLinkTag('shortcut icon', 'image/x-icon', Yii::app()->request->baseUrl.'/images/icons/icon-72x72.png')
		->registerLinkTag('manifest', '', '<?php echo Yii::app()->request->baseUrl ?>/manifest.json') // For Mobile app simulation
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
				<a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl ?>/">
					<img class="icon-brand" src="<?php echo Yii::app()->request->baseUrl ?>/images/icons/icon-72x72.png">
					<i>my Notes</i>
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
					<li><a href="<?php echo Yii::app()->request->baseUrl ?>/note/index">Notes</a></li> 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					<li><a href="<?php echo Yii::app()->request->baseUrl ?>/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			</div>
		</div>
		<!-- Navigation for mobile -->
		<div id="mySidenav" class="sidenav">
			<a href="<?php echo Yii::app()->request->baseUrl ?>/about">About</a>
			<a href="<?php echo Yii::app()->request->baseUrl ?>/note/index">Notes</a>
			<hr>
			<a href="#">Sign Up</a>
			<a href="<?php echo Yii::app()->request->baseUrl ?>/login">Login</a>
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