<?php  defined('C5_EXECUTE') or die('Access Denied');

/**
 *
 * @package Event Tester
 * @category Packages
 * @author Michael Krasnow <mnkras@gmail.com>
 * @copyright  Copyright (c) 2011 Michael Krasnow. (http://www.mnkras.com)
 * @license    see LICENSE.txt
 *
 */
 
class EventTester extends Object{

	/**
	 * When an event is fired it will log all of its data to the logs
	 * @param string $event
	 * @return void
	 */
	public function testEvent($event) {
		$arg_list = func_get_args();
		$event_name = array_pop($arg_list);
		$l = new Log('event_tester', true);
		$l->write('===Event Tester===');
		$l->write('');
		$l->write('Fired Event: '.$event_name);
		$l->write('');
		$numargs = func_num_args();
		$i = 0;
		foreach($arg_list as $thing){
			$count = $i+1;
			if(is_string($arg_list[$i])|| is_bool($arg_list[$i])) {
				$l->write("Argument $count: " . $arg_list[$i]);
			} else {
				$l->write("Argument $count: " . print_r($arg_list[$i], true));
			}
			$i++;
		}
		$l->close();
	}

	/**
	 * Add a new event to be logged
	 * @param string $event
	 * @return EventTester
	 */	
	public function add($event) {
		if(!self::eventExists($event)) {
			$db = Loader::db();
			$db->Execute('insert into EventTesterEvents (event) values (?)', array(self::CleanEvent($event)));
			$ID = $db->Insert_ID();
			return self::getByID($ID);
		}
		throw new Exception(t('An event with that name already exists!'));
	}

	/**
	 * Delete an event from being logged
	 * @return void
	 */	
	public function delete() {
		if($this->ID) {
			$db = Loader::db();
			$db->Execute('delete from EventTesterEvents where ID = ?', $this->ID);
		}
	}
	
	/**
	 * Get the object for an event
	 * @param string $event
	 * @return EventTester
	 */
	public function getByEvent($event) {
		$db = Loader::db();
		$row = $db->GetRow("select * from EventTesterEvents where handle = ?", array(self::CleanEvent($event)));
		if ($row) {
			$ID = $row['ID'];
			return self::getByID($ID);
		}
	}
	
	/**
	 * Get the object for an event by id
	 * @param string $ID
	 * @return EventTester
	 */
	public function getByID($ID) {
		$db = Loader::db();
		$row = $db->GetRow("select * from EventTesterEvents where ID = ?", array($ID));
		if ($row) {
			$et = new self();
			$et->setPropertiesFromArray($row);
			return $et;
		}
	}
	
	/**
	 * @access private
	 */	
	private function EventExists($event) {
		$db = Loader::db();
		$r = $db->GetOne("select count(ID) from EventTesterEvents where event = ?", array(self::CleanEvent($event)));
		return $r > 0;
	}
	
	/**
	 * @access private
	 */	
	private function CleanEvent($event) {
		$clean = preg_replace("/[^0-9A-Za-z-_]/", "", trim($event));
		return $clean;
	}

	public function getID() {return $this->ID;}
	public function getEvent() {return $this->event;}
	
	/**
	 * Get a list of all the event objects
	 * @return array $events
	 */
	public function getEventList() {
		$db = Loader::db();
		$events = array();
		$r = $db->Execute('select ID from EventTesterEvents order by ID asc');
		while ($row = $r->FetchRow()) {
			$events[] = self::getByID($row['ID']);
		}
		return $events;
	}


}