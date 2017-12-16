<?php
require('../config.php');
include("../auth.php");
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
$trn_date = date("Y-m-d H:i:s");
$name =$_REQUEST['name'];
$quantity =$_REQUEST['quantity'];
$cost =$_REQUEST['cost'];
$notes =$_REQUEST['notes'];
$username = $_SESSION["username"];
    $ins_query="insert into inventory
    (`trn_date`,`name`,`quantity`,`cost`,`notes`,`username`)values
    ('$trn_date','$name','$quantity','$cost','$notes','$username')";
    mysqli_query($con,$ins_query)
    or die(mysql_error());
    $status = "<center>New Item Added Successfully.
    </br></br><a href='./'>View Inventory</a></center>";
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

    <title>Insert New Item</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body>
<div class="form">
<center>
<p><a href="../">Home</a> 
| <a href="./">View Inventory</a> 
| <a href="../logout.php">Logout</a></p></center>
 <div class="container">

      <form class="form-signin" action="" method="post" name="form">
	  <input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
        <center><h2 class="form-signin-heading">Insert New Item</h2></center>
        <label for="inputName" class="sr-only">Name</label>
        <input type="name" name="name" class="form-control" placeholder="Name" required autofocus>
        <label for="inputquantity" class="sr-only">Quantity</label>
        <input type="quantity" name="quantity" class="form-control" placeholder="Quantity">
		<label for="inputCost" class="sr-only">Cost (USD)</label>
        <input type="cost" name="cost" class="form-control" placeholder="Cost (USD)">
		 <label for="inputNotes" class="sr-only">Notes</label>
        <input type="notes" name="notes" class="form-control" placeholder="Notes">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
    </div> <!-- /container -->
<p style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</div>
</body>
</html>