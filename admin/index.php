<?php 
 session_start ();
 if (!isset($_SESSION['name']) ) {
    header("location:login.php");
 }
 include '../db/db.php';
include 'layouts/header.php';
include 'layouts/sidebar.php';
$sql = mysqli_query($conn, "SELECT * FROM news ORDER BY news_date DESC");
?>
<style>
    .dashboard-card p{
font-size: 13px !important;}
</style>
<main class="app-content" id="app">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
    <div class="row pt-3 dashboard-card">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Subscription</h4>
                    <p>50</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-thumbs-o-up fa-3x"></i>
                <div class="info">
                    <h4>Location</h4>
                    <p>Kolkata</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Language</h4>
                    <p>Hindi</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Today</h4>
                    <p><?php
                    date_default_timezone_set('Asia/Kolkata'); 
                    $yrdata= strtotime(date("d-m-Y"));
                    echo date('d-M-Y', $yrdata); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h5>Uploaded News</h5>
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th> News Date</th>
                                <th> News File</th>
                                <th> Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            while($rows = mysqli_fetch_array($sql) ){
                            //    $news_path =  dirname(__FILE__).'/backend/upload/'.$rows['news_file'];
                            $news_path =  'backend/upload/'.$rows['news_file'];
                            ?>
                            <tr>
                                <td><?php echo $rows['news_date']?></td>
                                <td>
                                <a href="<?php echo $news_path ?>" class="btn btn-sm btn-primary edit-btn" target="_blank">View News</a>
                                </td>
                                <td>
                                    <a href="news-upload-edit.php?id=<?php echo $rows['id']; ?>" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-pencil"></i></a>
                                    <!-- <div class="btn-group" role="group" aria-label="Second group"><a href="javascript:void(0)" data-id="" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a></div> -->
                                </td>
                            </tr>
                            <?php 
                            }?>
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