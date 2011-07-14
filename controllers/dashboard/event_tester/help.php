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
 
class DashboardEventTesterHelpController extends Controller { 	 

	public function view(){
		$html = Loader::helper('html');
		$this->addHeaderItem($html->javascript('jquery.accordion.js', 'event_tester'));
	}
	
}