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
 

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Tester Help'), false, '');?>
	<div class="row">
		<div class="span11">
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
					<?php $txt = Loader::helper('text');
					$types = array_unique(array_keys($GLOBALS['EVENT_TESTER_DEFAULT_EVENTS']));
					foreach($types as $type) {
						foreach($GLOBALS['EVENT_TESTER_DEFAULT_EVENTS'] as $type2=>$events) {
							if($type == $type2) {
								echo '<p><a href="#">'.$txt->unhandle($type).'</a></p>';
								echo '<div><div class="type">';
									foreach($events as $event) {
										echo '<p><a href="#">'.$event['event'].'</a></p>';
										echo '<div>';
											echo '<p>'.$event['description'].'</p>';
											if(count($event['examples']) > 0) {
												echo '<div class="examples">';
													$i = 1;
													foreach($event['examples'] as $example){
														echo '<p><a href="#">'.t('Argument %s:', $i).'</a></p>';
														echo '<pre>'.$txt->entities($example).'</pre>';
														$i++;
													}
												echo '</div>';
											}
										echo '</div>';
									}
								echo '</div></div>';
							}
						}
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
				<p><?php echo t('For support please submit a support ticked on the addon\'s page located here: <a target="_blank" href="http://www.concrete5.org/marketplace/addons/event-tester/">Event Tester</a>.')?></p>
			</div>
			
			<br />
			
			<div id="credits">
				<a name="credits"></a>
				<h2><?php echo t('Credits')?></h2>
				<p><?php echo t('Michael Krasnow is the author of the Event Tester.<br /><a target="_blank" href="http://www.concrete5.org/profile/-/781/">Check out some of my other stuff</a>! Donations are welcome.')?></p>
			</div>
		</div>
				
		<div class="span4" valign="top" align="left">
			<div class="well">
				<h2><?php echo t('Table of Contents')?></h2>
				<ul>
					<li><a class="contents" href="#use"><?php echo t('How to Use the Event Tester')?></a></li>
					<li><a class="contents" href="#events"><?php echo t('Default concrete5 Events')?></a></li>
					<li><a class="contents" href="#trouble"><?php echo t('Troubleshooting')?></a></li>
					<li><a class="contents" href="#support"><?php echo t('Support')?></a></li>
					<li><a class="contents" href="#credits"><?php echo t('Credits')?></a></li>
				</ul>
			</div>
		</div>
	</div>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);
