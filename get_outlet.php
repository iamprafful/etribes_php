<?php 
include('config.php');
	//Creating a connection
	$con = mysqli_connect($servername, $musername, $mpassword, $dbname);
	 
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	
	$sql= "select * from food_outlet";
	
	$result = mysqli_query($con ,$sql);
	
	while ($row = mysqli_fetch_assoc($result)) {
		
  
        $array[]=$row;

		
	}
	header('Content-Type:Application/json; charset=utf-8');
	
	echo json_encode($array, JSON_UNESCAPED_UNICODE);
 
    mysqli_free_result($result);
 
    mysqli_close($con);
  
 ?>