<?php
    include 'data.php';

    if($_SESSION['login_id']>0){
        $data = get_all_image();
        $data = json_decode($data, true);
    }else{
        header("Location: logout.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>..:: Admin ::..</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/view.css">
</head>

<style>
    body, html{
        height: 100%;
    }
</style>

<body>

<div class="container-fluid">
    <h1 class="text-center">..:: Admin Panel ::..</h1>
    
    <hr>
    <div class="row justify-content-md-center">
        <div class="col">
            <button type="button" class="btn btn-success" id="add">Add image</button>
            <button type="button" class="btn btn-primary" id="edit">Update image</button>
            <button type="button" class="btn btn-danger" id="delete">Delete image</button>
        </div>
        <div class="col">
            Mode: <span id="mode">Insert</span>
        </div>
        <div class="col">
            <form action="logout.php"><button class="btn btn-outline-primary float-right">Logout</button></form><br>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col" id="upload-div">
            <form action="data.php" method="POST" enctype="multipart/form-data">
                <input name="id" id='id' style="display: none">
                <input name="img_name" id='img_name' style="display: none">
                <div class="form-group">
                    <label for="title">Image Title</label>
                    <input type="text" class="form-control" name="img_title" id="img_title"  required="" placeholder="Image Name">
                    <p name="delete_img_title" id="delete_img_title"></p>
                </div>
                <div class="form-group">
                    <label for="web_select">Select Upload for</label>
                    <select class="form-control" name="web_select" id="web_select" required="">
                        <option value="">..:: Select One ::..</option>
                        <option value="1">Oichi International</option>
                        <option value="2">Golden Arrow BD</option>
                        <option value="3">Golden Arrow Tours</option>
                        <option value="4">Oichi Builders</option>
                    </select>
                    <p name="delete_web_select" id="delete_web_select"></p>
                </div>
                <div class="form-group" id="file_upload">
                    <label for="file">Select File for Upload</label>
                    <input type="file" class="form-control-file"  name="file" id="file" required="">
                </div>
                <div class="form-group">
                    <label for="img_desc">Image Description</label>
                    <textarea class="form-control" name="img_desc" id="img_desc" rows="3"  required="" placeholder="Caption or description for the image"></textarea>
                    <p name="delete_img_desc" id="delete_img_desc"></p>
                </div>
                <div class="form-group" id="file_upload">
                    <label for="delete_file">File for Delete</label>
                    <div class="col">
                        <img src="" class="img-fluid" name="delete_file" id="delete_file">
                    </div>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-warning">Go</button>
            </form>
        </div>
        
        <div class="col-md-9 col-sm-12">
            <div class="row">
                <?php if(sizeof($data)>0){ foreach ($data as $key => $value) { ?>
                    <div class="col-md-3 col-xs-6">
                        <div class="card card-height">
                            <div class="card-image">
                                <img class="card-img-top" src='uploads/<?php echo $value["image"]; ?>' alt="Image">
                            </div>
                            <div class="card-body text-center" style="background-color: #0c5460e3; color: #FFF">
                                <!-- <h5 class="card-title"><?php //echo $value["title"]; ?></h5> -->
                                <p class="card-text"><?php echo $value["title"]; ?></p>
                                <a href="#" class="btn btn-danger text-center" onClick=viewImage("<?php echo $value['id']; ?>"); 
                                data-toggle="modal" data-target="#exampleModal">View</a>
                                <a href="#" class="btn btn-primary text-center edit" onClick=selectImage("<?php echo $value['id']; ?>");>Select</a>
                            </div>
                        </div>
                    </div>
                    <textarea style="display:none;" id="<?php echo $value['id']; ?>"><?php echo json_encode($value);?></textarea>
                <?php }}else{ echo "<h1>No record for display</h1>"; }?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content col-xs-12">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="modal_img" src="" class="img-fluid">
        <hr>
        <p id="modal_img_desc" style="text-align: justify;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#add').click(function(){
            $('#upload-div').hide();
            $('#upload-div').fadeIn();
            document.getElementById('submit').value = "add";
            document.getElementById('mode').innerHTML = "Insert";
            document.getElementById('file').required = true;

            document.getElementById('id').value = "";
            document.getElementById('img_title').value = "";
            document.getElementById('web_select').value = "";
            document.getElementById('img_desc').innerHTML = "";
            
            showInputFields();
        });
        $('#delete').click(function(){
            $('#upload-div').hide();
            $('#upload-div').fadeIn();
            document.getElementById('file').required = false;
            document.getElementById('submit').value = "delete";
            document.getElementById('mode').innerHTML = "Delete";

            // document.getElementById('id').value = data['id'];
            document.getElementById('img_name').style.display = "none";
            document.getElementById('img_title').style.display = "none";
            document.getElementById('web_select').style.display = "none";
            document.getElementById('img_desc').style.display = "none";
            document.getElementById('file').style.display = "none";
            
            document.getElementById('delete_img_title').style.display = "block";
            document.getElementById('delete_web_select').style.display = "block";
            document.getElementById('delete_img_desc').style.display = "block";
            document.getElementById('delete_file').style.display = "block";
        });

        $('#edit').click(function(){
            $('#upload-div').hide();
            $('#upload-div').fadeIn();
            document.getElementById('file').required = false;
            document.getElementById('submit').value = "edit";
            document.getElementById('mode').innerHTML = "Edit";

            showInputFields();
        });
    });

    function showInputFields(){
        document.getElementById('img_title').style.display = "block";
        document.getElementById('web_select').style.display = "block";
        document.getElementById('img_desc').style.display = "block";
        document.getElementById('file').style.display = "block";
        
        document.getElementById('delete_img_title').style.display = "none";
        document.getElementById('delete_web_select').style.display = "none";
        document.getElementById('delete_img_desc').style.display = "none";
        document.getElementById('delete_file').style.display = "none";
    }

    function viewImage(id){
        var data = document.getElementById(id).innerHTML;
        data = JSON.parse(data);
        document.getElementById('modal_title').innerHTML = data['title'];
        document.getElementById('modal_img').src = "uploads/"+data['image'];
        document.getElementById('modal_img_desc').innerHTML = data['description'];
    }

    function selectImage(id){
        var data = document.getElementById(id).innerHTML;
        data = JSON.parse(data);
        document.getElementById('id').value = data['id'];
        document.getElementById('img_name').value = data['image'];
        document.getElementById('img_title').value = data['title'];
        document.getElementById('web_select').value = data['web_id'];
        document.getElementById('img_desc').innerHTML = data['description'];
        
        document.getElementById('delete_img_title').innerHTML = data['title'];
        document.getElementById('delete_web_select').innerHTML = data['web_id'];
        document.getElementById('delete_img_desc').innerHTML = data['description'];
        document.getElementById('delete_file').src = 'uploads/'+data['image'];
    }
</script>

</body>
</html>