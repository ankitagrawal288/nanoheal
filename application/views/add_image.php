<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <style type="text/css">
    .error{ color:red; }
  </style>
</head>
<body>
  <div class="container">
  <br>
  <br>
    <?php echo $this->session->flashdata('msg');?>
    <div class="row">
      <div class="col-md-10"><center><h2>Home</h2></center></div>
      <div class="col-md-2"><a href="<?php echo base_url('logout');?>" class="btn btn-danger">Logout</a></div>
    </div>
        <form id="home" name="home" method="post" action="<?php echo base_url('add-image');?>" enctype="multipart/form-data" >
          <br>
          <div class="row">
            <div class="col-md-3">
              <label>Photo:</label>
            </div>
            <div class="col-md-9">
              <input type="file" name="image" id="image" placeholder="select file" class="form-control" />
            </div>
          </div>
          <br>
      <br>
      <div class="row" align="center">
        <input type="submit" name="save_btn" class="btn btn-success" value="Save" >
        <a href="<?php echo base_url('home');?>" class="btn btn-danger">List</a>
      </div>
    </form>
</div>
</body>
<script type="text/javascript">
  /* Validatio front end */
  $(document).ready(function () {
    $("#home").validate({
      rules: {
        'image': {
          required: true,
          extension: "png|jpeg|gif",
        },
      },
    });
  });
</script>
<script type="text/javascript">
  setInterval(function () {
    $(".alert").hide(); 
  },5000);
</script>

</html>
