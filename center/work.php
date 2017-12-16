<?php
include("database.php");
include("auth.php");
//$row = mysqli_fetch_assoc($result2)
//$uid = $_SESSION['user'];  // set your user id settings
$datetime_string = date('c',time());    
$username = $_SESSION['username'];
    
if(isset($_POST['action']) or isset($_GET['view']))
{
    if(isset($_GET['view']))
    {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($connection,$_GET["start"]);
        $end = mysqli_real_escape_string($connection,$_GET["end"]);
        
        $result = mysqli_query($connection,"SELECT `id`, `start` ,`end` ,`title` FROM  `workcalendar` where (date(start) >= '$start' AND date(start) <= '$end') and id2='".$username."'");
        while($row = mysqli_fetch_assoc($result))
        {
            $events[] = $row; 
        }
        echo json_encode($events); 
        exit;
    }
    elseif($_POST['action'] == "add")
    {   
        mysqli_query($connection,"INSERT INTO `workcalendar` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `id2` 
                    )
                    VALUES (
                    '".mysqli_real_escape_string($connection,$_POST["title"])."',
                    '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."',
                    '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."',
                    '".mysqli_real_escape_string($connection,$username)."'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"'.mysqli_insert_id($connection).'"}';
        exit;
    }
    elseif($_POST['action'] == "update")
    {
        mysqli_query($connection,"UPDATE `workcalendar` set 
            `start` = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
            `end` = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' 
            where id2 = '".mysqli_real_escape_string($connection,$username)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
        exit;
    }
    elseif($_POST['action'] == "delete") 
    {
        mysqli_query($connection,"DELETE from `workcalendar` where id2 = '".mysqli_real_escape_string($connection,$username)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
        if (mysqli_affected_rows($connection) > 0) {
            echo "1";
        }
        exit;
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

    <title>Part Calendar</title>

    <!-- Bootstrap core CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
 <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
<link href="css/fullcalendar.css" rel="stylesheet" />
<link href="css/fullcalendar.print.css" rel="stylesheet" media="print" />
<script src="js/moment.min.js"></script>
<script src="js/fullcalendar.js"></script>

   
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="work.php">Work Calendar<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="materials.php">Materials List</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="printers.php">Printers Portfolio</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="parts.php">Part Database</a>
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="inventory.php">Item Inventory</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
		 <ul class="navbar-nav mr-auto">
		 <li class="nav-item">
 <a class="nav-link" href="logout.php">Logout</a>
           </ul>
        </form>
      </div>
    </nav>
<main role="main" class="container">
  <center><div class="jumbotron">
       <h1>Work Calendar</h1>
       <div class="row">
<div id="calendar"></div>
</div>
      </div></center>
   </main>

<!-- Modal -->
<div id="createEventModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Event</h4>
      </div>
      <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="inputPatient">Event:</label>
                <div class="field desc">
                    <input class="form-control" id="title" name="title" placeholder="Event" type="text" value="">
                </div>
            </div>
            
            <input type="hidden" id="startTime"/>
            <input type="hidden" id="endTime"/>
            
            
       
        <div class="control-group">
            <label class="control-label" for="when">When:</label>
            <div class="controls controls-row" id="when" style="margin-top:5px;">
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
    </div>
    </div>

  </div>
</div>


<div id="calendarModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Event Details</h4>
        </div>
        <div id="modalBody" class="modal-body">
        <h4 id="modalTitle" class="modal-title"></h4>
        <div id="modalWhen" style="margin-top:5px;"></div>
        </div>
        <input type="hidden" id="eventID"/>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
        </div>
    </div>
</div>
</div>
<!--Modal-->


<div style='margin-left: auto;margin-right: auto;text-align: center;'>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>