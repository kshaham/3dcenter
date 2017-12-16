<?php
require('config.php');
include("auth.php");
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $trn_date = date("Y-m-d H:i:s");
    $name =$_REQUEST['name'];
    $quantity = $_REQUEST['quantity'];
	$price = $_REQUEST['price'];
	$notes = $_REQUEST['notes'];
    $username = $_SESSION["username"];
    $ins_query="insert into materials
    (`trn_date`,`name`,`quantity`,`price`,`notes`,`username`)values
    ('$trn_date','$name','$quantity','$price','$notes','$username')";
    mysqli_query($con,$ins_query)
    or die(mysql_error());
    $status = "<center><h2>New Material Added Successfully.</h2>
    </br></br><h3><a href='materials.php'>View Materials</a></h3></center>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Insert New Material</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>
<div class="form">
<center>
<p><a href="index.html">Home</a> 
| <a href="materials.php">View Materials</a> 
| <a href="logout.php">Logout</a></p></center>
 <div class="container">

      <form class="form-signin" action="" method="post" name="form">
	  <input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
        <center><h2 class="form-signin-heading">Insert New Material</h2></center>
        <label for="inputName" class="sr-only">Name</label>
        <input type="name" name="name" class="form-control" placeholder="Name" required autofocus>
        <label for="inputQuantity" class="sr-only">Quantity</label>
        <input type="quantity" name="quantity" class="form-control" placeholder="Quantity">
		 <label for="inputPrice" class="sr-only">Price</label>
        <input type="price" name="price" class="form-control" placeholder="Price" required autofocus>
        <label for="inputNotes" class="sr-only">Notes</label>
        <input type="notes" name="notes" class="form-control" placeholder="Notes" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
    </div> <!-- /container -->
<p style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</div>
</body>
</html>