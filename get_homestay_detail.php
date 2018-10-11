<?php 
include('config.php');
    header('Content-Type: application/json');
	//Creating a connection
	$con = mysqli_connect($servername, $musername, $mpassword, $dbname);
	 
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	/*Get the id of the last visible item in the RecyclerView from the request and store it in a variable. For            the first request id will be zero.*/
	
	$sql= "select * from tribal_homestay where id=".$_GET["id"].";";
	
	$result = mysqli_query($con ,$sql);
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		$array[] = $row;
		
	}
	header('Content-Type:Application/json; charset=utf-8');
	
	echo json_encode($array, JSON_UNESCAPED_UNICODE);
 
    mysqli_free_result($result);
 
    mysqli_close($con);
  
 ?>