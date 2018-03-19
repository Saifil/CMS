<?php include_once("../includes/session.php");?>
<?php include_once("../includes/connect.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>


<?php

if (isset($_POST["submit"])) { //form processing

    //print_r($_POST);

    $menu_name = mysql_prep($_POST["menu_name"]);
    $position = (int)$_POST["position"];
    $visible = (int)$_POST["visible"];

    //validations
    $required_fields = array("menu_name","position","visible");

    //check the presence
    validate_presence($required_fields);

    //check lengths
    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    //if errors exist, redirect the user
    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        //print_r($errors);
        redirect_to("new_subject.php");
    } else { //details are valid
        $query  = "INSERT INTO subjects VALUES(";
        $query .= "'','{$menu_name}',{$position},{$visible});";

        echo $query;

        $result = mysqli_query($conn,$query);

        if ($result) { //success
            $_SESSION["message"] = "Subject created.";
            redirect_to("manage_content.php");
        } else { //failure
            $_SESSION["message"] = "Subject creation failed.";
            redirect_to("new_subject.php");
        }

        //echo $message;
    }



} else { //probably a GET request
    redirect_to("new_subject.php");
}

?>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
?>
