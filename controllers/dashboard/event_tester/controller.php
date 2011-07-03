<?php defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventTesterController extends Controller { 	 
	
	function __construct() {  
		$this->redirect('/dashboard/event_tester/events');
	}
	
}