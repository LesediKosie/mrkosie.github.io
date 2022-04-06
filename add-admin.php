<?php include('useable/menu.php'); ?>

<div class="menu-content">
	<div class="wrapper">
		<h1>Add Admin</h1>
		<br>
		<br>

		<?php
		if (isset($_SESSION['add'])) //checking if its set or not
		{
			echo $_SESSION['add']; //displaying session
			unset($_SESSION['add']); //removing Session message
		}
		?>


		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>Full Name:</td>
					<td><input type="text" name="full_name" placeholder="Enter your full name" required /></td>



				</tr>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" placeholder="Enter your username" required /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" placeholder="Enter your password" required /></td>
				</tr>




				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>

				</tr>
			</table>
		</form>
	</div>
</div>



<?php include('useable/footer.php'); ?>

<?php
//Process the value from form and save it in Database
//Check whether the submit button is clicked

if (isset($_POST['submit'])) {
	//Button clicked
	//echo "Button Clicked";

	//Create data from form


	//1. Get data from form
	$full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, md5($_POST["password"])); //password encrypt

	//2. SQL Query to save the data into database

	$sql = "INSERT INTO tbl_admin SET

		full_name ='$full_name',
		username='$username',
		password='$password'
        ";

	//3.Executing Query and Saving data into database
	$res = mysqli_query($conn, $sql) or die(mysqli_error());

	//.4 check whether the (Query is executed) data is inserted or not and display appropriate message



	if ($res == TRUE) {
		//Data Inserted
		//echo "Data Inserted";

		//create a session variable to display Message For matter
		$_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
		//redirect page to Manage Admin
		header("location:" . SITEURL . 'manage.php');
	} else {
		// Failed insert Data...
		//echo "Failed to Insert Data";

		//create a session variable to display Message For matter
		$_SESSION['add'] = "<div class='error'>Admin Added Successfully</div>";
		//redirect page to Manage Admin
		header('location:' . SITEURL . 'add-admin.php');
	}
}

?>