<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href="styles/headerAndFooter.css">
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/sidebar.css">
	<link rel="stylesheet" href="styles/main.css">
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
</head>
<body>

<?php
    include_once('header.php');

    if (isset($_GET['user'])) {
        $current_username = mysqli_real_escape_string($connect, $_GET['user']);
        $sql = "SELECT * FROM users WHERE nickname='$current_username' LIMIT 1";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_fetch_row($query);
		$current_id = $row[0];
		$current_xp = $row[4];
    } else {
        header("location: ranking.php");
    }
?>


<div class="wrapper">
	<div class="username">
	    <h2 align="center"><?=$_SESSION['username']?></h2>
	</div>

	<div class="profile-pic" align="center">
	    <img src="images/footer_github.png" alt="Profile picture" class="profile">
	</div>

	<table class="profileinfo" cellpadding="40" cellspacing="20" style="margin: 40px auto;">
	    <tr>
	        <th>First Name</th>
	        <th>Last Name</th>
	        <th>Score</th>
	        <th>Ranking</th>

	    </tr>
		<?php
		$user = $_SESSION ['username'];
		$sql = "SELECT * FROM users WHERE nickname = '$user'";
		$query = mysqli_query($connect, $sql);
		$row = $query->fetch_assoc();
		echo '<tr>
            <td>
                <h4>' . $row['first_name'] . '</h4>
            </td>
                <td>
                <h4>' . $row['last_name'] . '</h4>
                </td>
            <td>
               <h4>' . $row['xp'] . '</h4>
            </td>
                        <td>
               <h4>' . '#' . $row['rank'] . '</h4>
            </td>
               </tr>';
		?>

	<div class="text" style="font-family: MainText">
	   <p>This is information about me</p>
	</div>

    <div class="match-history">
        <h2 class="desc">Match History</h2>
    </div>

    <div class="table-history">
        <table class="match-history-table">
        <tr>
            <th>Username</th>
            <th>Result</th>
            <th>Against</th>
            <th>Gained XP</th>
            <th>Date</th>
        </tr>
        <tr>
            <?php
                $userid = $_SESSION['userid'];
                $sql = "SELECT * FROM battle_log WHERE user1_id = '$userid' || user2_id = '$userid' ORDER BY wonned_xp DESC";
                $query = mysqli_query($connect, $sql);

                while($row = $query->fetch_assoc()) {
                    if ($row['user1_id'] == $userid) {
                        $opponentid = $row['user2_id'];
                    } else {
                        $opponentid = $row['user1_id'];
                    }

					echo '<tr  class="match">
		        <td><img src="images/footer_github.png" height="20"></td>
           		 <td>' . $user . '</td>
                <td>' . $result . '</td>
                <td><img src="images/footer_github.png" height="20" </td>
                <td>' . $opponent . '</td>
                <td>' . $row['won_xp'] . '</td>
                <td>' . $row['date'] . '</td>
               </tr>
               ';
				}

				?>
			</tr>
			<script>
				var matches = document.getElementsByClassName("match");
				for	(row of matches) {
					document.getElementsByClassName("match").style.backgroundColor = "blue";
				}
			</script>
		</table>
	</div>
</div>

<?php include_once('footer.html'); ?>
</body>
</html>
