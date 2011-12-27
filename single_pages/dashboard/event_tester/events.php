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

echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Tester'), false, 'span6 offset5');?>
	<div class="clearfix">
		<h3><?php echo t('Add Event')?></h3>
		<form class="form-stacked" method="post" id="add_event" action="<?php echo $this->action('add_new_event')?>">
			<?php echo $this->controller->token->output('add_new_event')?>
			<label for="event"><?php echo t('Event')?>:</label>
			<input type="text" id="event" name="event" class="span4" />
			<span class="help-block"><?php echo t('(eg. on_user_login)')?></span>
			<?php print $ih->submit(t('Save'), 'add_event', 'left', 'primary');?>

		</form>
		<table class="zebra-striped" cellspacing="1" cellpadding="0" border="0">	
			<tbody>
				<tr>
					<td class="subheader"><strong><?php echo t('Event')?></strong></td>
					<td class="subheader" style="width:18%;"></td>
				</tr>			
		<?php
		if(count($events) > 0) {
			foreach($events as $event) {
				$delete = $ih->button_js(t('Delete'), 'delete_confirm(\''.$event->getEvent().'\', \''.$event->getID().'\')', 'left', 'danger');
				echo '<tr>'."\n";
					echo '<td><strong>'.$event->getEvent().':</strong></td>'."\n";
					echo '<td>'.$delete.'</td>'."\n";
				echo '</tr>'."\n";			
			}
		} else {
			echo '<tr><td colspan="2">'.t('There are no events to display.').'</td></tr>';
		}
		
		?>		
			</tbody>
		</table>
		<br />
		<script type="text/javascript">
			delete_confirm = function(event, ID) {
				if (confirm('<?php echo t("Are you sure you want to delete the event \"%s\"?", "' + event + '")?>')) {
					window.location = "<?php echo View::url('dashboard/event_tester/events/', 'delete');?>" + ID + "/<?php echo $val->generate('delete_event')?>";
				}
			};
		</script>
		</div>
	</div>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);