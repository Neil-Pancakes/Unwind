<?php

     $target_dir = "/public_html/pics/";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES["file"]["name"]);

	$ftp_server = "files.000webhost.com";
	$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

	if (@ftp_login($ftp_conn, "unwindv2", "fluffy1221"))
	  {
	  echo "Connection established.";
	  ftp_put($ftp_conn,$target_file,$_FILES["file"]["tmp_name"],FTP_BINARY);
	  $file_list = ftp_nlist($ftp_conn, "/public_html/pics/");
	  echo "<script>console.log('".$file_list["2"]."')</script>";
	  }
	else
	  {
	  echo "Couldn't establish a connection.";
	  }


//      move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

//      //write code for saving to database 
//      include_once "config.php";

//      // Create connection
//      $conn = new mysqli($servername, $username, $password, $dbname);
//      // Check connection
//      if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//      }

//      $sql = "INSERT INTO MyData (name,filename) VALUES ('".$name."','".basename($_FILES["file"]["name"])."')";

//      if ($conn->query($sql) === TRUE) {
//          echo json_encode($_FILES["file"]); // new file uploaded
//      } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//      }

//      $conn->close();

// $postdata = file_get_contents("php://input");
//   $request = json_decode($postdata, true);

//  $picture=$request['picture'];
// // connect to FTP server
// $ftp_server = "files.000webhost.com";
// $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

// // login
// if (@ftp_login($ftp_conn, "unwindv2", "fluffy1221"))
//   {
//   echo "Connection established.";
//   ftp_put($ftp_conn,"/public_html/pics/bacon1.jpg",$picture,FTP_BINARY);
//   $file_list = ftp_nlist($ftp_conn, "/public_html/pics/");
//   echo "<script>console.log('".$file_list["2"]."')</script>";
//   }
// else
//   {
//   echo "Couldn't establish a connection.";
//   }

// // do something...

// // close connection
// ftp_close($ftp_conn); 
?>