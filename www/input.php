<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<form action ="display.php" method = "POST" enctype="multipart/form-data">
	
		Name: <input type = "text" name = "name">
		<br><br>
		Text:</br><textarea name = "text" rows="5" cols="40"></textarea>
		<br><br>
		<input name = "image" type = "file">
		<input type= "hidden" name="MAX_FILE_SIZE" value="30000" />
		<br><br>
		Gender:
		<input name = "gender" type ="radio" value = "Female">Female
		<input name = "gender" type ="radio" value = "Male">Male
		<input name = "gender" type ="radio" value = "?">?
		<br><br>
		<input type = "submit" name="submit" value="Отправить"/>
		<input type = "reset">
				
	</form>
</body>
</html>