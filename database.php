<?php

session_start();
echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><title>База даних</title>";
echo "</head><body>";

if (isset($_SESSION['author'])) {
    $author_id = $_SESSION['author'];
    echo "<H1>Ваш юзерайді:" . $author_id . "</H1>";
    echo "<a href='http://localhost'>Logout</a>";
} else {
    die('Доступ заборонено!');
}
?>
	
	<?php include 'db.php' ?>
	<?php include 'antispam.php' ?>
<!-- DB Connect -->
<?php
$connect = mysql_connect(HOST, USER, PASSWORD) or
         die("Error" . mysql_error());
?>
<!-- DB select -->
<?php
mysql_select_db(NAME_DB, $connect) or
         die("Error selecting db" . mysql_error());
// set encoding to unicode
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");
?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
	<!-- Get all query -->
	<?php
/**
 * Get table data from DB
 *
 * @author Akceptor <akceptor.spam@gmail.com>
 * @version 1.0
 *         
 */
$sql = "SELECT * FROM my_table";
$result = mysql_query($sql) or die(mysql_error());
$table = "<table border=1>";
$table .= "<tr align='center'>";
$table .= "<td></td><td> NAME </td><td> SHORT </td><td> FULL </td><td> CREATE </td><td> EDIT </td><td colspan=2> BUTTONS </td></tr>";
while ($row = mysql_fetch_assoc($result)) {
    $table .= "<tr>"; // show records from db
    $table .= "<td><input type = 'text' name='id[]' id='id' size = 1 value='" .
             $row['id'] . "' hidden></td>";
    $table .= "<td><input type = 'text' name='name[]' id='name' size = 10 value='" .
             $row['name'] . "' ></td>";
    $table .= "<td><input type = 'text' name='short[]' id='short' size = 20 value='" .
             $row['shorttext'] . "'></td>";
    $table .= "<td><textarea name='full[]' id='full' rows = 3 cols = 50 >" .
             $row['fulltext'] . "</textarea></td>";
    $table .= "<td><input type = 'date' name='creation[]' id='creation' size = 8 value='" .
             $row['creation_date'] . "'></td>";
    $table .= "<td><input type = 'date' name='edition[]' id='edition' size = 8 value='" .
             $row['edit_date'] . "'></td>";
    $table .= "<td><button type='submit' name='edit' id='edit' value='" .
             $row['id'] . "'>EDIT</button>" . "</td>";
    $table .= "<td><button type='submit' name='del' id='del' value='" .
             $row['id'] . "'>DELETE</button>" . "</td>";
    $table .= "</tr>";
}
$table .= "<tr>"; // add new record
$table .= "<td><input type = 'text' name='addid' id='addid' size = 3 value='' hidden></td>";
$table .= "<td><input type = 'text' name='addname' id='addname' size = 10 value='' placeholder='Як Вас звати?' ></td>";
$table .= "<td><input type = 'text' name='addshort' id='addshort' size = 20 value='' placeholder='Коротка інфа' ></td>";
$table .= "<td><textarea name='addfull' id='addfull' rows = 3 cols = 50 placeholder='Опишіть ситуацію повністю' ></textarea></td>";
$table .= "<td><input type = 'date' name='addcreation' id='addcreation' size = 8 value='" .
         $date . "'></td>";
$table .= "<td><input type = 'date' name='addedition' id='addedition' size = 8 value='" .
         $date . "'></td>";
$table .= "<td colspan=2 align='center'><input type='submit' name='add' id='add' value=' ADD '>" .
         "</td>";
$table .= "</tr>";
$table .= "</table> ";
echo $table;
?>
	
	</form>
<center>
	<a href="<?php $_SERVER['PHP_SELF']?>">RELOAD</a>
</center>
<!-- add data to DB -->
<?php
/**
 * Add\edit\delete stuff
 *
 * @author Akceptor <akceptor.spam@gmail.com>
 * @version 1.0
 *         
 */

$add = $_POST['add'];
if ($add) {

	$content = antispam($_POST[addfull]);

    mysql_query(
            "INSERT INTO my_table (`name`, `shorttext`, `fulltext`, `creation_date`, `edit_date`, `author_id`) VALUES ('$_POST[addname]','$_POST[addshort]','$content','$_POST[addcreation]','$_POST[addedition]', '$author_id')") or
             die("Error inserting to db" . mysql_error());
    // reload window
     echo "<script type='text/javascript'>
     parent.window.location.reload(true);</script>";
}
$edit = $_POST['edit'];
if ($edit) {
    //check author
    $sql="SELECT `author_id` FROM my_table WHERE `id`=".$edit." LIMIT 1";
    $result = mysql_query($sql);
    if  ($author_id == mysql_result($result, 0)){

	$content = antispam($_POST[full][array_search($edit, $_POST['id'])]);

    // create UPDATE query
    $sql = "UPDATE my_table SET `name`='" .
             $_POST[name][array_search($edit, $_POST['id'])] . "', `shorttext`='" .
             $_POST[short][array_search($edit, $_POST['id'])] . "', `fulltext`='" .
             $content.
             "', `creation_date`='" .
             $_POST[creation][array_search($edit, $_POST['id'])] .
             "', `edit_date`='" .
             $_POST[edition][array_search($edit, $_POST['id'])] . "' WHERE `id`=" .
             $edit;
    // execute UPDATE query
    mysql_query($sql) or die("Error updating DB" . mysql_error());
    } else { 
        die ("No rights to do that");
    }
    // reload window
     echo "<script type='text/javascript'>
     parent.window.location.reload(true);</script>";
}
$delete = $_POST['del'];
if ($delete) {
    //check author
    $sql="SELECT `author_id` FROM my_table WHERE `id`=".$delete." LIMIT 1";
    $result = mysql_query($sql);
    if  ($author_id == mysql_result($result, 0)){
    // create and execute DELETE query
    mysql_query("DELETE FROM my_table WHERE `id`=" . $delete) or
             die("Error deleting from DB" . mysql_error());
    } else {
        die ("No rights to do that");
    }
    // reload window
     echo "<script type='text/javascript'>
     parent.window.location.reload(true);</script>";
}
?>

<!-- close DB -->
<?php
mysql_close($connect);
?>


</body>
</html>
