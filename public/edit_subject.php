<?php include_once("../includes/session.php");?>
<?php include_once("../includes/connect.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php include("../includes/layouts/header.php");?>

<!--required to set which page / subject is selected currently-->
<!--goes hand in hand with the main content and navbar-->
<?php require_once("../includes/currentStatus.php");?>

<?php

if (!$selected_subject_id) { //subject id was missing
    redirect_to("manage_content.php");
}

?>

<?php //form validation and subject

if (isset($_POST["submit"])) { //form processing

    //print_r($_POST);

    //validations
    $required_fields = array("menu_name","position","visible");

    //check the presence
    validate_presence($required_fields);

    //check lengths
    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    $id = $selected_subject_id;
    $menu_name = mysql_prep($_POST["menu_name"]);
    $position = (int)$_POST["position"];
    $visible = (int)$_POST["visible"];

    if (!empty($errors)) { //if errors exist, redirect the user
        $_SESSION["errors"] = $errors;
        //print_r($errors);
        //redirect_to("new_subject.php");
    } else { //details are valid

        $query  = "UPDATE subjects SET ";
        $query .= "menu_name = '{$menu_name}', ";
        $query .= "position = {$position}, ";
        $query .= "visible = {$visible} ";
        $query .= "WHERE id = {$id};";
        //echo $query;

        $result = mysqli_query($conn,$query);

        if ($result && mysqli_affected_rows($conn) >= 0) { //success
            $_SESSION["message"] = "Subject updated.";
            redirect_to("manage_content.php");
        } else { //failure
            $message = "Subject updated failed.";
        }

        //echo $message;
    }



} else { //probably a GET request
//    redirect_to("new_subject.php");

    //we redisplay the form which is in the same page
}

?>


<div class="wrapper">

    <!-- Sidebar Holder -->
    <?php include("../includes/layouts/navigation.php");?>
    <!--/Sidebar Holder -->

    <!-- Page Content Holder -->
    <div id="content">
        <!--Toggle Button-->
        <?php include("../includes/layouts/toggle_menu.php");?>
        <!--/Toggle Button-->

        <!--Main content-->
        <!--Validation error display-->
        <?php
        if ($errors) {
        ?>
        <ul class="list-group">
            <?php
            foreach ($errors as $val) {
                echo "<li class=\"list-group-item list-group-item-danger\">" . $val . "</li>";
            }
            ?>
            <?php echo "</ul>";
            }
            ?>

            <!--DB entry error display-->
            <?php
            if (!empty($message)) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $message . "</div>";
                }
                ?>

                <h1>Edit Subject : <?php echo $current_subject["menu_name"]?></h1><br><br>

                <!--new subject form-->
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 jumbotron">
                        <form action="edit_subject.php?subject=<?php echo $selected_subject_id?>" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Menu Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="menu_name"
                                value="<?php echo $current_subject["menu_name"]?>">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!--position-->
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Position</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="position">
                                            <?php //display option
                                            $subject_set = find_all_subjects();
                                            $subject_count = mysqli_num_rows($subject_set);
                                            for ($i = 1; $i <= $subject_count; $i++) {
                                                echo "<option value=\"{$i}\"";
                                                if ($i == $current_subject["position"]) {
                                                    echo " selected";
                                                }
                                                echo ">{$i}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--visibility-->
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Visibility</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="visible">
                                            <?php
                                            if ($current_subject["visible"] == 1) {
                                                  echo "<option value=\"1\" selected>1</option>";
                                                  echo "<option value=\"0\">0</option>";
                                            } else {
                                                echo "<option value=\"1\">1</option>";
                                                echo "<option value=\"0\" selected>0</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary form-control" name="submit">Edit Subject</button>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6"><a href="manage_content.php"">Cancel</a></div>
                                <div class="col-md-6" style="text-align:right;">
                                    <a href="delete_subject.php?subject=<?php echo $selected_subject_id;?>"
                                        onclick="return confirm('Are you sure?');"><u>Delete subject</u></a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <!--/Main content-->


                <!--Footer-->
                <?php include("../includes/layouts/page_footer.php")?>
                <!--/Footer-->
            </div>
    </div>

    <?php include("../includes/layouts/footer.php")?>
