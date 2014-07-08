<?php 
    if ( !empty($_POST)) {
        require 'db.php';
        // validation errors
        $fnameError     = null;
        $lnameError     = null;
        $ageError       = null;
        $genderError    = null;
        
        // post values
        $fname  = $_POST['fname'];
        $lname  = $_POST['lname'];
        $age    = $_POST['age'];
        $gender = $_POST['gender'];
        
        // validate input
        $valid = true;
        if(empty($fname)) {
            $fnameError = 'Please enter First Name';
            $valid = false;
        }
        
        if(empty($lname)) {
            $lnameError = 'Please enter Last Name';
            $valid = false;
        }
        
        if(empty($age)) {
            $ageError = 'Please enter Age';
            $valid = false;
        }
        
        if(empty($gender)) {
            $genderError = 'Please select Gender';
            $valid = false;
        }
        
        // insert data
        if ($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (fname,lname,age,gender) values(?, ?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($fname,$lname,$age,$gender));
            $PDO = null;
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
<div class="container">
    
                    <div class="row">
                    <div class="row">
                        <h3>Create a User</h3>
                    </div>
            
                    <form method="POST" action="">
    <div class="form-group <?php echo !empty($fnameError)?'has-error':'';?>">
        <label for="inputFName">First Name</label>
        <input type="text" class="form-control" required="required" id="inputFName" value="<?php echo !empty($fname)?$fname:'';?>" name="fname" placeholder="First Name">
        <span class="help-block"><?php echo $fnameError;?></span>
    </div>
    <div class="form-group <?php echo !empty($lnameError)?'has-error':'';?>">
        <label for="inputLName">Last Name</label>
        <input type="text" class="form-control" required="required" id="inputLName" value="<?php echo !empty($lname)?$lname:'';?>" name="lname" placeholder="Last Name">
        <span class="help-block"><?php echo $lnameError;?></span>
    </div>
    <div class="form-group <?php echo !empty($ageError)?'has-error':'';?>">
        <label for="inputAge">Age</label>
        <input type="number" required="required" class="form-control" id="inputAge" value="<?php echo !empty($age)?$age:'';?>" name="age" placeholder="Age">
        <span class="help-block"><?php echo $ageError;?></span>
    </div>
    <div class="form-group <?php echo !empty($genderError)?'has-error':'';?>">
        <label for="inputGender">Gender</label>
        <select class="form-control" required="required" id="inputGender" name="gender" >
        <option></option>
        <option value="male" <?php echo $gender == 'male'?'selected':'';?>>Male</option>
        <option value="female" <?php echo $gender == 'female'?'selected':'';?>>Female</option>
        </select>
    <span class="help-block"><?php echo $genderError;?></span>
        
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-success">Create</button>
        <a class="btn btn btn-default" href="index.php">Back</a>
    </div>
</form>
                
    </div> <!-- /row -->
    </div> <!-- /container -->
</body>
</html>