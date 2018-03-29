<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php

	$link = mysql_connect('localhost','root','');
	$db = mysql_select_db('screen',$link);
	mysql_set_charset("utf8",$link);
	if( !$link || !$db ){
		die("не удалось подключиться к базе");
	}
	else{
	$name = $_POST['name'];
	$text = $_POST['text'];
	$gender = $_POST['gender'];
	$imagename = $_FILES["image"]["tmp_name"];
	$imname = $_FILES['image']['name'];
	$imsize = $_FILES['image']['size'];
	$types = array('image/gif', 'image/png', 'image/jpeg');
	$newpath = $_SERVER['DOCUMENT_ROOT'].'/images/'.$imname;
	//если какое-то поле формы было не заполнено
	if(!empty($name) AND !empty($text) AND !empty($gender) AND !is_uploaded_file($imname)){
		
		//проверка на тип картинки
		if (!in_array($_FILES['image']['type'], $types))
			die('Выбрана не картинка. <a href="input.php">Попробовать другой файл?</a>');
		if ($imsize > 30000)
			die('Выбрать <a href="input.php">картинку</a> меньшего размера');
		// Загрузка картинки с сервера в мою папку
		if(copy($imagename, $newpath)){
			unlink($_FILES["image"]["tmp_name"]);
			//записываем информацию из формы в базу
			if (!mysql_query("INSERT INTO Form(Name, Text, Gender, Image) VALUES ('$name','$text','$gender','$newpath')")){
				echo "Форма не добавлена в базу<br>";
				exit(mysql_error());
			}
		}
		else
			echo 'картинка не была скопирована с сервера<br>';
	}else if(empty($name)){
		echo 'Не заполнено поле: Name <a href="input.php">ввести заново?</a>';
	}else if(empty($text)){
		echo 'Не заполнено поле: Text <a href="input.php">ввести заново?</a>';
	}else if(empty($gender)){
		echo 'Не заполнено поле: Gender <a href="input.php">ввести заново?</a>';
	}else if(is_uploaded_file($imname)){
		echo 'Не выбрана картинка <a href="input.php">загрузить картинку?</a>';
	}
	//таблица вывода
	$query = mysql_query("SELECT * FROM form");
	echo "<table border=3 bordercolor=blue align=center width="."50%".">";
	echo 	"<th>№</th>
			<th>Имя</th>
			<th>Пол</th>
			<th>Текст</th>
			<th>Картинка</th>";
	//заполняем таблицу данными из базы
	$N = 1;
	while($row = mysql_fetch_assoc($query))
	{
		$Name_array=$row['Name'];
		$Text_array=$row['Text'];
		$Gender_array=$row['Gender'];
		$Image_array=$row['Image'];
		echo "<tr>
		<td><div  align=center>$N</div></td>
		<td><div  align=center>$Name_array</div></td>
		<td><div  align=center>$Gender_array</div></td>
		<td><pre>$Text_array</pre></td>
		<td><div align=center>$Image_array</div></td>
		</tr>";
		$N++;
	}
	echo "</table>";
	}
?>
<br><a href='input.php'>Вернуться к заполнению формы</a>
</body>
</html>