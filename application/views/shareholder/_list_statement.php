<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
if (isset($this->session->userdata['logged_in'])) {

$username = $this->session->userdata['logged_in']['username'];

} 
?> 
<?php
if(isset($_GET['acct'])){
$account = $_GET['acct'];
}

if(isset($_GET['block'])){

?>
<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Success!</b> Shareholder Released Successfully!.
</div>

<?php } ?>
<!-- Main content -->
<section class="content invoice" style="overflow:hidden">                    
<!-- title row -->
<div class="row">
<div class="col-xs-12">
<h2 class="page-header">
<img src="<?php echo base_url();?>public/img/logo.jpg" alt=""> 

</h2>
</div>
<!-- /.col -->
</div>
<?php
if(isset($_GET['acct'])){                

$account = $_GET['acct'];               

$from = $_GET['from'];

$to = $_GET['to'];       

$year = date('Y');

$query = mysqli_query($conn,"SELECT * FROM shareholders WHERE account_no = '$account' group by name") or die(mysqli_error($conn));

$a = 0;

while ($rows = mysqli_fetch_array($query)) {

$a = $a + 1;

?>
<!-- info row -->
<div class="col-sm invoice-col" style="width:100%">

<address>
<strong>Name of Shareholder: <?php echo $rows['name']; ?></strong><br>
<strong>Account Number:: <?php echo $rows['account_no']; ?></strong>
</address>
</div>

<?php } ?>
<!-- Table row -->
<div class="row">
<div class="col-xs-12 table-responsive">
<table id="" class="table table-bordered table-striped">
<thead>
<tr>
<th></th>
<th>Date</th>
<th>Particular</th>
<th>Debit</th>
<th>Credit</th>
<th>Balance</th>

</thead>
<tbody>
<tr align="right">
<td></td>
<td></td>
<td>Balance Forward</td>
<td></td>
<td></td>
<td>

<?php

$query1 = mysqli_query($conn,"SELECT * from balance where account_no = '$account'") or die(mysqli_error($conn));

$row_balance = mysqli_fetch_array($query1);

echo number_format($row_balance['total_paidup_capital_inbirr'],2);

//while ($rows1 = mysqli_fetch_array($query1)) {                                           

$query2 = mysqli_query($conn,"SELECT * from capitalized where account_no = '$account' AND capitalized_status = 'authorized' order by value_date ASC") or die(mysqli_error($conn));

$sum1 = 0;

while ($rows_cap = mysqli_fetch_array($query2)) {


?>

</td>
</tr>
<tr align="right">
<td></td>

<td><?php echo $rows_cap['value_date'];?></td>

<td><?php echo $rows_cap['type'];?></td>

<td></td>

<td><?php echo number_format($rows_cap['capitalized_in_birr'],2); ?></td>

<?php 

$balance = $row_balance['total_paidup_capital_inbirr'] + $rows_cap['capitalized_in_birr'];

$sum1 = $rows_cap['capitalized_in_birr'] + $row_balance['total_paidup_capital_inbirr'] + $sum1;

?>

<td> <?php echo number_format($sum1,2);

$sum1 = $sum1 - $row_balance['total_paidup_capital_inbirr'];


?></td>

<input type="hidden" name="registration_no" value="<?php //echo $rows['registration_no']; ?>">

<input type="hidden" name="full_name" value="<?php echo $rows_cap['name']; ?>">

<?php } //} ?>

</tr>
<?php

$account = $_GET['acct'];

$query3 = mysqli_query($conn,"SELECT * from balance where account_no = '$account'") or die(mysqli_error($conn));

while ($rows2 = mysqli_fetch_array($query3)) {

$query4 = mysqli_query($conn,"SELECT * from transfer where raccount_no = '$account' AND status_of_transfer = 'authorized' order by value_date ASC") or die(mysqli_error($conn));

while ($rows_trans = mysqli_fetch_array($query4)) {                                                       

?>                                                        

<tr align="right">


<td>
</td>

<td><?php echo $rows_trans['value_date'];?></td>

<td><?php echo "Transfer";?></td>

<?php  ?>

<td></td>

<td> 

<?php echo number_format($rows_trans['total_share_transfered_in_birr'],2); 

$sum1 = $rows2['total_paidup_capital_inbirr'] + $sum1;

?>

<?php //echo "<h1>".$sum1."</h1>";

$sum1 = $sum1 + $rows_trans['total_share_transfered_in_birr'];


?></td>

<td>

<?php 
echo number_format($sum1,2);
$sum1 = $sum1 - $rows2['total_paidup_capital_inbirr']; ?></td>


<?php }  } ?>
</tr> 
<?php

$account = $_GET['acct'];

$query3 = mysqli_query($conn,"SELECT * from balance where account_no = '$account'") or die(mysqli_error($conn));

$rows2 = mysqli_fetch_array($query3);                                        

$query4 = mysqli_query($conn,"SELECT * from transfer where account_no = '$account' AND status_of_transfer = 'authorized'") or die(mysqli_error($conn));

while ($rows_trans = mysqli_fetch_array($query4)) { 

?>                                                

<tr align="right">

<td></td>

<td><?php echo $rows_trans['value_date'];?></td>

<td><?php echo "Transfer";?></td>

<?php  ?>

<td><?php echo number_format($rows_trans['total_share_transfered_in_birr'],2); 

$sum1 = $rows2['total_paidup_capital_inbirr'] + $sum1;

?>

<td> <?php //echo "<h1>".$sum1."</h1>";

$sum1 = $sum1 - $rows_trans['total_share_transfered_in_birr'];
$sum1 = abs($sum1);
?></td>

<td>

<?php 
echo number_format($sum1,2);
$sum1 = $sum1 - $rows2['total_paidup_capital_inbirr']; ?></td>


<?php

} } ?>
</tr>




</tbody>
</table>                            
</div><!-- /.col -->
</div><!-- /.row -->

<!-- this row will not appear when printing -->
<div class="row no-print">
<div class="col-xs-12">
<button class="btn btn-default" onclick="window.print();"> Print</button>

</div>
</div>
</section><!-- /.content -->
