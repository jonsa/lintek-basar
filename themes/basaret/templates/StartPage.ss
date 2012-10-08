<!DOCTYPE html>
<html>
<head>
	$MetaTags(false)
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %></title>
	<link rel="shortcut icon" href="/$ThemeDir/css/images/favicon.ico" type="image/x-icon"/>
	<% base_tag %>
	<!--[if lt IE 9]>
	<script src="/$ThemeDir/javascript/html5.js" type="text/javascript"></script>
	<script src="/$ThemeDir/javascript/excanvas.compiled.js" type="text/javascript"></script>
	<script src="/$ThemeDir/javascript/respond.min.js" type="text/javascript"></script>
	<style type="text/css">body{overflow-x: hidden;}</style>
	<![endif]-->
	<link href="/$ThemeDir/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/$ThemeDir/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<% require themedCSS(Page) %>
</head>

<body>
	<div id="header" class="row-fluid">
		<div>
			<p class="page-title">$SiteConfig.Title</p>
			<p class="page-tagline">$SiteConfig.Tagline</p>
		</div>
		<img id="karallen" src="/$ThemeDir/css/images/karallen.png" alt="">
		$TopMenu
	</div>
	<div class="container-fluid">
		<ul class="breadcrumb"><li><a href="/">Start</a><span class="divider">&raquo;</span></li><li>$Breadcrumbs</li></ul></div>
	</div>
	<div id="article"><div class="container-fluid">
		<div class="row-fluid">
		<div class="span1"></div>
		<div class="span10 offset1 content<% if Content %> has-content<% end_if %>"><div>$Layout $Form</div></div>
		</div>
	</div></div>
	<div id="footer">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="/$ThemeDir/javascript/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	<script src="/$ThemeDir/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
