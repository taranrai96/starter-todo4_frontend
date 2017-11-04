<?php

class Task extends Entity {
	private $Priority = '';

	public function setPriority($value) {
		switch($value) {
			case 'low':
				$this->Priority=$value;
				break;
			case 'medium':
				$this->Priority=$value;
				break;
			case 'high':
				$this->Priority=$value;
				break;
			default:
			break;
			
		}
		return $this->Priority;
	}
}