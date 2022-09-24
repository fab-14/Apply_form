
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <?php
            // creating the connection to mysql
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
            // this is for the error else our program will show us warnings
            $fathers_name = $mothers_name = $contact2 = $occupation = $selected_id = " "; 

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $selected_id = $_POST['sel_id'];
                $sql = "SELECT * FROM `student_data` WHERE id = $selected_id";
                $result = $conn->query($sql) or die("Error Occured" .$conn->error);

            }
        ?>
    </head>
    <body>
        
    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" role="form">
        <div class="container">
            <div class="form-group col-lg-6">
                <label for=sel_id">Select An id to Delete Parentage Data
                    </label>
                <select name="sel_id" id="sel_id">
                <?php
                
                    $sql = "select id from student_data";
                    $result = $conn->query($sql);  
                    // creating options -- how many ids there are we will create a select menu 
                    // user will select id from them and will change the data
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            echo "<option ". $row. "value=" .$row['id'].">". $row['id']. "</option>";
                        }
                    }
                ?>
            </select>
                
            </div>
            
            <button type="submit" class="btn btn-danger">Delete</button>
            
            </form>
         </div>   
        
    <?php
    // sql update statement
        $sql = "DELETE FROM `student_data` WHERE `student_data`.`id` = $selected_id";
        $result = $conn->query($sql);
        if($result === "TRUE"){
            echo "success";
        }
        else{
            "We are having some problem in deleting data";
        }
        
   ?>
    </body>
</html>
