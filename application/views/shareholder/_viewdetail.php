<?php

$conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {

$username = $this->session->userdata['logged_in']['username'];

} 

?> 
<?php

if(isset($_GET['active'])){

?>

<div class="alert alert-success alert-dismissable">
        <i class="fa fa-ban"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>Success!</b> Shareholder Released Successfully!.
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
                <th>Account number</th>
                <th>Shareholder Name</th>
                <th>Share subscribed</th>
                <th>Allotment</th>                                                
                <th>Total Share Subscribed</th>
                <th>Total paid up capital in share</th>
                <th>Total share Subscribed in Birr</th>                                                  
                <th>Total paid up capital in birr</th>                                                
                <th>Unpaid balance</th>
                <th>New Request </th>
                                                        
        </thead>
        <tbody>
            
    <?php
            
            $from = $_GET['from'];

            $to = $_GET['to'];
            
            $id = $_GET['id'];

            $query = mysqli_query($conn,"SELECT * from shareholders where account_no = '$id' order by id ASC") or die(mysqli_error($conn));
            
            $a = 0;
            
            while ($rows = mysqli_fetch_array($query)) {
            
            $a = $a + 1;
            
            $acct =$_GET['id'];

            $year = date('Y');
            
            $query2 = mysqli_query($conn,"SELECT * from allotment where account_no = '$acct' order by id ASC") or die(mysqli_error($conn));
            
            $rows2 = mysqli_fetch_array($query2);

            $query_new_request = mysqli_query($conn,"SELECT * from new_request where account_no = '$acct' and status = 'waiting' order by id ASC") or die(mysqli_error($conn));
            
            $request_rows = mysqli_fetch_array($query_new_request);
            
            ?>
            <tr>
                <td></td>
                
                <td><?php echo $a; ?></td>

                <td><?php echo $rows['account_no']; ?></td>

                <td><?php echo $rows['name']; ?></td>

                <td><?php echo number_format($rows['total_share_subscribed']); ?></td>

                <td><?php echo $rows2['allotment_update']; ?></td>

                <td><?php echo $rows2['allotment_update'] + $rows['total_share_subscribed']; ?></td>

                <td><?php echo number_format($rows['total_paidup_capital_inbirr']/500); ?></td>

                <td><?php echo number_format(($rows['total_share_subscribed']+$rows2['allotment_update'])*500,2); ?></td>
            
                <td><?php echo number_format($rows['total_paidup_capital_inbirr'],2); ?></td>

                <?php 
                        $unpaid_balance = ($rows['total_share_subscribed']+$rows2['allotment_update'])*500 - $rows['total_paidup_capital_inbirr'];
                        
                        $unpaid_balance2 = $unpaid_balance; 

                ?>

                <td><?php echo number_format($unpaid_balance2,2); ?></td>                
                <td><?php echo $request_rows['total_share']; ?></td>
                <?php }  ?>
            </tr>
            
        </tbody>
        
    </table>


        <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th></th>                          
                <th>city </th>
                <th>Sub city </th>
                <th>Woreda</th>
                <th>House no </th>
                <th>P.O.Box</th>
                <th>Telephone Residence</th>
                <th>Telephone Office</th>
                <th>Mobile</th>
                <th>Member</th>
                <th>Reason</th>
                <th>Status</th>                                               
        </thead>
        <tbody>
            
    <?php
            
            $from = $_GET['from'];

            $to = $_GET['to'];
            
            $id = $_GET['id'];

            $query = mysqli_query($conn,"SELECT * from shareholders where account_no = '$id' order by id ASC") or die(mysqli_error($conn));
            
            $a = 0;
            
            while ($rows = mysqli_fetch_array($query)) {
            
            $a = $a + 1;
            
            $acct =$_GET['id'];

            $year = date('Y');
            
            $query2 = mysqli_query($conn,"SELECT * from allotment where account_no = '$acct' order by id ASC") or die(mysqli_error($conn));
            
            $rows2 = mysqli_fetch_array($query2);

            $query_new_request = mysqli_query($conn,"SELECT * from new_request where account_no = '$acct' and status = 'waiting' order by id ASC") or die(mysqli_error($conn));
            
            $request_rows = mysqli_fetch_array($query_new_request);
            
            ?>
            <tr>
                <td></td>
                <td><?php echo $rows['city']; ?></td>
                <td><?php echo $rows['sub_city']; ?></td>
                <td><?php echo $rows['woreda']; ?></td>                
                <td><?php echo $rows['house_no']; ?></td>                
                <td><?php echo $rows['pobox']; ?></td>
                <td><?php echo $rows['telephone_residence']; ?></td>
                <td><?php echo $rows['telephone_office']; ?></td>                
                <td><?php echo $rows['mobile']; ?></td>                
                <td><?php echo $rows['member']; ?></td>
                <td><?php echo $rows['remark']; ?></td>
                
                <td><?php
                    if($rows['status'] == 'active'){
                        
                        ?>
                        
                        <span class="badge bg-blue"><?php echo $rows['status']; ?></span>
                        
                        <?php
                        
                    } else {
                        
                        ?>
                        
                        <span class="badge bg-red"><?php echo $rows['status']; ?></span>
                        
                        <?php
                        
                        }
                        
                        ?></td>
                        
                    
                    
                <?php }  ?>
            </tr>
            
        </tbody>
        
    </table>
    
    
    </form> 
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>

</section><!-- /.content -->

