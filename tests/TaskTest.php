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
	
	protected function teardown() 
	{
		$this->CI = NULL;
	}
	
    public function testInput()
	{
		$this->CI->task->priority=3;
		$this->assertEquals(3, $this->CI->task->priority);
		
    }
	
  }
