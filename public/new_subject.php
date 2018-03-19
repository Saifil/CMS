<?php include_once("../includes/session.php");?>
<?php include_once("../includes/connect.php");?>
<?php require_once("../includes/functions.php");?>
<?php include("../includes/layouts/header.php");?>

<!--required to set which page / subject is selected currently-->
<!--goes hand in hand with the main content and navbar-->
<?php require_once("../includes/currentStatus.php");?>

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
        if ($errors = errors()) {
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
        if ($message = message()) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $message . "</div>";
        }
        ?>

        <h1>Create Subject</h1><br><br>

        <!--new subject form-->
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 jumbotron">
                <form action="create_subject.php" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Menu Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="menu_name">
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
                                    for ($i = 1; $i <= $subject_count + 1; $i++) {
                                        echo "<option value=\"{$i}\">{$i}</option>";
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
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary form-control" name="submit">Create Subject</button>
                    <br><br>
                    <a href="manage_content.php"">Cancel</a>
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
