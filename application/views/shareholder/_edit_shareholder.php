<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
if (isset($this->session->userdata['logged_in'])) { 
$username = $this->session->userdata['logged_in']['username'];
$role = $this->session->userdata['logged_in']['role'];

} 
?>
<!-- general form elements disabled -->
<div class="box box-warning">
<div class="col-md-12">
<?php
if(isset($_GET['dividend'])){
?>
<div class="alert alert-success alert-dismissable">
      <i class="fa fa-ban"></i>
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <b>Success!</b> Data edited Succesfully!.
  </div>
<?php } ?>

<?php if(isset($_GET['edit'])){ ?>

<div class="alert alert-success alert-dismissable" role="alert">
   Shareholder data edited succesfully
</div>

<?php } ?>
<div class="box-body">
       <!-- display message -->

<?php if($this->session->flashdata('flashError')): ?>

<p class='flashMsg flashError alert alert-danger alert-dismissable'> <?php echo $this->session->flashdata('flashError')?> </p>
<?php endif ?>

<form action="" method="POST" role="form">

<?php 

$id = $_GET['di'];

$query = mysqli_query($conn,"SELECT * from shareholders WHERE id = '$id'")or die(mysqli_error($conn));; 

while($row = mysqli_fetch_array($query)){

?>
<div class="col-sm-6">                                           
    
<?php if($role == "Authorizer"){ ?>
      <div class="form-group">
          <label>Shareholder Full names</label>
          <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('name'); ?>
      </div>
      <div class="form-group">
          <label>Total Share Subscribed</label>
          <input type="text" name="total_share_subscribed" class="form-control" value="<?php echo $row['total_share_subscribed']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('total_share_subscribed'); ?>
      </div>
     <div class="form-group">
          <label>Total Paidup </label>
          <input type="text" name="total_paidup" class="form-control" value="<?php echo $row['total_paidup_capital_inbirr']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('total_paidup_capital_inbirr'); ?>
      </div>
      <?php } else { ?>
       <div class="form-group">
          <label>Shareholder Full names</label>
          <input type="text" readonly name="name2" class="form-control" value="<?php echo $row['name']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('name'); ?>
      </div>
      <?php } ?>
    <div class="form-group">
          <label>City </label>
          <input type="text" name="city" class="form-control" value="<?php echo $row['city']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('city'); ?>
      </div>
         <div class="form-group">
          <label>Sub City </label>
          <input type="text" name="sub_city" class="form-control" value="<?php echo $row['sub_city']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('sub_city'); ?>
      </div>

      <div class="form-group">
          <label>Woreda</label>
          <input type="text" name="woreda" class="form-control" value="<?php echo $row['woreda']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('woreda'); ?>
      </div>
      <div class="form-group">
          <label>House Number</label>
          <input type="text" name="house_no" class="form-control" value="<?php echo $row['house_no']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('house_no'); ?>
      </div>
      <div class="form-group">
        <label>Share Type </label>
            <select name="share_type" class="form-control" required>
              <option value="Individual">Individual</option>
              <option value="company">Company</option>
              <option value="church">Church</option>
              <option value="edir">Edir</option>
              <option value="Ngo">NGO</option>
            </select>
        <?php echo form_error('share_type'); ?>
    </div>

    </div>
     
    <div class="col-sm-6"> 
           <div class="form-group">
          <label>P.O.Box</label>
          <input type="text" name="pobox" class="form-control" value="<?php echo $row['pobox']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('pobox'); ?>
      </div>
          <div class="form-group">
          <label>Telephone Residence</label>
          <input type="text" name="telephone_residence" class="form-control" value="<?php echo $row['telephone_residence']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('telephone_residence'); ?>
      </div>
         <div class="form-group">
          <label>Telephone Office</label>
          <input type="text" name="telephone_office" class="form-control" value="<?php echo $row['telephone_office']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('telephone_office'); ?>
      </div>
      <div class="form-group">
          <label>Mobile</label>
          <input type="text" name="mobile" class="form-control" value="<?php echo $row['mobile']; ?>" placeholder="Enter ..."/>
    <?php echo form_error('mobile'); ?>
      </div>

       <input type="hidden" value="<?php echo $row['id']; ?>" name="id" class="form-control"/>

     <div class="box-footer">
      <button type="submit" name="submit" class="btn btn-primary">Update</button>
  </div>
 </div>  
       <?php   } ?> 
</form>

</div><!-- /.box-body -->
</div>
</div>
<?php if($role == 'user') { ?>
<?php if(isset($_POST['submit'])){

$city = $_POST['city'];
$sub_city = $_POST['sub_city'];
$woreda = $_POST['woreda'];
$house_no = $_POST['house_no'];
$pobox = $_POST['pobox'];
$telephone_residence = $_POST['telephone_residence'];
$telephone_office = $_POST['telephone_office'];

$mobile = $_POST['mobile'];
$id = $_POST['id']; 

$query = mysqli_query($conn,"UPDATE shareholders 
            SET 
              city = '$city',
              sub_city = '$sub_city',
              woreda = '$woreda',
              house_no = '$house_no',
              pobox = '$pobox',
              telephone_residence = '$telephone_residence',
              telephone_office = '$telephone_office',
              mobile = '$mobile'                                                
            WHERE 
              id = '$id'"
              );
header("location:http://172.23.2.174/shareholder/shareholder/edit_shareholder?di=".$id."&edit=okay");
   
}} else { ?>

<?php if(isset($_POST['submit'])){

$total_share_subscribed = $_POST['total_share_subscribed'];
$total_paidup = $_POST['total_paidup'];
$name = $_POST['name'];
$city = $_POST['city'];
$sub_city = $_POST['sub_city'];
$woreda = $_POST['woreda'];
$share_type = $_POST['share_type'];
$house_no = $_POST['house_no'];
$pobox = $_POST['pobox'];
$telephone_residence = $_POST['telephone_residence'];
$telephone_office = $_POST['telephone_office'];

$mobile = $_POST['mobile'];
$id = $_POST['id']; 

$query = mysqli_query($conn,"UPDATE shareholders 
            SET 
              name = '$name',
              total_share_subscribed = '$total_share_subscribed',
              total_paidup_capital_inbirr = '$total_paidup',
              city = '$city',
              sub_city = '$sub_city',
              woreda = '$woreda',
              house_no = '$house_no',
              pobox = '$pobox',              
              share_type = '$share_type',
              telephone_residence = '$telephone_residence',
              telephone_office = '$telephone_office',
              mobile = '$mobile'                                                
            WHERE 
              id = '$id'"
              );
header("location:http://172.23.2.174/shareholder/shareholder/edit_shareholder?di=".$id."&edit=okay");
  } } 
?>