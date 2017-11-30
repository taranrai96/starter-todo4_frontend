<?php

class Tasks extends XML_Model {

        public function __construct()
        {
                //parent::__construct(APPPATH . '../data/tasks.xml', 'id');
				parent::__construct();
				$this->load->library(['curl', 'format', 'rest']);
        }
		
		public function getCategorizedTasks()
	{
		// extract the undone tasks
		foreach ($this->all() as $task)
		{
			if ($task->status != 2)
				$undone[] = $task;
		}

		// substitute the category name, for sorting
		foreach ($undone as $task)
			$task->group = $this->app->group($task->group);

		// order them by category
		usort($undone, "orderByCategory");

		// convert the array of task objects into an array of associative objects       
		foreach ($undone as $task)
			$converted[] = (array) $task;

		return $converted;
	}
	
	// provide form validation rules
	public function rules()
	{
		$config = array(
			['field' => 'task', 'label' => 'TODO task', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
			['field' => 'priority', 'label' => 'Priority', 'rules' => 'integer|less_than[4]'],
			['field' => 'size', 'label' => 'Task size', 'rules' => 'integer|less_than[4]'],
			['field' => 'group', 'label' => 'Task group', 'rules' => 'integer|less_than[5]'],
		);
		return $config;
	}
	
	protected function load() 
	{
		
		
		// load our data from the REST backend
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $this->_data =  $this->rest->get('/job');
		
		$this->reindex();
	}
	
	protected function store()
	{
		
	}
	
	function get($key, $key2 = null) 
	{
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('/job/' . $key);
	}
	
	function delete($key, $key2 = null)
	{
		if (isset($this->_data[$key]))
		{
			unset($this->_data[$key]);
			$this->store();
		}
	}
	
	function update($record)
	{
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $key = $record->{$this->_keyfield};
        $retrieved = $this->rest->put('/job/' . $key, $record);
        $this->load(); // because the "database" might have changed
	}
	
	function add($record)
	{
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $key = $record->{$this->_keyfield};
        $retrieved = $this->rest->post('/job/' . $key, $record);
        $this->load(); // because the "database" might have changed
	}
}

// return -1, 0, or 1 of $a's category name is earlier, equal to, or later than $b's
function orderByCategory($a, $b)
{
    if ($a->group < $b->group)
        return -1;
    elseif ($a->group > $b->group)
        return 1;
    else
        return 0;
}