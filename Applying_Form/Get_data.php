<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <title>Getting_Data</title>
</head>
<body>
  <?php
  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbt = "college_students";
    // error_reporting(E_ERROR | E_PARSE); // else you'll get warnings
    $conn = new mysqli($servername, $username, $password, $dbt);
    // checking the connection
    // if($conn->connect_error){
    //     die("connection failed "  . $conn->connect_error);
    // }
    // echo "connected Successfully";
  $IDE = $_POST['giver'];
  $sql = "select * from student_data where id = $IDE";
  $result = $conn->query($sql) or die("Error Occured" .$conn->error);
  echo "<br>";
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      echo "<h3> Personal Details</h3>";
      echo "<hr>";
      echo "<h4>";
        echo "ID : ".$row['id']. " NAME : ". $row['first_name'] . " ". $row['last_name'].", GENDER : ".$row['gender'].", RELIGION : ".$row['religion']. ", COURSE :" . $row['course']."<br>"." EMAIL : ".$row['email'].", DATE OF BIRTH : ".$row['date_of_birth'].", CONTACT : ".$row['contact'];
        echo "</h4>";
?>
<div align="center">

  <a href="edit_personal.php"  type="button" class="btn btn-primary btn-lg">Edit Data</a>
  <a href="delete_personal.php"  type="submit" class="btn btn-warning btn-lg">Delete Data</a>

</div>
<?php
        echo '<hr>';
        echo "<h3>Parentage Details</h3>";
        echo '<hr>';

        echo "<h4>";
        echo "FATHERS NAME : ".$row['fathers_name'].", MOTHERS NAME : " .$row['mothers_name'].", OCCUPATION : ". $row['fathers_occupation'].", FATHERS CONTACT :".$row['contact2'];
        
       
?>

<div align="center">
  
  <a href="edit_fathers.php" name="edit_fathers"  type="button" class="btn btn-primary btn-lg">Edit Data</a>
  <a href="delete_fathers.php" name="del_fathers" type="submit" class="btn btn-warning btn-lg">Delete Data</a>

</div>
<?php
   echo "</h4>";

   echo '<hr>';
   echo "<br>";
 
}
}else{
echo "0 Results Found";
}
// this is about getting the data of student next we will creat a button to edit and update data

$conn->close();
?>
</body>
</html>