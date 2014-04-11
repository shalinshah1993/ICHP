<html>
<?php
session_start();
$db = mysql_connect("localhost", "root","");
$email_id=$_SESSION['indexPageEmailId'];
$quest_id=$_SESSION['quest_id'];
$answer=$_POST['option'];
$timer=$_POST['testPageTimer'];
echo $quest_id;
echo $email_id;
echo $answer;
echo $timer;
settype($answer, "int");
settype($quest_id,"int");
mysql_select_db("onlinetest",$db);

if($answer!=0){
// 	$sql = mysqli_query($db,"UPDATE user SET lastQAttempted='$quest_id'
// WHERE email_id='$email_id'");
	$sql2 = "UPDATE user SET lastQAttempted='$quest_id'
	WHERE email_id='$email_id'";
	//$result = mysqli_query($db, $sql);
}
// elseif($answer==0){
// 	$sql = "UPDATE user
//     SET lastQAttempted = $quest_id
//     WHERE email_id = $email_id";
// }

if($answer!=0){
	$sql = "INSERT INTO record_answer (email_id, q_no, answer, time_elapsed) 
	VALUES ('$email_id', '$quest_id', '$answer', '$timer') ON DUPLICATE KEY UPDATE 
	answer=$answer,
	time_elapsed=time_elapsed+$timer";
}
elseif($answer==0){
	$sql = "INSERT INTO record_answer (email_id, q_no, answer, time_elapsed) 
	VALUES ('$email_id', '$quest_id', '$answer', '$timer') ON DUPLICATE KEY UPDATE  
	time_elapsed=time_elapsed+$timer";
}

$result = mysql_query($sql);
$result = mysql_query($sql2);
$quest_id++;
echo $quest_id;
$pass = mysql_query('SELECT passage_id FROM question WHERE q_no="'.$quest_id.'"');
$quest_row = mysql_fetch_array($pass);
$pass_id = $quest_row['passage_id'];
echo $pass_id;
settype($pass_id,"int");
$test = mysql_query('SELECT test_id FROM passage WHERE id="'.$pass_id.'"');
$test_row = mysql_fetch_array($test);
$test_id = $test_row['test_id'];
echo $test_id;
$lang = mysql_query('SELECT L2 FROM user WHERE email_id="'.$email_id.'"');
$lang_row = mysql_fetch_array($lang);
$l2=$lang_row['L2'];
echo $l2;
if(($l2 == $test_id)&&(isset($l2))&&(isset($test_id)))
{
	echo "l2= ".$l2. " test_id= ".$test_id;
	header("Location: test.php?quest_id=".$quest_id."&pass_id=".$pass_id); 
}
else
{
	$current_t=strtotime("now");
	$current_time=date('H:i:s', $current_t);
	$insert=mysql_query('UPDATE user SET  end_time = "'.$current_time.'" WHERE  email_id = "'.$email_id.'";');	
	echo "else l2= ".$l2. " test_id= ".$test_id;
	header("Location:result.php"); 
}
?>
</html>