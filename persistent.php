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
