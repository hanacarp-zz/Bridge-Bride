<html>
	<head>
		<title>bridge bride!</title>
		<?php 
			include 'includes/dbconn.php';
			$collection = "riddles";
			$query = array("status" => "1");
			$cursor= $db->$collection->find($query);
			$cursor->batchSize(1);
		?>
	</head>
	
	<body>
		<h1>oh, goody, a parlor game!</h1>
		<p>Riddle me this, traveler: <span id="riddle">
			<?php 
				if($cursor->count() > 0){
					while($cursor->hasNext()){
						$doc = $cursor->getNext();
						echo $doc['riddle'];
						$solution = $doc['answer'];
			?>
		</span></p>
		<form name="bb">
			<input type="text" name="answer" id="answer"> <input type="button" id="submit" name="submit" value="O, Quiz Master, how hath I fared?"> 
		</form>
		<p>The Quiz Master says: <span id="quizmaster">Type your answer into the box above!</span></p>
		
		<script type="text/javascript" src="js/checkSubset.js"></script> <!-- this is a function i made ._.  -->
		<script type="text/javascript">
			
			var solution = "<?php echo $solution;?>";
					
			<?php
					} //end while
				}	//end if
			?>
			
			document.getElementById("submit").addEventListener("click", function(){
			
				var input = document.getElementById("answer").value; // get what the user entered... 
				
				if(input == "zork"){
					document.getElementById("quizmaster").innerHTML = "A kingly reference, but you shan't win mine heart so easily.";
					return false;
				}
				
				if(input != ''){ // ...and if it's not blank... 
					var reg = /([a-zA-Z]+)/g;
					console.log(reg);
					var answer = input.match(reg); // ...grab all of the words entered. 
					
					console.log(answer);
					
					if(answer.length < 2){
						document.getElementById("quizmaster").innerHTML = "Having trouble? The answer must be TWO WORDS long! Don't half-ass this.";
						return false;
					}
					
					var bridge = answer[0].split(""); // load the letters of the first word into an array...
					
					var bride = answer[1].split(""); // ... then load all of the second words into an array...
					
					if(checkSubset(bridge,bride) == -4){ // was one of the variables blank?
						document.getElementById("quizmaster").innerHTML = "Having trouble? The answer must be TWO WORDS long! Don't leave it blank, you dolt!";
					} 
					
					if(checkSubset(bridge,bride) == -1){ // did the function error out horribly?
						document.getElementById("quizmaster").innerHTML = "There was a JavaScript error. The checkSubset() function didn't receive variables of the proper type. You lose. Good day, sir.";
					} 
					
					if(checkSubset(bridge,bride) == -2){ // did the comparison function return a -2? if so, the second word was longer than the first.
						document.getElementById("quizmaster").innerHTML = "Fie, the second word is longer than the first word! Remember, the second word in your answer must be the first word MINUS ONE LETTER!";
					}
					
					if(checkSubset(bridge,bride) == -3){ // did the comparison function return a -3? if so, the words are the same length.
						document.getElementById("quizmaster").innerHTML = "You peasant, these words are the same length. Remember, the second word in your answer must be the first word MINUS ONE LETTER!";
					}
					
					if(checkSubset(bridge,bride) == -5){ // did the comparison function return a -5? if so, the first word is more than 1 character longer than the second.
						document.getElementById("quizmaster").innerHTML = "How dear and simple you are, my child. The first word is far too long. Remember, the second word in your answer must be the first word MINUS A SINGLE LETTER!";
					}

					
					if(checkSubset(bridge,bride) == true){ // if the second array is a subset of the first array...
						if(input !== solution){ // ...but it doesn't match the answer we have on file in the database, show an error message.
							document.getElementById("quizmaster").innerHTML = "Clever, you've got the format right, but your answer is wrong! Maybe you should consider writing a riddle to go with it and <a href='add.php'>submitting it</a>.";
						}
						
						if(input == solution){ // ...and it DOES match the answer we have on file...
							document.getElementById("quizmaster").innerHTML = "<strong>Good God!</strong> You got it!"; // ...show some kind of success message!!
						}
					}
					
				} else {
					document.getElementById("quizmaster").innerHTML = "Having trouble? The answer must be TWO WORDS long! Solve this riddle!"; // if the answer field is blank, show this error.
				}
			
			});
		</script>
	</body>
</html>