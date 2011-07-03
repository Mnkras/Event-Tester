<?php     
defined('C5_EXECUTE') or die("Access Denied.");

class EventTesterPackage extends Package {

	protected $pkgHandle = 'event_tester';
	protected $appVersionRequired = '5.4.1.1';
	protected $pkgVersion = '1.0';
	
	public function getPackageName() {
		return t("Event Tester");
	}
	
	public function getPackageDescription() {
		return t("Logs when events fire.");
	}
	
	public function install() {
		$pkg = parent::install();
		$co = new Config();
		$pkg = Package::getByHandle($this->pkgHandle);
		$co->setPackageObject($pkg);
		//if you want to use the GUI or just change the code in here, by default its GUI
		$co->save('EVENT_TESTER_GUI_ENABLE', 1);
		
		if($co->get('EVENT_TESTER_GUI_ENABLE')) {
			Loader::model('single_page');
	
			$sp = SinglePage::add('/dashboard/'.$this->pkgHandle.'/', $pkg);
			$sp->update(array('cName'=>t("Event Tester"), 'cDescription'=>t("Log when events fire.")));
			
			$sp = SinglePage::add('/dashboard/'.$this->pkgHandle.'/events/', $pkg);
			$sp->update(array('cName'=>t("Events")));
			
			$sp = SinglePage::add('/dashboard/'.$this->pkgHandle.'/help/', $pkg);
			$sp->update(array('cName'=>t("Help")));
		}
	}
	
	public function uninstall() {
		parent::uninstall();
		$db = Loader::db();
		$db->Execute('DROP TABLE IF EXISTS `EventTesterEvents`');//remove everthing!
	}
	
	public function on_start() {
		
		//is there a better way to do this?
		include('core_events.php');
				
		$GLOBALS['EVENT_TESTER_DEFAULT_EVENTS'] = $defaultevents;
		//print_r($GLOBALS['EVENT_TESTER_DEFAULT_EVENTS']);
		
		$co = new Config();
		$pkg = Package::getByHandle($this->pkgHandle);
		$co->setPackageObject($pkg);

		if($co->get('EVENT_TESTER_GUI_ENABLE') == 0) {
			/*
			 * There may be events here that are not in c5, just ignore them,
			 */
			//has on_page_get_icon, on_start, on_page_view, on_before_render, and on_render_complete
			//$misc_events = array('on_page_get_icon', 'on_start', 'on_before_render', 'on_render_complete', 'on_page_view');
			$misc_events = array();
			$page_events = array('on_page_update', 'on_page_move', 'on_page_duplicate', 'on_page_delete', 'on_page_add', 'on_page_version_approve', 'on_page_version_add');
			$user_events = array('on_user_add', 'on_user_delete', 'on_user_update', 'on_user_login', 'on_user_change_password');
			$group_events = array('on_group_delete');
			
			$events = array_merge($misc_events, $page_events, $user_events, $group_events);

			foreach($events as $event) {
				Events::extend($event, 'EventTester', 'testEvent', DIR_PACKAGES.'/'.$this->pkgHandle.'/'.DIRNAME_MODELS.'/'.$this->pkgHandle.'.php', array($event));
			}
			
		} else {
			
			Loader::model('event_tester', 'event_tester');
			$events = EventTester::getEventList();
			if(count($events) > 0) {
				foreach($events as $event) {
					Events::extend($event->getEvent(), 'EventTester', 'testEvent', DIR_PACKAGES.'/'.$this->pkgHandle.'/'.DIRNAME_MODELS.'/'.$this->pkgHandle.'.php', array($event->getEvent()));
				}
			}
		}
	}
}