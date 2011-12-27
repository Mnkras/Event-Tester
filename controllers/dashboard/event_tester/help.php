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
 
class DashboardEventTesterHelpController extends DashboardBaseController { 	 

	public function view(){
		$html = Loader::helper('html');
		$this->addFooterItem($html->javascript('jquery.accordion.js', 'event_tester'));
		$js = <<<EOD
<script type="text/javascript">
	$(function() {
		$(".type,.events_acc,.examples").accordion({
			collapsible: true,
			active: -1,
			clearStyle: true,
			//header: 'p',
			autoHeight: false
		});
		
		$( ".contents" ).click(function() {
			$('html,body').animate({scrollTop:$(this.hash).offset().top-50}, 1000);
			var name = $(this).attr('href');
			$(name).effect( 'highlight', {}, 3000);
			return false;
		});
	});
</script>
EOD;
		$this->addFooterItem($js);
	}
	
}