<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <style type="text/css">
    .error{ color:red; }
  </style>
</head>
<body>
  <div class="container">
    <br><br><br>
    <?php echo $this->session->flashdata('msg');?>
    <div class="row">
      <div class="col-md-10"><center><h2>Login</h2></center></div>
    </div>
    <form id="login" name="login" method="post" action="<?php echo base_url('do_login');?>" >
     <div class="row">
      <div class="col-md-3">
        <label>Email:</label>
      </div>
      <div class="col-md-9">
        <input type="text" name="email" id="email" class="form-control" placeholder="enter email address">
      </div>
    </div><br>
    <div class="row">
      <div class="col-md-3">
        <label>Password:</label>
      </div>
      <div class="col-md-9">
       <input type="password" name="password" id="password" class="form-control" placeholder="enter password">
     </div>
   </div><br>
   <div class="row" align="center">
     <input type="submit" name="login_btn" class="btn btn-success" value="Login" >
     <input type="reset" name="rest" class="btn btn-danger" value="Reset" >
   </div>
 </form>
</div>
</body>

<!-- <script type="text/javascript">
  /* Validation front end */
  $(document).ready(function () {
    $("#login").validate({
      rules: {
        'email': {
          required: true,
          email:true, 
        },
        'password': {
          required: true,
          minlength:1,
          maxlength:30,
        },
      },
    });
  });
</script>
<script type="text/javascript">
  setInterval(function () {
    $(".alert").hide(); 
  },5000);
</script> -->
</html>
