<?php
error_reporting( ~E_NOTICE ); // avoid notice
require_once 'dbconfig.php';
if(isset($_POST['btnsave']))
{
$boxerName = $_POST['boxer_name'];// boxer name
$boxer_weight = $_POST['bweight'];// boxer weight

$imgFile = $_FILES['bimage']['name'];
$tmp_dir = $_FILES['bimage']['tmp_name'];
$imgSize = $_FILES['bimage']['size'];


if(empty($boxerName)){
$error_message = "Please enter boxer name.";
}
else if(empty($boxer_weight)){
$error_message = "Please enter boxer weight.";
}
else if(empty($imgFile)){
$error_message = "Please select image file.";
}
else
{
$upload_dir = 'images/'; // upload directory

$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

// valid image extensions
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

// rename uploading image
$boxerPic = rand(1000,1000000).".".$imgExt;

// allow valid image file formats
if(in_array($imgExt, $valid_extensions)){			
// Check file size '5MB'
if($imgSize < 5000000)				{
move_uploaded_file($tmp_dir,$upload_dir.$boxerPic);
}
else{
$error_message = "Sorry, your file is too large.";
}
}
else{
$error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
}
}
// if no error occured, continue ....
if(!isset($error_message))
{
$statement = $db->prepare('INSERT INTO boxers(boxerName,weight,boxerPic) VALUES(:bname, :bweight, :bimg)');
$statement->bindParam(':bname',$boxerName);
$statement->bindParam(':bweight',$boxer_weight);
$statement->bindParam(':bimg',$boxerPic);

if($statement->execute())
{
$successMSG = "new record succesfully inserted ...";
header("refresh:2;index.php"); // redirects image view page after 2 seconds.
}
else
{
$error_message = "error while inserting....";
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload, Insert, Update, Delete an Image using PHP MySQL</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link href="styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">
<div class="page-header">
<h1>Add new Boxer</h1>
<a class="btn btn-primary" href="index.php">View all </a>
</div>
<?php
if(isset($error_message)){
?>
<div class="alert alert-danger">
<strong><?php echo $error_message; ?></strong>
</div>
<?php
}
else if(isset($successMSG)){
?>
<div class="alert alert-success">
<strong><?php echo $successMSG; ?></strong>
</div>
<?php
}
?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
<table class="table table-bordered table-responsive micro">
<tr>
<td><label class="control-label">Boxer Name</label></td>
<td><input class="form-control" type="text" name="boxer_name" placeholder="Enter Name" value="<?php echo $boxerName; ?>" /></td>
</tr>
<tr>
<td><label class="control-label">Weight</label></td>
<td><input class="form-control" type="text" name="bweight" placeholder="Weight Category" value="<?php echo $boxer_weight; ?>" /></td>
</tr>
<tr>
<td><label class="control-label">Boxer Img.</label></td>
<td><input class="input-group" type="file" name="bimage" accept="image/*" /></td>
</tr>
<tr>
<td colspan="2"><button type="submit" name="btnsave" class="btn btn-success">Save</button>
</td>
</tr>
</table>
</form>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>