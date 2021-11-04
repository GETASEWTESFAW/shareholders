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
        <b>Success!</b>  Transfer Authorized Successfully!.
    </div>

<?php } ?>
<?php if(isset($_GET['check'])){ ?>

<div class="alert alert-success alert-dismissable">
        <i class="fa fa-ban"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        You have to activate the new shareholder first 
    </div>

<?php } ?>
<?php

if(isset($_GET['reject'])){

?>

<div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b></b> Transfer Rejected Succesfully!.
    </div>

<?php } ?>



<!-- Main content -->
<section class="content">
<div class="row">
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
                <th>Transfer From</th>
                <th>Total Share Transfered</th>
                <th>Total Share Transfer To</th>
                <th>Transfer Date</th>
                <th>Dividend Agreement For</th>
                <th>Kind of transfer</th>
                <th>Status</th>
               
               </tr>
        </thead>
        <tbody>
            <?php

            $from = $_GET['from'];
            $to =$_GET['to']; 

            $query = mysqli_query($conn,"SELECT * from transfer where 
            status_of_transfer = 'pending' and (value_date BETWEEN '$from' and '$to')") or die(mysqli_error($conn));
                        
            $a = 0;
            
            while ($rows = mysqli_fetch_array($query)) {
                $a = $a + 1;
                
            ?>
            <tr>
                <input type="hidden" name="name[]" value="<?php echo $rows['name'];?>">                
                 
                <input type="hidden" name="account_no[]" value="<?php echo $rows['account_no'];?>">
                <input type="hidden" name="howmany[]" value="<?php echo $rows['total_share_transfered'];?>">
                <input type="hidden" name="seller_paidup[]" value="<?php echo $rows['seller_paidup_in_birr'];?>">
                <input type="hidden" name="account_noof_buyyer[]" value="<?php echo $rows['raccount_no'];?>">
                <input type="hidden" name="seller_account_no[]" value="<?php echo $rows['account_no'];?>">
                <input type="hidden" name="total_share_of_seller[]" value="<?php echo $rows['total_share'];?>">
                <input type="hidden" name="total_share_of_buyyer[]" value="<?php echo $rows['rtotal_share'];?>">
                <input type="hidden" name="buyyer_paidup[]" value="<?php echo $rows['buyyer_paidup_in_birr'];?>">
                 <input type="hidden" name="value_date[]" value="<?php echo $rows['value_date'];?>">
                
                <input type="hidden" name="from[]" value="<?php echo $from;?>">
                <input type="hidden" name="to[]" value="<?php echo $to;?>">

                
                <td><input type="checkbox" name="id[]" value="<?php echo $rows['id']; ?>"></td>
                
                <td><!--<input type="Checkbox" name="applist[]" value="<?php //echo $rows['id'];?>">--></td>

                <td><?php echo $a; ?></td>
                
                <td><?php echo $rows['account_no']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['total_share_transfered']; ?></td>            
                <td><?php echo $rows['rname']; ?></td>                
                <td><?php echo $rows['value_date']; ?></td>
                <td><?php echo $rows['agreement']; ?></td>                
                <td><?php echo $rows['transfer_type']; ?></td>
                
                <td><?php
                    if($rows['status_of_transfer'] == 'active'){
                        
                        ?>
                        
                        <span class="badge bg-blue"><?php echo $rows['status_of_transfer']; ?></span>
                        
                        <?php
                        
                    } else {
                        
                        ?>
                        
                        <span class="badge bg-red"><?php echo $rows['status_of_transfer']; ?></span>
                        
                        <?php
                        
                        }
                        
                        ?></td>
               
                
               <?php } ?>
                
            </tr>
            
        </tbody>
                                                    
<?php if($role == 'Authorizer'){?>      
  <fieldset>
<button type="submit" name="authorize" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Authorize</button>
 <button type="submit" name="reject" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Reject</button>
</fieldset>
<?php } ?>        <br><br>
    </table>



    <?php
                        
        if (isset($_POST['authorize'])){
        
        $id = $_POST['id'];
        $from = $_POST['from'];
        $to =$_POST['to'];      
        $buyyer_account_no = $_POST['account_noof_buyyer'];
        $seller_account_no = $_POST['seller_account_no'];
        $howmany = $_POST['howmany'];
        $value_date = $_POST['value_date'];
        $account_no = $_POST['account_no'];    

        $name = $_POST['name'];
        $rsc_no = $_POST['account_noof_buyyer'];   
        $total_share_transfered = $_POST['howmany'];
        $seller_paidup = $_POST['seller_paidup'];
        $buyyer_paidup = $_POST['buyyer_paidup'];
       /********************************************************/
       // to get sum of how many  
       /********************************************************/

        $sum = 0;
        foreach ($_POST['id'] as $ids) {
            
            $query = mysqli_query($conn,"SELECT * FROM transfer WHERE id = '$ids'") or mysqli_error($conn);
            $rows = mysqli_fetch_array($query);
            
            $seller_account_no = $rows['account_no'];
            $buyyer_account_no = $rows['raccount_no'];
            $howmany = $rows['total_share_transfered']*500;
            $howmany_share = $rows['total_share_transfered'];
            $seller_paidup = $rows['seller_paidup_in_birr'];
            $buyyer_paidup = $rows['buyyer_paidup_in_birr'];
            $sum += $howmany; 
        }
         /********************************************************/
    

        foreach ($_POST['id'] as $ids) {
            
            $query = mysqli_query($conn,"SELECT * FROM transfer WHERE id = '$ids'") or mysqli_error($conn);
            $rows = mysqli_fetch_array($query);
            
            $seller_account_no = $rows['account_no'];
            $buyyer_account_no = $rows['raccount_no'];
            $howmany = $rows['total_share_transfered']*500;
            $howmany_share = $rows['total_share_transfered'];
            $seller_paidup = $rows['seller_paidup_in_birr'];
            $buyyer_paidup = $rows['buyyer_paidup_in_birr'];

            echo "seller paidup".$seller_paidup.'<br/>';
            echo "how many".$howmany.'<br/>'; 
            echo "how many share".$howmany_share.'<br/>';         

            $tot_share = $rows['total_share']*500;

            $aggrement = $rows['agreement'];

            $query_check = mysqli_query($conn,"SELECT * from shareholders where account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
            $row_check = mysqli_fetch_array($query_check);

            if($seller_paidup == $howmany){

            $query1 = mysqli_query($conn,"SELECT * FROM shareholders WHERE account_no = '$seller_account_no'") or die(mysqli_error($conn));
            
            $query_allot = mysqli_query($conn,"SELECT * FROM allotment WHERE account_no = '$seller_account_no'") or die(mysqli_error($conn));
            
            $alltrows = mysqli_fetch_array($query_allot);
            
            $seller_allot =  $alltrows['allotment_update'];

            $query_buyer_allot = mysqli_query($conn,"SELECT * FROM allotment WHERE account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
            
            $buyer_rows = mysqli_fetch_array($query_buyer_allot);      

            $buyyer_allot =  $buyer_rows['allotment_update'];
            
            $rows_allot = mysqli_num_rows($query_buyer_allot);  

            $allot_date = $value_date;                                                                                 

            if($rows_allot > 0){
                
                $buyer_allot_update = $buyyer_allot + $seller_allot;                
                
                $alloted_query = mysqli_query($conn,"UPDATE allotment SET allotment_update = '$buyer_allot_update',allotment = '$buyer_allot_update' WHERE 
                                                account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
                
                $buyyer_all = mysqli_fetch_array($alloted_query);
                echo $buyyer_all ;
                
                $seller_allot_update = mysqli_query($conn,"UPDATE allotment SET allotment_update = '0',allotment = '0' WHERE 
                                                account_no = '$seller_account_no'");

                $allot_update = mysqli_query($conn,"INSERT into allotement_update (seller_account_no,buyyer_account_no,seller_allotment,buyyer_allotment,allot_date) 
                    VALUES('$seller_account_no','$buyyer_account_no','$seller_allot','$buyyer_allot','$allot_date ')");
                      
                        } else {
                $allot_update2 = mysqli_query($conn,"INSERT into allotment (account_no,allot_year,allotment,allotment_update) 
                    VALUES('$buyyer_account_no','$allot_date','$seller_allot','$seller_allot')");
               
               $seller_allot_update = mysqli_query($conn,"UPDATE allotment SET allotment_update = '0',allotment = '0' WHERE 
                                                account_no = '$seller_account_no'");
                            
                        } 
             
                while($rows = mysqli_fetch_array($query1)){

                $query5 = mysqli_query($conn,"SELECT * FROM shareholders WHERE account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
                
                $rows5 = mysqli_fetch_array($query5);
                    
                    $updated_share = $rows['total_share_subscribed'] + $rows5['total_share_subscribed'];
                    $update_paidup1 = $buyyer_paidup + $seller_paidup;
                   
                    $result = mysqli_query($conn,"UPDATE shareholders set total_share_subscribed = '$updated_share',total_paidup_capital_inbirr = '$update_paidup1' where account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
                   $result4 = mysqli_query($conn,"UPDATE transfer SET status_of_transfer = 'authorized',total_share_transfered_in_birr = '$tot_share',status_of_seller = 'closed',authorized_by = '$username',rejected_authorized_date = '$rejected_authorized_date' where id='$ids'")or die(mysqli_error($conn));
                    
                    $result_transfer_from_bank = mysqli_query($conn,"SELECT * FROM transfer where raccount_no = '$seller_account_no'")or die(mysqli_error($conn));
                    $row_transfer_from_bank = mysqli_fetch_array($result_transfer_from_bank);
                    
                    $value_d = $row_transfer_from_bank['value_date'];                    
                    $account_nib_transfer = $row_transfer_from_bank['account_no'];
                    $total_share_nib_transfer = $row_transfer_from_bank['total_share'];
                    $name_nib_transfer = $row_transfer_from_bank['name'];
                    $raccount_no_nib_transfer = $row_transfer_from_bank['raccount_no'];
                    $rname_nib_transfer = $row_transfer_from_bank['rname'];
                    $rtotal_share_nib_transfer = $row_transfer_from_bank['rtotal_share'];

                    $total_share_transfered_nib_transfer = $row_transfer_from_bank['total_share_transfered'];
                    $transfered_in_birr_nib_transfer = $row_transfer_from_bank['total_share_transfered_in_birr'];
                    $buyyer_paidup_in_birr_nib_transfer = $row_transfer_from_bank['buyyer_paidup_in_birr'];
                    $seller_paidup_in_birr_nib_transfer = $row_transfer_from_bank['seller_paidup_in_birr'];
                    $share_balance_nib_transfer = $row_transfer_from_bank['share_balance'];
                    $transfer_date_nib_transfer = $row_transfer_from_bank['transfer_date'];
                    $closed_date_nib_transfer = $row_transfer_from_bank['closed_date'];
                    $value_date_nib_transfer = $row_transfer_from_bank['value_date'];

                    $debit_nib_transfer = $row_transfer_from_bank['debit'];
                    $credit_nib_transfer = $row_transfer_from_bank['credit'];
                    $balance_nib_transfer = $row_transfer_from_bank['balance'];
                    $pervalue_nib_transfer = $row_transfer_from_bank['pervalue'];
                    $status_of_transfer_nib_transfer = $row_transfer_from_bank['status_of_transfer'];
                    $status_of_seller_nib_transfer = $row_transfer_from_bank['status_of_seller'];
                    $authorized_by_nib_transfer = $row_transfer_from_bank['authorized_by'];
                    $rejected_by_nib_transfer = $row_transfer_from_bank['rejected_by'];

                    $rejected_authorized_date_nib_transfer = $row_transfer_from_bank['rejected_authorized_date'];
                    $year_nib_transfer = $row_transfer_from_bank['year'];
                    $agreement_nib_transfer = $row_transfer_from_bank['agreement'];
                    $agred_to_nib_transfer = $row_transfer_from_bank['agred_to'];
                    $both_seller_nib_transfer = $row_transfer_from_bank['both_seller'];
                    $both_buyer_nib_transfer = $row_transfer_from_bank['both_buyer'];
                    $transfer_type_nib_transfer = $row_transfer_from_bank['transfer_type'];

                    $result_transfer = mysqli_query($conn,"SELECT * FROM transfer where account_no = '$seller_account_no'")or die(mysqli_error($conn));
                    $row_transfer = mysqli_fetch_array($result_transfer);
                    $aggrement_transfer = $row_transfer['agreement'];
                    $status_of_seller_transfer = $row_transfer['status_of_seller'];
                    
                    if($aggrement_transfer == 'both' && $status_of_seller_transfer == 'closed' &&  $account_nib_transfer == 'NIB'){
                       
                        $transfer_move = mysqli_query($conn,"INSERT INTO bank_to_shareholder_transfer (account_no,total_share,name,raccount_no,rname,rtotal_share,total_share_transfered,total_share_transfered_in_birr,buyyer_paidup_in_birr,seller_paidup_in_birr,share_balance,transfer_date,value_date,debit,credit,balance,pervalue,status_of_transfer,authorized_by,rejected_by,rejected_authorized_date,year,agreement,agred_to,both_seller,both_buyer,transfer_type) VALUES 
            ('$account_nib_transfer','$total_share_nib_transfer','$name_nib_transfer','$raccount_no_nib_transfer','$rname_nib_transfer','$rtotal_share_nib_transfer','$total_share_transfered_nib_transfer','$total_share_transfered_in_birr_nib_transfer','$buyyer_paidup_in_birr_nib_transfer','$seller_paidup_in_birr_nib_transfer','$share_balance_nib_transfer','$transfer_date_nib_transfer','$value_date_nib_transfer','$debit_nib_transfer','$credit_nib_transfer','$balance_nib_transfer','$pervalue_nib_transfer','$status_of_transfer_nib_transfer','$authorized_by_nib_transfer','$rejected_by_nib_transfer','$rejected_authorized_date_nib_transfer','$year_nib_transfer','$agreement_nib_transfer','$agred_to_nib_transfer','$both_seller_nib_transfer','$both_buyer_nib_transfer','$transfer_type_nib_transfer')") or die(mysqli_error($conn));
           
           $result_delete = mysqli_query($conn,"DELETE FROM transfer WHERE raccount_no='$seller_account_no'") or die(mysqli_error($conn)); 

                        $result_tra = mysqli_query($conn,"UPDATE transfer SET transfer_date = '$value_d' where id='$ids'")or die(mysqli_error($conn));
                        
                     }                    

                if($aggrement == 'buyer'){                      
                        
                        $capitalize_transfer = mysqli_query($conn,"UPDATE capitalized set capitalized_status = 'authorized' WHERE account_no = '$buyyer_account_no' and transfer_from = '$seller_account_no'") or die(mysqli_error($conn));
                        $capitalize_seller_transfer = mysqli_query($conn,"UPDATE capitalized set capitalized_status = 'rejected_by_transfer' WHERE account_no = '$seller_account_no'") or die(mysqli_error($conn));
                        
                    } else {
                        $capitalize_transfer = mysqli_query($conn,"UPDATE capitalized set capitalized_status = 'authorized' WHERE account_no = '$buyyer_account_no' and transfer_from = '$seller_account_no'") or die(mysqli_error($conn));   
                    }  
                }         
            $query2 = mysqli_query($conn,"SELECT * from shareholders where account_no = '$seller_account_no'") or die(mysqli_error($conn));
            
            while($rows2 = mysqli_fetch_array($query2)){
                    
                    $id2 = $rows2['id'];
                    $updated_shares = 0;
                    $update_paidup2 = 0;

            $query = mysqli_query($conn,"UPDATE shareholders set total_share_subscribed = '$updated_shares',total_paidup_capital_inbirr = '$update_paidup2',status = 'closed' where account_no = '$seller_account_no'") or die(mysqli_error($conn));
            
            }

        }

elseif(($seller_account_no == 'NIB') && ($row_check['status_of_new_share'] == 'pending')) { 
           
            $from = $_GET['from'];            
            $to =$_GET['to']; 
            header("location:authorize_new_shareholder?check=true&from=".$from.'&to='.$to);
            exit();
    } elseif($sum == $seller_paidup){
        
        $query60 = mysqli_query($conn,"SELECT * FROM shareholders WHERE account_no = '$seller_account_no'") or die(mysqli_error($conn));
            
        while($rows60 = mysqli_fetch_array($query60)){
                
                $query61 = mysqli_query($conn,"SELECT * FROM shareholders WHERE account_no = '$buyyer_account_no'") or die(mysqli_error($conn));                                                
                $rows61 = mysqli_fetch_array($query61);
                
                $updated_share60 = $rows60['total_share_subscribed'] - $howmany_share;
                $update_paidup60 = $rows60['total_paidup_capital_inbirr'] - $howmany;
                
                $updated_share61 = $rows61['total_share_subscribed'] + $howmany_share;
                $update_paidup61 = $rows61['total_paidup_capital_inbirr'] + $howmany;
                               
                //echo "rows60 - ".$rows60['total_share_subscribed'].'<br/>';
                //echo "howmany_share - ".$howmany_share.'<br/>';
         
                $result62 = mysqli_query($conn,"UPDATE transfer SET status_of_transfer = 'authorized',status_of_seller = 'closed',authorized_by = '$username',rejected_authorized_date = '$rejected_authorized_date' where id='$ids'")or die(mysqli_error($conn));
                $result60 = mysqli_query($conn,"UPDATE shareholders set total_share_subscribed = '$updated_share61',total_paidup_capital_inbirr = '$update_paidup61' where account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
                $result61 = mysqli_query($conn,"UPDATE shareholders set total_share_subscribed = '$updated_share60',total_paidup_capital_inbirr = '$update_paidup60',status = 'closed' where account_no = '$seller_account_no'") or die(mysqli_error($conn));
                

                $select_cap_query = mysqli_query($conn,"SELECT * FROM capitalized  WHERE account_no = '$seller_account_no'");
                $num_rows = mysqli_num_rows($select_cap_query);
                if($num_rows > 0){
                    $result62 = mysqli_query($conn,"UPDATE capitalized SET status_type = 'distribute' where account_no = '$seller_account_no'")or die(mysqli_error($conn));
                }
                

    } } else {
            
            $query55 = mysqli_query($conn,"SELECT * FROM shareholders WHERE account_no = '$seller_account_no'") or die(mysqli_error($conn));
            
            while($rows55 = mysqli_fetch_array($query55)){
                    
                    $query56 = mysqli_query($conn,"SELECT * FROM shareholders WHERE account_no = '$buyyer_account_no'") or die(mysqli_error($conn));                                                
                    $rows56 = mysqli_fetch_array($query56);

                    $updated_share55 = $rows55['total_share_subscribed'] - $howmany_share;
                    $update_paidup55 = $rows55['total_paidup_capital_inbirr'] - $howmany;
                    
                    
                    $updated_share56 = $rows56['total_share_subscribed'] + $howmany_share;
                    $update_paidup56 = $rows56['total_paidup_capital_inbirr'] + $howmany;                    
                
                    $result57 = mysqli_query($conn,"UPDATE transfer SET status_of_transfer = 'authorized',authorized_by = '$username',rejected_authorized_date = '$rejected_authorized_date' where id='$ids'")or die(mysqli_error($conn));
                    $result55 = mysqli_query($conn,"UPDATE shareholders set total_share_subscribed = '$updated_share56',total_paidup_capital_inbirr = '$update_paidup56' where account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
                    $result56 = mysqli_query($conn,"UPDATE shareholders set total_share_subscribed = '$updated_share55',total_paidup_capital_inbirr = '$update_paidup55' where account_no = '$seller_account_no'") or die(mysqli_error($conn));
                      
        } 
    }
    if($name == $seller_account_no){
        
            $transfer_from_nib = mysqli_query($conn,"UPDATE transfer SET status_of_transfer = 'authorized',authorized_by = '$username',rejected_authorized_date = '$rejected_authorized_date' where raccount_no='$buyyer_account_no'")or die(mysqli_error($conn));
            $result_share_transfer = mysqli_query($conn,"UPDATE shareholders SET share_transfer_status = '' WHERE account_no = '$buyyer_account_no'") or die(mysqli_error($conn));
        
        }
             
        header("location:authorize_transfer?authorize=true&from=".$from.'&to='.$to);
    }

}                                 
?>
<?php 

        if (isset($_POST['reject'])){

if(!isset($_POST['id'])){

    echo '<script>alert("Either data not selected or no data to reject !");</script>';
} else{
        

        $from = $_POST['from'];
        $to =$_POST['to'];    
        foreach($_POST['id'] as $cap_del){ 

            $id = array();
            array_push($id, $cap_del);          
          
            $N = count($id);
            
            $query_cap = mysqli_query($conn,"SELECT * from transfer where 
            status_of_transfer = 'pending' AND id = '$cap_del'") or die(mysqli_error($conn));
        
            $row_cap1 = mysqli_fetch_array($query_cap);            

            $account_no = $row_cap1['account_no'];
            $total_share = $row_cap1['total_share'];
            $name = $row_cap1['name'];
            $raccount_no = $row_cap1['raccount_no'];
            $rname = $row_cap1['rname'];
            $rtotal_share = $row_cap1['rtotal_share'];
            $total_share_transfered = $row_cap1['total_share_transfered'];
            $total_share_transfered_in_birr = $row_cap1['total_share_transfered_in_birr'];

            $buyyer_paidup_in_birr = $row_cap1['buyyer_paidup_in_birr'];
            $seller_paidup_in_birr = $row_cap1['seller_paidup_in_birr'];
            $share_balance = $row_cap1['share_balance'];
            $transfer_date = $row_cap1['transfer_date'];
            $value_date = $row_cap1['value_date'];
            $debit = $row_cap1['debit'];
            $credit = $row_cap1['credit'];
            $balance = $row_cap1['balance'];

            $pervalue = $row_cap1['pervalue'];
            $status_of_transfer = $row_cap1['status_of_transfer'];
            $authorized_by = $row_cap1['authorized_by'];
            $rejected_by = $username;
            $rejected_authorized_date = $row_cap1['rejected_authorized_date'];
            $year = $row_cap1['year'];
            $agreement = $row_cap1['agreement'];
            $agred_to = $row_cap1['agred_to'];
            $both_seller = $row_cap1['both_seller'];
            $both_buyer = $row_cap1['both_buyer'];
            $transfer_type = $row_cap1['transfer_type'];
            echo "account_no".$account_no.'<br/>';
            echo "raccount_no".$raccount_no.'<br/>';
            $query_check = mysqli_query($conn,"SELECT * from shareholders where account_no = '$raccount_no'") or die(mysqli_error($conn));
            $row_check = mysqli_fetch_array($query_check);

            print_r($row_check['status_of_new_share']);
            if(($account_no == 'NIB') && ($row_check['status_of_new_share'] == 'pending')) { 
           
                $result_cap = mysqli_query($conn,"INSERT INTO rejected_transfer (account_no,total_share,name,raccount_no,rname,rtotal_share,total_share_transfered,total_share_transfered_in_birr,buyyer_paidup_in_birr,seller_paidup_in_birr,share_balance,transfer_date,value_date,debit,credit,balance,pervalue,status_of_transfer,authorized_by,rejected_by,rejected_authorized_date,year,agreement,agred_to,both_seller,both_buyer,transfer_type) VALUES 
            ('$account_no','$total_share','$name','$raccount_no','$rname','$rtotal_share','$total_share_transfered','$total_share_transfered_in_birr','$buyyer_paidup_in_birr','$seller_paidup_in_birr','$share_balance','$transfer_date','$value_date','$debit','$credit','$balance','$pervalue','$status_of_transfer','$authorized_by','$rejected_by','$rejected_authorized_date','$year','$agreement','$agred_to','$both_seller','$both_buyer','$transfer_type')") or die(mysqli_error($conn));
           
               $result_delete = mysqli_query($conn,"DELETE FROM transfer WHERE status_of_transfer = 'pending' AND id='$cap_del'") or die(mysqli_error($conn));
               $result_delete_shareholder = mysqli_query($conn,"DELETE FROM shareholders WHERE status_of_new_share = 'pending' AND account_no = '$raccount_no'") or die(mysqli_error($conn));

        } else{
        
           $result_cap = mysqli_query($conn,"INSERT INTO rejected_transfer (account_no,total_share,name,raccount_no,rname,rtotal_share,total_share_transfered,total_share_transfered_in_birr,buyyer_paidup_in_birr,seller_paidup_in_birr,share_balance,transfer_date,value_date,debit,credit,balance,pervalue,status_of_transfer,authorized_by,rejected_by,rejected_authorized_date,year,agreement,agred_to,both_seller,both_buyer,transfer_type) VALUES 
            ('$account_no','$total_share','$name','$raccount_no','$rname','$rtotal_share','$total_share_transfered','$total_share_transfered_in_birr','$buyyer_paidup_in_birr','$seller_paidup_in_birr','$share_balance','$transfer_date','$value_date','$debit','$credit','$balance','$pervalue','$status_of_transfer','$authorized_by','$rejected_by','$rejected_authorized_date','$year','$agreement','$agred_to','$both_seller','$both_buyer','$transfer_type')") or die(mysqli_error($conn));
           
           $result_delete = mysqli_query($conn,"DELETE FROM transfer WHERE status_of_transfer = 'pending' AND id='$cap_del'") or die(mysqli_error($conn));
         
           }
            header("location:authorize_transfer?reject=true&from=".$from.'&to='.$to);
    }
}
}      ?>
    <?php
   /*  
    if (isset($_POST['reject'])){

        $rejected_authorized_date = date("Y-m-d");
         
         $id=$_POST['applist'];
                                            
            $N = count($id);
            
            for($i=0; $i < $N; $i++)
            {   

              $result = mysqli_query($conn,"UPDATE transfer SET status_of_transfer = 'rejected',rejected_by = '$username',rejected_authorized_date = '$rejected_authorized_date' where id='$id[$i]'")or die(mysqli_error($conn));
            
              header('location:authorize_transfer?authorize_transfer=true');
                
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