<?php
require('../config.php');
include("../auth.php");
$id=$_REQUEST['id'];
$query = "SELECT * from printers where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Update Printers</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>
<div class="form">
<center><p><a href="../index.html">Home</a> 
| <a href="insert.php">Insert New Printer</a>
| <a href="./">View Printers</a>  
| <a href="../logout.php">Logout</a></p></center>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$name =$_REQUEST['name'];
$xlength =$_REQUEST['xlength'];
$ylength =$_REQUEST['ylength'];
$zheight =$_REQUEST['zheight'];
$cost =$_REQUEST['cost'];
$notes =$_REQUEST['notes'];
$username = $_SESSION["username"];
$update="update printers set trn_date='".$trn_date."',
name='".$name."', xlength='".$xlength."', ylength='".$ylength."', zheight='".$zheight."', cost='".$cost."', notes='".$notes."',
username='".$username."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<center><h2>Printer Updated Successfully. </br></br>
<a href='./'>View Updated Printer</a></h2>";
echo '<p style="color:#FF0000;">'.$status.'</p></center>';
}else {
?>
 <div class="container">

      <form class="form-signin" action="" method="post" name="form">
	  <input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
        <center><h2 class="form-signin-heading">Update Printer</h2></center>
        <label for="inputName" class="sr-only">Name</label>
        <input type="name" name="name" class="form-control" placeholder="Name" required autofocus>
        <label for="inputXlength" class="sr-only">X-length</label>
        <input type="xlength" name="xlength" class="form-control" placeholder="X-length (inches)">
		 <label for="inputYlength" class="sr-only">Y-length</label>
        <input type="ylength" name="ylength" class="form-control" placeholder="Y-length (inches)">
        <label for="inputZheight" class="sr-only">Z-height</label>
        <input type="zheight" name="zheight" class="form-control" placeholder="Z-height (inches)">
		<label for="inputCost" class="sr-only">Cost (USD)</label>
        <input type="cost" name="cost" class="form-control" placeholder="Cost (USD)">
		 <label for="inputNotes" class="sr-only">Notes</label>
        <input type="notes" name="notes" class="form-control" placeholder="Notes">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
    </div> <!-- /container -->
<?php } ?>
</div>
</body>
</html>