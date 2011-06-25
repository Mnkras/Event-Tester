<?php     

defined('C5_EXECUTE') or die(_("Access Denied."));

class EventTesterPackage extends Package {

	protected $pkgHandle = 'event_tester';
	protected $appVersionRequired = '5.4.1';
	protected $pkgVersion = '1.0';
	
	public function getPackageDescription() {
		return t("Logs when events fire.");
	}
	
	public function getPackageName() {
		return t("Event Tester");
	}
	
	public function on_start() {
		Events::extend('on_start', 'EventTester', 'testOnStart', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_before_render', 'EventTester', 'testOnBeforeRender', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_render_complete', 'EventTester', 'testOnRenderComplete', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_group_delete', 'EventTester', 'testOnGroupDelete', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_page_update', 'EventTester', 'testOnPageUpdate', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_page_move', 'EventTester', 'testOnPageMove', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_page_duplicate', 'EventTester', 'testOnPageDuplicate', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_page_delete', 'EventTester', 'testOnPageDelete', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_page_add', 'EventTester', 'testOnPageAdd', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_page_view', 'EventTester', 'testOnPageView', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_page_version_approve', 'EventTester', 'testOnPageVersionApprove', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_user_add', 'EventTester', 'testOnUserAdd', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_user_delete', 'EventTester', 'testOnUserDelete', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_user_update', 'EventTester', 'testOnUserUpdate', DIR_PACKAGES.'/event_tester/models/event_tester.php');
		Events::extend('on_user_login', 'EventTester', 'testOnUserLogin', DIR_PACKAGES.'/event_tester/models/event_tester.php');
	}
}