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
$guj="gn";
$ben="bn";
$temp="4";

$pass = mysql_query('SELECT id,content FROM passage WHERE test_id="'.$l2.'"');
$pass_row = mysql_fetch_array($pass);
$pass_id = $pass_row['id'];
$quest = mysql_query('SELECT q_no FROM question WHERE passage_id="'.$pass_id.'"');
$quest_row = mysql_fetch_array($quest);
$quest_id = $quest_row['q_no'];

$current_t=strtotime("now");
$current_time=date('H:i:s', $current_t);
$insert=mysql_query('UPDATE user SET  start_time = "'.$current_time.'" WHERE  email_id = "'.$email_id.'";');	
echo "<script LANGUAGE='JavaScript'>";

$sql_result = mysql_query('SELECT email_id, lastQAttempted FROM user WHERE email_id = "'.$email_id.'"');

if(is_resource($sql_result) && mysql_num_rows($sql_result) > 0 ){
	$q = mysql_query('SELECT lastQAttempted FROM user WHERE email_id = "'.$email_id.'"');
	$q_row = mysql_fetch_array($q);
	$q_id = $q_row['lastQAttempted'] +1;
	$p = mysql_query('SELECT passage_id FROM question WHERE q_no = "'.$q_id.'"');
	$p_row = mysql_fetch_array($p);
	$p_id = $p_row['passage_id'];
	//echo "check";
	if($q_id==1){
		if($l2=="gu"){
			echo "window.open('test.php?quest_id=1&pass_id=6')";
		}
		elseif ($l2=="bn") {
			echo "window.open('test.php?quest_id=26&pass_id=11')";
		}
	}
 	elseif($l2=="gu" && $q_id<26){
	//echo "window.open('test.php?quest_id=".$q_id."&pass_id=6','mywin', 'quest_id='.$q_id.',pass_id=6')";
	echo "window.open('test.php?quest_id=$q_id&pass_id=$p_id')";
	// elseif($l2=="bn"):
	// echo "window.open('test.php?quest_id=26&pass_id=11','mywin', 'quest_id=26,pass_id=11')";
	// endif;
    }

    elseif($l2=="bn" && $q_id<51){
	//echo "window.open('test.php?quest_id=".$q_id."&pass_id=6','mywin', 'quest_id='.$q_id.',pass_id=6')";
	echo "window.open('test.php?quest_id=$q_id&pass_id=$p_id')";
	// elseif($l2=="bn"):
	// echo "window.open('test.php?quest_id=26&pass_id=11','mywin', 'quest_id=26,pass_id=11')";
	// endif;
    }

    else
	{
	//echo "window.open('test.php?quest_id=3&pass_id=6')";
	header("Location:result.php"); 
	}
}

// else{

// if($l2=="gu"){
// 	echo "window.open('test.php?quest_id=2&pass_id=6')";
// }
// elseif($l2=="bn"){
// 	echo "window.open('test.php?quest_id=26&pass_id=11')";
// }

// }
echo "</script>";
// header("Location: test.php?quest_id=".$quest_id."&pass_id=".$pass_id);
?>
</html>
