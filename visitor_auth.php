<?php
include('config.php');
    $response=array();
	$response["id"]="404";
	$response["Full_name"] = "404";
    $response["email"] = "404";
	$response["password"] = "404";
	//Creating a connection
	$con = mysqli_connect($servername, $musername, $mpassword, $dbname);

    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	/*Get the id of the last visible item in the RecyclerView from the request and store it in a variable. For            the first request id will be zero.*/

	$sql= "select * from visitor where email='".$_GET["email"]."' and password='".$_GET["password"]."';";

	$result = mysqli_query($con ,$sql);

	while ($row = mysqli_fetch_assoc($result)) {

		$response["id"] = $row["id"];
		$response["Full_name"] = $row["Full_name"];
		$response["email"] = $row["email"];
	    $response["password"] = $row["password"];

	}
	header('Content-Type: application/json');

	echo "[".json_encode($response)."]";

    mysqli_free_result($result);

    mysqli_close($con);

 ?>
