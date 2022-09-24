
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
                $fathers_name = $_POST['faname'];
                $mothers_name = $_POST['moname'];
                $contact2 = $_POST['contact2'];
                $occupation = $_POST['occupation'];
                $selected_id = $_POST['sel_id'];
            }
        ?>
    </head>
    <body>
        
    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" role="form">
        <div class="container">
            <h4 align="center">
                <span class="label label-primary">Parentage Details</span>
            </h4>
            <div class="form-group col-lg-6">
                <label for=sel_id">Select an id to change Data
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
            <!-- <div class="form-group">
                
                <input type="hidden" name="" id="input" class="form-control" value="">
                
            </div> -->
            <div class="form-group col-lg-6">
                <label for="faname">Enter Your Fathers Name</label>
                <input type="text" class="form-control has-success has-feedback" id="faname" name="faname" value="<?php ?>" required />
            </div>
            <div class="form-group col-lg-6">
                <label for="moname">Enter Your Mothers Name</label>
                <input type="text" class="form-control has-success has-feedback" id="moname" name="moname" required />
            </div>
            <!-- getting fathers contact no -->
            <div class="form-group col-lg-6">
                <label for="contact2">Enter Fathers Contact No: </label>
                <input type="tel" class="form-control" id="contact2" name="contact2" pattern="[0-9]{10}" required />
            </div>
            <!-- selecting the fathers occupation -->
            <div class="form-group col-lg-6">
                <label for="occupation" class="col-sm-2"> Fathers Occupation
                </label>
                <div class="col-lg-6">
                    <select name="occupation" id="occupation" class="form-control">
                        <option value="Farmer">Farmer</option>
                        <option value="Government Employee" selected>Govt. Employee</option>
                        <option value="Labour">Labour</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-lg-6">
            <button type="submit" class="btn btn-primary btn-block ">
                Update
            </button>
        </div>
        </div> 
       
        </form>

    </div>
        
    <?php
    // sql update statement
        $sql = "UPDATE `student_data` SET `fathers_name` = '$fathers_name', `mothers_name` = '$mothers_name', `contact2` = '$contact2', `fathers_occupation` = '$occupation' WHERE `student_data`.`id` = $selected_id";
        $result = $conn->query($sql);
        //  if the query got successfull then we will print something
        if($result=="TRUE"){
            echo 'Success';
        }
        else{ // else will print this 
            "There is some issue";
        }
   ?>
    </body>
</html>
