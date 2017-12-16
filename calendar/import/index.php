<?php
include '../config.php';
include("../../auth.php");
$username = $_SESSION['username'];
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Part data has been inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>

<!doctype html>
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

    <title>Import Parts</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap core CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="../../js/script.js"></script>
 <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../navbar-top-fixed.css" rel="stylesheet">
<link href="../../css/fullcalendar.css" rel="stylesheet" />
<link href="../../css/fullcalendar.print.css" rel="stylesheet" media="print" />
<script src="../../js/moment.min.js"></script>
<script src="../../js/fullcalendar.js"></script>
   
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../">Parts Calendar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../materials.php">Materials List</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="../../printers">Printers Portfolio</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="../../parts">Part Database</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="../../inventory">Item Inventory</a>
          </li>
		    <li class="nav-item">
            <a class="nav-link active" href="./">Import Orders<span class="sr-only">(current)</a>
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
       <h1>Import Parts to Calendar</h1>
<div class="container">
    <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Parts Calendar List
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Parts</a>
        </div>
        <div class="panel-body">
            <form action="import.php" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th>Title</th>
                      <th>Printer</th>
                      <th>Start</th>
                      <th>End</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    //get records from database
                    $query = $con->query("SELECT `id`, `start` ,`end` ,`title`, `printer` FROM  `partcalendar` where id2='".$username."'");
                    if($query->num_rows > 0){ 
                        while($row = $query->fetch_assoc()){ ?>
                    <tr>
                      <td><?php echo $row['title']; ?></td>
                      <td><?php echo $row['printer']; ?></td>
                      <td><?php echo $row['start']; ?></td>
                      <td><?php echo $row['end']; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No parts found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
      </div></center>
   </main>
</body>
</html>