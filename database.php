<?php

session_start();
echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><title>База даних</title>";
echo "</head><body>";

if (isset($_SESSION['author'])) {
    $author_id = $_SESSION['author'];
    echo " Ваш юзерайді: " . $author_id . "     <a href='http://localhost'>Вийти</a><br>";
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

$result = mysql_query("SELECT COUNT(id) AS count FROM `my_table`");
$row = mysql_fetch_assoc($result);
$rows_max = $row['count']; // Records quantity
$show_pages = max(1, $_GET['pages']); // Records per page
$this_page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
echo "Всього записів у базі: ".$rows_max;
echo "<br>Записів на сторінку: ".$show_pages;
echo "<br>Поточна сторінка: ".max(1,$this_page);
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
if ($this_page)
{
        $offset = (($show_pages * $this_page) - $show_pages);
}
else
{
        $this_page = 1; // set first page $_GET['page']
	$offset = 0;
}
echo'<center> ';
// Page navi
echo '<a href="?page=1"> << </a>';//goto 1st page
if ($rows_max > $show_pages)
{
       $r = 1;
       while ($r <= ceil($rows_max/$show_pages))
       {
           if ($r != $this_page)
           {          
                echo '<a href="?page=' . $r . '&pages='.$show_pages.'"> '. $r .'</a>';
           }
           else
           {
               echo '<b>' . $r . '</b>'; // Current page
            }
            $r++;      
       }
}
echo '<a href="?page='.ceil($rows_max/$show_pages).'"> >> </a>';//goto last page
echo'</center> <br>';
$sql = "select * from my_table ORDER BY id ASC LIMIT $offset, $show_pages";
$result = mysql_query($sql) or die(mysql_error());

$table = "<table border=1 align='center'>";
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
<form name='recform' action='' method='get'></br>
Показувати по: <select name='pages'><option value=3>3</option><option value=5>5</option><option value=7>7</option></select> записів
<button type='submit'>Так!</button></form>
<center>
	<a href="<?php $_SERVER['PHP_SELF']?>">RELOAD</a>
</center>
<!-- add data to DB -->

<?php include 'persistent.php' ?>

<!-- close DB -->
<?php
mysql_close($connect);
?>


</body>
</html>
