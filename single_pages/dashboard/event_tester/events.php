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
 
$ih = Loader::helper('concrete/interface');
$form = Loader::helper('form');
Loader::model('event_tester', 'event_tester');
$valt = Loader::helper('validation/form');
$val = Loader::helper('validation/token');
?>
<div>
	<h1><span><?php echo t('Event Tester')?></span></h1>
	<div class="ccm-dashboard-text">
		<table class="grid-list" width="100%" cellspacing="1" cellpadding="0" border="0">	
			<tbody>
				<tr>
					<td class="subheader"><strong><?php echo t('Event')?></strong></td>
					<td class="subheader" style="width:18%;"></td>
				</tr>			
		<?php
		if(count($events) > 0) {
			foreach($events as $event) {
				$delete = $ih->button_js(t('Delete'), 'delete_confirm(\''.$event->getEvent().'\', \''.$event->getID().'\')', 'left');
				echo '<tr>'."\n";
					echo '<td><strong>'.$event->getEvent().':</strong></td>'."\n";
					echo '<td>'.$ih->buttons($delete).'</td>'."\n";
				echo '</tr>'."\n";			
			}
		} else {
			echo '<tr><td colspan="3">'.t('There are no events to display.').'</td></tr>';
		}
		
		?>		
			</tbody>
		</table>
		<br />
		<div class="ccm-spacer">&nbsp;</div>		
		<script type="text/javascript">
			delete_confirm = function(event, ID) {
				if (confirm('<?php echo t("Are you sure you want to delete the event \"%s\"?", "' + event + '")?>')) {
					window.location = "<?php echo View::url('dashboard/event_tester/events/', 'delete');?>" + ID + "/<?php echo $val->generate('delete_event')?>";
				}
			};
		</script>
		</div>
	</div>
	<h1><span><?php echo t('Add New Event')?></span></h1>
	<div class="ccm-dashboard-inner">
		<form method="post" action="<?php echo $this->action('add_new_event')?>" id="event-tester-add-form">
			<?php echo $this->controller->token->output('add_new_event');?>
			<div class="ccm-dashboard-text">
				<?php
					echo '<label for="event"><strong>'.t('Event').':</strong><div class="ccm-dashboard-description">'.t('(eg. on_user_login)').'</div></label>';
					echo $form->text('event');
					echo '<div class="ccm-spacer">&nbsp;</div>';
					echo $ih->submit(t('Save New Event'), 'event-tester-add-form', 'left');
				?>
			</div>
		</form>		
	</div>
</div>