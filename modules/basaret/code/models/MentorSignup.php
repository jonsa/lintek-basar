<?php

class MentorSignup extends DataObject {
	public static $db = array(
			'Year' => 'Year',
			'AskToMentor' => 'Boolean',
			'AskToShadow' => 'Boolean',
			'AskToParty' => 'Boolean'
	);

	public static $has_one = array(
			'Submitter' => 'Member'
	);

	public function fieldLabels($includerelations = true) {
		$labels = parent::fieldLabels($includerelations);
		$labels['AskToMentor'] = _t('MentorSignup.db_AskToMentor',
			'Ask me if I want to be a mentor');
		$labels['AskToShadow'] = _t('MentorSignup.db_AskToShadow',
			'Ask me if I want to be shadowed by a new student');
		$labels['AskToParty'] = _t('MentorSignup.db_AskToParty',
			'Ask me if I want to attend parties');
		return $labels;
	}
}
