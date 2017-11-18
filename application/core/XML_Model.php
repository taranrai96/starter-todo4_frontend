<?php

/**
 * CSV-persisted collection.
 * 
 * @author		JLP
 * @copyright           Copyright (c) 2010-2017, James L. Parry
 * ------------------------------------------------------------------------
 */
class XML_Model extends Memory_Model
{

//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------

	/**
	 * Constructor.
	 * @param string $origin Filename of the CSV file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Entity name meaningful to the persistence
	 */
	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{
		parent::__construct();

		// guess at persistent name if not specified
		if ($origin == null)
			$this->_origin = get_class($this);
		else
			$this->_origin = $origin;

		// remember the other constructor fields
		$this->_keyfield = $keyfield;
		$this->_entity = $entity;

		// start with an empty collection
		$this->_data = array(); // an array of objects
		$this->fields = array(); // an array of strings
		// and populate the collection
		$this->load();
	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{
		$xml = simplexml_load_file($this->_origin);
		foreach($xml->children() as $item) {
			$record = new Task();
			foreach($item->children() as $prop) {
				$this->_fields[] = $prop->getName();
				$record->{$prop->getName()} = (string)$prop;
			}
			$key = $record->{$this->_keyfield};
			$this->_data[$key] = $record;
		}
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */

	protected function store()
	{
		// rebuild the keys table
		$this->reindex();
		$tasks = new SimpleXMLElement("<xml/>");
		
		foreach ($this->_data as $item) {
			$task = $tasks->addChild('item');
			foreach ($item as $key => $value){
				$task->addChild($key,(string)$value);
			}
		}
		$tasks->asXML("../data/tasks.xml");
	}
	
	

}
