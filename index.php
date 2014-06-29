<?php require_once 'includes/connection.php' ?>
<?php require_once 'includes/functions.php' ?>
<?php
	if(!(isset($_POST['correct']) || isset($_POST['pass']) || isset($_POST['wrong']))) {
		$ques_no = 0;
		$selected_player = 0;
		$question = 0;
		$pass_player = -1;
		if(isset($_COOKIE['ques_no']) && isset($_COOKIE['ques_org'])) {
			setcookie('ques_org',$ques_no,time() - (86400 * 7));
			setcookie('ques_no',$ques_no,time() - (86400 * 7));	
		}
		setcookie('ques_no',$question,time() + (86400 * 7)); // 86400 = 1 day
		setcookie('ques_org',$ques_no,time() + (86400 * 7));
	}
?>
<?php
	$query = "SELECT * FROM questions";
	$result = mysqli_query($connection, $query);
	if ((isset($_POST['correct']) || isset($_POST['wrong']) || isset($_POST['pass_correct'])) && isset($_POST['ques_no'])) {
		$ques_no = $_POST['ques_no'];
		$selected_player = $ques_no%5;
		$amount = get_score($_POST['sel_player']+1);
		$add = 0;
		$sub = 0;
		$padd = 0;
		if(isset($_POST['correct'])) {
			if($_POST['ques_no'] < 11) {
				$add = 10;
			} else {
				$add = 15;
			} 
			$pass_player = -1;
			$amount += $add;
			update_score($_POST['sel_player']+1,$amount);
		} elseif(isset($_POST['wrong'])) {
			if($_POST['ques_no'] < 11) {
				$sub = -5;
			} else {
				$sub = -10;
			}
			$pass_player = -1;
			$amount += $sub;
			update_score($_POST['sel_player']+1,$amount);
		} elseif (isset($_POST['pass_correct'])) {
			if($_POST['ques_no'] < 11) {
				$padd = 5;
			} else {
				$padd = 10;
			}
			$pass_player = -1;
			$amount = get_score($_POST['pass_player_no']+1);
			$amount += $padd;
			update_score($_POST['pass_player_no']+1,$amount);
		}
		//$question = $ques_no + 1;
		//setcookie('ques_org',$ques_no,time() - (86400 * 7));
		setcookie('ques_org',$ques_no,time() + (86400 * 7)); // 86400 = 1 day
		setcookie('ques_no',$ques_no,time() + (86400 * 7));
		
	} elseif (isset($_POST['pass'])) {
		$ques_no = $_COOKIE['ques_org'];
		$selected_player = $ques_no%5;
		$question = $_COOKIE['ques_no'] + 1;
		$pass_player = $question%5;
		//setcookie('ques_no',$question,time() - (86400 * 7)); // 86400 = 1 day
		setcookie('ques_no',$question,time() + (86400 * 7));
	}
	$query_players = "SELECT * FROM players";
	$result_players = mysqli_query($connection, $query_players);
?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>Ilm | Finals</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div id="outerDiv">
			<header>
				<h1>Ilm</h1>
				<h3>An Islamic Quiz</h3>
				<hr />
			</header>
			<section id="mainContent">
				<?php 

					for($i=0;$i<5;$i++) {
						$player = mysqli_fetch_array($result_players);
						echo "
							<div id=\"player\"";if ($i == $selected_player) {
								# code...
								echo "class=\"current\"";
							} elseif(($pass_player != -1) && ($i == $pass_player)) {
								echo "class=\"passColor\"";
							} else {
								echo "class=\"defaultColor\"";
							} 
						echo " >
								<h3>{$player['name']}</h3>
								
								<hr />
								<h4>Score: {$player['score']}</h4>
							</div>
						";
					}
				?>
			</section>
			<div  id="questionBody">
				<hr />
				<?php while($ques = mysqli_fetch_array($result)) { if($ques['id'] > $ques_no) break;} ?>
				<h2>Question No <?php echo "{$ques['id']}"; ?></h2>
				<p><?php echo "{$ques['content']}" ?></p>
				<p><?php /*if (isset($_POST['correct'])) {
							# code...
							echo "Its Correct";
						} elseif (isset($_POST['pass'])) {
							# code...
							echo "Its Passed";
						} elseif (isset($_POST['wrong'])) {
							# code...
							echo "Its Wrong";
						}*/
					?>
				</p>
				<form method="post" action="index.php">
					<?php echo "
						<input type=\"text\" name=\"ques_no\" style=\"display:none;\" value=\"{$ques['id']}\" />
						<input type=\"text\" name=\"sel_player\" style=\"display:none;\" value=\"{$selected_player}\" />
						<input type=\"text\" name=\"pass_player_no\" style=\"display:none;\" value=\"{$pass_player}\" />
						";
					?>
					<button type="submit" class="btn btn-success" name="correct">Correct</button>
					<br />
					<button type="submit" class="btn btn-warning" name="pass">Pass</button>
					<br />
					<button type="submit" class="btn btn-warning" name="pass_correct" style="margin-top: -30px;">Pass Correct</button>
					<br />
					<button type="submit" class="btn btn-danger" name="wrong" style="margin-top: -50px; float:right;">Wrong</button>
				</form>
			</div>
		</div>
	</body>
</html>