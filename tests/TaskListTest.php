<?php

if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

 class TaskListTest extends PHPUnit_Framework_TestCase
 {
     private $CI;
     private $tasks;

     public function setUp()
     {
         // Load CI instance normally
         $this->CI = &get_instance();
         $this->tasks = new Tasks;
     }

     public function testTasks()
     {
         $completed = 0;
         $in_progress = 0;

         foreach($this->tasks->all() as $task) {
            if( strcmp($task->status,"2") === 0 ){
                $completed += 1;
            } else{
                $in_progress += 1;
            }
         }

         $this->assertGreaterThan($completed, $in_progress); //in_progress has to be greater than completed - OK
     }
 }