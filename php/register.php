<html>
<?php
session_start();
$db = mysql_connect("localhost", "root","");
$email_id = $_POST['indexPageEmailId'];
$_SESSION['indexPageEmailId'] = $email_id;
//echo $_SESSION['indexPageEmailId'];
$name = $_POST['indexPageName'];
$_SESSION['indexPageName'] = $name;
$l2 = $_POST['indexPageLangSelect'];
mysql_select_db("onlinetest",$db);
$sql = "INSERT INTO user (email_id, name, L2) 
VALUES ('$email_id', '$name','$l2')";
$result = mysql_query($sql);

$pass = mysql_query('SELECT id,content FROM passage WHERE test_id="'.$l2.'"');
$pass_row = mysql_fetch_array($pass);
$pass_id = $pass_row['id'];
$quest = mysql_query('SELECT q_no FROM question WHERE passage_id="'.$pass_id.'"');
$quest_row = mysql_fetch_array($quest);
$quest_id = $quest_row['q_no'];

$current_t=strtotime("now");
$current_time=date('H:i:s', $current_t);
$insert=mysql_query('UPDATE user SET  start_time = "'.$current_time.'" WHERE  email_id = "'.$email_id.'";');	

header("Location: test.php?quest_id=".$quest_id."&pass_id=".$pass_id);
?>
</html>
