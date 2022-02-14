<?php
include 'models/student.php';
include 'models/lecturePortion.php';
$txt_file    = file_get_contents('data.txt');
$rows        = explode("\n", $txt_file);
$date;
$students = [];
foreach($rows as $row => $data)
{

    if($row == 0){
        $row_data = explode(' ', $data);
        $dateData = $row_data[count($row_data) - 2];
        $dateData = preg_split( "/[:\/]/", $dateData );
        $dateString = strval($dateData[2])."/".strval($dateData[0])."/".strval($dateData[1])." ".strval($dateData[3]).":".strval($dateData[4]).":".strval($dateData[5]);
        $date = new DateTime($dateString);
        
        
    }else{

        if(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data) === "Sorted by last name:"){
            
            break;
        }
        $row_data = explode(' ', $data);
        
        if (sizeof($row_data)===2){

            $student = new Student($row_data[0],$row_data[1]);
            array_push($students,$student);
        }
    }

}

$newLecturePortion = new LecturePortion($students,$date);
return $newLecturePortion;
?>