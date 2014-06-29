<?php


	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}

	function get_score($user_id) {
		global $connection;
		$query = "SELECT score ";
		$query .= "FROM players WHERE id={$user_id}";
		$result = mysqli_query($connection,$query) or die("Cannot get capital from the database<br />" . mysqli_error($connection));
		$row = mysqli_fetch_array($result);
		return $row['score'];
	}
	
	function update_capital($user_id,$capital) {
		global $connection;
		$query = "UPDATE users ";
		$query .= "SET capital={$capital} ";
		$query .= "WHERE id={$user_id}";
		$result = mysqli_query($connection,$query) or die("Cannot update capital<br />" . mysqli_error($connection));
	}
	
	function get_stock_capital($user_id) {
		global $connection;
		$capital = 0;
		$query = "SELECT stock_price ";
		$query .= "FROM stocks_bought WHERE user_id={$_SESSION['user_id']}";
		$result = mysqli_query($connection,$query) or die("Cannot get capital from the database<br />" . mysqli_error($connection));
		while($row = mysqli_fetch_array($result)){
			$capital += $row['stock_price'];
		}
		return $capital;
	}
	
	function update_score($user_id,$amount) {
		global $connection;
		$query = "UPDATE players ";
		$query .= "SET score={$amount} ";
		$query .= "WHERE id={$user_id}";
		$result = mysqli_query($connection,$query) or die("Cannot update capital<br />" . mysqli_error($connection));
	}
	
	
?>
