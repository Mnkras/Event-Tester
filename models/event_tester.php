<?php  

class EventTester {

	public function testEvent($event) {
		$arg_list = func_get_args();
		$event_name = array_pop($arg_list);
		$l = new Log('event_tester', true);
		$l->write('===Event Tester===');
		$l->write('');
		$l->write('Fired Event: '.$event_name);
		$l->write('');
		$numargs = func_num_args();
		$i = 0;
		foreach($arg_list as $thing){
			$count = $i+1;
			if(is_string($arg_list[$i])|| is_boolean($arg_list[$i])) {
				$l->write("Argument $count: " . $arg_list[$i]);
			} else {
				$l->write("Argument $count: " . print_r($arg_list[$i], true));
			}
			$i++;
		}
		$l->close();
	}

}