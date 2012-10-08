<?php
class LogoutPage extends Page {
	public function canCreate($member = null) {
		$filter = '`Classname` = \'LogoutPage\'';
		if (ClassInfo::exists('Subsite'))
			$filter .= ' AND `SubsiteID` = ' . Subsite::currentSubsiteID();
		$page = DataObject::get_one('LogoutPage', $filter);
		if ($page)
			return false;
		return parent::canCreate($member);
	}

	public function getCMSFields($params = null) {
		$fields = parent::getCMSFields($params);
		$fields->removeByName('Content', true);
		return $fields;
	}
}

class LogoutPage_Controller extends Page_Controller {
	public function index() {
		$member = Member::currentUser();
		if ($member)
			$member->logOut();
		
		$filter = '`Classname` = \'MemberLoginPage\'';
		if (ClassInfo::exists('Subsite'))
			$filter .= ' AND `SubsiteID` = ' . Subsite::currentSubsiteID();
		$page = DataObject::get_one('MemberLoginPage', $filter);
		if ($page)
			return Director::redirect($page->Link());
		Director::redirectBack();
	}
}