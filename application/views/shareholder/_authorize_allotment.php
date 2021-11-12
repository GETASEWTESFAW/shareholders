<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
if (isset($this->session->userdata['logged_in'])) {
$username = $this->session->userdata['logged_in']['username'];
$role = $this->session->userdata['logged_in']['role'];  
} 
?> 
<?php if(isset($_GET['authorize'])){ ?>

<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Success!</b> Allotment Authorized Successfully!.
</div>

<?php } ?>
<?php

if(isset($_GET['reject'])){

?>

<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Success!</b> Allotment Rejected Successfully!.
</div>

<?php } ?>

<!-- Main content -->
<section class="content">
<div class="row" style="width:100%">
<div class="col-xs-12">
<div class="box">

<div class="box-body table-responsive">
<form action="" method="POST">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th></th>
<th>No.</th>
<th>Account no</th>
<th>Shareholder Name</th>
<th>Start date</th>
<th>Due date</th>
<th>Alloted Amount</th>

</tr>
</thead>
<tbody>
<?php

$query = mysqli_query($conn,"SELECT * from allotment where 
allot_status = 'pending'") or die(mysqli_error($conn));

$a = 0;

while ($rows = mysqli_fetch_array($query)) {
$a = $a + 1;

$id = $rows['id'];
$account_no = $rows['account_no'];
$query2 = mysqli_query($conn,"SELECT * from shareholders where account_no = '$account_no'") or die(mysqli_error($conn));
$rows2 = mysqli_fetch_array($query2);
?>
<tr>

<td><input type="checkbox" name="id[]" value="<?php echo $rows['id'];?>"></td>

<td><?php echo $a; ?></td>
<td><?php echo $rows['account_no']; ?></td>
<td><?php echo $rows2['name']; ?></td>
<td><?php echo $rows['allot_year']; ?></td>
<td><?php echo $rows['due_date']; ?></td>
<td><?php echo $rows['allotment']; ?></td>


<input type="hidden" name="allot_year[]" value="<?php echo $rows['allot_year']; ?>">
<input type="hidden" name="name[]" value="<?php echo $rows2['name']; ?>">
<input type="hidden" name="allotment[]" value="<?php echo $rows['allotment']; ?>">
<input type="hidden" name="account_no[]" value="<?php echo $rows['account_no']; ?>">
<input type="hidden" name="due_date[]" value="<?php echo $rows['due_date']; ?>">

<?php } ?>

</tr>

</tbody>
                            
<?php if($role == 'Authorizer'){ ?>      

<fieldset>
<button type="submit" name="authorize" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Authorize</button>
<button type="submit" name="reject" class="btn btn-danger"><i class="glyphicon glyphicon-ok"></i> Reject</button>
</fieldset>
<?php } ?>        <br><br>
</table>

<?php 

if (isset($_POST['authorize'])) {

if(!isset($_POST['id'])){

echo '<script>alert("Either data not selected or no data to authorize !");</script>';
} else{

$id = $_POST['id'];

foreach ($_POST['id'] as $ids) {

$query_allot = mysqli_query($conn,"SELECT * from allotment where 
allot_status = 'pending' AND id = '$ids'") or die(mysqli_error($conn));

$row_allot = mysqli_fetch_array($query_allot);

$allotment = $row_allot['allotment'];
$account_no = $row_allot['account_no'];      

$result = mysqli_query($conn,"UPDATE allotment SET allot_status = 'authorized' where id='$ids'") or die(mysqli_error($conn));

header('location:http://172.23.2.174/shareholder/shareholder/authorize_allotment?authorize=ok');

}
}
}
?>


<?php 
/*
if (isset($_POST['authorize'])){

$N = count($_POST['applist']);

$id = $_POST['applist'];

$account_no = $_POST['selector'];

for($i=0; $i < $N; $i++)
{

$query_cap = mysqli_query($conn,"SELECT * from capitalized where 
capitalized_status = 'pending' and type = 'cash' AND id = '$id[$i]'") or die(mysqli_error($conn));

$row_cap = mysqli_fetch_array($query_cap);

$capitalized_in_birr = $row_cap['capitalized_in_birr'];        


$result1 = mysqli_query($conn,"UPDATE shareholders set total_paidup_capital_inbirr = total_paidup_capital_inbirr + '$capitalized_in_birr' where account_no='$account_no[$i]'") or die(mysqli_error($conn));

$result = mysqli_query($conn,"UPDATE capitalized SET capitalized_status = 'authorized' where id='$id[$i]'");

header('location:http://172.23.2.174/shareholder/shareholder/authorize_cashpayment?authorize=ok');

}
}
*/  ?>


<?php 

if (isset($_POST['reject'])){        

//$account_no = $_POST['selector'];
if(!isset($_POST['id'])){

echo '<script>alert("Either data not selected or no data to reject !");</script>';
} else{


foreach($_POST['id'] as $allot_del){ 

$id = array();
array_push($id, $allot_del);

$N = count($id);

$query_allot1 = mysqli_query($conn,"SELECT * from allotment where 
allot_status = 'pending' AND id = '$cap_del'") or die(mysqli_error($conn));

$row_allot1 = mysqli_fetch_array($query_allot1);
$allot_start_date = $row_allot1['allot_year'];
$allot_due_date = $row_allot1['due_date'];
$allotment1 = $row_allot1['allotment'];
$account_no1 = $row_allot1['account_no'];
$allot_name = $row_allot1['name'];
$rejected_by = $username; 
$rejected_date = date('Y-m-d');

for($i=0; $i < $N; $i++)
{   

$result_cap = mysqli_query($conn,"INSERT INTO rejected_allotment (account_no,name,allotment,allot_start_date,due_date,rejected_by,rejected_date) VALUES ('$account_no1','$name','$allotment1','$allot_start_date','$allot_due_date','$rejected_by','$rejected_date')") or die(mysqli_error($conn));

$result_delete = mysqli_query($conn,"DELETE FROM allotment WHERE allot_status = 'pending' AND id='$allot_del'") or die(mysqli_error($conn));

header('location:authorize_allotment?reject=true');

}
}
}
}
?>


</form> 
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>

</section><!-- /.content -->












