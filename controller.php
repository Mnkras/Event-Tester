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
	
		$defaultevents = array();
		
		$defaultevents[] = array('event' => 'on_page_update',
								'description' => 'Fires when a page is updated. If a function hooks into this event, the function is passed the page being updated as the argument.',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 137
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-07-02 18:39:43
[cDisplayOrder] => 1
[cDateModified] => 2011-07-02 18:39:43
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => 
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 115
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 137
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:39:46
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Version 3
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

)')
								);
		$defaultevents[] = array('event' => 'on_page_move',
								'description' => 'Fires when a page is moved. Functions hooking into this event are passed three arguments: the first is the page being moved, the second is the old parent page, and the third is the new parent page.',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 136
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-07-02 18:25:17
[cDisplayOrder] => 0
[cDateModified] => 2011-07-02 18:29:12
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about/asdf
[ctID] => 3
[ctHandle] => full
[ctIcon] => main.png
[ptID] => 1
[cParentID] => 69
[cChildren] => 0
[ctName] => Full Width
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 136
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => asdf
[cvName] => asdf
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:28:59
[cvDatePublic] => 2011-07-02 18:25:00
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => New Version 3
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

[childrenCIDArray] => Array
(
)

)',
									'Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 69
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 1
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 1
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 69
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => Version 3
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

)',
									'Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 1
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 0
[cDateModified] => 2011-06-30 17:42:32
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => OVERRIDE
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => 
[ctID] => 1
[ctHandle] => right_sidebar
[ctIcon] => template3.png
[ptID] => 1
[cParentID] => 0
[cChildren] => 16
[ctName] => Right Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 1
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 6
[cvIsNew] => 0
[cvHandle] => home
[cvName] => Home
[cvDescription] => 
[cvDateCreated] => 2011-06-30 16:46:25
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => New Version 6
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

)')
								);
		$defaultevents[] = array('event' => 'on_page_duplicate',
								'description' => 'Fires when a page is copied. Functions hooking into this event are passed two arguments: the first is the new parent, the second is the current page.',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 137
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-07-02 18:39:43
[cDisplayOrder] => 1
[cDateModified] => 2011-07-02 18:39:43
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => 
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 115
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 137
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:39:46
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Version 3
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

)',
									'Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 69
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 1
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 1
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 69
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => Version 3
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

[childrenCIDArray] => Array
(
)

)')
								);
		$defaultevents[] = array('event' => 'on_page_delete',
								'description' => 'Fires when a page is being deleted. Can be cancelled by returning -1. If a function hooks into this event, the function is passed the page to be deleted as the argument.',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 137
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-07-02 18:39:43
[cDisplayOrder] => 1
[cDateModified] => 2011-07-02 18:39:43
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /catalog/about
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 115
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 137
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:39:46
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Version 3
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

)')
								);
		$defaultevents[] = array('event' => 'on_page_add',
								'description' => 'Fires when a page is being added. If a function hooks into this event, the function is passed the new page object as the argument. This happens immediately after a page is added.',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 136
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-07-02 18:25:17
[cDisplayOrder] => 0
[cDateModified] => 2011-07-02 18:25:17
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => 
[ctID] => 3
[ctHandle] => full
[ctIcon] => main.png
[ptID] => 1
[cParentID] => 69
[cChildren] => 0
[ctName] => Full Width
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 0
[cID] => 136
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 1
[cvIsNew] => 0
[cvHandle] => asdf
[cvName] => asdf
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:25:17
[cvDatePublic] => 2011-07-02 18:25:00
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Initial Version
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

)')
								);
		$defaultevents[] = array('event' => 'on_page_version_approve',
								'description' => 'Fires when a page\'s version is approved. Passes an additional page object, containing the approved version.',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 136
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-07-02 18:25:17
[cDisplayOrder] => 0
[cDateModified] => 2011-07-02 18:25:17
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 1
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about/asdf
[ctID] => 3
[ctHandle] => full
[ctIcon] => main.png
[ptID] => 1
[cParentID] => 69
[cChildren] => 0
[ctName] => Full Width
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 0
[cID] => 136
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 2
[cvIsNew] => 1
[cvHandle] => asdf
[cvName] => asdf
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:25:17
[cvDatePublic] => 2011-07-02 18:25:00
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => New Version 2
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
[versionComments] => New Version 2
)

)')
								);
		$defaultevents[] = array('event' => 'on_page_version_add',
								'description' => '',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 136
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-07-02 18:25:17
[cDisplayOrder] => 0
[cDateModified] => 2011-07-02 18:25:17
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => 
[ctID] => 3
[ctHandle] => full
[ctIcon] => main.png
[ptID] => 1
[cParentID] => 69
[cChildren] => 0
[ctName] => Full Width
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 0
[cID] => 136
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 1
[cvIsNew] => 0
[cvHandle] => asdf
[cvName] => asdf
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:25:17
[cvDatePublic] => 2011-07-02 18:25:00
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Initial Version
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

)',
									'CollectionVersion Object
