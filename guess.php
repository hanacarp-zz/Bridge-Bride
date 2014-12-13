<?php
	
	include "includes/check_subset.php"; //the function that validates input
	include 'includes/dbconn.php';
	
	$document_id = $_POST['_id']; // get the _id of the mongo document so we can find the answer...
	$document_id = new MongoId($document_id); // ...and convert it to the right datatype.
	
	$query = array("_id" => $document_id); 
	$cursor= $db->riddles->findOne($query); //then look up the answer...
	$solution = $cursor["answer"];//...and store it in a variable for later.
	
	$input = $_POST["answer"]; // then get what the user entered... 
	$message = "";
	
	if($input != ''){ // ...and if it's not blank... 
		if($input == "zork"){ // ...or zork...
			$message = "A kingly reference, but you shan't win mine heart so easily.";
		}
		
		$reg = "/([a-zA-Z]+)/";
		preg_match_all($reg,$input,$matches); // ...grab all of the words entered.
		
		if(count($matches[1]) != 2){ // make sure there are only two words...
			$message = "What's this? The answer must be TWO WORDS long!";
			return false; // ...and error out if not.
		}
		
		$bridge = str_split($matches[1][0]); // load the letters of the first word into an array...
		$bride = str_split($matches[1][1]); // ... then load all of the second words into an array...
				
		$result = check_subset($bridge,$bride);
				
		if ($result === true) {
			if(strtolower($input) != $solution){  // ...but it doesn't match the answer in the database...
				$message = "Clever, you've got the format right, but your answer is wrong! Maybe you should consider writing a riddle to go with it and <a href='add.php'>submitting it</a>."; // ...show an error.
			}
			
			if(strtolower($input) == $solution){ // ...and it DOES match the answer we have on file...
				$message = "<strong>Good God!</strong> You got it!"; // ...show some kind of success message!!
			}
		} else if ($result < 0) {
			switch ($result) {
				case -1: // was one of the variables blank?
					$message = "Having trouble? The answer must be TWO WORDS long! Don't leave it blank, you dolt!";
				break;
				
				case -2: // did the comparison function return a -2? if so, the second word was longer than the first.
					$message = "Fie, the second word is longer than the first word! Remember, the second word in your answer must be the first word MINUS ONE LETTER!";
				break;
				
				case -3: // did the comparison function return a -3? if so, the words are the same length.
					$message = "You peasant, these words are the same length. Remember, the second word in your answer must be the first word MINUS ONE LETTER!";
				break;
				
				case -4: // did the function error out horribly?
					$message = "There was an error. The check_subset function didn't receive variables of the proper type. You lose. Good day, sir.";
				break;
				
				case -5: // did the comparison function return a -5? if so, the first word is more than 1 character longer than the second.
					$message = "How dear and simple you are, my child. The first word is far too long. Remember, the second word in your answer must be the first word MINUS A SINGLE LETTER!";
				break;
			}
		}
			
		
	} else {
		$message = "Having trouble? The answer must be TWO WORDS long! Solve this riddle!"; // if the answer field is blank, show this error.
	}
	
?>

<html>
	<head>
		<title>bridge bride!</title>
	</head>
	
	<body>
		<p>The Quiz Master says: <?php echo $message;?></p>
	</body>
</html>