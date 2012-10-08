<?php
define('BASARET_DIR', 'basaret');

Object::add_extension('ContentController', 'DividedMenu');
Object::add_extension('DataObject', 'DividedMenu');
Object::add_extension('Member', 'MemberProfile');

SiteTree::$breadcrumbs_delimiter = '<span class="divider">&raquo;</span></li><li>';
