<html>
	<head>
		<title>bridge bride!</title>
	</head>
	
	<body>
		
		<form action="do.php">
			<h3>Your riddle:</h3>
			<p>This can be as long as you want. Don't use either of the answer's words in the riddle itself.</p>
			<textarea id="riddle" name="riddle"></textarea>
			<h3>The answer to your riddle:</h3>
			<p>Make sure it's only <strong><em>two</em> words</strong>. The second word must be the <strong>first word minus <em>one</em> letter</strong>.</p>
			<input type="text" name="answer">
			<input type="submit" value="add" name="add" id="add_button">
		</form>
	</body>
</html>