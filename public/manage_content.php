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
            <?php
            if ($message = message()) {
            ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message . "</div>";
            }
            ?>

            <h1>Manage Content</h1>
            </br></br>


            <?php //display content according to selected pages / subject
            if ($current_page) {
                echo "<h2>Manage Page : ".$current_page["menu_name"]."</h2>";
            } else if ($current_subject) {
                echo "<h2>Manage Subject : ".$current_subject["menu_name"]."</h2>";
            }
            else {
                echo "Nothing selected";
            }

            ?>
            <!--/Main content-->


            <!--Footer-->
            <?php include("../includes/layouts/page_footer.php")?>
            <!--/Footer-->
        </div>
    </div>

<?php include("../includes/layouts/footer.php")?>
