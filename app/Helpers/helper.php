<?php 
	
	function pre($data) {
		if(is_array($data) || is_object($data)) {
			print"<pre>";
			print_r($data);
			print"</pre>";
		} else {
			echo "<pre>";
			echo "$data";
			echo "</pre>";
		}
	}

 ?>