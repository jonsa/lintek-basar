<?php

class MemberLoginPage extends RedirectorPage {
	public function canCreate($member = null) {
		$filter = '`Classname` = \'MemberLoginPage\'';
		if (ClassInfo::exists('Subsite'))
			$filter .= ' AND `SubsiteID` = ' . Subsite::currentSubsiteID();
		$page = DataObject::get_one('MemberLoginPage', $filter);
		if ($page)
			return false;
		return parent::canCreate($member);
	}

	public function Link($action = null) {
		if (Member::currentUserID())
			return parent::Link($action);
		return $this->regularLink($action);
	}

	public function redirectionLink() {
		if (Member::currentUserID())
			return parent::redirectionLink();
		return null;
	}
}

class MemberLoginPage_Controller extends RedirectorPage_Controller {
	public static $allowed_actions = array(
			'register',
			'Form',
			'RegisterForm',
	);

	public function index() {
		if (Member::currentUserID())
			return Director::redirect($this->redirectionLink(), 301);
		return array();
	}

	public function Content() {
		if (Member::currentUserID())
			return parent::Content();
		return ' ';
	}

	public function Form() {
		$fields = new FieldSet(new TextField('Email', _t('Member.EMAIL', 'E-mail')),
			new PasswordField('Password', _t('Member.PASSWORD', 'Password')));
		$actions = new FieldSet(new FormAction('doLogin', _t('Security.LOGIN', 'Login')),
			new LiteralField('register',
				'<p><a href="' . $this->regularLink('register') . '">'
						. _t('ProfilePage.Register', 'Register Account') . '</a></p>'));
		$validator = new RequiredFields('Email', 'Password');
		return new Form($this, 'Form', $fields, $actions, $validator);
	}

	public function doLogin($data, Form $form) {
		$authenticator = new MemberAuthenticator();
		$member = $authenticator->authenticate($data, $form);
		if ($member) {
			$member->logIn();
			return Director::redirect($this->Link());
		}
		return array(
				'Form' => $form
		);
	}

	public function register() {
		return array(
				'Title' => _t('MemberLoginPage.RegisterAccount', 'Register Account'),
				'Content' => ' ',
				'Form' => $this->RegisterForm()
		);
	}

	public function RegisterForm() {
		$fields = singleton('Member')->getRegistrationFields();
		$fields
			->push(new CheckboxField('Confirm',
					_t('MemberLoginPage.ConfirmRegister', 'I allow my information to be saved')));
		$actions = new FieldSet(
			new FormAction('doRegister', _t('ProfilePage.RegisterButton', 'Register')));
		$validator = new RequiredFields('FirstName', 'Surname', 'Email', 'Password[_Password]', 'Program');
		return new Form($this, 'RegisterForm', $fields, $actions, $validator);
	}

	public function doRegister($data, Form $form) {
		if (!(isset($data['Confirm']) && $data['Confirm'])) {
			$form
				->setMessage(_t('MemberLoginPage.ConfirmMissingError',
						'You need to confirm that you allow your information to be saved'),
					'bad');
			return array(
					'Title' => _t('MemberLoginPage.RegisterAccount', 'Register Account'),
					'Content' => ' ',
					'Form' => $form
			);
		}

		$member = DataObject::get_one('Member',
			sprintf("`Email` = '%s'", Convert::raw2sql($data['Email'])));
		if ($member) {
			$form
				->setMessage(_t('MemberLoginPage.EmailExistsError',
						'The email you provided is already in use'),
					'bad');
			return array(
					'Title' => _t('MemberLoginPage.RegisterAccount', 'Register Account'),
					'Content' => ' ',
					'Form' => $form
			);
		}

		$member = new Member();
		$form->saveInto($member);
		$member->write();
		$member->logIn();
		return Director::redirect($this->Link());
	}
}
