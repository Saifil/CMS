<?php include_once("../includes/connect.php")?>
<?php require_once("../includes/functions.php")?>
<?php include("../includes/layouts/header.php")?>

    <div class="wrapper">

        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Bootstrap Sidebar</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Dummy Heading</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="#">Home 1</a></li>
                        <li><a href="#">Home 2</a></li>
                        <li><a href="#">Home 3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li><a href="" class="download">Public Page</a></li>
            </ul>
        </nav>
        <!--/Sidebar Holder -->

        <!-- Page Content Holder -->
        <div id="content">
            <!--Toggle Button-->
            <?php include("../includes/layouts/toggle_menu.php")?>
            <!--/Toggle Button-->

            <!--Main content-->
            <h1>Admin Menu</h1>
            <p>Welcome to Admin panel.</p>

            </br></br>

            <div class="row" style="min-height: 350px;">
                <div class="col-md-4">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item">Manage Website Content</a>
                        <a href="#" class="list-group-item">Manage Admin User</a>
                        <a href="#" class="list-group-item">Logout</a>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
            </div>
            <!--/Main content-->

            <!--Footer-->
            <?php include("../includes/layouts/page_footer.php")?>
            <!--/Footer-->
        </div>
    </div>

<?php include("../includes/layouts/footer.php")?>
