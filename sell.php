<?php 
 
 //importing dbDetails file 
include('config.php');
// Create connection
                    $conn1 = new mysqli($servername, $musername, $mpassword, $dbname);
                    // Check connection
                    if ($conn1->connect_error) {
                        die("Connection failed: " . $conn1->connect_error);
                    } 

                    $get_id="select id+1 from product order by id desc limit 1";
                    $result = $conn1->query($get_id);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $id =$row["id+1"];
                        }
                    } else {
                        $id="48001";
                    }
                    $conn1->close();

 
 //this is our upload folder 
 $upload_path = 'product/';
 
 //Getting the server ip 
 $server_ip = gethostbyname(gethostname());
 
 //creating the upload url 
 $upload_url = $upload_path; 
 
 //response array 
 $response = array(); 
 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 //checking the required parameters from the request 

 //connecting to the database 
 $con = mysqli_connect($servername, $musername, $mpassword, $dbname) or die('Unable to Connect...');
 
 //getting name from the request 
     $name = $_POST['name'];
     $product_name = $_POST['product_name'];
     $description = $_POST['description'];
     $cost=$_POST["cost"];
     $shop_address = $_POST['shop_address'];
     $seller_phone = $_POST['seller_phone'];
     $seller_name = $_POST['seller_name'];
     
 //getting file info from the request 
 $fileinfo = pathinfo($_FILES['image']['name']);
 
 //getting the file extension 
 $extension = $fileinfo['extension'];
 
 //file url to store in the database 
 $file_url = $upload_url . $name . '.' . $extension;
 
 //file path to upload in the server 
 $file_path = $upload_path . $name . '.'. $extension; 
 
 //trying to save the file in the directory 
 try{
 //saving the file 
 move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
 $sql = "INSERT INTO product (id, product_name, description, cost, shop_address, seller_phone, seller_name, image_loc) VALUES ('$id', '$product_name', '$description', '$cost', '$shop_address', '$seller_phone', '$seller_name', '$file_url');";
 
 //adding the path and name to database 
 if(mysqli_query($con,$sql)){
 
 //filling response array with values 
 $response['error'] = false; 
 $response['url'] = $file_url; 
 $response['name'] = $name;
 }
 //if some error occurred 
 }catch(Exception $e){
 $response['error']=true;
 $response['message']=$e->getMessage();
 } 
 //displaying the response 
 echo json_encode($response);
 
 //closing the connection 
 mysqli_close($con);

 }