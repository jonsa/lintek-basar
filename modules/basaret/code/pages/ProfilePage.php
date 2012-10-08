<?php

class ProfilePage extends Page {

}

class ProfilePage_Controller extends Page_Controller {

	public function Content() {
		return ' ';
	}

	public function Form() {
		$member = Member::currentUser();
		if (!$member)
			return '';
		$signup = $member->getSignup();

		$fields = $member->getProfileFields();

		$actions = new FieldSet(new FormAction('doSave', _t('ProfilePage.SaveButton', 'Save')),
			new LiteralField('ChangePassword',
				'<p><a href="' . $this->Link('password') . '">'
						. _t('ProfilePage.ChangePassword', 'Change Password') . '</a></p>'));

		$validator = new RequiredFields('FirstName', 'Surname', 'Email', 'Program');

		$form = new Form($this, 'Form', $fields, $actions, $validator);
		$form->loadDataFrom($member);

		$fields = new FieldSet();
		return $form;
	}

	public function doSave($data, Form $form) {
		$member = Member::currentUser();
		$form->saveInto($member);
		$member->write();
		Director::redirect($this->Link());
	}

	public function password() {
		return array(
				'Title' => _t('ProfilePage.ChangePassword', 'Change Password'),
				'Content' => ' ',
				'Form' => $this->ChangePasswordForm()
		);
	}

	public function ChangePasswordForm() {
		$fields = new FieldSet(
			new PasswordField('CurrentPassword',
				_t('ProfilePage.CurrentPassword', 'Current Password')),
			new ConfirmedPasswordField('Password', _t('Member.NEWPASSWORD', 'New Passowrd')));

		$actions = new FieldSet(
			new FormAction('doChangePassword', _t('ProfilePage.SaveButton', 'Save')));

		$validator = new RequiredFields('CurrentPassword', 'Password');
		return new Form($this, 'ChangePasswordForm', $fields, $actions, $validator);
	}

	public function doChangePassword($data, Form $form) {
		$member = Member::currentUser();
		if (!$member->checkPassword($data['CurrentPassword'])->valid()) {
			$form = $this->ChangePasswordForm();
			$form
				->setMessage(_t('Member.ERRORPASSWORDNOTMATCH',
						'Your current password does not match, please try again'),
					'bad');
			return array(
					'Title' => _t('ProfilePage.ChangePassword', 'Change Password'),
					'Content' => ' ',
					'Form' => $form
			);
		}
		$form->saveInto($member);
		$member->write();
		Director::redirect($this->Link());
	}
}
