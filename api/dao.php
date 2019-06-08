<?php
include "const.inc.php";

function connect(){
    return new mysqli(
        DB_SERVER_NAME,
        DB_USERNAME,
        DB_PASSWORD,
        DB_NAME
    );
}

function insert_image($data){
	$data = json_decode($data, true);
	$response = array('result'=>'','error'=>'');

	$sql = "INSERT INTO `web_content` 
    (`title`, `description`, `image`, `web_id`) 
    VALUES 
    ('".$data['title']."', '".$data['description']."', '".$data['image']."', ".$data['web_id'].");";
    $conn = connect();
    if ($conn->query($sql) === TRUE) {
        $response['result'] = true;
    } else {
        $response['error'] = $conn->error;
    }
    return $response;
}

function get_all_image(){
	$sql = "SELECT * FROM web_content ORDER BY created_on DESC";
    $result = connect()->query($sql);
    $response = array('result'=>'','error'=>'');
    $numRows = $result->num_rows;

    if($numRows>0){
        while($row = $result->fetch_assoc()){
            $data[]=$row;
        }
        $response['result'] = $data;
    }else{
    	$response['error'] = "No data found";
    }
    return $response;
}

function delete_image($id){
	$response = array('result'=>'','error'=>'');
	$sql = "DELETE FROM web_content WHERE id=".$id;
	$conn = connect();
	if($conn->query($sql) === TRUE){
		$response['result']=ture;
	}else{
        $response['error']=$conn->error;
	}
	return $response;
}

function get_login($data){
	$response = array('result'=>'','error'=>'');
	$data = json_decode($data,true);
	$sql = "SELECT * FROM admins WHERE username='".$data['username']."'";
	$conn = connect();
	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		$login_info = $result->fetch_assoc();
		if($login_info['password']==$data['password']){
			$response['result'] = $login_info['id'];
		}else{
			$response['result'] =  0;
		}
	}else{
		$response['result'] =  -1;
	}
	return $response;
}

/////////////////////////////////////////////////
$data = array('error' => "Invalid Call for data");

$methods_with_param = array(
	'get_login',
	'delete_image',
	'update_image',
	'insert_image',
	'get_all_image_for_web'
);

$methods_wothout_param = array(
	'get_all_image',
	'connect'
);

if(isset($_GET['action']) || isset($_POST['action'])){
	$data = $_GET;
	if(isset($_GET['action'])){
		$func = $_GET['action'];
	}else{
		$func = $_POST['action'];
	}

	if(in_array($func, $methods_wothout_param)){
		$data = $func();
	} 
	else if(in_array($func, $methods_with_param)){
		if(isset($_GET['value'])){
			$data = $func($_GET['value']);
		}else{
			$data = array('error' => "perameter value required");
		}
	}
}

die(json_encode($data));
?>