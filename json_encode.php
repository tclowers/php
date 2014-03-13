<?php 

function is_assoc($array) {
  return (bool)count(array_filter(array_keys($array), 'is_string'));
}


function encode_to_json($input) {
	if(is_string($input)) {
		return "'" . $input . "'";
	} elseif (is_numeric($input)) {
		return $input;
	} elseif (is_array($input)) {
		if(!is_assoc($input)) {
			$new_string = "[";
			$a = 0;
			foreach($input as $element) {
				if($a > 0) {
					$new_string .= ", ";
				}
				$new_string .= encode_to_json($element);
			}
			$new_string .= "]";
			return $new_string;
		} else {
			$new_string = "{";
			$a = 0;
			foreach($input as $key => $val) {
				if($a > 0) {
					$new_string .= ", ";
				}
				$new_string .= "'" . $key . "': " . encode_to_json($val);
			}
			$new_string .= "}";
			return $new_string;
		}
	}
}


echo "encode 'house': " . encode_to_json("house");

?>

