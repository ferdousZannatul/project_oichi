<?php
// echo file_get_contents("https://sienese-products.000webhostapp.com/api/dao.php?action=delete_image&value=48");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hello</title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>

</body>
</html>
<script>
function ajax_get_call(path){
	return $.ajax({
		type:'GET',
		url : path,
		}
	);
}

function ajax_post_call(path, data){
	return $.ajax({
		type:'POST',
		url : path,
		data: data
		}
	);
}

function show_data(data){
	console.log(JSON.parse(data));
}

// var g_url = "http://localhost/webproject/api/dao.php?action=get_all_image";
// ajax_get_call(g_url).done(show_data);

var p_url = "http://localhost/webproject/api/dao.php";
var data={};
data['action'] = "get_all_image";
ajax_post_call(p_url, data).done(show_data);

</script>