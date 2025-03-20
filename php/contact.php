<?php 
$array = array("firstname"=>"","name"=>"","email"=>"","telephone"=>"", "message"=>"", "firstnameError"=>"","nameError"=>"","emailError"=>"","telephoneError"=>"","messageError"=>"","isSuccess"=>false);
$emailTo = "jaurellekeugongf@gmail.com";

if($_SERVER["REQUEST_METHOD"]== "POST") {
    $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["name"] = verifyInput($_POST["name"]);
    $array["email"] = verifyInput($_POST ["email"]);
    $array["telephone"] = verifyInput($_POST["telephone"]);
    $array["message"] = verifyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";

    if(empty($array["firstname"])){
        $array["firstnameError"] = "Je veux connaître ton prénom!";
        $array["isSuccess"] = false;
        
    }else {
        $emailText .= "Firstname: {$array["firstname"]}\n";
    }

    if(empty($array["name"])){
        $array["nameError"] = "Eh oui, je veux aussi connâitre ton mon!";
        $array["isSuccess"] = false;
        
    }else {
        $emailText .= "Name: {$array["name"]}\n";
    }

   
    if(!isEmail($array["email"])){
        $array["emailError"] = "Humm, je ne pense pas que ce soit un email ça!";
        $array["isSuccess"] = false;
        
    }else {
        $emailText .= "Email: {$array["email"]}\n";
    }

    if(!isPhone ($array["telephone"])){
        $array["telephoneError"] = "Le numéro de téléphone est composé de chiffres et d'espaces uniquement";
        $array["isSuccess"] = false;
        
    }else {
        $emailText .= "Telephone: {$array["telephone"]}\n";
    }

    if(empty($array["message"])){
        $array["messageError"] = "Hummm, Qu'est ce que tu veux me dire??";
        $array["isSuccess"] = false;
        
    }else {
        $emailText .= "Message: {$array["message"]}\n";
    }

    if ($array["isSuccess"]){
        $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To : {$array["email"]}";
        mail($emailTo, "Quelqu'un veux t'a contacté!", $emailText, $headers);
        
    }

    echo json_encode($array);

}


function isEmail($var){
    if (filter_var($var, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {
        return false;
    }
 
}
function isPhone($var){
    return preg_match("/^[0-9]*$/", $var);
}

function verifyInput ($var){
    $var = trim($var);
    $var = stripcslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}


?>
