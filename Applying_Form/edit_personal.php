
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Personal Details</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
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
            // getting the data so that we can restore 
            $fname = $lname = $contact = $gender = $dob = $course = $religion = $email = $selected_id = " ";
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $fname = $_POST['name'];
                $lname = $_POST['lname'];
                $contact = $_POST['contact'];
                $gender = $_POST['gen'];
                $dob = $_POST['dateofb'];
                $course = $_POST['course'];
                $religion = $_POST['religion'];
                $email = $_POST['email'];
                $selected_id = $_POST['sel_id'];
            }
            // get the data from table
        

    ?>
    <body>
    <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" role="form">
                <legend>
                    <h3 align="center">
                        <span class="label label-info">Admission Form</span>
                    </h3>
                </legend>
                <h4 align="center">
                    <span class="label label-primary">Your Personal Details</span>
                </h4>
                <!-- choosing an id to update data -->
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

                <div class="form-group col-lg-6">
                    <label for="name">Enter Your Firstname</label>
                    <input type="text" class="form-control has-success has-feedback" id="name" name="name" required
                        aria-current="date"/>
                </div>
                <div class="form-group col-lg-6">
                    <label for="lname">Enter Your Lastname</label>
                    <input type="text" class="form-control" id="lname" name="lname" required />
                </div>
                <!-- entering phone number -->
                <div class="form-group col-lg-6">
                    <label for="contact">Enter Your Contact No: </label>
                    <input type="tel" class="form-control" id="contact" name="contact" pattern="[0-9]{10}" required />
                </div>
                <div class="form-group col-lg-6">
                    <label for="email">Enter Your Email Here</label>
                    <input type="email" class="form-control" id="email" name="email" aria-required="false"
                        placeholder="Email is not Mandetory" />
                </div>
                <div class="form-group col-lg-6">
                    <label for="dateofb">Enter Your Date Of Birth</label>
                    <input type="date" class="form-control" id="dateofb" name="dateofb" required />
                </div>
                <!-- selecting the course -->
                <div class="form-group">
                    <label for="course" class="col-sm-2"> Select Course </label>
                    <div class="col-lg-6">
                        <select name="course" id="course" class="form-control">
                            <option value="IMCA">IMCA</option>
                            <option value="BCA" selected>BCA</option>
                            <option value="B>SC">B.SC</option>
                            <option value="B.tech">B.Tect</option>
                            <option value="M.tech">M.Tect</option>
                            <option value="M.sc">M.sc</option>
                        </select>
                    </div>
                </div>

                <div class="radio col-lg-12">
                    <h5><strong>Choose Gender : </strong></h5>
                    <h4>
                        <label>
                            <input type="radio" checked name="gen" id="gen1" value="Male" />
                            Male
                        </label>
                        <label>
                            <input type="radio" name="gen" id="gen2"
                            value="Female"  />
                            Female
                        </label>

                        <label>
                            <input type="radio" name="gen" id="gen3" value="Other" />
                            Other
                        </label>
                    </h4>
                </div>

                <!-- radio buttons -->
                <div class="radio col-lg-12">
                    <h5><strong>Choose Religion : </strong></h5>
                    <h4>
                        <label>
                            <input type="radio" checked name="religion" id="rel1" value="Muslim" />
                            Muslim
                        </label>
                        <label>
                            <input type="radio" name="religion" id="rel2" value="Hindu" />
                            Hindu
                        </label>

                        <label>
                            <input type="radio" name="religion" id="rel3"
                            value="Sikh" />
                            Sikh
                        </label>
                        <label>
                            <input type="radio" name="religion" id="rel3"
                            value="Other" />
                            Other
                        </label>
                    </h4>
                </div>
                <div class="form-group col-lg-6">
            <button type="submit" class="btn btn-primary btn-block ">
                Update
            </button>
        </div>
        </form>
        </div>
<?php
$sql = "UPDATE `student_data` SET `first_name` = '$fname', `last_name` = '$lname', `email` = '$email', `contact` = '$contact', `date_of_birth` = '$dob', `religion` = '$religion', `gender` = '$gender' WHERE `student_data`.`id` = $selected_id";
$result = $conn->query($sql);
if($result == "TRUE"){
    echo "success";
}
else{
    echo "something went wrong Try After some time";
}

$conn->close();
?>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
