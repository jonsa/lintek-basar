<!DOCTYPE html>
<html lang="sv">
<head>
	$MetaTags(false)
	<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %></title>
	<link rel="shortcut icon" href="$ThemeDir/images/favicon.ico" type="image/x-icon"/>
	<% base_tag %>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
	<script src="http://explorercanvas.googlecode.com/svn/tags/m3/excanvas.compiled.js" type="text/javascript"></script>
	<![endif]-->
	<link href="themes/basaret/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<% require themedCSS(Page) %>
</head>

<body>
	<div id="header" class="row"><div class="container">
		<a id="logo-link" href="/"></a>
		$TopMenu
	</div></div>
	<div id="breadcrumbs" class="row"><div class="container">
		<div class="span12"><a href="/">Start</a> &raquo; $Breadcrumbs</div>
	</div></div>
	<div id="article"><div class="container">
		<div class="row">
		<div class="span3 sub-menu"><% if SubMenu %>$SubMenu<% else %>&nbsp;<% end_if %></div>
		<div class="span8 content<% if Content %> has-content<% end_if %>"><div>$Layout $Form</div></div>
		</div>
	</div></div>
	<div id="footer">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" type="text/javascript"></script>
	<script src="themes/basaret/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>