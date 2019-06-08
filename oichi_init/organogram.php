<?php include "header.php";?>

<script>
    $(document).ready(function(){
        $('#dropdownMenuButton').addClass('active');
        $('#organogram').addClass('active');
    });
</script>

<style>
	.padding{
		padding: 50px;
	}
</style>

<div class="continer">
	<div class="row padding">
		<div class="col">
			<h1 class="text-center text-secondary">COMPANY ORGANOGRAM</h1>
			<img src="image/organogram.png" class="padding img-fluid img-thumbnail mx-auto d-block" alt="Organogram of Oichi International">
		</div>
	</div>
</div>

<?php include "footer.php";?>