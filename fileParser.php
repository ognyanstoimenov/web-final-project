<?php
include 'users.php';
$txt_file    = file_get_contents('data.txt');
$rows        = explode("\n", $txt_file);
print_r($rows);
// array_shift($rows);

foreach($rows as $row => $data)
{
    //get row data
    // print_r($data);
    $row_data = explode(', ', $data);

    // print_r($row_data);
    $users = array();
    foreach($row_data as $row_d => $data_on_row)
    {
        // print_r($data_on_row);
        // print_r("\n");
        
        $sort_data=str_replace("\n","",$sort_data);
        $sort_data = explode(" ",$data_on_row);
        // print_r($sort_data);
        $firstName = $sort_data[0];
        $lastName = $sort_data[1];
        $identification = '';
        if(str_contains($sort_data[2], 'f.n.')){
            $identification = trim($sort_data[2],"(f.n.");
            $identification = trim($identification,")");
            // print_r($identification);
        } elseif (str_contains($sort_data[2], 'guest')){
            $identification1 = trim($sort_data[2],"(");
            $identification = trim($identification1,")");
        }else{
            $identification1 = trim($sort_data[2],"(");
            $identification = trim($identification1,")");
        }
       
        $user =new User($firstName,$lastName,$identification);
        array_push($users, $user);
        
        // $fn = trim(explode(".",$sort_data[2])[2],")");
        // print_r([$first_name,$last_name,$fn]);
        // $sort_data = explode(' ',$row_data);
       
    }
    print_r($users);
    // $info[$row]['id']           = $row_data[0];
    // $info[$row]['name']         = $row_data[1];
    // $info[$row]['description']  = $row_data[2];
    // $info[$row]['images']       = $row_data[3];

    // //display data
    // echo 'Row ' . $row . ' ID: ' . $info[$row]['id'] . '<br />';
    // echo 'Row ' . $row . ' NAME: ' . $info[$row]['name'] . '<br />';
    // echo 'Row ' . $row . ' DESCRIPTION: ' . $info[$row]['description'] . '<br />';
    // echo 'Row ' . $row . ' IMAGES:<br />';

    // //display images
    // $row_images = explode(',', $info[$row]['images']);

    // foreach($row_images as $row_image)
    // {
    //     echo ' - ' . $row_image . '<br />';
    // }

    // echo '<br />';
}
?>