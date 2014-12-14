<html>
	<head>
		<title>bridge bride!</title>
		<?php 
			include 'includes/dbconn.php';
			$query = array("status" => "1");
			$cursor= $db->riddles->find($query);
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
			<input type="text" name="answer" id="answer"> <input type="hidden" name="id" id="id" value="<?php echo $doc['_id'] ?>"><input type="button" id="guess" name="guess" value="O, Quiz Master, how hath I fared?"> 
		<p>The Quiz Master says: <span id="quizmaster">Type your answer into the box above!</span></p>
			<?php
					} //end while
				}	//end if
			?>
			
			<script type="text/javascript">
				document.getElementById("guess").addEventListener("click", function(){
					
					var answer = document.getElementById("answer").value;
					var id =  document.getElementById("id").value;
					var params = "answer=" + answer + "&id=" + id;
					var url = "guess.php";

					var http = new XMLHttpRequest();
					
					http.open("POST", url, true);
					
					//Send the proper header information along with the request
					http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					
					http.onreadystatechange = function() { //Call a function when the state changes.
					    if(http.readyState == 4 && http.status == 200) {
					        document.getElementById("quizmaster").innerHTML = http.responseText; //return $message
					    }
					}
					
					http.send(params);
				});
			</script>
	</body>
</html>