<?php
class EditableMemberField extends EditableFormField {
	
	static $singular_name = 'Member Field';
	
	static $plural_name = 'Member Fields';
	
	public function getFormField() {
		$name = $this->getExportValue();
		$field = new TextField($this->Name, $this->Title, $name);
		if ($name)
			return $field->transform(new ReadonlyTransformation());
		return $field;
	}
	
	public function getValueFromData($data) {
		if (Member::currentUserID())
			return Member::currentUserID();
		return $data[$this->Name];
	}
	
	public function getExportValue() {
		if (Member::currentUserID())
			return Member::currentUser()->Name;
		return '';
	}
	
	public function getIcon() {
		return BASARET_DIR . '/images/' . strtolower($this->class) . '.png';
	}
	
	public function getSubmittedFormField() {
		return new SubmittedMemberField();
	}
}