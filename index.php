<?php session_start(); ?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>

<?php include 'db.php' ?>

<form action="index.php" method="post">
    <table>
        <tr>
            <td>Логін:</td>
            <td><input type="text" name="login" /></td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Авторизуватися" /></td>
        </tr>
    </table>
</form>

<!-- DB Connect -->
<?php
	$connect = mysql_connect(HOST, USER, PASSWORD) or die ("Error" .mysql_error( ));
?>
<!-- DB select -->
<?php
	mysql_select_db(NAME_DB, $connect) or die ("Error selecting db" .mysql_error( ));
	//set encoding to unicode
	mysql_query("SET character_set_connection=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_results=utf8"); 


if (isset($_POST['login']) && isset($_POST['password']))
{
	$login = mysql_real_escape_string($_POST['login']);
	$password = ($_POST['password']);

	//user search
	$query = "SELECT `author_id`
		FROM `authors`
		WHERE `login`='{$login}' AND `password`='{$password}'
		LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());

	// found
	if (mysql_num_rows($sql) == 1) {
        // set mark in session
	$row = mysql_fetch_assoc($sql);
	$_SESSION['author'] = $row['author_id'];
        
       echo "<script>document.location.replace('database.php');</script>";
    }
    else {
        die('Користувача не знайдено. Перевірте логін\пасворд і спробуйте ще');
    }
}


?>




</head>
</html>
