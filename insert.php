<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO user (fullname, address, phone_number, email, C_group, profession, image) 
			VALUES (:fullname, :address, :phone_number, :email, :C_group, :profession, :image)
		");
		$result = $statement->execute(
			array(
				':fullname'	=>	$_POST["fullname"],
				':address'	=>	$_POST["address"],
				':phone_number'	=>	$_POST["phone_number"],
				':email'	=>	$_POST["email"],
				':C_group'	=>	$_POST["C_group"],
				':profession'	=>	$_POST["profession"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE user 
			SET fullname = :fullname, address = :address, phone_number = :phone_number, email = :email, C_group = :C_group, profession = :profession, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':fullname'	=>	$_POST["fullname"],
				':address'	=>	$_POST["address"],
				':phone_number'	=>	$_POST["phone_number"],
				':email'	=>	$_POST["email"],
				':C_group'	=>	$_POST["C_group"],
				':profession'	=>	$_POST["profession"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>