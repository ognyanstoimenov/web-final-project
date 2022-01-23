<?php
header('Content-Type: text/html; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $errors = array();
    $filters = array("name","teacher","description","group","credits");
    $presentFields = array(0,0,0,0,0);
    foreach ($data as $key => $value) {
        switch ($key) { 
            case "name": {
                $len = mb_strlen($value);
                if ($len < 2) {
                   $errors["name"]="Дължината на името е под 2 символа, а вие сте въвели {$len}";
                }elseif ($len > 150){
                   $errors["name"]="Дължината на името е над 150 символа, а вие сте въвели {$len}";
                }else{
                  $presentFields[0] = 1;
                }
                break;
            }
            case "teacher": {
                $len = mb_strlen($value);
                if ($len < 3){
                    $errors["teacher"]="Дължината на името на преподавателя е под 3 символа, а вие сте въвели {$len}";
                }elseif($len > 150){
                    $errors["teacher"]="Дължината на името на преподавателя е над 150 символа, а вие сте въвели {$len}";
                }else{
                    $presentFields[1] = 1;
                }
                break;
            }
            case "description": {
                $len = mb_strlen($value);
                if ($len < 10){
                    $errors["description"]="Описанието трябва да е с дължина поне 10 символа, а вие сте въвели {$len}";
                }else{
                    $presentFields[2] = 1;
                }
                break;
            }
            case "group": {
                $filterGroup = array("М","ПМ","ОКН","ЯКН");
                print_r($filterGroup);
                foreach ($filterGroup as $string){
                    if($string === $value){
                        print_r("mau");
                        print_r($value);
                        print($string);
                        $presentFields[3] = 1;
                        break;
                    }
               
                }
                if ($presentFields[3] == 0){
                    $errors["group"]="Невалидна група, изберете една от М, ПМ, ОКН и ЯКН";
                }
                break;
            }
            case "credits": {
                if ($value < 1){
                    $errors["credits"]="Невалиден брой кредити, въведете цяло положително число";
                }else {
                    $presentFields[4] = 1;
                }
                break;
            }
        }
    }
    for ($x = 0; $x < 5; $x+=1) {
        switch ($x) {
            case 0:{
                if ($presentFields[$x] === 0 && !array_key_exists('name', $errors)){
                    $errors["name"]="Името на учебния предмет е задължително поле";
                }
                break;
            }
            case 1:{
                if ($presentFields[$x] === 0 && !array_key_exists('teacher', $errors)){
                    $errors["teacher"] = "Името на преподавателя е задължително поле";
                }
                break;
            }
            case 2:{
                if ($presentFields[$x] === 0 && !array_key_exists('description', $errors)){
                    $errors["description"] = "Описанието е задължително поле";
                }
                break;
            }
            case 3:{
                if ($presentFields[$x] === 0 && !array_key_exists('group', $errors)){
                    $errors["group"] = "Групата е задължително поле";
                }
                break;
            }
            case 4:{
                if ($presentFields[$x] === 0 && !array_key_exists('credits', $errors)){
                    $errors["credits"] = "Броя кредити е задължително поле";
                }
                break;
            }
        }
      }
      $result = array();
      if (count($errors) == 0){
        $result["success"] = TRUE;
      }else{
        $result["success"] = FALSE;
        $result["errors"] = $errors;
      }
      echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>