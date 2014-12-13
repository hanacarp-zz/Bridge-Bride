function checkSubset(sup,sub){ // take two arrays, sup (the superset array) and sub (the subset array).
	
	if(sup == '' || sub == ''){
		return -4;
	}
	
	if(Array.isArray(sup) == false || Array.isArray(sub) == false){
		return -1;
	}
	
	if(sub.length > sup.length){ // if sub is longer than sup, error out.
		return -2;
	}
	
	if(sup.length > sub.length+1){ // if sup is more than one character longer than sub, error out.
		return -5;
	}
	
	var counter = 0; // (set a counter for later)
	
	for(var i=0;i<sup.length;i++){ // if everything above is okay, see if the value of element i in sup...
	
		for(var j=0;j<sub.length;j++){ 
			if(sub[j] == sup[i]){	// ...equals the value of any of the elements in sub.
				counter++; // increment a counter every time an element of sub matches an element of sup...
			}
		
			if(counter == sub.length && sub.length == sup.length-1){ // ...and when that counter hits the length of sub (provided that sub is shorter than sup by one)...
				return true; // ...confirm that the array sub is a subset of the array sup. 
			}
			
			if(counter == sub.length && sub.length == sup.length){ // if the counter hits the length of sub and it's the same length as sup...
				return -3; // ...confirm that the array sub is a subset of the array sup. 
			}
		}
	
	}
		
	return false; // but if the counter never becomes equal to the length of sub, we know that it is not a subset of sup.
}