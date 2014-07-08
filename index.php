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
    <h3>PHP CRUD Grid</h3>
    </div>
    <div class="row">
    <p><a class="btn btn-xs btn-success" href="create.php">Create</a></p>
    <table class="table table-striped table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Action</th>
    </tr>
    <tbody>
    <?php
    include 'db.php';
    $sql = 'SELECT * FROM users ORDER BY ID DESC';
    foreach ($PDO->query($sql) as $row) {
        echo '<tr>';
        echo '<td>'. $row['ID'] . '</td>';
        echo '<td>'. $row['FName'] . ' '. $row['LName'] . '</td>';
        echo '<td>'. $row['Age'] . '</td>';
        echo '<td>'. $row['Gender'] . '</td>';
        echo '<td><a class="btn btn-xs btn-info" href="read.php?id='. $row['ID'] . '">Read</a>&nbsp;
                  <a class="btn btn-xs btn-primary" href="update.php?id='. $row['ID'] . '">Update</a>
                  <a class="btn btn-xs btn-danger" href="delete.php?id='. $row['ID'] . '">Delete</a>
              </td>';
        echo '</tr>';
    }
$PDO = null;
    ?>
    </tbody>
    </table>
    </div><!-- /row -->
</div><!-- /container -->
</body>
</html>