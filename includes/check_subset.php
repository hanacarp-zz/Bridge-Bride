<?php
	
	//checking for proper form:
	
	function check_subset($sup,$sub){
		
		if(!$sup || !$sub){ //obviously the arguments can't be blank!
			return -1;
		}
		
		if(!is_array($sup) || !is_array($sub)){ // if the types are all wrong, error out.
			return -4;
		}
		
		if(count($sup) < count($sub)){ // if sub is longer than sup, error out
			return -2;
		}
		
		if(count($sup) > count($sub)+1){ // if sup is more than one character longer than sub, error out.
			return -5;
		}
		
		$counter = 0; // (set a counter for later)
		for($i=0;$i<count($sup);$i++){ // if everything above is okay, see if the value of element i in sup...
			for($j=0;$j<count($sub);$j++){
				if($sub[$j] == $sup[$i]){ // ...equals the value of any of the elements in sub.
					$counter++; // increment a counter every time an element of sub matches an element of sup...
				}
				
				if($counter == count($sub) && count($sup) == count($sub)+1){ // ...and when that counter hits the length of sub (provided that sup is longer than sub by one)...
					return true; // ...confirm that the array sub is a subset of the array sup. 
				}

				if($counter == count($sub) && count($sup) == count($sub)){// if the counter hits the length of sub and it's the same length as sup...
					return -3; // ...error out.
				}
			}
		}
		
		return false; // but if the counter never becomes equal to the length of sub, we know that it is not a subset of sup.
	}
	
	
?>