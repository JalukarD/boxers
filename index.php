<?php
require_once 'dbconfig.php';
// Get boxers form the database
$queryBoxers = "SELECT boxerID, boxerName, weight, boxerPic FROM boxers ORDER BY boxerID DESC";
$statement1 = $db->prepare($queryBoxers);
$statement1->execute();
$boxers = $statement1->fetchAll(PDO::FETCH_ASSOC);
$statement1->closeCursor();
?>
<!DOCTYPE html>
<html>
<head>
<title>Upload, Insert, Update, Delete an Image using PHP MySQL</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link href="styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">
<div class="page-header">
<h1>Famous Boxers</h1>
<a class="btn btn-primary" href="addnew.php"> Add new </a>
</div>
<br/>
<div class="row">  
<table class="table table-bordered table-responsive">
<tr>
<th>Image</th>
<th>Name</th>
<th>Weight</th>
<th>Delete</th>
</tr>               
<?php foreach ($boxers as $boxer) : ?> 
<tr>
<td><img src="https://storage.googleapis.com/imagesj/images/<?php echo $boxer['boxerPic']; ?>" class="img-rounded" width="150px" height="150px" /></td>
<td><p><?php echo $boxer['boxerName']; ?></p></td>
<td><p><?php echo $boxer['weight']; ?></p></td>
<td><form action="delete_boxer.php" method="post"
      id="delete_boxer_form">
<input type="hidden" name="boxer_id"
       value="<?php echo $boxer['boxerID']; ?>">
<input type="submit" class="btn btn-danger" value="Delete">
</form></td>
</tr>
<?php endforeach; ?>               
</table> 
</div>

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>