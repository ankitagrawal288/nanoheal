<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>
<br><br>
<div class="row"  style="text-align:right; padding-right:50px;">
<a href="<?php echo base_url('add-image');?>" class="btn btn-primary">Add Image</a>
<a href="<?php echo base_url('logout');?>" class="btn btn-danger">Logout</a>
</div>
<h2>List of Images and Thumbnail with Meta Data</h2>

<div style="overflow-x:auto;">
  <table>
    <thead>
    <tr>
      <th>Sr. No.</th>
      <th>Image Name</th>
      <th>Size</th>
      <th>Image Type</th>
      <th>Date Added</th>
      <th>Thumbnail Image Name</th>
      <th>Thumbnail Image</th>
      <th>Thumbnail Size</th>
      <th>Thumbnail Image Type</th>
      <th>Thumbnail Date Added</th>
      <th> Added By</th>
      <th> Action</th>
    </tr>
    </thead>
    <tbody>
        <?php 
        if(isset($image_data) && count($image_data) > 0)
        { 
            $i=1;
            foreach($image_data as $value){
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $value->image_name;?></td>
                <td><?php echo $value->image_size.' MB';?></td>
                <td><?php echo $value->image_type;?></td>
                <td><?php echo $value->image_added;?></td>
                <td><?php echo $value->thumbnail_name;?></td>
                <td><?php 
                    if($value->thumbnail_name != "")
                    {?>
                        <img src="<?php echo base_url('image/thumbnail/').$value->thumbnail_name;?>" />
                    <?php }
                ?></td>
                <td><?php echo $value->thumbnail_size.' MB';?></td>
                <td><?php echo $value->thumbnail_type;?></td>
                <td><?php echo $value->thumbnail_added;?></td>
                <td><?php echo ucfirst($value->first_name.' '.$value->last_name);?></td>
                <?php
                    if($value->user_role == '1')
                    { ?>
                    <td>
                        <a href="<?php echo base_url('delete/').$value->image_id;?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                <?php }
                ?>
            </tr>
        <?php $i++; } }
        ?>
    </tbody>
    
    </table>
</div>

</body>
</html>
