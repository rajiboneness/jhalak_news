<?php
    include '../../db/db.php';
    // Insert Data
    if(isset($_POST['insert_data'])){
        $file = $_FILES['news_file'];
        if( $file['name']!= null) {
            $originalDate = $_POST['news_date'];
            $date = date("d-m-Y", strtotime($originalDate));
            if($originalDate == null){
                $result = array('status' => 400, 'message'=>'Please Select News Date !');
            }else{
                $targetfolder = "upload/";
                if ($file['type']=="application/pdf") {
                    if($file['size']>10000000){
                        $result = array('status' => 400, 'message'=>'Maximum File Size 10 MB.');
                    }else{
                        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        $file_name = $date.'.'.$file_extension;
                        
                        $select = mysqli_query($conn, "SELECT * FROM news WHERE news_date = '".$date."'");
                        if(mysqli_num_rows($select)) {
                            $result = array('status' => 400, 'message'=>'Sorry News olready uploaded on '.$date);
                        }else{
                            $uploaded_file = move_uploaded_file($_FILES['news_file']['tmp_name'], "$targetfolder".$file_name);
                            if($uploaded_file){
                                $sql = "INSERT INTO news (news_date, news_file)VALUES ('$date', '$file_name')";
                                if (mysqli_query($conn, $sql)) {
                                    $result = array('status' => 200, 'message'=>'Successfully Uploaded');
                                }else{
                                    $result = array('status' => 400, 'message'=>"Error: " . $sql . "<br>" . $conn->error);
                                }
                            }
                            else{
                                $result = array('status' => 400, 'message'=>'Something happened');
                            }
                        }
                    }
                }
                else {
                    $result = array('status' => 400, 'message'=>'You may only upload PDF file.');
                }
            }
        }else {
            $result = array('status' => 400, 'message'=>'Please Upload  File !');
        }
        echo json_encode($result);
    }

    // Update Data


    if(isset($_POST['update_data'])){
        $file = $_FILES['news_file'];
        $originalDate = $_POST['news_date'];
        $id = $_POST['id'];
        $date = date("d-m-Y", strtotime($originalDate));
        if( $file['name']!= null) {
            $targetfolder = "upload/";
            if ($file['type']=="application/pdf") {
                if($file['size']>10000000){
                    $result = array('status' => 400, 'message'=>'Maximum File Size 10 MB.');
                }else{
                    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $file_name = $date.'.'.$file_extension;

                    $fetch_data = mysqli_query($conn, "SELECT * FROM news WHERE id = '$id'");
                    $Fetch_rows = mysqli_fetch_array($fetch_data);
                    $path_user = 'upload/'.$Fetch_rows['news_file'];
                    if (file_exists($path_user)) {
                        unlink($path_user);
                    } 
                    $uploaded_file = move_uploaded_file($_FILES['news_file']['tmp_name'], "$targetfolder".$file_name);
                }
            }
            else {
                $result = array('status' => 400, 'message'=>'You may only upload PDF file.');
            }
        }

        $update = mysqli_query($conn, "UPDATE news SET news_date='$date', news_file='$file_name' WHERE id=$id");
        if ($update) {
            $result = array('status' => 200, 'message'=>'Successfully Uploaded');
        }else{
            $result = array('status' => 400, 'message'=>"Error: " . $update . "<br>" . $conn->error);
        }
        echo json_encode($result);
    }

?>