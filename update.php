<?php
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }
    if($id == null)
    {
        header("Location: index.php");
    } 
    if ( !empty($_POST))
    {
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
        
        // update data
        if ($valid) {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "Update users set fname=?,lname=?,age=?,gender=? where id=?";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($fname,$lname,$age,$gender,$id));
            $PDO = null;
            header("Location: index.php");
        }
    }
    else{
        require 'db.php';
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users where id = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($id));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $PDO = null;
        if (empty($data)){
            header("Location: index.php");
        }
        $fname  = $data['FName'];
        $lname  = $data['LName'];
        $age    = $data['Age'];
        $gender = $data['Gender'];
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
                        <h3>Update a User</h3>
                    </div>
            
                    <form method="POST" action="update.php?id=<?php echo $id?>">
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
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn btn-default" href="index.php">Back</a>
    </div>
</form>
                
    </div> <!-- /row -->
    </div> <!-- /container -->
</body>
</html>