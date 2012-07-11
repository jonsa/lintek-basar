<?php
class DividedMenu extends Extension {
	public function extraStatics() {
		return array();
	}

	public function TopMenu() {
		Requirements::css(BASARET_DIR .'/css/DividedMenu.css');
		Requirements::javascript(BASARET_DIR .'/javascript/DividedMenu.js');
		return $this->owner->customise(array(
				'Menu' => $this->owner->Menu(1),
				'IncludeChildren' => false,
				'Type' => 'dm-topmenu'
		))->renderWith(array('DividedMenu'));
	}

	public function SubMenu() {
		Requirements::css(BASARET_DIR .'/css/DividedMenu.css');
		Requirements::javascript(BASARET_DIR .'/javascript/DividedMenu.js');
		$page = $this->owner;
		while ($page->ParentID != 0)
			$page = $page->Parent();

		return $this->owner->customise(array(
				'Root' => $page,
				'Menu' => $page->Children(),
				'IncludeChildren' => true,
				'Type' => 'dm-submenu'
		))->renderWith(array('DividedMenu'));
	}

	public function RenderChildren() {
		return $this->owner->renderWith(array('DividedMenu_children'));
	}
}