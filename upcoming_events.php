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
	
	$sql= "select title, day(date)'Date',substr(ucase(monthname(date)),1,3)'month', address, image_location, description from upcoming_events where date>=curdate() order by date-curdate() asc;";
	
	$result = mysqli_query($con ,$sql);
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		$array[] = $row;
		
	}
	header('Content-Type:Application/json');
	
	echo json_encode($array);
 
    mysqli_free_result($result);
 
    mysqli_close($con);
  
 ?>