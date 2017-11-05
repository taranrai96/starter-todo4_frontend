<?php

class Task extends Entity {
	public $priority = NULL;
	public $task = NULL;
	public $size = NULL;
	public $group = NULL;
	
	public function __get($property){
        if(isset($this->$property)){
            return $this->$property;
        }
        else{
            return NULL;
        }
    }
	
	 public function setTask($value)
     {
         if(ctype_alpha(str_replace(' ', '', $value)) || strlen($value) <= 64) {
			 $this->task = $value;
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