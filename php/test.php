
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This is our course project for IT442 where we attempt at solving Indian Coffee House Problem.">
	<meta name="author" content="Shalin Shah, Shivang Bhatt, Nikit Saraf">
	<!-- <link rel="shortcut icon" href="../../assets/ico/favicon.ico"> -->

	<title>ICHP</title>

	<!-- Bootstrap core CSS -->
	<link href="./../css/bootstrap/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="./../css/testPage.css" rel="stylesheet">

	<script src="./../javascript/test.js" type="text/javascript"></script>

	<?php
	$db = mysql_connect("localhost", "root","");
	mysql_select_db("onlinetest",$db);
	?>
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">ICHP</a>
			</div>

			<div class="navbar-collapse collapse">
				<form class="navbar-form navbar-right" role="form">
					<a href="result.php"><button type="button" class="btn btn-danger">End Test</button></a>
				</form>
			</div>
		</div>
	</div>

	<?php
	session_start();
	$email_id=$_SESSION['indexPageEmailId'];
	$user_name=$_SESSION['indexPageName'];
	$quest_id = $_GET['quest_id'];
	$_SESSION['quest_id']=$quest_id;
	$pass_id = $_GET['pass_id'];
	$pass_c = mysql_query("SET NAMES utf8");
	$pass_c = mysql_query('SELECT content FROM passage WHERE id="'.$pass_id.'"');
	$pass_row = mysql_fetch_array($pass_c);
	/*$utf8_string = Encoding::toUTF8($pass_row['content']);*/
	$quest_c = mysql_query("SET NAMES utf8");
	$quest_c = mysql_query('SELECT q_english,q_name,option_1,english_option_1,option_2,english_option_2,option_3,english_option_3,option_4,english_option_4 FROM question WHERE q_no="'.$quest_id.'"');
	$quest_row = mysql_fetch_array($quest_c);
	?>

	<body  id="testPageBody" onkeydown="return (!(event.keyCode == 116) && !(event.keyCode == 82))">
		<div style="margin-top:70px; margin-bottom:30px;">
			<div class="container">
				<div class="progress progress-striped active">
					<!-- echo '<td>'.$r['q_no'].'</td>'; -->
					<?php
					$progress = (int) $quest_id/25.0*100;
					echo '<div class="progress-bar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" role="progressbar" style="width: '.$progress.'%">'	;
					?>
				</div>
			</div>

			<!-- <p id="testPageError" class="alert alert-danger" hidden>Please select any one option before proceding to the next page.</p> -->

			<div class="panel panel-primary">
				<table class="table">					
					<tr class="panel-heading">
						<th ><?php echo 'Passage '.$pass_id; ?></th>
						<th> Time Elapsed in this question: </th>
						<th id="testPageTimeShow"></th>
						<th id="testPageTime" hidden></th>
					</tr>
					<tr>
						<td rowspan=3 width="70%" height="100%">
							<div style='height:500px; overflow:auto'>
								<div class="passage">
									<?php echo $pass_row['content'];?> 
								</div>
							</div>
						</td>
					</tr>

					<!-- <tr><td> -->
					<!-- <div name='qname' id="questions" style="overflow:auto;color:black;font-family:'Courier New', Courier, monospace;font-size:18px;padding-left: 5px;padding-right: 5px;text-align: justify;"><?php echo $quest_id,".", $quest_row['q_name']; ?></div><?php echo $quest_row['q_english']; ?><br/><br/> -->
					<tr>
						<td width="20%">
							<div class="questionGujju">
								<?php echo $quest_id,".", $quest_row['q_name']; ?>
							</div>
							<div class="questionEnglish">
								<?php echo $quest_row['q_english']; ?>
							</div>
						</td>
						<td width="0%"></td>
					</tr>

					<tr>
						<td height="80%">
							<form id ="qform" method="post" action="recordscript.php" onsubmit="return TRUE">
								<div>
									<input type="radio" id="option_1" name="option" value="1">
									<label for="option_1"><?php echo $quest_row['option_1']; ?></label><br/>
									<?php echo str_repeat('&nbsp;', 5); echo $quest_row['english_option_1']; ?><br/>

									<input type="radio" id="option_2" name="option" value="2">
									<label for="option_2"><?php echo $quest_row['option_2']; ?></label><br/>
									<?php echo str_repeat('&nbsp;', 5); echo $quest_row['english_option_2']; ?><br/>

									<input type="radio" id="option_3" name="option" value="3">
									<label for="option_3"><?php echo $quest_row['option_3']; ?></label><br/>
									<?php echo str_repeat('&nbsp;', 5); echo $quest_row['english_option_3']; ?><br/>

									<input type="radio" id="option_4" name="option" value="4">
									<label for="option_4"><?php echo $quest_row['option_4']; ?></label><br/>
									<?php echo str_repeat('&nbsp;', 5); echo $quest_row['english_option_4']; ?><br/>

									<input type="input" id="testPageTimer" name="testPageTimer" value="2" hidden>
								</div>
								<td></td>

								<tr>
									<!--	<td align="left" style='border-left:1px solid;border-right:0px;padding-left:2px;padding-top:1px;' valign="middle"><?php echo $email_id ?> -->
									<?php echo '<th> Welcome, '.$user_name.'</th>'; ?>
									<td><input type="button" class="btn btn-primary" value="Previous" style="width:100px; algin:left;" onclick="history.go(-1);"></td>
									<td><input type="submit" class="btn btn-primary" value="Next" style="width:100px; algin:right;" onclick="validateOption()"></td>
								</tr>
							</form>							
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>


	<div class="footer">
		<footer>	
			<div align="right">
				<p><b>Developers :- Abhishek Shah, Shivang Bhatt, Shalin Shah and Nikit Saraf. &nbsp; &copy; 2014 IRLab, DA-IICT.</b></p>
			</div>
		</footer>
	</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
</body>


</html>