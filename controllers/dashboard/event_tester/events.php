<?php defined('C5_EXECUTE') or die("Access Denied.");

/**
 *
 * @package Event Tester
 * @category Packages
 * @author Michael Krasnow <mnkras@gmail.com>
 * @copyright  Copyright (c) 2011 Michael Krasnow. (http://www.mnkras.com)
 * @license    see LICENSE.txt
 *
 */
 
Loader::model('event_tester', 'event_tester');

class DashboardEventTesterEventsController extends Controller { 	

	public function on_start() {
		$this->token = Loader::helper('validation/token');
		$this->set('events', EventTester::getEventList());
	}	
	
	public function delete($ID = false, $token = false) {
		if (!$this->token->validate("delete_event", $token)) {
			$this->set('error', array($this->token->getErrorMessage()));
			return;
		}
		$obj = EventTester::getByID($ID);
		if(is_object($obj)) {
			$obj->delete();
			$this->redirect("/dashboard/event_tester/events", "event_deleted");
		} else {
			throw new exception(t('Invalid Event ID!'));
		}
	
	}
	
	public function add_new_event() {
		if (!$this->token->validate("add_new_event")) {
			$this->set('error', array($this->token->getErrorMessage()));
			return;
		}
		$txt = Loader::helper('text');
		if(!$this->post('event')) {
			$this->set('error', array(t('Please enter a valid event.')));
			return;
		}
		EventTester::add($this->post('event'));

		$this->redirect("/dashboard/event_tester/events", "event_added");
	}
	
	public function event_deleted() {
		$this->set('message', t('Event deleted.'));
	}
	
	public function event_added() {
		$this->set('message', t('Event added.'));
	}
	
}