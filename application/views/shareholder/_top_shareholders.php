<?php

$conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {

$username = $this->session->userdata['logged_in']['username'];
$role = $this->session->userdata['logged_in']['role'];
} 
?> 
<script type="text/javascript">
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
	}
</script>
<script language="javascript" type="text/javascript">

function popitup(url) {
newwindow=window.open(url,'name','height=600,width=1300');
if (window.focus) {newwindow.focus()}
return false;
}
</script>

<?php
if(isset($_GET['active'])){
?>
<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Success!</b> Shareholder Released Successfully!.
</div>
<?php } ?>
<?php
if(isset($_GET['dividend'])){

?>
<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Success!</b> Dividend Capitalized!.
</div>

<?php } ?>
<section class="content invoice" style="overflow:hidden">
<div class="row no-print">
<div class="row">
<div class="col-xs-12">

<div class="box">
<br><br>

<form method="post" action="">
<div class="form-group" align="center">
<label>Enter the number to list top Shareholdes  </label>
<input type="text" name="top_number" required onKeyPress="return event.charCode > 47 && event.charCode < 58;" autofocus value="<?php echo set_value('top_number'); ?>" placeholder="Enter ..."/>
<button type="submit" name="search" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search </button></div>
</form>
<?php //echo form_error('top_number'); ?>
</div>                       
<!-- Main content -->

</div>
</div>              
</div> 
<div class="row" style="width:100%">
<div class="col-xs-12">
	 
<div class="print_cont">

<div class="box-body table-responsive">
<form action="" method="POST">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th></th>

<th>No.</th>

<th>Account number</th>
<th>Shareholder Name</th>
<th>Total share subscribed</th>
<th>Total paid up capital in birr</th>
<th>Percent</th>
</tr>
</thead>
<tbody>
<?php

$month = 7; $year = date('Y')-20;
$from = date("Y-m-t", mktime(0, 0, 0, $month - 1, 1, $year));

$month = 8; $year = date('Y');
$to = date("Y-m-d", mktime(0, 0, 0, $month - 1, 1, $year));
?>
<?php

if(isset($_POST['search'])){

$top_number = $_POST['top_number'];
$query = mysqli_query($conn,"SELECT shareholders.total_share_subscribed,shareholders.total_paidup_capital_inbirr,shareholders.account_no,
shareholders.name,allotment.allotment_update 
					  FROM shareholders 
					  LEFT JOIN allotment ON shareholders.account_no = allotment.account_no 
					  ORDER BY shareholders.total_share_subscribed + allotment.allotment_update DESC 
LIMIT 0 ,$top_number") or die(mysqli_error($conn));

$a = 0;
                                                                             
$subscribe = mysqli_query($conn,"SELECT sum(total_share_subscribed) from shareholders where (year BETWEEN '$from' and '$to')") or die(mysqli_error($conn));
$subscribe_total = mysqli_fetch_array($subscribe);
$total_subscribed_share = $subscribe_total['sum(total_share_subscribed)'];
 
$allot_total = mysqli_query($conn,"SELECT sum(allotment_update) from allotment where (allot_year BETWEEN '$from' and '$to')") or die(mysqli_error($conn));
$allot_total_data = mysqli_fetch_array($allot_total);
$total_allot = $allot_total_data['sum(allotment_update)'];




while ($rows = mysqli_fetch_array($query)) {

$acct = $rows['account_no'];                                          
$query2 = mysqli_query($conn,"SELECT * from allotment where account_no = '$acct' and (allot_year BETWEEN '$from' and '$to') order by id ASC") or die(mysqli_error($conn));
$rows2 = mysqli_fetch_array($query2);
if($rows2){
	
$a = $a + 1;
$denuminator = $total_allot + $total_subscribed_share;

?>
<tr>

<td></td>
<td><?php echo $a; ?></td>
<td><?php echo $rows['account_no']; ?></td>
<td><?php echo $rows['name']; ?></td>
<td><?php echo number_format($rows['total_share_subscribed'] + $rows2['allotment_update']); ?></td>
<td><?php echo number_format($rows['total_paidup_capital_inbirr']); ?></td>
<td><?php echo round(((($rows['total_share_subscribed'] + $rows2['allotment_update'])/$denuminator)*100),2); ?> % </td>

<?php }}} ?>

</tr>
</tbody>

</table>
</form> 
</div><!-- /.box-body -->
<div class="row no-print">
<div class="col-xs-12">
   <button class="btn btn-default" onclick="window.print();"> Print</button>
</div>
</div>		
</section><!-- /.content -->

