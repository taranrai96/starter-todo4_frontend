<?php

class Task extends Entity {
	private $priority = NULL;
	
	public function __get($property){
        if(isset($this->$property)){
            return $this->$property;
        }
        else{
            return NULL;
        }
    }

	public function setPriority($value) {
		if(is_int($value) && $value < 4){
            $this->priority = $value;
        }
	}
	
	public function setSize($value) {
		if(is_int($value) && $value < 4){
            $this->size = $value;
        }
	}
	
	public function setGroup($value) {
		if(is_int($value) && $value < 5){
            $this->group = $value;
        }
	}
	
	
}