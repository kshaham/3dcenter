<?php
require('../config.php');
include("../auth.php");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	    <style type="text/css">
    
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body  >
    <style type="text/css">
        .block a:hover{
            color: silver;
        }
        .block a{
            color: #fff;
        }
        .block {
            position: fixed;
            background: #2184cd;
            padding: 20px;
            z-index: 1;
            top: 240px;
        }
    </style>

    <title>Part Calendar</title>

    <!-- Bootstrap core CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
<script src="js/moment.min.js"></script>

   
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../calendar">Parts Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../materials.php">Materials List</span></a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="../printers">Printers</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="../parts">Part Database</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link active" href="./">Item Inventory<span class="sr-only">(current)</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
		 <ul class="navbar-nav mr-auto">
		 <li class="nav-item">
 <a class="nav-link" href="../logout.php">Logout</a>
           </ul>
        </form>
      </div>
    </nav>
<main role="main" class="container">
  <center><div class="jumbotron">
       <h1>Inventory</h1>
       <div class="form">
<p><a href="insert.php">Insert New Item</a></p>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><center><strong>Number</strong></th>
<th><center><strong>Item Name</strong></th>
<th><center><strong>Quantity</strong></th>
<th><center><strong>Cost (USD)</strong></th>
<th><center><strong>Notes</strong></th>
<th><center><strong>Edit</strong></th>
<th><center><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$username = $_SESSION['username'];
$count=1;
$sel_query="Select * from `inventory` where username='".$username."'";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["name"]; ?></td>
<td align="center"><?php echo $row["quantity"]; ?></td>
<td align="center"><?php echo $row["cost"]; ?></td>
<td align="center"><?php echo $row["notes"]; ?></td>
<td align="center">
<a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
</td>
<td align="center">
<a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</table>
</div>
      </div></center>
   </main>
<body>

</body>
</html>