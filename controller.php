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
		//stupid hack until the protected function is changed to public
		parent::install();
	}
	
	public function on_start() {
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
	}
}