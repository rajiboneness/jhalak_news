<?php 
 session_start ();
 if (!isset($_SESSION['name']) ) {
    header("location:login.php");
 }
include '../db/db.php';
include 'layouts/header.php';
include 'layouts/sidebar.php';
$sql = mysqli_query($conn, "SELECT * FROM news WHERE id = '$_GET[id]'");
$rows = mysqli_fetch_array($sql);
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
    .edit_value{
        text-align: end;
        color: #013782;
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
                <h3 class="tile-title">Update News
                    <span class="top-form-btn">
                        <a class="btn btn-warning" href="news-upload.php" onclick="window.location.reload();"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Back</a>
                    </span>
                </h3>
                <hr>
                <form action="backend/upload-news.php" method="POST" role="form" id="upload_form" enctype="multipart/form-data">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="news_file"> File <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" type="file" name="news_file" id="news_file">
                        </div>
                        <div class="edit_value">News File : <?php echo $rows['news_file']?></div>
                        <div class="form-group">
                            <label class="control-label" for="news_date"> News Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control" type="date" name="news_date" id="news_date" placeholder="News Date">
                            <input type="hidden" name="update_data" value="update_data">
                            <input type="hidden" name="id" value="<?php echo $rows['id']?>">
                        </div>
                        <div class="edit_value">News Date : <?php echo $rows['news_date']?></div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" id="sendButton" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save News</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="#" onclick='window.location.reload();'><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
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