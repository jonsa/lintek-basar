<?php

class MemberProfile extends DataObjectDecorator {
	protected $signup_cache = null;

	public function extraStatics() {
		return array(
				'db' => array(
						'Program' => 'Varchar(100)',
						'DidBaseYear' => 'Int'
				),
				'has_many' => array(
						'Signups' => 'MentorSignup'
				),
				'field_labels' => array(
						'DidBaseYear' => _t('MemberProfile.DidBaseYear',
							'Completed Base Year (year)')
				)
		);
	}

	public function getDidBaseYear() {
		$value = $this->owner->getField('DidBaseYear');
		if ($value)
			return $value;
		return '';
	}

	public function getSignup() {
		if (!$this->signup_cache) {
			$year = date('Y');
			foreach ($this->owner->Signups() as $form) {
				if ($form->Year == $year) {
					$this->signup_cache = $form;
					break;
				}
			}
			if (!$this->signup_cache) {
				$this->signup_cache = new MentorSignup();
				$this->signup_cache->Year = $year;
				$this->signup_cache->write();
				$this->owner->Signups()->add($this->signup_cache);
			}
		}
		return $this->signup_cache;
	}

	public function getProfileFields() {
		$fields = new FieldSet();
		$fields
			->push($this->owner->dbObject('FirstName')
					->scaffoldFormField($this->owner->fieldLabel('FirstName')));
		$fields
			->push($this->owner->dbObject('Surname')
					->scaffoldFormField($this->owner->fieldLabel('Surname')));
		$fields->push(new EmailField('Email', $this->owner->fieldLabel('Email')));
		$fields->push($this->getProgramDropdown());
		$fields
			->push($this->owner->dbObject('DidBaseYear')
					->scaffoldFormField($this->owner->fieldLabel('DidBaseYear')));

		$signup = $this->getSignup();
		if ($this->owner->Program != 'Alumn') {
			$fields
				->push($signup->dbObject('AskToMentor')
						->scaffoldFormField($signup->fieldLabel('AskToMentor')));
			$fields
				->push($signup->dbObject('AskToShadow')
						->scaffoldFormField($signup->fieldLabel('AskToShadow')));
		}
		$fields
			->push($signup->dbObject('AskToParty')
					->scaffoldFormField($signup->fieldLabel('AskToParty')));
		return $fields;
	}

	public function getRegistrationFields() {
		$fields = $this->getProfileFields();
		$fields
			->insertAfter($password = new ConfirmedPasswordField('Password',
					$this->owner->fieldLabel('Password')), 'Email');
		$password->minLength = 1;
		$fields->removeByName('AskToMentor');
		$fields->removeByName('AskToShadow');
		$fields->removeByName('AskToParty');
		
		return $fields;
	}

	public function setAskToMentor($value) {
		$signup = $this->getSignup();
		$signup->AskToMentor = $value;
	}

	public function setAskToShadow($value) {
		$signup = $this->getSignup();
		$signup->AskToShadow = $value;
	}

	public function setAskToParty($value) {
		$signup = $this->getSignup();
		$signup->AskToParty = $value;
	}

	public function getAskToMentor() {
		return $this->getSignup()->AskToMentor;
	}

	public function getAskToShadow() {
		return $this->getSignup()->AskToShadow;
	}

	public function getAskToParty() {
		return $this->getSignup()->AskToParty;
	}

	public function onAfterWrite() {
		if ($this->signup_cache && count($this->signup_cache->getChangedFields(true)))
			$this->signup_cache->write();
		parent::onAfterWrite();
	}

	protected function getProgramDropdown() {
		static $values = array(
				'Alumn',
				'Affärsjuridiska programmet',
				'Affärsjuridiska programmet med Europainriktning',
				'Arbetsterapeut',
				'Asienkunskap - inriktning Japan (Yi)',
				'Asienkunskap - inriktning Japan (Ii)',
				'Asienkunskap - inriktning Kina (Yi)',
				'Asienkunskap - inriktning Kina (Ii)',
				'Bastermin för dig som har läst Ma C, Fy A, Ke A',
				'Biologi, kandidatprogram',
				'Biomedicinsk analytiker',
				'Civilekonom',
				'Civilekonom, internationell',
				'Civilingenjör i datateknik',
				'Civilingenjör i design och produktutveckling',
				'Civilingenjör i elektronikdesign',
				'Civilingenjör i energi - miljö - management',
				'Civilingenjör i industriell ekonomi',
				'Civilingenjör i industriell ekonomi, internationell',
				'Civilingenjör i informationsteknologi',
				'Civilingenjör i kemisk biologi - med valbar utgång till naturvetenskaplig kandidat',
				'Civilingenjör i kommunikation, transport och samhälle',
				'Civilingenjör i maskinteknik',
				'Civilingenjör i medicinsk teknik',
				'Civilingenjör i medieteknik',
				'Civilingenjör i teknisk biologi',
				'Civilingenjör i teknisk fysik och elektroteknik',
				'Civilingenjör i teknisk fysik och elektroteknik, internationell',
				'Datavetenskap, kandidatprogram',
				'Flygtrafik och logistik, kandidatprogram',
				'Folkhögskollärare',
				'Fysik och nanovetenskap, kandidatprogram',
				'Förskollärare',
				'Grafisk design och kommunikation, kandidatprogram',
				'Högskoleingenjör i byggnadsteknik',
				'Högskoleingenjör i datateknik',
				'Högskoleingenjör i elektronik',
				'Högskoleingenjör i kemisk analysteknik',
				'Högskoleingenjör i maskinteknik',
				'Innovativ programmering, kandidatprogram',
				'Kemi - molekylär design, kandidatprogram',
				'Kognitionsvetenskap',
				'Kultur, samhälle, mediegestaltning',
				'Kulturvetenskap',
				'Logoped',
				'Läkare',
				'Lärare i fritidshem',
				'Lärare i årskurs F-3',
				'Lärare i årskurs 4-6',
				'Matematik, kandidatprogram',
				'Medicinsk biologi',
				'Miljövetare',
				'Möbeldesign - Carl Malmsten Furniture Studies',
				'Möbelkonservering - Carl Malmsten Furniture Studies',
				'Möbelsnickeri - Carl Malmsten Furniture Studies',
				'Möbeltapetsering - Carl Malmsten Furniture Studies',
				'Personal- och arbetsvetenskap',
				'Politices kandidatprogrammet',
				'Psykolog',
				'Samhällets logistik, kandidatprogram',
				'Samhälls- och kulturanalys',
				'Sjukgymnast',
				'Sjuksköterska',
				'Slöjd, hantverk och formgivning',
				'Socionom',
				'Statistik- och dataanalys',
				'Systemvetenskap',
				'Tekniskt/naturvetenskapligt basår för dig som läst Ma B',
				'Turism - Inriktning mot kulturarv och naturmiljö',
				'Ämneslärare i gymnasieskolan',
				'Ämneslärare i årskurs 7-9',
				'Övrigt'
		);

		$dropdown = new DropdownField('Program', $this->owner->fieldLabel('Program'),
			array_combine($values, $values));
		$dropdown->setHasEmptyDefault(true);
		$dropdown->setEmptyString(_t('MemberProfile.ChooseProgram', '(Choose Program)'));

		return $dropdown;
	}
}
