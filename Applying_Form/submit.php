<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Option Choose</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    // creating the connection to mysql
    $servername = "localhost";
    $username = "root";
    $password = ""; // password
    $dbt = "college_students";
    // error_reporting(E_ERROR | E_PARSE); // else you'll get warnings
    $conn = new mysqli($servername, $username, $password, $dbt);
    // checking the connection
    // if($conn->connect_error){
    //     die("connection failed "  . $conn->connect_error);
    // }
    // echo "connected Successfully";
    // getting the data
    $fname = $_POST['name'];
    $lname = $_POST['lname'];
    $fathers_name = $_POST['faname'];
    $mothers_name = $_POST['moname'];
    $contact = $_POST['contact'];
    $contact2 = $_POST['contact2'];
    $gender = $_POST['gen'];
    $occupation = $_POST['occupation'];
    $dob = $_POST['dateofb'];
    $course = $_POST['course'];
    $religion = $_POST['religion'];
    $email = $_POST['email'];

    // and inserting it into database
    $sql = "INSERT INTO `student_data`(`first_name`, `last_name`, `email`, `fathers_name`, `mothers_name`, `gender`, `religion`, `contact`, `date_of_birth`, `course`, `contact2`, `fathers_occupation`)  values('$fname', '$lname', '$email','$fathers_name','$mothers_name','$gender','$religion','$contact','$dob','$course','$contact2','$occupation')";
    $result = $conn->query($sql) or die("Insertion Error" .$conn->error);

    echo "<br>";
    echo "<br>";

    if($result == 1){ // here 1 means true
        echo "successfully inserted the data";
    }
    else {
        echo "Error";
    }
    echo "<br>";

?>
   
    <div class="container">
    <form action="Get_data.php" method="POST" role="form">
        <div class="form-group col-lg-12" align="center">
            <label for="">Type in an rollno to show data</label>
            <input type="text" class="form-control" id="idsearch" name="giver" placeholder="Enter an id to search">
            <br>
            <button type="submit" class="btn btn-primary btn-lg">Get Data</button>
        </div>
    </form>
    </div>
    </body>
</html>