(
[cvIsApproved] => 0
[cID] => 136
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 2
[cvIsNew] => 1
[cvHandle] => asdf
[cvName] => asdf
[cvDescription] => 
[cvDateCreated] => 2011-07-02 18:25:17
[cvDatePublic] => 2011-07-02 18:25:00
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => New Version 2
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)')
								);
		
		$defaultevents[] = array('event' => 'on_user_add',
								'description' => 'Fires when a user is being added. Functions hooking into this event receive the newly added UserInfo object as their one argument.',
								'examples' =>
									array('UserInfo Object
(
[error] => 
[uID] => 3
[uLastLogin] => 0
[uIsValidated] => -1
[uPreviousLogin] => 0
[uIsFullRecord] => 1
[uNumLogins] => 0
[uDateAdded] => 2011-07-02 18:45:09
[uIsActive] => 1
[uLastOnline] => 0
[uHasAvatar] => 0
[uName] => concrete5
[uEmail] => c5@me.com
[uPassword] => dfd22fcbdde6472e47cb69fe6f9942c1
[uTimezone] => 
)')
								);
		$defaultevents[] = array('event' => 'on_user_delete',
								'description' => 'Fires when a user is being deleted. Can be cancelled by returning false. If a function hooks into this event, the function is passed the user to be deleted as the argument (a UserInfo object.)',
								'examples' =>
									array('UserInfo Object
(
[error] => 
[uID] => 3
[uLastLogin] => 1309646916
[uIsValidated] => -1
[uPreviousLogin] => 0
[uIsFullRecord] => 1
[uNumLogins] => 1
[uDateAdded] => 2011-07-02 18:45:09
[uIsActive] => 1
[uLastOnline] => 1309646916
[uHasAvatar] => 0
[uName] => concrete5
[uEmail] => c5@me.com
[uPassword] => 18d8cb7c128e25503aeb93218e700fd9
[uTimezone] => 
)')
								);
		$defaultevents[] = array('event' => 'on_user_update',
								'description' => 'Fires when a user is being updated. If a function hooks into this event, the function is passed the user to be updated as the argument (a UserInfo object.) IMPORTANT NOTE - When hooking into deletion events, if your function returns false, the deletion will NOT continue. In this way, you can use custom code to stop people from deleting content.',
								'examples' =>
									array('UserInfo Object
(
[error] => 
[uID] => 3
[uLastLogin] => 0
[uIsValidated] => -1
[uPreviousLogin] => 0
[uIsFullRecord] => 1
[uNumLogins] => 0
[uDateAdded] => 2011-07-02 18:45:09
[uIsActive] => 1
[uLastOnline] => 0
[uHasAvatar] => 0
[uName] => concrete5
[uEmail] => c5@me.com
[uPassword] => dfd22fcbdde6472e47cb69fe6f9942c1
[uTimezone] => 
)')
								);
		$defaultevents[] = array('event' => 'on_user_login',
								'description' => 'Fires when a user logs in via the /login page (NOTE: this does NOT fire when a user is logged in programmatically.)',
								'examples' =>
									array('LoginController Object
(
[helpers] => Array
(
[0] => form
)

[openIDReturnTo:LoginController:private] => http://localhost/web/index.php/login/complete_openid/
[locales:protected] => Array
(
)

[theme] => 
[sets:Controller:private] => Array
(
[uNameLabel] => Username
[locales] => Array
(
)

[invalidRegistrationFields] => 
)

[helperObjects:protected] => Array
(
[form] => FormHelper Object
(
[radioIndex:FormHelper:private] => 1
[selectIndex:FormHelper:private] => 1
[th] => TextHelper Object
(
)

)

)

[c:protected] => Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 5
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => /login.php
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 0
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 5
[cInheritPermissionsFrom] => OVERRIDE
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /login
[ctID] => 0
[ctHandle] => 
[ctIcon] => 
[ptID] => 1
[cParentID] => 1
[cChildren] => 0
[ctName] => 
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 5
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 1
[cvIsNew] => 0
[cvHandle] => login
[cvName] => Login
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Initial Version
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

)

[task:protected] => do_login
[parameters:protected] => Array
(
)

[restrictedMethods:Controller:private] => Array
(
)

[error] => ValidationErrorHelper Object
(
[error:protected] => Array
(
)

)

)')
								);
		$defaultevents[] = array('event' => 'on_user_change_password',
								'description' => 'Fires when a user changes their profile, the first argument is a user object, and the second is the password in plaintext.',
								'examples' =>
									array('UserInfo Object
(
[error] => 
[uID] => 3
[uLastLogin] => 0
[uIsValidated] => -1
[uPreviousLogin] => 0
[uIsFullRecord] => 1
[uNumLogins] => 0
[uDateAdded] => 2011-07-02 18:45:09
[uIsActive] => 1
[uLastOnline] => 0
[uHasAvatar] => 0
[uName] => concrete5
[uEmail] => c5@me.com
[uPassword] => 18d8cb7c128e25503aeb93218e700fd9
[uTimezone] => 
)',
									'thisismynewpassword')
								);
		
		$defaultevents[] = array('event' => 'on_group_delete',
								'description' => 'Fires when a group is deleted. Can be cancelled by returning false. If a function hooks into this event, the function is passed the group to be deleted as the argument.',
								'examples' =>
									array('Group Object
(
[ctID] => 
[permissionSet] => 
[permissions:Group:private] => Array
(
)

[error] => 
[gID] => 7
[gName] => asf
[gDescription] => sadfasdf
[gUserExpirationIsEnabled] => 0
[gUserExpirationMethod] => 
[gUserExpirationSetDateTime] => 
[gUserExpirationInterval] => 0
[gUserExpirationAction] => 
)')
								);
		
		$defaultevents[] = array('event' => 'on_page_get_icon',
								'description' => 'Fires when a pagetype icon is loaded (when adding a page this will fire several times).',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 123
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-05 11:48:53
[cDisplayOrder] => 14
[cDateModified] => 2011-06-05 11:48:53
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 0000-00-00 00:00:00
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /love-of-duck
[ctID] => 1
[ctHandle] => right_sidebar
[ctIcon] => template3.png
[ptID] => 1
[cParentID] => 1
[cChildren] => 1
[ctName] => Right Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 123
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 1
[cvIsNew] => 0
[cvHandle] => love-of-duck
[cvName] => Love of Duck
[cvDescription] => 
[cvDateCreated] => 2011-06-05 11:48:53
[cvDatePublic] => 2011-06-05 11:48:53
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Version 1
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

[cIndexScore] => 
)')
								);
		$defaultevents[] = array('event' => 'on_start',
								'description' => 'Fired when concrete5 starts up.',
								'examples' =>
									array('View Object
(
[viewPath:View:private] => 
[controller] => 
[headerItems:View:private] => Array
(
)

[themePaths:View:private] => Array
(
[/dashboard] => dashboard
[/dashboard/*] => dashboard
[/page_forbidden] => concrete
[/page_not_found] => concrete
[/install] => concrete
[/login] => concrete
[/register] => concrete
[/maintenance_mode] => concrete
)

[areLinksDisabled:View:private] => 
[isEditingEnabled:View:private] => 1
[error] => 
)')
								);
		$defaultevents[] = array('event' => 'on_page_view',
								'description' => 'Fires when a page is being viewed. If a function hooks into this event, the function is passed two arguments: the first is the page being viewed, the second is the user object viewing it. User object could be unregistered/anonymous. Note: if statistics are disabled this event will never fire.',
								'examples' =>
									array('Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 29
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => /dashboard/reports/logs.php
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 2
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 15
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /dashboard/reports/logs
[ctID] => 0
[ctHandle] => 
[ctIcon] => 
[ptID] => 0
[cParentID] => 26
[cChildren] => 0
[ctName] => 
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 29
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 1
[cvIsNew] => 0
[cvHandle] => logs
[cvName] => Logs
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 
[cvComments] => Initial Version
[cvAuthorUname] => Mnkras
[cvIsMostRecent] => 1
)

)',
									'User Object
(
[uID] => 1
[uName] => Mnkras
[uGroups] => Array
(
[2] => 2
[1] => 1
)

[superUser] => 1
[uTimezone] => 
[uDefaultLanguage:protected] => 
[error] => 
)')
								);
		$defaultevents[] = array('event' => 'on_before_render',
								'description' => 'Fires immediately before rendering the entire page. If a function hooks into this event, the function is passed the page being rendered as the argument.',
								'examples' =>
									array('View Object
(
[viewPath:View:private] => /about
[controller] => Controller Object
(
[theme] => 
[sets:Controller:private] => Array
(
)

[helperObjects:protected] => Array
(
[html] => HtmlHelper Object
(
)

)

[c:protected] => Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 69
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 1
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 1
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 69
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => New Version 3
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

)

[task:protected] => view
[parameters:protected] => Array
(
)

[restrictedMethods:Controller:private] => Array
(
)

[helpers] => Array
(
[0] => html
)

)

[headerItems:View:private] => Array
(
[CONTROLLER] => Array
(
[0] => CSSOutputObject Object
(
[file] => /web/concrete/elements/header_menu/sitemap/view.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/elements/header_menu/sitemap/view.css?v=8f443a47e79f49e0d
[compress] => 
)

[1] => JavaScriptOutputObject Object
(
[file] => /web/concrete/elements/header_menu/sitemap/view.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/elements/header_menu/sitemap/view.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 
)

[2] => CSSOutputObject Object
(
[file] => /web/concrete/elements/header_menu/filemanager/view.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/elements/header_menu/filemanager/view.css?v=8f443a47e79f4
[compress] => 
)

[3] => JavaScriptOutputObject Object
(
[file] => /web/concrete/elements/header_menu/filemanager/view.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/elements/header_menu/filemanager/view.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 
)

)

)

[themePaths:View:private] => Array
(
[/dashboard] => dashboard
[/dashboard/*] => dashboard
[/page_forbidden] => concrete
[/page_not_found] => concrete
[/install] => concrete
[/login] => concrete
[/register] => concrete
[/maintenance_mode] => concrete
)

[areLinksDisabled:View:private] => 
[isEditingEnabled:View:private] => 1
[error] => 
[c] => Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 69
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 1
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 1
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 69
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => New Version 3
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

)

[ptHandle] => default
[theme] => /web/concrete/config/../themes/default/left_sidebar.php
[themePath] => /web/concrete/themes/default
[themeDir] => /web/concrete/config/../themes/default
[themePkgID] => 0
)')
								);
		$defaultevents[] = array('event' => 'on_render_complete',
								'description' => 'Fires immediately after rendering the entire page. If a function hooks into this event, the function is passed the page being rendered as the argument.',
								'examples' =>
									array('View Object
(
[viewPath:View:private] => /about
[controller] => Controller Object
(
[theme] => 
[sets:Controller:private] => Array
(
)

[helperObjects:protected] => Array
(
[html] => HtmlHelper Object
(
)

)

[c:protected] => Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 69
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 1
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 1
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 69
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => New Version 3
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

)

[task:protected] => view
[parameters:protected] => Array
(
)

[restrictedMethods:Controller:private] => Array
(
)

[helpers] => Array
(
[0] => html
)

)

[headerItems:View:private] => Array
(
[CONTROLLER] => Array
(
[0] => CSSOutputObject Object
(
[file] => /web/concrete/elements/header_menu/sitemap/view.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/elements/header_menu/sitemap/view.css?v=8f443a47e79f49e0d
[compress] => 
)

[1] => JavaScriptOutputObject Object
(
[file] => /web/concrete/elements/header_menu/sitemap/view.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/elements/header_menu/sitemap/view.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 
)

[2] => CSSOutputObject Object
(
[file] => /web/concrete/elements/header_menu/filemanager/view.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/elements/header_menu/filemanager/view.css?v=8f443a47e79f4
[compress] => 
)

[3] => JavaScriptOutputObject Object
(
[file] => /web/concrete/elements/header_menu/filemanager/view.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/elements/header_menu/filemanager/view.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 
)

)

[CORE] => Array
(
[0] => CSSOutputObject Object
(
[file] => /web/concrete/css/ccm.base.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/ccm.base.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[1] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/jquery.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/jquery.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[2] => JavaScriptOutputObject Object
(
[file] => /web/js/ccm.base.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/js/ccm.base.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

)

[VIEW] => Array
(
[0] => CSSOutputObject Object
(
[file] => /web/concrete/css/ccm.ui.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/ccm.ui.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[1] => CSSOutputObject Object
(
[file] => /web/concrete/css/jquery.rating.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/jquery.rating.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[2] => CSSOutputObject Object
(
[file] => /web/css/ccm.dialog.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/css/ccm.dialog.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[3] => CSSOutputObject Object
(
[file] => /web/concrete/css/ccm.menus.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/ccm.menus.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[4] => CSSOutputObject Object
(
[file] => /web/concrete/css/ccm.forms.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/ccm.forms.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[5] => CSSOutputObject Object
(
[file] => /web/concrete/css/ccm.search.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/ccm.search.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[6] => CSSOutputObject Object
(
[file] => /web/concrete/css/ccm.filemanager.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/ccm.filemanager.css?v=8f443a47e79f49e0d9155350009fb9d
[compress] => 1
)

[7] => CSSOutputObject Object
(
[file] => /web/concrete/css/ccm.colorpicker.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/concrete/css/ccm.colorpicker.css?v=8f443a47e79f49e0d9155350009fb9d
[compress] => 1
)

[8] => CSSOutputObject Object
(
[file] => /web/css/jquery.ui.css?v=8f443a47e79f49e0d9155350009fb9db
[href] => http://localhost/web/css/jquery.ui.css?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[9] => <script type="text/javascript" src="/web/index.php/tools/required/i18n_js"></script>
[10] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/jquery.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/jquery.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[11] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/jquery.form.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/jquery.form.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[12] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/jquery.metadata.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/jquery.metadata.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[13] => JavaScriptOutputObject Object
(
[file] => /web/js/jquery.ui.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/js/jquery.ui.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[14] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/quicksilver.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/quicksilver.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[15] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/jquery.liveupdate.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/jquery.liveupdate.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[16] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/jquery.rating.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/jquery.rating.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[17] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/jquery.colorpicker.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/jquery.colorpicker.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[18] => JavaScriptOutputObject Object
(
[file] => /web/js/ccm.dialog.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/js/ccm.dialog.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[19] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/ccm.themes.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/ccm.themes.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[20] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/ccm.filemanager.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/ccm.filemanager.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[21] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/ccm.search.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/ccm.search.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[22] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/ccm.ui.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/ccm.ui.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[23] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/ccm.layout.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/ccm.layout.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[24] => JavaScriptOutputObject Object
(
[file] => /web/concrete/js/tiny_mce/tiny_mce.js?v=8f443a47e79f49e0d9155350009fb9db
[href] => /web/concrete/js/tiny_mce/tiny_mce.js?v=8f443a47e79f49e0d9155350009fb9db
[compress] => 1
)

[25] => <script type="text/javascript" src="/web/index.php/tools/required/page_controls_menu_js?cID=69&amp;cvID=&amp;btask=&amp;ts=1309643980"></script>
)

)

[themePaths:View:private] => Array
(
[/dashboard] => dashboard
[/dashboard/*] => dashboard
[/page_forbidden] => concrete
[/page_not_found] => concrete
[/install] => concrete
[/login] => concrete
[/register] => concrete
[/maintenance_mode] => concrete
)

[areLinksDisabled:View:private] => 
[isEditingEnabled:View:private] => 1
[error] => 
[c] => Page Object
(
[blocksAliasedFromMasterCollection:protected] => 
[cID] => 69
[attributes:protected] => Array
(
)

[error] => 
[pkgID] => 0
[cPointerID] => 0
[cPointerExternalLink] => 
[cPointerExternalLinkNewWindow] => 0
[cFilename] => 
[cDateAdded] => 2011-06-04 22:39:29
[cDisplayOrder] => 1
[cDateModified] => 2011-06-04 22:39:29
[cInheritPermissionsFromCID] => 1
[cInheritPermissionsFrom] => PARENT
[cOverrideTemplatePermissions] => 1
[cPendingAction] => 
[cPendingActionUID] => 
[cPendingActionTargetCID] => 
[cPendingActionDatetime] => 2011-06-04 22:39:29
[cCheckedOutUID] => 
[cIsTemplate] => 0
[uID] => 1
[cPath] => /about
[ctID] => 2
[ctHandle] => left_sidebar
[ctIcon] => template1.png
[ptID] => 1
[cParentID] => 1
[cChildren] => 0
[ctName] => Left Sidebar
[cCacheFullPageContent] => -1
[cCacheFullPageContentOverrideLifetime] => 0
[cCacheFullPageContentLifetimeCustom] => 0
[isMasterCollection] => 0
[vObj] => CollectionVersion Object
(
[cvIsApproved] => 1
[cID] => 69
[attributes:protected] => AttributeValueList Object
(
[attributes:AttributeValueList:private] => Array
(
[meta_title] => 
[meta_description] => 
[meta_keywords] => 
[exclude_nav] => 0
)

[error] => 
)

[customAreaStyles] => Array
(
)

[layoutStyles] => Array
(
)

[error] => 
[cvID] => 3
[cvIsNew] => 0
[cvHandle] => about
[cvName] => About
[cvDescription] => 
[cvDateCreated] => 2011-06-04 22:39:29
[cvDatePublic] => 2011-06-04 22:39:29
[cvAuthorUID] => 1
[cvApproverUID] => 1
[cvComments] => New Version 3
[cvAuthorUname] => Mnkras
[cvApproverUname] => Mnkras
[cvIsMostRecent] => 1
)

)

[ptHandle] => default
[theme] => /web/concrete/config/../themes/default/left_sidebar.php
[themePath] => /web/concrete/themes/default
[themeDir] => /web/concrete/config/../themes/default
[themePkgID] => 0
)')
								);
				
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
			$misc_events = array('on_page_view');
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