<?php
class ValidatorContainer extends Validator {
	protected $validators;
	
	public function __construct() {
		$validators = func_get_args();
		if(isset($validators[0]) && is_array($validators[0]))
			$validators = $validators[0];
		foreach ($validators as $i => $validator)
			if (!$validator instanceof Validator)
				trigger_error("Parameter $i is not a valid Validator", E_USER_ERROR);
		$this->validators = $validators;
	}
	
	public function setForm($form) {
		parent::setForm($form);
		foreach ($this->validators as $validator) {
			$validator->setForm($form);
		}
	}
	
	public function javascript() {
		$javascript = '';
		foreach ($this->validators as $validator)
			$javascript .= $validator->javascript();
		return $javascript;
	}
	
	public function php($data) {
		$valid = true;
		foreach ($this->validators as $validator)
			$valid &= $validator->php($data);
		return $valid;
	}
}