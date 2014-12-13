<html>
	<head>
		<title>bridge bride!</title>
		<?php 
			include 'includes/dbconn.php';
			$collection = "riddles";
			$query = array("status" => "2");
			$cursor = $db->$collection->find($query);
		?>
	</head>
	
	<body>
		
			<h3>Riddles awaiting approval:</h3>
			
			<?php 
				if($cursor->count() > 0){
					echo '<ul id="waiting-room">';
					while($cursor->hasNext()){
						$doc = $cursor->getNext();
						echo '<li>';
						echo '<span><strong>Riddle:</strong> '.$doc['riddle'].'<span><br>';
						echo '<span><strong>Answer:</strong> '.$doc['answer'].'</span>';
						echo '</li>';
						
						echo '<form name="admin" method="POST" action="do.php">';
							echo '<input type="hidden" name="doc" value="'.$doc['_id'].'">';
							echo '<input type="submit" value="approve" name="admin">';
							echo '<input type="submit" value="reject" name="admin">';
						echo '</form>';
					}
				echo '</ul>';
				}
				
				else{
					echo '<p>There are no riddles awaiting approval.</p>';
				}
			?>
			
	</body>
</html>