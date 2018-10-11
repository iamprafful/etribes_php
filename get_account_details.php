<?php 
include('config.php');
    $response=array();
	//Creating a connection
	$con = mysqli_connect($servername, $musername, $mpassword, $dbname);
	 
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	/*Get the id of the last visible item in the RecyclerView from the request and store it in a variable. For            the first request id will be zero.*/
	
	$sql= "select * from tribal_user where id=".$_GET["id"].";";
	
	$result = mysqli_query($con ,$sql);
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		$response["id"] = $row["id"];
		$response["name"] = $row["Full_name"];
		$response["phone"] = $row["phone"];
	        $response["password"] = $row["password"];
		
	}
	header('Content-Type: application/json');
	
	echo "[".json_encode($response)."]";
 
    mysqli_free_result($result);
 
    mysqli_close($con);
  
 ?>