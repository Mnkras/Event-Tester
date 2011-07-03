<?php defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventTesterHelpController extends Controller { 	 

	public function view(){
		$html = Loader::helper('html');
		$this->addHeaderItem($html->javascript('jquery.accordion.js', 'event_tester'));
	}
	
}