<?php 
include('config.php');
    header('Content-Type: application/json');
	$id=0;
	$name=$_GET["name"];
	$IMEI=$_GET["IMEI"];
	$phone=$_GET["phone"];
	$pwd=$_GET["pwd"];
	$response=array();
	

                    // Create connection
                    $conn1 = new mysqli($servername, $musername, $mpassword, $dbname);
                    // Check connection
                    if ($conn1->connect_error) {
                        die("Connection failed: " . $conn1->connect_error);
                    } 

                    $get_id="select id+1 from tribal_user order by id desc limit 1";
                    $result = $conn1->query($get_id);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $id =$row["id+1"];
                        }
                    } else {
                        $id="18001";
                    }
                    $conn1->close();
        


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $musername, $mpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
	$sql="Insert into tribal_user (id,Full_name,IMEI,phone,password)
	       values ('".$id."','".$name."','".$IMEI."','".$phone."','".$pwd."')";
    $conn->exec($sql);
	$response["id"]=$id;
	$response["Success"]="1";
	$response["Comment"]="Account Created Successfully";
    }
catch(PDOException $e)
    {
		$response["id"]=0;
		$response["Success"]="0";
		$response["Comment"]=$e->getMessage()."\n".$sql;
		//echo $sql;
    }

$conn = null;
	
echo "[".json_encode($response)."]";
 

  
 ?>