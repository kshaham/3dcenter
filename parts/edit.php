<?php
require('../config.php');
include("../auth.php");
$id=$_REQUEST['id'];
$query = "SELECT * from parts where id='".$id."'"; 
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

    <title>Update Parts</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>
<div class="form">
<center><p><a href="../index.html">Home</a> 
| <a href="insert.php">Insert New Part</a>
| <a href="./">View Parts</a>  
| <a href="../logout.php">Logout</a></p></center>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$name =$_REQUEST['name'];
$printtime =$_REQUEST['printtime'];
$printcost =$_REQUEST['printcost'];
$retailcost =$_REQUEST['retailcost'];
$notes =$_REQUEST['notes'];
$username = $_SESSION["username"];
$update="update parts set trn_date='".$trn_date."',
name='".$name."', printtime='".$printtime."', printcost='".$printcost."', retailcost='".$retailcost."', notes='".$notes."',
username='".$username."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<center><h2>Parts Updated Successfully. </br></br>
<a href='./'>View Updated Parts</a></h2>";
echo '<p style="color:#FF0000;">'.$status.'</p></center>';
}else {
?>
 <div class="container">

      <form class="form-signin" action="" method="post" name="form">
	  <input type="hidden" name="new" value="1" />
		<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
        <center><h2 class="form-signin-heading">Update Part</h2></center>
        <label for="inputName" class="sr-only">Name</label>
        <input type="name" name="name" class="form-control" placeholder="Name" required autofocus>
        <label for="inputprinttime" class="sr-only">Print Time</label>
        <input type="printtime" name="printtime" class="form-control" placeholder="Print Time">
		 <label for="inputprintcost" class="sr-only">Print Cost</label>
        <input type="printcost" name="printcost" class="form-control" placeholder="Print Cost (USD)">
        <label for="inputretailcost" class="sr-only">Retail Cost</label>
        <input type="retailcost" name="retailcost" class="form-control" placeholder="Retail Cost (USD)">
		 <label for="inputNotes" class="sr-only">Notes</label>
        <input type="notes" name="notes" class="form-control" placeholder="Notes">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
    </div> <!-- /container -->
<?php } ?>
</div>
</body>
</html>