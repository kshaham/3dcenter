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
				$partQuery = "SELECT name, printtime FROM parts WHERE name = '".$line[1]."' AND username = '".$username."'";
                //check whether member already exists in database with same email
				$start = new DateTime(); 
				$hours = $line[2];
				$end = date("Y-m-d H:i:s", strtotime(sprintf("+%d hours", $hours))
                $prevQuery = "SELECT id FROM events WHERE id2 = '".$username."'";
                $prevResult = $con->query($prevQuery);
                if($prevResult->num_rows > 0){
                    //update member data
                    $con->query("UPDATE events SET title = '".$line[0]."', printer = '".$line[1]."', start = '".$start."', end = '".$end."', id2 = '".$username."' WHERE id2 = '".$username."'");
                }else{
                    //insert member data into database
                    $con->query("INSERT INTO events (title, printer, start, end, id2) VALUES ('".$line[0]."','".$line[1]."','".$start."','".$end."','".$username."')");
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

//redirect to the listing page
header("Location: index.php".$qstring);