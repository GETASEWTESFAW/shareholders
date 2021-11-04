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
<b>Success!</b> Shareholder Authorized Successfully!.
</div>

<?php } ?>
<?php if(isset($_GET['check'])){ ?>

<div class="alert alert-danger alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
You have to activate the shareholder first before authorizing the transfer!.
</div>

<?php } ?>

<?php if(isset($_GET['reject'])){ ?>

<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<b>Success!</b> Shareholder data deleted successfully!.
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
    <th></th>
    <th>No.</th>                                                
    <th>Account number</th>
    <th>Shareholder Name</th>
    <th>Total share subscribed</th>
    <th>Total paid up capital in birr</th>
    <th>city </th>
    <th>Sub city </th>
    <th>Woreda</th>
    <th>House no </th>
    <th>P.O.Box</th>
    <th>Telephone Residence</th>
    <th>Telephone Office</th>
    <th>Mobile</th>
    <th>Share type</th>
    <th>Member</th>
    <th>Reason</th>
    <th>Status</th>
    <th>Created by</th>
   </tr>
</thead>
<tbody>
<?php

$budget_query = mysqli_query($conn,"SELECT * FROM budget_year_status WHERE budget_status = 'active'");
$budget_result = mysqli_fetch_array($budget_query);
$from="";
$to="";
if($budget_result){
$from = $budget_result['budget_from'];
$to = $budget_result['budget_to'];
} 

$query = mysqli_query($conn,"SELECT * from shareholders where 
status_of_new_share = 'pending'") or die(mysqli_error($conn));

//$query = mysqli_query($conn,"SELECT * from shareholders where 
//status_of_new_share = 'pending' and (year BETWEEN '$from' and '$to')") or die(mysqli_error($conn));
$a = 0;

while ($rows = mysqli_fetch_array($query)) {
    $a = $a + 1;
    
?>
<tr>
    <td></td>
    <td><input type="checkbox" name="id[]" value="<?php echo $rows['id'];?>"></td>    
    <input type="hidden" readonly="" value="<?php echo date('Y-m-d');?>" name="data_authorization_date" class="form-control"/> 
    <input type="hidden" readonly="" value="<?php echo $username;?>" name="data_authorized_by" class="form-control"/> 
    <input type="hidden" name="from[]" value="<?php echo $_GET['from'];?>">
    <input type="hidden" name="to[]" value="<?php echo $_GET['to'];?>">
    <input type="hidden" name="account_no[]" value="<?php echo $rows['account_no'];?>">
    <input type="hidden" name="name[]" value="<?php echo $rows['name'];?>">

    <input type="hidden" name="total_paidup_capital_inbirr[]" value="<?php echo $rows['total_paidup_capital_inbirr'];?>">

    <td><?php echo $a; ?></td>   
    <td><?php echo $rows['account_no']; ?></td>
    <td><?php echo $rows['name']; ?></td>
    <td><?php echo $rows['total_share_subscribed']; ?></td>
    <td><?php echo $rows['total_paidup_capital_inbirr']; ?></td>                                                   
    <td><?php echo $rows['city']; ?></td>
    <td><?php echo $rows['sub_city']; ?></td>
    <td><?php echo $rows['woreda']; ?></td>   
    <td><?php echo $rows['house_no']; ?></td>    
    <td><?php echo $rows['pobox']; ?></td>
    <td><?php echo $rows['telephone_residence']; ?></td>
    <td><?php echo $rows['telephone_office']; ?></td>    
    <td><?php echo $rows['mobile']; ?></td>
    <td><?php echo $rows['share_type']; ?></td>    
    <td><?php echo $rows['member']; ?></td>   
    <td><?php echo $rows['remark']; ?></td>
    <td><?php
        if($rows['status'] == 'active'){

            ?>
            
            <span class="badge bg-blue"><?php echo $rows['status_of_new_share']; ?></span>
            
            <?php
            
        } else {
            
            ?>
            
            <span class="badge bg-red"><?php echo $rows['status_of_new_share']; ?></span>
            
            <?php
            
            }
            
            ?></td>

     <td><?php echo $rows['data_created_by'];?></td>
   <?php } ?>
   
</tr>

</tbody>
                                        
<?php if($role == 'Authorizer') { ?>      
<fieldset>
<button type="submit" name="authorize" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Authorize</button>
<button type="submit" name="reject" class="btn btn-danger"><i class="glyphicon glyphicon-ok"></i> Reject</button>
</fieldset>

<?php } ?>        <br><br>
</table>

<?php 

if (isset($_POST['authorize'])){

if(!isset($_POST['id'])){

    echo '<script>alert("Either data not selected or no data to authorize !");</script>';
} else{

$id=$_POST['id'];                                                                                                                                           
$from = $_POST['from'];

$to = $_POST['to'];
$name = $_POST['name'];

$year = date('Y');
$current_date = date('Y-m-d');


                                                        
foreach ($_POST['id'] as $ids) {

$query_acct = mysqli_query($conn,"SELECT account_no,name,total_share_subscribed,total_paidup_capital_inbirr from shareholders where id='$ids'");
$rows_acct = mysqli_fetch_array($query_acct);
$account_no = $rows_acct['account_no'];
$total_paidup_capital_inbirr = $rows_acct['total_paidup_capital_inbirr'];
$name = $rows_acct['name'];
$data_authorized_by = $_POST['data_authorized_by'];
$data_authorization_date = $_POST['data_authorization_date'];
$balance = 0;
echo "account number -".$account_no.'<br/>';
echo "name -".$name.'<br/>';
echo "total paid up capital in birr -".$total_paidup_capital_inbirr.'<br/>';
echo "balance - ".$balance.'<br/>';
echo "....................................".'<br/>';

$select_transfer = mysqli_query($conn,"SELECT * FROM transfer WHERE status_of_transfer = 'pending' AND raccount_no = '$account_no'") or die(mysqli_error($conn));
$transfer_num_rows = mysqli_num_rows($select_transfer);

if($transfer_num_rows > 0){

$transfer_from_nib = mysqli_query($conn,"UPDATE transfer SET status_of_transfer = 'authorized',authorized_by = '$username',rejected_authorized_date = '$current_date' WHERE raccount_no = '$account_no'") or die(mysqli_error($conn));
$result_share_transfer = mysqli_query($conn,"UPDATE shareholders SET share_transfer_status = '' WHERE account_no = '$account_no'") or die(mysqli_error($conn));
}

$result = mysqli_query($conn,"UPDATE shareholders SET status = 'active',status_of_new_share = 'active',data_authorization_date = '$data_authorization_date',data_authorized_by = '$data_authorized_by' where id='$ids'");
$balance = mysqli_query($conn,"INSERT INTO balance (name,account_no,total_paidup_capital_inbirr,year,budget_year_status,status) VALUES('$name','$account_no','$balance','$year','$current_date','active')");     
$allotment = mysqli_query($conn,"INSERT INTO allotment (account_no,allot_year,allotment,allotment_update) VALUES('$account_no','$current_date','0','0')");        

header("location:authorize_new_shareholder?authorize=true&from=".$from."&to=".$to."");

}
}
}
?>

<?php 

        if (isset($_POST['reject'])){        
            
            
            if(!isset($_POST['id'])){

     echo '<script>alert("Either data not selected or no data to reject !");</script>';
} else{
            $from = $_POST['from'];
            $to = $_POST['to'];


        foreach($_POST['id'] as $cap_del){ 

            $id = array();
            array_push($id, $cap_del);          
            $N = count($id);


            
            $query_new_share = mysqli_query($conn,"SELECT * from shareholders where 
            status_of_new_share = 'pending' AND id = '$cap_del'") or die(mysqli_error($conn));       
            $row_new_share = mysqli_fetch_array($query_new_share);
            $type_of_creation = $row_new_share['type_of_creation'];

            if($type_of_creation == 'zero_value'){

            $from = $_POST['from'];
            $to = $_POST['to'];   

            $result_delete = mysqli_query($conn,"DELETE FROM shareholders WHERE status_of_new_share = 'pending' AND id='$cap_del'") or die(mysqli_error($conn));
            header("location:authorize_new_shareholder?reject=true".$from."&to=".$to."");

            } else {
            $query_new_share = mysqli_query($conn,"SELECT * from shareholders where 
            status_of_new_share = 'pending' AND id = '$cap_del'") or die(mysqli_error($conn));       
            $row_new_share = mysqli_fetch_array($query_new_share);
            $account_no = $row_new_share['account_no'];
            
            //echo "account number".$account_no.'<br/>';                  
            
            $query_select_transfer = mysqli_query($conn,"SELECT * from transfer where 
            status_of_transfer = 'pending' AND raccount_no = '$account_no'") or die(mysqli_error($conn));
            $num = mysqli_num_rows($query_select_transfer);

            //echo "num rows".$num.'<br/>';
            
            if($num>0){

            $query_transfer = mysqli_query($conn,"DELETE FROM transfer where 
            status_of_transfer = 'pending' AND raccount_no = '$account_no'") or die(mysqli_error($conn));
           
            }            

            $result_delete = mysqli_query($conn,"DELETE FROM shareholders WHERE status_of_new_share = 'pending' AND id='$cap_del'") or die(mysqli_error($conn));
            header("location:authorize_new_shareholder?reject=true".$from."&to=".$to."");    

            }


           

    }
}
}
?>

<?php 
/*
if (isset($_POST['reject'])){

$from = $_GET['from'];

$to =$_GET['to'];
    
$id=$_POST['applist'];
                                
$N = count($id);

for($i=0; $i < $N; $i++)
{   
    $result = mysqli_query($conn,"UPDATE shareholders SET status_of_new_share = 'rejected' where id='$id[$i]'");
    
    header("location:authorize_new_shareholder?reject=true&from=".$from."&to=".$to."");

}
    }
*/
?>

</form> 
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>

</section><!-- /.content -->












