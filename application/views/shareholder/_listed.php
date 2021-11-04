<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
if (isset($this->session->userdata['logged_in'])) {    
$username = $this->session->userdata['logged_in']['username'];
$role = $this->session->userdata['logged_in']['role'];

} 
?> 
<style type="text/css">
#homepage_search{
margin-left: 400px;
}
#homepage_search_btn{
margin-left:200px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
$("#myRelease").modal('show');
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#myPledged").modal('show');
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#myReleaseblock").modal('show');
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#myModal").modal('show');
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#myAuthorize").modal('show');
});
</script>

<div id="myModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Info</h4>
</div>
<div class="modal-body">
<div class="alert alert-danger alert-dismissable" role="alert" align="center">

You can't transfer Share , Shareholder Blocked!                        
</div>                
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<div id="myAuthorize" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Info</h4>
</div>
<div class="modal-body">
<div class="alert alert-danger alert-dismissable" role="alert" align="center">

Authorize the transfer first.                       
</div>                
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<div id="myReleaseblock" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Info</h4>
</div>
<div class="modal-body">
<div class="alert alert-danger alert-dismissable" role="alert" align="center">

Blocked Request waiting for Authorization                        
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<div id="myRelease" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Info</h4>
</div>
<div class="modal-body">
<div class="alert alert-danger alert-dismissable" role="alert" align="center">

Pledged Release waiting for Authorization

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<?php

if(isset($_GET['release_blocked_share'])){

?>

<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Request sent to authorization</a>
</div>

<?php } ?>
<div id="myPledged" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Info</h4>
</div>
<div class="modal-body">
<div class="alert alert-danger alert-dismissable" role="alert" align="center">

You can't pledge Share , Shareholder Blocked!

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>
<script language="javascript" type="text/javascript">

function popitup(url) {
newwindow=window.open(url,'name','height=600,width=1300');
if (window.focus) {newwindow.focus()}
return false;
}

// -->
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

