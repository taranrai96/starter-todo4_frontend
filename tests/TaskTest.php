<?php

if (! class_exists('PHPUnit_Framework_TestCase')) {
    class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

 class CITest extends PHPUnit_Framework_TestCase
  {
    private $CI;

    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
	  $this->CI->load->model('task');
    }
	
    public function testPriorityInput()
	{
		//PASS
		$this->CI->task->priority=3;
		$this->assertEquals(3, $this->CI->task->priority);
		
		//FAIL
		//$this->CI->task->priority=56;
		//$this->assertEquals(56, $this->CI->task->priority);
		
    }
	
	public function testTaskInput()
	{
		//PASS
		$this->CI->task->task='This is a test task';
		$this->assertEquals('This is a test task', $this->CI->task->task);
		
		//FAIL
		//$this->CI->task->task=2345;
		//$this->assertEquals(2345, $this->CI->task->task);
    }

	public function testSizeInput()
	{
		//PASS
		$this->CI->task->size=2;
		$this->assertEquals(2, $this->CI->task->size);
		
		//FAIL
		//$this->CI->task->size=10;
		//$this->assertEquals(10, $this->CI->task->size);
    }
	
	public function testGroupInput()
	{
		//PASS
		$this->CI->task->group=4;
		$this->assertEquals(4, $this->CI->task->group);
		
		//FAIL
		//$this->CI->task->group=14;
		//$this->assertEquals(14, $this->CI->task->group);
    }
  }
