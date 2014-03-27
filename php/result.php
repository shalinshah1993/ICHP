
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-10646-1">
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
	<link href="./../css/resultPage.css" rel="stylesheet">
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<li class="active"><a class="navbar-brand">ICHP</a></li>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="./../index.html">Home</a></li>
					<li class="active"><a href="#">Results</a></li>					
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>


	<div style="margin-top: 100px">
		<div class="container">
			<p class="alert alert-success"><b>Congratulations!</b> You've completeted the test. Thank-you for your time and efforts, we appriciate it.</p>
			<div class="panel panel-primary">
				<div class="panel-heading"><font size="3"><b>Results for your Test</b></font></div>

				<table class="table" id="testPageTable">
					<b><tr>
						<th>Question Number</th>
						<th>Correct Answer</th>
						<th>Your Answer</th>
						<th>Time Taken</th>
					</tr></b>
					
					<?php
					session_start();
					$db = mysql_connect("localhost", "root","");
					mysql_select_db("onlinetest",$db);
					$email_id = $_SESSION['indexPageEmailId'];

					$time = mysql_query('SELECT start_time,end_time FROM user WHERE email_id="'.$email_id.'"');
					$quest_row = mysql_fetch_array($time);
					$start_time = $quest_row['start_time'];
					$end_time = $quest_row['end_time'];

					$time1 = strtotime($start_time);
					$time2 = strtotime($end_time);
					$diff = $time2 - $time1;

					$ques_ans = mysql_query("SELECT q_no, answer FROM question");
					$marked_answers = mysql_query('SELECT q_no, answer FROM record_answer WHERE email_id="'.$email_id.'"');
					$correct_answers = 0;
					while($r = mysql_fetch_assoc($marked_answers)){
						echo '<tr>';

						$marked_answer = mysql_query('SELECT answer FROM question WHERE q_no="'.$r['q_no'].'"');

						$ans = mysql_fetch_array($marked_answer);

						echo '<td>'.$r['q_no'].'</td>';
						echo '<td>'.$ans['answer'].'</td>';
						echo '<td>'.$r['answer'].'</td>';
						echo '<td>00:00:00</td>';
						echo '</tr>';

						if ($r['answer'] == $ans['answer']) {
							$correct_answers = $correct_answers + 1;
						}
					} 

					?>
				</table>
			</div>
		</div>
	</div>

	<center>
		<h3 style="padding-bottom: 40px;"><span class="label label-default">
			<?php echo "Total Correct Answers : ".$correct_answers ?>
		</span></h3>
	</center>

	<div class="footer">
		<footer>	
			<div align="right">
				<p><b>Developers :- Shalin Shah, Nikit Saraf and Shivang Bhatt. &nbsp; &copy; 2014 IRLab, DA-IICT.</b></p>
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
