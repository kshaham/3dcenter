<?php
//load the database configuration file
include '../config.php';
include("../../auth.php");
if(isset($_POST['importSubmit'])){
    $username = $_SESSION['username'];
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
				$start1 = $line[2];
				$end1 = $line[3];
				$start2 = new DateTime((string)$start1);
				$end2 = new DateTime((string)$end1);
				$start = $start2->format('Y-m-d H');
				$end = $end2->format('Y-m-d H');
				$type = '-1';
				/* $nextmonth = date("Y-m-d", strtotime("+1 month", $month));
				$end = $now->format('Y-m-d H');
				$query = "SELECT `start` , `end` , `printer` FROM `partcalendar` WHERE (start >= '".$month."' AND end <= '".$nextmonth."') AND id2 = '".$username."' AND printer = '".$line[1]."'";
				$sql = mysqli_query($con,"SELECT `start` , `end` , `printer` FROM `partcalendar` WHERE (start >= '".$month."' AND end <= '".$nextmonth."') AND id2 = '".$username."' AND printer = '".$line[1]."'"); */
    //echo ($emptyPeriod) ? 'Empty period' : 'OK';
				$prevQuery = "SELECT `start` , `printer` FROM `partcalendar` WHERE (start >= '".$start."' AND start <= '".$end."') AND id2 = '".$username."' AND printer = '".$line[1]."'";
				$prevResult2 = $con->query($prevQuery2);
				if($prevResult->num_rows > 0){
					//echo "Skipped: '".$line[0]."' overlapping another part!";
                    //$db->query("UPDATE members SET name = '".$line[0]."', phone = '".$line[2]."', created = '".$line[3]."', modified = '".$line[3]."', status = '".$line[4]."' WHERE email = '".$line[1]."'");
				} else if($prevResult2->num_rows > 0){
                    //insert data into database
				} else {
					$con->query("INSERT INTO `partcalendar` (title, printer, start, end, id2) VALUES ('".$line[0]."','".$line[1]."','".$start."','".$end."','".$username."')");
			}
            }
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect 
header("Location: index.php".$qstring);