<?php
    include 'const.inc.php';
    error_reporting(E_ERROR | E_PARSE);
    session_start();

    $img = 0;
    if(isset($_POST['username'])){
        login();
    }
    if(isset($_SESSION['login_id'])){
        if($_SESSION['login_id']>0 && isset($_POST['submit'])){
            if(strcmp($_POST['submit'],'edit')==0){
                update_data();
            }else if(strcmp($_POST['submit'],'delete')==0){
                $val = delete_image($_POST['delete_id']);
                // $val = delete_image($_POST['id']);
                if($val>0){
                    unlink("uploads/".$_POST['delete_img_name']);
                    header("Location: view.php");
                    die();
                }
            }else{
            	insert_data();
            }
        }
    }
    
    function login(){
        if(isset($_POST['password'])){
            $_SESSION['login_user'] = $_POST['username'];
            $_SESSION['login_password'] = $_POST['password'];
            $arr = array(
                'username' => $_SESSION['login_user'],
                'password' => $_SESSION['login_password']
                 );
            // $login_status = file_get_contents(API."action=get_login&value=".json_encode($arr));
            $login_status = (int)get_login($arr);
            // var_dump( $login_status);
            if($login_status > 0){
                $_SESSION['login_id'] = $login_status;
                header("Location: view.php");
                die();
            }else if($login_status == 0){
                $_SESSION['error_msg'] = "password dont match";
            }else{
                $_SESSION['error_msg'] = "user dont exists";
            }

        }else{
            $_SESSION['error_msg'] = "password required";
        }
        header('Location: login.php');
        die();
    }

    function update_data(){
        $img=0;
        
        if(isset($_FILES['file']['name'])){
            $img = img_upload();
        }

        if(isset($_POST['id']) && isset($_POST['img_title']) && isset($_POST['img_desc']) && isset($_POST['web_select'])){
            //Set data for insertion
            if(!is_numeric($img)){
                $data['image'] = $img;
                unlink('uploads/'.$_POST['img_name']);
            }
            $data['id'] = $_POST['id'];
            $data['title'] = $_POST['img_title'];
            $data['description'] = $_POST['img_desc'];
            $data['web_id'] = $_POST['web_select'];
            $data = json_encode($data);
            // $data = file_get_contents(API."action=insert_image&value=".$data);
            update_image($data);
            header("Location: view.php");
            die();
        }
        if($img > 0){
            echo IMAGE_UPLOAD_ERRORS[$img];
            die();
        }
    }

    function insert_data(){
        $img=0;
    	if(isset($_FILES['file']['name'])){
	        $img = img_upload();
	    }
	    if(isset($_POST['img_title']) && isset($_POST['img_desc']) && isset($_POST['web_select']) && !is_numeric($img)){
	        //Set data for insertion
	        $data['title'] = $_POST['img_title'];
	        $data['description'] = $_POST['img_desc'];
	        $data['image'] = $img;
	        $data['web_id'] = $_POST['web_select'];
	        $data = json_encode($data);
            insert_image($data);
            header("Location: view.php");
            die();
	    }
        if($img > 0){
            echo IMAGE_UPLOAD_ERRORS[$img];
            die();
        }
    }
    //////////////////////////////////////////////////////////////////////DAO/////////////////////////////////////////////////////////////////
    function connect(){
        $conn = new mysqli(
            DB_SERVER_NAME,
            DB_USERNAME,
            DB_PASSWORD,
            DB_NAME
        );
        return $conn;
    }

    function insert_image($data){
        $data = json_decode($data, true);
        
        $sql = "INSERT INTO `web_content` 
        (`title`, `description`, `image`, `web_id`) 
        VALUES 
        ('".$data['title']."', '".$data['description']."', '".$data['image']."', ".$data['web_id'].");";

        if (connect()->query($sql) === TRUE) {
            return true;
        } else {
            // echo "Error: ".$sql. "<br>".connect()->error;
            // die();
            return false;
        }
    }

    function update_image($data){
        $data = json_decode($data, true);
        if(isset($data['image'])){
            $sql = "UPDATE `web_content` 
        SET `title`='".$data['title']."', `description`='".$data['description']."', `image`='".$data['image']."', `web_id`=".$data['web_id']." WHERE id=".$data['id'].";";
        }else{
            $sql = "UPDATE `web_content` 
            SET `title`='".$data['title']."', `description`='".$data['description']."', `web_id`=".$data['web_id']." WHERE id=".$data['id'].";";
        }

        if (connect()->query($sql) === TRUE) {
            return true;
        } else {
            // echo "Error: ".$sql. "<br>".connect()->error;
            // die();
            return false;
        }
    }

    function get_all_image(){
        $sql = "SELECT * FROM web_content ORDER BY created_on DESC";
        $result = connect()->query($sql);

        $numRows = $result->num_rows;

        if($numRows>0){
            while($row = $result->fetch_assoc()){
                $data[]=$row;
            }
            return json_encode($data);
        }
    }

    function get_image_by_web_id($id){
        $sql = "SELECT * FROM web_content WHERE web_id=".$id." ORDER BY created_on DESC";
        $result = connect()->query($sql);

        $numRows = $result->num_rows;

        if($numRows>0){
            while($row = $result->fetch_assoc()){
                $data[]=$row;
            }
            return json_encode($data);
        }
    }

    function delete_image($id){
        $sql = "DELETE FROM web_content WHERE id=".$id;

        if(connect()->query($sql) === TRUE){
            return 1;
        }else{
            echo "Error: ".$sql. "<br>".connect()->error;
            // die();
            return 0;
        }
    }

    function get_login($data){
        // $data = json_decode($data,true);
        $sql = "SELECT * FROM admins WHERE username='".$data['username']."'";
        $result = connect()->query($sql);
        
        if($result->num_rows > 0){
            $login_info = $result->fetch_assoc();
            
            if(strcmp($login_info['password'],$data['password'])==0){
                return $login_info['id'];
            }else{
                return 0;
            }
        }else{
            return -1;
        }
    }
    ////////////////////////////////////////////////////////////////////////DAO///////////////////////////////////////////////////////////////

    /**
     * Method for image upload
     * upload success=return file name,
     * image too big = return 1,
     * error while upload = return 2,
     * format not supported = return 3 
     */
    function img_upload(){
        if(isset($_FILES['file']['name'])){
            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileType = $_FILES['file']['type'];
            $temp_name = $_FILES['file']['tmp_name'];
            $error = $_FILES['file']['error'];
            $size = $fileType = $_FILES['file']['size'];
    
            $fileNameExplode = explode('.', $fileName);
            $fileExt = strtolower(end($fileNameExplode));
    
            $allowed = array('jpg','jpeg','png');
    
            if(in_array($fileExt, $allowed)){
                if($error == 0){
                    if($size < 2000000){
                        $fileNameNew = uniqid('', true).".".$fileExt;
                        $fileLocation = "uploads/".$fileNameNew;
                        move_uploaded_file($temp_name, $fileLocation);
                        return $fileNameNew;
                    }else{
                        // echo "Chosen file is too big";
                        // header("Location: index.php?msg=big");
                        return 1;
                    }
                }else{
                    // echo "There was an error uploading your file";
                    // header("Location: index.php?msg=error");
                    return 2;
                }
            }else{
                // echo "File format not supported for Upload";
                // header("Location: index.php?msg=unsupported");
                return 3;
            }
        }
    }
?>