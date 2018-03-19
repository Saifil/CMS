<?php include_once("../includes/session.php");?>
<?php include_once("../includes/connect.php");?>
<?php require_once("../includes/functions.php");?>

<?php

$subject_id = $_GET["subject"];
if (!isset($subject_id)) { //if subject id not set
    echo "No subject selected";
} else {
    $current_subject = find_subject_by_id($subject_id);
    if (!$current_subject) { //if no data retrived from DB
        redirect_to("manage_content.php");
    } else {

        $id = $current_subject["id"];

        $page_list = find_pages_for_subject($id);
        if (mysqli_num_rows($page_list) > 0) { //child pages for given subject exist
            //disallow deletion
            $_SESSION["errors"] = array("Can't delete a subject with pages.");
            redirect_to("manage_content.php?subject={$id}");
        }

        $query = "DELETE FROM subjects WHERE id = {$id};";

        //echo $query;

        $result = mysqli_query($conn,$query);

        if ($result && mysqli_affected_rows($conn) == 1) { //success
            $_SESSION["message"] = "Subject deleted.";
            redirect_to("manage_content.php");
        } else { //failure
            $_SESSION["message"] = "Subject deletion failed.";
            redirect_to("manage_content.php?subject={$id}");
        }
    }
}

?>

<?php
if (isset($conn)) {
    mysqli_close($conn);
}
?>
