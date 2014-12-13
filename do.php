<?php
	include 'includes/dbconn.php';
	
	$admin = strtolower(trim($_POST['admin']));
	$document_id = $_POST['doc'];
	$document_id = new MongoId($document_id);
	$message = "default";
	
	if(isset($admin) && $admin != ''){ //if the button was called "admin"...
		if($admin == "approve"){ //...and the button's value was "approve"
			$query = array('$set' => array("status" => "1"));
			$what = array("_id" => $document_id);
			print_r($what);
			$cursor = $db->riddles->update($what, $query);
			//$cursor = $db->riddles->findOne(array("_id" => $document_id));
			
			if($cursor["nModified"] == 1){
				$message = "OK, it's approved.";
			} else {
				$message = "Nothing was changed.";
			}
			
		} elseif($admin == "reject"){ //...and the button's value was "reject"
			$db->$collection->remove(array("_id" => $document_id));
			if($cursor["nModified"] == 1){
				$message = "OK, it's gone.";
			} else {
				$message = "Nothing was removed.";
			}
		} else{
			$message = "Ooops, you got here by mistake, didn't you? It's okay. <a href='index.php'>You can go back</a>.";
		}
	}
	
	if(isset($submit) && $submit != ''){ //if the button was called submit...
		if($submit == "add"){ //...and the button's value was "add"
			
		}
	}
?>

<html>
<head>
	<title>bridge bride!</title>
</head>

<body>
	<p><?php echo $message; ?></p>
	<?php
		var_dump($cursor);
	?>
</body>
</html>