if(isset($_GET['blocked'])){

?>

<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Success!</b> Shareholder Blocked Successfully!.
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
<?php if($role == 'user'){?>
<!-- Main content -->
<div id="createshareholder"><a href="<?php echo base_url();?>shareholder/choose_shareholder" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Shareholder</a></div>
<?php } ?>
<?php

/*$query = mysqli_query($conn,"SELECT *,count(id) from shareholders where status = 'active'") or die(mysqli_error($conn));

while($row = mysqli_fetch_array($query)){*/

?>

<?php //echo $row['count(id)']; } ?>

<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="col-xs-2">

<form method="POST" action="<?php echo base_url('');?>shareholder/shareholder_excel" id="form">

<button id="submit" class="btn btn-success" name="save"><i class="icon-download icon-large"></i>Download Shareholder Data</button>

</form>
</div>
<div id="homepage_search">

<form method="post" action=""><br>

<?php echo $this->load->view('shareholder/year1'); ?><br>                          

<div class="col-xs-6">
<label for="ex3">Please Enter Account No or Shareholder name </label>
<input class="form-control" id="ex3" type="text" name="key"><br/>
<button type="submit" name="search" id="homepage_search_btn" class="btn btn-primary btn-sm">Search</button>

</div>
<div class="col-xs-6">
</div>                           

</form>

</div>

<div class="box-body table-responsive">
<form action="" method="POST">                               

<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
    <th></th>                                              
    <th>No.</th>                                               
    <th>Account number</th>
    <th>Shareholder Name</th>
    <th>Total share subscribed</th>
    <th>Total paid up capital in birr</th>
    <th></th>
        <?php if($role == 'Authorizer'){?>
    <th></th>
    <th></th>
    <th></th>
        <th></th>                                                 
    <?php } ?>
    <?php if($role == 'user'){?>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <?php } ?>
    </tr>
</thead>
<tbody>

<?php

if(isset($_POST['search'])){

$year = date('Y');

$budget_query = mysqli_query($conn,"SELECT * FROM budget_year_status WHERE budget_status = 'active'");
$budget_result = mysqli_fetch_array($budget_query);

$from="";
$to="";
if($budget_result){
$from = $budget_result['budget_from'];
$to = $budget_result['budget_to'];
}

$key = $_POST['key'];
$query="";
if($key){
$query = mysqli_query($conn,"SELECT * from shareholders where status_of_new_share = 'active' AND status = 'active' AND name LIKE '$key%' || account_no LIKE '$key%'") or die(mysqli_error($conn));
}else{
    $query = mysqli_query($conn,"SELECT * from shareholders where status_of_new_share = 'active' AND status = 'active'") or die(mysqli_error($conn));
    
}
$a = 0;

while ($rows = mysqli_fetch_array($query)) {
    
$a = $a + 1;

$acct = $rows['account_no'];

$query2 = mysqli_query($conn,"SELECT * from allotment where account_no = '$acct' order by id ASC") or die(mysqli_error($conn));

$rows2 = mysqli_fetch_array($query2);

?>
<tr>

<td></td>
    <td><?php echo $a; ?></td>
    
    <td><?php echo $rows['account_no']; ?></td>
    <td><?php echo $rows['name']; ?></td>
    <td><?php echo $rows2['allotment_update'] + $rows['total_share_subscribed']; ?></td>    
    <td><?php echo number_format($rows['total_paidup_capital_inbirr']); ?></td>  
    <td><a href="<?php echo base_url();?>shareholder/viewdetail?id=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to;?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/viewdetail?id=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to;?>')">View detail</td>
        
                                                        
    <?php if($role == 'user') { ?>
    <td>

        <?php

        if($rows['blocked_status'] == 'blocked') {

        ?>

        <a href="" data-toggle="modal" data-target="#myModal">Transfer</a>

        <?php } elseif($rows['total_share_subscribed'] == '0') { ?>

        Transfer

        <?php } elseif($rows['share_transfer_status'] == 'check transfer') { ?>
        
        <a href="" data-toggle="modal" data-target="#myAuthorize">Transfer</a>

        <?php } else { ?>
        
        <a href="<?php echo base_url();?>shareholder/transfer?id=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/transfer?id=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to; ?>')">Transfer</a>
    
    </td>
    
    <?php }} ?>
    <td>

        <?php if($rows['blocked_status'] == 'blocked'){ ?>
            <a href="<?php echo base_url();?>shareholder/blockconfirm?ids=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to;?>">
            <span class="badge bg-red"> blocked </span>
        </a>

    <?php
$account = $rows['account_no'];
$query_block = mysqli_query($conn,"SELECT *,count(id) from blocked where 
status = 'blocked' AND account_no = '$account'") or die(mysqli_error($conn));

while($blocked_row = mysqli_fetch_array($query_block)){

        if($blocked_row['count(id)'] > '0'){ ?>

        <a href="<?php echo base_url();?>shareholder/release_blocked_share?acct=<?php echo $rows['account_no']; ?>">
            <span class="badge bg-info"> release </span>
        </a>

<?php } else { ?> 

<a href="" data-toggle="modal" data-target="#myReleaseblock">
    <span class="badge bg-info"> Release </span>
</a>

<?php } } ?>


        <?php } elseif(($rows['total_share_subscribed'] == '0') || ($rows['share_transfer_status'] == 'check transfer')) { ?>
                Block
        <?php } elseif($role == 'Authorizer') { ?>
            block
        <?php }else{ ?> 

    <a href="<?php echo base_url();?>shareholder/blockconfirm?ids=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to;?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/blockconfirm?ids=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to;?>')" onClick="deleteImage(<?php echo $rows['id']; ?>)">
        block

    </a><?php }  ?>
        </td>
    <td>
        <?php if($rows['pledged_status'] == 'pledged' && $rows['blocked_status'] != 'blocked'){ ?>

        <a href="<?php echo base_url();?>shareholder/pledgeconfirm?id=<?php echo $rows['id']; ?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/pledgeconfirm?id=<?php echo $rows['id']; ?>')">
            <span class="badge bg-blue"> Pledge</span>
        </a>

<?php
$account = $rows['account_no'];
$query_pledge = mysqli_query($conn,"SELECT *,count(id) from pludge where 
pledged_status = 'pledged' AND account_no = '$account'") or die(mysqli_error($conn));

while($pledge_row = mysqli_fetch_array($query_pledge)){

if($pledge_row['count(id)'] > '0'){ ?>

<a href="<?php echo base_url();?>shareholder/release_pledge?acct_no=<?php echo $rows['account_no']; ?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/release_pledge?acct_no=<?php echo $rows['account_no']; ?>')">
<span class="badge bg-info"> Release</span>
</a>

<?php } else {?> 

<a href="" data-toggle="modal" data-target="#myRelease">
<span class="badge bg-info"> Release </span>
</a>

<?php } } ?>
    
<?php } elseif($rows['pledged_status'] == 'pledged' && $rows['blocked_status'] == 'blocked') { ?>

        <a href="" data-toggle="modal" data-target="#myPledged">
            <span class="badge bg-blue"> Pledged </span>
        </a>
<?php
$account = $rows['account_no'];
$query_pledge = mysqli_query($conn,"SELECT *,count(id) from pludge where 
pledged_status = 'pledged' AND account_no = '$account'") or die(mysqli_error($conn));

while($pledge_row = mysqli_fetch_array($query_pledge)){

        if($pledge_row['count(id)'] > '0'){ ?>

        <a href="<?php echo base_url();?>shareholder/release_pledge?acct_no=<?php echo $rows['account_no']; ?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/release_pledge?acct_no=<?php echo $rows['account_no']; ?>')">
            <span class="badge bg-info"> Release </span>
        </a>
        <?php } else { ?>

            <a href="" data-toggle="modal" data-target="#myRelease">
            <span class="badge bg-info"> Release </span>
        </a>

        <?php }} ?>
        
        <?php } elseif($rows['blocked_status'] == 'blocked') {

        ?>

        <a href="" data-toggle="modal" data-target="#myPledged">Pledge

        <?php } elseif(($rows['total_share_subscribed'] == '0') || ($rows['share_transfer_status'] == 'check transfer')) {?>
                Pledge
            <?php } else {  ?>

        <a href="<?php echo base_url();?>shareholder/pledgeconfirm?id=<?php echo $rows['id']; ?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/pledgeconfirm?id=<?php echo $rows['id']; ?>')">

        Pledge
    </a>

        <?php }  ?>

        </td>
        
    <td><a href="<?php echo base_url();?>shareholder/edit_shareholder?di=<?php echo $rows['id']; ?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/edit_shareholder?di=<?php echo $rows['id']; ?>')">Edit</a></td>
    
    <td><a href="<?php echo base_url();?>shareholder/statement?acct=<?php echo $rows['account_no']; ?>" oncontextmenu="return false;" onclick="return popitup('<?php echo base_url();?>shareholder/statement?acct=<?php echo $rows['account_no']; ?>&from=<?php echo $from; ?>&to=<?php echo $to;?>')">Statement</a></td>                                     
    <?php } } ?>
    
</tr>

</tbody>
<tfoot>
        <tr >
            <td></td>
            <td></td>
            <td></td>
            <td align="right">Total subscribed in birr</td>
            <td>
<?php
    if(isset($from) AND isset($to)){

    
    $subscribe = mysqli_query($conn,"SELECT sum(total_share_subscribed) from shareholders") or die(mysqli_error($conn));
    $subscribe_total = mysqli_fetch_array($subscribe);
    $allt = mysqli_query($conn,"SELECT *,sum(allotment) from allotment") or die(mysqli_error($conn));
    $allt_total = mysqli_fetch_array($allt);
    $total_subscr = ($allt_total['sum(allotment)']+$subscribe_total['sum(total_share_subscribed)'])*500;
    echo number_format($total_subscr,2);
}
?>
</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="right">Paid up capital</td>
            <td>
<?php
    
    if(isset($from) AND isset($to)){
    $subscribe = mysqli_query($conn,"SELECT sum(total_paidup_capital_inbirr) from shareholders") or die(mysqli_error($conn));
    $subscribe_total = mysqli_fetch_array($subscribe);
    echo number_format($subscribe_total['sum(total_paidup_capital_inbirr)'],2); 
}
?>
</td>
            <td> </td>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>                                                    
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="right">Unpaid balance</td>
            <td>
            <?php
if(isset($from) AND isset($to)){              
$subscribe = mysqli_query($conn,"SELECT sum(total_share_subscribed) from shareholders") or die(mysqli_error($conn));
$subscribe_total = mysqli_fetch_array($subscribe);
$total_subscribed_share = $subscribe_total['sum(total_share_subscribed)'];

$paid = mysqli_query($conn,"SELECT sum(total_paidup_capital_inbirr) from shareholders") or die(mysqli_error($conn));
$paid_total = mysqli_fetch_array($paid);
$total_paidup = $paid_total['sum(total_paidup_capital_inbirr)'];


$allot_total = mysqli_query($conn,"SELECT sum(allotment_update) from allotment") or die(mysqli_error($conn));
$allot_total_data = mysqli_fetch_array($allot_total);
$total_allot = $allot_total_data['sum(allotment_update)'];

$unpaid = ($total_allot + $total_subscribed_share)*500;
$unpaid_balance = $unpaid - $total_paidup;

echo number_format($unpaid_balance);
}
?>

</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>            
                                    
</tfoot>
</table>

</form> 
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>

</section><!-- /.content -->

