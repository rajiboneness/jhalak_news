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
    .alert {
        display: none;
        position: fixed;
        bottom: 0px;
        right: 0px;
        .fa {
            margin-right: 0.5em;
        }
    }

</style>
<main class="app-content" id="app">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> News</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Upload News
                    <span class="top-form-btn">
                        <a class="btn btn-secondary" href="#" onclick="window.location.reload();"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="backend/upload-news.php" method="POST" role="form" id="upload_form" enctype="multipart/form-data">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="news_file"> File <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" type="file" name="news_file" id="news_file">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="news_date"> News Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" type="date" name="news_date" id="news_date" placeholder="News Date">
                            <input type="hidden" name="insert_data" value="insert_data">
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" id="sendButton" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save News</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="#" onclick='window.location.reload();'><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
            <div class="tile">
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
</div>
</main>
<?php
include 'layouts/footer.php';
?>
<script type="text/javascript">


$(document).ready(function () {
    $('#sampleTable').DataTable();
});


    $(document).ready(function () {
        $("form").submit(function (event) {
           event.preventDefault();
            var formdata = new FormData($('form')[0]);
            var url = $("form").attr('action');
            $.ajax({
                url: url,
                type: "POST",
                data: formdata,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(result) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    if (result.status == 200) {
                        Toast.fire({
                        icon: 'success',
                        title: result.message
                        })
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 2000);
                    } else {
                        Toast.fire({
                        icon: 'error',
                        title: result.message
                        })
                    }
                },
            });
        });
    });
</script>