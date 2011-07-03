<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * @package Event Tester
 * @category Single Page
 * @author Michael Krasnow <mike@c5rockstars.com>
 * @copyright  Copyright (c) 2010-2011 C5Rockstars. (http://www.c5rockstars.com)
 * @license    http://www.concrete5.org/license/     MIT License
 */
?>
<script type="text/javascript">
	$(function() {
		$(".events_acc,.examples").accordion({
			collapsible: true,
			active: -1,
			clearStyle: true,
			autoHeight: false
		});
		
		$( ".contents" ).click(function() {
			var name = $(this).attr('href');
			$(name).effect( 'highlight', {}, 1000);
			return true;
		});
	});
</script>
<div>
	<h1><span><?php echo t('Event Tester Help')?></span></h1>
	<div class="ccm-dashboard-inner">
		<table width="100%" cellpadding="10" cellspacing="20" border="0">
			<tr>
				<td valign="top" align="left">
				
					<div id="use">
						<a name="use"></a>
						<h2><?php echo t('How to Use the Event Tester')?></h2>
						<p><?php echo t('To use the event tester, you first need to add an <a href="#events">event</a> on the main <a href="%s">Event Tester Dashboard Page</a>, then all you need to do is trigger the event (eg. add a user) and it will show up in the <a href="%s">Log</a>, where all data passed by the event will be shown.', View::url('/dashboard/event_tester'), View::url('/dashboard/reports/logs'))?></p>
					</div>
					<br />
					
					<div id="events">
						<a name="events"></a>
						<h2><?php echo t('Default concrete5 Events')?></h2>
						<div class="events_acc">
							<?php foreach($GLOBALS['EVENT_TESTER_DEFAULT_EVENTS'] as $event) {
								echo '<h3><a href="#">'.$event['event'].'</a></h3>';
								echo '<div>';
								echo '<p>'.$event['description'].'</p>';
								if(count($event['examples']) > 0) {
									$txt = Loader::helper('text');
									echo '<div class="examples">';
									$i = 1;
									foreach($event['examples'] as $example){
										echo '<h3><a href="#">'.t('Argument %s:', $i).'</a></h3>';
										echo '<pre><code>'.$txt->entities($example).'</code></pre>';
										$i++;
									}
									echo '</div>';
								}
								echo '</div>';
							} ?>		
						</div>
					</div>
					<br />
					
					<div id="trouble">
						<a name="trouble"></a>
						<h2><?php echo t('Troubleshooting')?></h2>
						<p><?php echo t('If your event does not show up in the log, then either you have not added your event to the Event Tester, or your event is not firing.')?></p>
					</div>
					
					<br />
					
					<div id="support">
						<a name="support"></a>
						<h2><?php echo t('Support')?></h2>
						<p><?php echo t('For support please submit a support ticked on the addon\'s page located here: <a href="http://www.concrete5.org/marketplace/addons/event_tester/">Event Tester</a>.')?></p>
					</div>
					
					<br />
					
					<div id="credits">
						<a name="credits"></a>
						<h2><?php echo t('Credits')?></h2>
						<p><?php echo t('Michael Krasnow of <a href="http://c5rockstars.com">C5 Rockstars</a> is the author of the Event Tester.<br /><a href="http://www.concrete5.org/profile/-/46463/">Check out some of our other stuff</a>.')?></p>
					</div>
				
				</td>			
				<td width="200" valign="top" align="left" style="border-left: 1px solid #cccccc;">
					<div style="position:fixed;">
						<h2><?php echo t('Table of Contents')?></h2>
						<ul>
							<li><a class="contents" href="#use"><?php echo t('How to Use the Event Tester')?></a></li>
							<li><a class="contents" href="#events"><?php echo t('Default concrete5 Events')?></a></li>
							<li><a class="contents" href="#trouble"><?php echo t('Troubleshooting')?></a></li>
							<li><a class="contents" href="#support"><?php echo t('Support')?></a></li>
							<li><a class="contents" href="#credits"><?php echo t('Credits')?></a></li>
						</ul>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>