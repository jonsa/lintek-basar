<?php

class SongPage extends Page {
	public static $has_one = array(
			'MusicFile' => 'File'
	);

	public function getCMSFields($params = null) {
		$fields = parent::getCMSFields($params);
		$fields
			->addFieldToTab('Root.Content.Main',
				$file = new FileIFrameField('MusicFile', $this->fieldLabel('MusicFile'),
					array(
							'fileExt' => '*.mp3'
					)), 'Content');
		$file->setFolderName('mp3');
		return $fields;
	}
	
	public function ValidFile() {
		return $this->MusicFileID > 0;
	}
	
	public function PlayerPath() {
		return BASE_URL .'/'. BASARET_DIR .'/thirdparty/playermaxi.swf';
	}
	
	public function FilePath() {
		if ($this->ValidFile())
			return $this->MusicFile()->Filename;
	}
}

class SongPage_Controller extends Page_Controller {

}
