<?php
class SubmittedMemberField extends SubmittedFormField {
	public function getFormattedValue() {
		$id = (int) $this->Value;
		$member = null;
		if ($id)
			$member = DataObject::get_by_id('Member', $id);
		if ($member)
			return $member->Name;
		return '';
	}
	
	public function getExportValue() {
		return $this->getFormattedValue();
	}
}