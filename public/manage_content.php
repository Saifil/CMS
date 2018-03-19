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
                echo "<h2>Manage Page : ".htmlentities($current_page["menu_name"])."</h2>";
                echo "<div class=\"line\"></div>";
                echo "<div><p>".htmlentities($current_page["content"])."</p></div>";

            } else if ($current_subject) {
                echo "<h2>Manage Subject : ".htmlentities($current_subject["menu_name"])."</h2>";
                echo "</br></br></br>";
                echo "<a href=\"edit_subject.php?subject={$selected_subject_id}\"><u>Edit Subject</u></a>";
                echo "</br></br></br>";

                //display the pages on that subject
                $page_list = find_pages_for_subject($current_subject["id"]);
                if (mysqli_num_rows($page_list) > 0) {
                    echo "<ul class=\"list-group list-group-flush\">";
                    foreach($page_list as $row) {
                        echo "<li class=\"list-group-item\">" . $row["menu_name"] . "</li>";
                    }
                    echo "</u>";
                    echo "</br></br></br>";
                }
                echo "<a href=\"new_page.php?subject={$selected_subject_id}\"><u>+ Add a page to this subject.</u></a>";
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
