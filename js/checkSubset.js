function checkSubset(sup,sub){ // take two arrays, sup (the superset array) and sub (the subset array).
	
	if(Array.isArray(sup) == false || Array.isArray(sub) == false){
		return -1;
	}
	
	if(sub.length > sup.length){ // if sub is longer than sup, error out.
		return -2;
	}
	
	var counter = 0; // (set a counter for later)
	
	for(var i=0;i<sup.length;i++){ // if everything above is okay, see if the value of element i in sup...
		
		for(var j=0;j<sub.length;j++){ 
			if(sub[j] == sup[i]){	// ...equals the value of any of the elements in sub.
				counter++; // increment a counter every time an element of sub matches an element of sup...
			}
		
			if(counter == sub.length){ // ...and when that counter hits the length of sub...
				return true; // ...confirm that the array sub is a subset of the array sup. 
			}
		}
	
	}

return false; // but if the counter never becomes equal to the length of sub, we know that it is not a subset of sup.

}