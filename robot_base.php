<?php

$servername="localhost";
$username="root";
$password="";
$database_name="test";


$conn= mysqli_connect($servername, $username, $password, $database_name);

//connection checker

if(!$conn) {
	
	die("Connection failed: " . mysqli_connect_error());
	
}

if (isset($_POST['save'])) {
	
	$movement= $_POST['movement'];
	$front = 0;
	$left = 0;
	$back = 0;
	$right = 0;
	$stop = 0;
	
	if($movement == "F") {
		
		$front++;
	}
	
	elseif($movement == "L") {
		
		$left++;
	}
	
	elseif($movement == "B") {
		
		$back++;
	}
	
	elseif($movement == "R") {
		
		$right++;
	}
	
	elseif($movement == "S") {
		
		$stop++;
	}
	
	else {
		
		$stop++;
		
	}

	
	$sql_query = "INSERT INTO robotbase(To_Front,To_Left,To_Back,To_Right,To_Stop,Movement_symbol)
	VALUES ('$front','$left','$back','$right','$stop','$movement')";
	
	
	if (mysqli_query($conn, $sql_query)){
		
		echo "New Entery Has inserted successfully !";
		echo "<br>";
		echo "The Movement is : " . $movement;
		echo "<br>";
		echo "<br>";
		echo "The movement List in Database.";
		echo "<br>";
		echo "<br>";
		
		$sql = "SELECT Movement_symbol FROM robotbase";
		$res_from_db = $conn->query($sql);
		
		if ($res_from_db->num_rows > 0) {
			
			while($rows = $res_from_db->fetch_assoc()) {
				
				echo "Movement symbol: " .$rows["Movement_symbol"]. "<br>";
				
			}
			
		}
		else {
			
			echo "The list is empty !!";
			
		}
		
	}
	else {
		
		echo "Error insertion: " . $sql . "" . mysqli_error($conn);
		
	}
	
	mysqli_close($conn);
	
}

?>
