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



	function update_score($user_id,$amount) {
		global $connection;
		$query = "UPDATE players ";
		$query .= "SET score={$amount} ";
		$query .= "WHERE id={$user_id}";
		$result = mysqli_query($connection,$query) or die("Cannot update capital<br />" . mysqli_error($connection));
	}


?>
