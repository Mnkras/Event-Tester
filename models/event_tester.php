<?php  

class EventTester {

	public function testEvent($event) {
		$arg_list = func_get_args();
		$l = new Log('event_tester', true);
		$l->write('===Event Tester===');
		$l->write('');
		$numargs = func_num_args();
		for ($i = 0; $i < $numargs; $i++) {
			if(!is_object($arg_list[$i])) {
        		$l->write("Argument $i: " . $arg_list[$i]);
        	} else {
        		$l->write("Argument $i: " . print_r($arg_list[$i], true));
        	}
   		}
		$l->close();
	}

}