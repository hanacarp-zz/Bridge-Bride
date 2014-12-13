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
		<form name="bb" action="guess.php" method="POST">
			<input type="text" name="answer" id="answer"> <input type="hidden" name="_id" value="<?php echo $doc['_id'] ?>"><input type="submit" id="guess" name="guess" value="O, Quiz Master, how hath I fared?"> 
		</form>
		<p>The Quiz Master says: <span id="quizmaster">Type your answer into the box above!</span></p>
			<?php
					} //end while
				}	//end if
			?>
	</body>
</html>