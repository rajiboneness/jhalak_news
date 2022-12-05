<?php 
 session_start ();
 if (!isset($_SESSION['name']) ) {
    header("location:login.php");
 }
include 'layouts/header.php';
include 'layouts/sidebar.php';
?>
<main class="app-content" id="app">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>25</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-thumbs-o-up fa-3x"></i>
                <div class="info">
                    <h4>Teachers</h4>
                    <p><b>14</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Courses</h4>
                    <p><b>24</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>News</h4>
                    <p><b>24</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="py-3">
                    <h4>10 Latest News</h4>
                </div>
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Course</th>
                                <th>Chapter</th>
                                <th>Price</th>
                                <th>Transaction Id</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                        Rajib Ali Khan<br />
                                    </td>
                                    <td>
                                        Rajib Ali Khan<br />
                                    </td>
                                    <td>
                                        Rajib Ali Khan<br />
                                    </td>
                                    <td>
                                        Rajib Ali Khan<br />
                                    </td>
                                    <td>
                                        Rajib Ali Khan<br />
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include 'layouts/footer.php';
?>