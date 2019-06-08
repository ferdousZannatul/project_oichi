<?php 
include 'header.php';
include "data.php";

$data = json_decode(get_image_by_web_id(1),true);
?>
<link rel="stylesheet" href="css/view.css">

<div class="space">
<div class="container">
  <div class="text-center">
    <h1>Image Gallary</h1><hr>
  </div>
	<div class="col">
        <div class="row">
            <?php if(sizeof($data)>0){ foreach ($data as $key => $value) { ?>
                <div class="col-md-3">
                    <div class="card card-height">
                        <div class="card-image">
                            <img class="card-img-top" src='uploads/<?php echo $value["image"]; ?>' alt="Image">
                        </div>
                        <div class="card-body text-center" style="background-color: #0c5460e3; color: #FFF">
                            <!-- <h5 class="card-title"><?php //echo $value["title"]; ?></h5> -->
                            <p class="card-text"><?php echo $value["title"]; ?></p>
                            <a href="#" class="btn btn-danger text-center" onClick=viewImage("<?php echo $value['id']; ?>"); 
                            data-toggle="modal" data-target="#exampleModal">View</a>
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

<script>
    $(document).ready(function(){
        $('#img_gallary').addClass('active');
    });

  function viewImage(id){
      var data = document.getElementById(id).innerHTML;
      data = JSON.parse(data);
      document.getElementById('modal_title').innerHTML = data['title'];
      document.getElementById('modal_img').src = "uploads/"+data['image'];
      document.getElementById('modal_img_desc').innerHTML = data['description'];
  }
</script>
<?php include 'footer.php';?>