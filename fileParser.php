<?php
include 'users.php';
$txt_file    = file_get_contents('data.txt');
$rows        = explode("\n", $txt_file);
foreach($rows as $row => $data)
{
    $row_data = explode(', ', $data);
    $users = array();
    foreach($row_data as $row_d => $data_on_row)
    {
        $sort_data = explode(" ",$data_on_row);
        $firstName =preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $sort_data[0]);
        $lastName = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $sort_data[1]);
        $sort_data[2] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $sort_data[2]);
        

        if(str_contains($sort_data[2], 'f.n.')){
            $identification = trim($sort_data[2],"(f.n.");
            $identification = trim($identification,")");
            if(str_contains($identification,"MI")){
                $two_numbers = explode("MI",$identification);
                $first_num = intval($two_numbers[0]);
                $second_num_numbers = str_split($two_numbers[1]);
                $sum_second_number = 0;
                foreach ($second_num_numbers as $value){
                    $sum_second_number += intval($value);
                }
                if(!$sum_second_number == $first_num){
                    continue;
                }
                $identification = strval($first_num)."MI".$two_numbers[1];
            }else{
                if(mb_strlen($identification) != 5){ 
                    continue;
                }             
            }
        }else{
            $identification = trim($sort_data[2],"(");
            $identification = trim($identification,")");
        }
       
        $user =new User($firstName,$lastName,$identification);
        array_push($users, $user);     
    }
    //Testing  input transformation 
    print_r($users);
    //TODO implement json serialization
    // echo json_encode(get_object_vars($users));
}
?>