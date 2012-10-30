<?php

class UserDefinedFormDecorator extends Extension {
	public function updateForm(Form $form) {
		foreach ($this->owner->Fields() as $field) {
			if ($field instanceof EditableMemberField) {
				foreach ($this->owner->data()->Submissions() as $submission) {
					foreach ($submission->Values("`ClassName` = 'SubmittedMemberField'") as $record) {
						if ($record->Value == Member::currentUserID()) {
							$form
								->setMessage(_t('UserDefinedFormDecorator.AlreadySubmitted',
										'Already submitted'),
									'good');
							$form->setFields(new FieldSet());
							$form->setActions(new FieldSet());
						}
					}
				}
			}
		}
	}
}
