<?php
     $conn=mysqli_connect('localhost','root','software','shareholder_test');
     
    if (isset($this->session->userdata['logged_in'])) {
      
    $username = $this->session->userdata['logged_in']['username'];
    $role = $this->session->userdata['logged_in']['role'];
         
    } 
    ?>
<?php
$budget_query = mysqli_query($conn,"SELECT * FROM budget_year_status WHERE budget_status = 'active'");

$budget_result = mysqli_fetch_array($budget_query,MYSQLI_BOTH );
$from="";
$to="";
if($budget_result){
$from="";
$to="";
if($budget_result){
$from = $budget_result['budget_from'];
$to = $budget_result['budget_to'];
}  
}                     
?>

      <?php if($role == 'Authorizer') { ?>
                              
                              
            <ul class="sidebar-menu">
            <li>
                <a href="http://172.23.2.174/shareholder/shareholder/layouts">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
             <li class="treeview">
                                                       
                            
                                    <?php 
                                        $result1 = mysqli_query($conn,"SELECT *,count(id) from Shareholders where status_of_new_share = 'pending'");
                                        $rowss = mysqli_fetch_array($result1); 
                                    ?>

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_new_shareholder?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>New Shareholders<?php if($rowss['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $rowss['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query2 = mysqli_query($conn,"SELECT *,count(id) from blocked where status = 'pending'");
                  
                                $row2 = mysqli_fetch_array($query2);

                                ?> 

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_blocked"><i class="fa fa-angle-double-right"></i>Blocked Shareholders <?php if($row2['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row2['count(id)']; ?><?php } ?></a></li>
                                
                                <?php 
                              
                                $query1212 = mysqli_query($conn,"SELECT *,count(id) from blocked where status = 'please_release_share'");
                  
                                $row1212 = mysqli_fetch_array($query1212);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/release_blocked"><i class="fa fa-angle-double-right"></i>Released Blocked  <?php if($row1212['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row1212['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query3 = mysqli_query($conn,"SELECT *,count(id) from pludge where pledged_status = 'pending'");
                  
                                $row3 = mysqli_fetch_array($query3);

                                ?> 
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/pledged"><i class="fa fa-angle-double-right"></i>Pledge Shareholders <?php if($row3['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row3['count(id)']; ?><?php } ?></span></a></li>
                                <?php 
                              
                                $query23 = mysqli_query($conn,"SELECT *,count(id) from pludge where pledged_status = 'release_pledged'");
                  
                                $row23 = mysqli_fetch_array($query23);

                                ?>

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/pledged_release"><i class="fa fa-angle-double-right"></i>Pledged Released <?php if($row23['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row23['count(id)']; ?><?php } ?></a></li>
                                
                                <?php 
                              
                                $query4 = mysqli_query($conn,"SELECT *,count(id) from transfer where status_of_transfer = 'pending'");
                  
                                $row4 = mysqli_fetch_array($query4);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_transfer?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i> Transfer <?php if($row4['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row4['count(id)']; ?><?php } ?></span></a></li>

                                

                                 <?php 
                              
                                $query_allotment = mysqli_query($conn,"SELECT *,count(id) from allotment where allot_status = 'pending'");
                  
                                $alloted_row = mysqli_fetch_array($query_allotment);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_allotment"><i class="fa fa-angle-double-right"></i>New Allotement <?php if($alloted_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $alloted_row['count(id)']; ?><?php } ?></span></a></li>                                 
                                



                                <li class="active"><a href="<?php echo base_url('');?>shareholder/distribute_capcash"><i class="fa fa-angle-double-right"></i>Distribute Capitalized and Cash Payment</a></li>                                

                                 <li class="active"><a href="<?php echo base_url('');?>shareholder/transfer_cap_cash_pay"><i class="fa fa-angle-double-right"></i>Transfer Capitalized, Cash or Payable</a></li>                                
                                                                
                               
                                <?php 
                              
                                $query5 = mysqli_query($conn,"SELECT *,count(id) from capitalized where capitalized_status = 'pending' and type = 'cash' and transfer_from != 'Bank'");
                  
                                $row5 = mysqli_fetch_array($query5);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_cashpayment"><i class="fa fa-angle-double-right"></i>Cash Payment <?php if($row5['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row5['count(id)']; ?><?php } ?></span></a></li>                                 
                                <?php 
                              
                                $query6 = mysqli_query($conn,"SELECT *,count(id) from capitalized where capitalized_status = 'pending' and type = 'capitalized'");
                  
                                $row6 = mysqli_fetch_array($query6);

                            
                                ?>

                                <?php 
                              
                                $query_bank_share = mysqli_query($conn,"SELECT *,count(id) from capitalized where capitalized_status = 'pending' and type = 'cash' and transfer_from = 'Bank'");
                  
                                $row_bank = mysqli_fetch_array($query_bank_share);



                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_cash_share_bank"><i class="fa fa-angle-double-right"></i>Cash Payment from Bank to Share <?php if($row_bank['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row_bank['count(id)']; ?><?php } ?></span></a></li>                                 
                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_capitalized"><i class="fa fa-angle-double-right"></i>Dividend Capitilized<?php if($row6['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row6['count(id)']; ?><?php } ?></span></a></li>
                                <?php 
                              
                                $query7 = mysqli_query($conn,"SELECT *,count(id) from capitalized where capitalized_status = 'pending' and type = 'payable'");
                  
                                $row7 = mysqli_fetch_array($query7);

                                ?>

                                <li class="treeview">
                            <a href="#">

                        <i class="fa fa-th"></i>
                                <span>Manage Certificate</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/certificate?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Certificate</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/certificate_report"><i class="fa fa-angle-double-right"></i>Certificate Report</a></li>
                            </ul>

                        </li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/paidup_calc?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Dividend Report</a></li>

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/authorize_payable"><i class="fa fa-angle-double-right"></i>Payable <?php if($row7['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row7['count(id)']; ?><?php } ?></span></a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/listed"><i class="fa fa-angle-double-right"></i>Manage Shareholders </a></li>                                 
                               
                           
            </li>

            <li class="active"><a href="<?php echo base_url('');?>shareholder/top_shareholders"><i class="fa fa-angle-double-right"></i>Top Shareholders</a></li>
             <li class="treeview">
                            <a href="#">

                        <i class="fa fa-gear"></i>
                                <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                 <?php 
                              
                                $query_blocked_report = mysqli_query($conn,"SELECT *,count(id) from blocked where status = 'blocked'");                  
                                $blocked_report_row = mysqli_fetch_array($query_blocked_report);

                                ?>
                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/blocked_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Blocked Report<?php if($blocked_report_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $blocked_report_row['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query_pledged_report = mysqli_query($conn,"SELECT *,count(id) from pludge where pledged_status = 'pledged'");                  
                                $pledged_row = mysqli_fetch_array($query_pledged_report);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/pledged_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Pledged Report<?php if($pledged_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $pledged_row['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query_transfer_report = mysqli_query($conn,"SELECT *,count(id) from transfer where status_of_transfer = 'authorized' and total_share != 'NIB'");                  
                                $transfer_row = mysqli_fetch_array($query_transfer_report);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/transfer_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Transfer Report<?php if($transfer_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $transfer_row['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query_closed_report = mysqli_query($conn,"SELECT *,count(id) from shareholders where status = 'closed'");                  
                                $closed_row = mysqli_fetch_array($query_closed_report);

                                ?>                               
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/closed_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Closed Report<?php if($closed_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $closed_row['count(id)']; ?><?php } ?></a></li>

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/certificate_report"><i class="fa fa-angle-double-right"></i>Certificate Report</a></li>               
                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/rejected_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Rejected List <?php if($row6['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $row6['count(id)']; ?><?php } ?></span></a></li>
                                
                                <?php 
                              
                                $query_transfer_from_nib = mysqli_query($conn,"SELECT *,count(id) from transfer where status_of_transfer = 'authorized' and total_share = 'NIB' and (year BETWEEN '$from' and '$to')");                  
                                $transfer_nib = mysqli_fetch_array($query_transfer_from_nib);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/transfer_from_nib?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Transfer From NIB<?php if($transfer_nib['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $transfer_nib['count(id)']; ?><?php } ?></a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/share_setting?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Change Share Mgt Setting</a></li>
                   
                            </ul>

                        </li>

                         <li class="treeview">
                            <a href="#">

                        <i class="fa fa-gear"></i>
                                <span>Reverse or Return </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">                              
                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/cash_rev_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Cash Payment</a></li>
                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/dev_rev_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Dividend Capitilized</a></li>
                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/payable_rev_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Payable</a></li>
                             </ul>

                        </li>   

                        
</ul>

          <?php }else if($role == 'IT'){ ?>

<ul class="sidebar-menu">
  
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
             <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>User Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/listed"><i class="fa fa-angle-double-right"></i>Add User </a></li>                                 
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/createshareholder"><i class="fa fa-angle-double-right"></i>User List</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/release_blocked"><i class="fa fa-angle-double-right"></i>Reset Passwrod </a></li>

                            </ul>
                            <li class="active"><a href="<?php echo base_url('');?>shareholder/allotment_update?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Allotment Update</a></li>
 
            </li> 

              <li class="treeview">
                            <a href="#">

            <i class="fa fa-th"></i>
                                <span>Manage Requestes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/sharerequest"><i class="fa fa-angle-double-right"></i>Request Share </a></li> 
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/list_requested_share"><i class="fa fa-angle-double-right"></i>List Request Share</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/upload_sharerequest"><i class="fa fa-angle-double-right"></i>Upload share request</a></li> 

                            </ul>

                        </li>
</ul>


          <?php } else { ?>   

            <ul class="sidebar-menu">
  
                        <li>
                            <a href="http://172.23.2.174/shareholder/shareholder/layouts">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
             <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Manage Shareholders</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/listed"><i class="fa fa-angle-double-right"></i>Manage Shareholders </a></li>                                 
                                <!--<li class="active"><a href="<?php //echo base_url('');?>shareholder/createshareholder"><i class="fa fa-angle-double-right"></i>Create Shareholder</a></li>-->
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/choose_shareholder"><i class="fa fa-angle-double-right"></i>Create Shareholder</a></li>                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/block"><i class="fa fa-angle-double-right"></i>Blocked Shareholders </a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/pledged"><i class="fa fa-angle-double-right"></i>Pledged Shareholders </a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/upload_shareholder"><i class="fa fa-angle-double-right"></i>Upload shareholder</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/upload_allotement"><i class="fa fa-angle-double-right"></i>Upload allotement</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/upload_certificate"><i class="fa fa-angle-double-right"></i>Upload certificate</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/upload_balance"><i class="fa fa-angle-double-right"></i>Upload balance</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/top_shareholders"><i class="fa fa-angle-double-right"></i>Top Shareholders</a></li>
                                 <!-- <li class="active"><a href="<?php //echo base_url('');?>shareholder/share_for_resale?from=<?php //echo $from; ?>&to=<?php //echo $to; ?>"><i class="fa fa-angle-double-right"></i>Share For Resale</a></li> -->
                               
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/manage_allotement?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Manage Allotement</a></li>
                            </ul>
            </li>

            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Manage Allotment</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/manage_allotement?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>New Allotment</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/list_allotment?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>List Allotment</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/upload_allotement"><i class="fa fa-angle-double-right"></i>Upload New Allotement</a></li>
                                
                </ul>
            </li>          

                        <li class="treeview">
                            <a href="#">

                        <i class="fa fa-th"></i>
                                <span>Manage Dividend</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>

                            <ul class="treeview-menu">
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/paidup_calc?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Dividend Report</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/dividend_capitalized?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Dividend Capitalized</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/dividend_payable?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Dividend Payable</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/cash_payment?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Cash Payment</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/transfer_to_existing?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Transfer From Bank to Existing Shareholder</a></li>
                                      
                            </ul>

                        </li>

                        <li class="treeview">
                            <a href="#">

                        <i class="fa fa-th"></i>
                                <span>Manage Certificate</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/certificate?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Certificate</a></li>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/certificate_report"><i class="fa fa-angle-double-right"></i>Certificate Report</a></li>
                            </ul>

                        </li>
                         <li class="treeview">
                            <a href="#">

            <i class="fa fa-th"></i>
                                <span>Manage Requestes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/sharerequest"><i class="fa fa-angle-double-right"></i>Request Share </a></li> 
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/list_requested_share"><i class="fa fa-angle-double-right"></i>List Request Share</a></li>
                                
                            </ul>

                        </li>

                        <li class="treeview">
                            <a href="#">

                        <i class="fa fa-gear"></i>
                                <span>Dividend Calculation</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/add_dividend"><i class="fa fa-angle-double-right"></i>Add Dividend Profit</a></li>

                                <li class="active"><a href="<?php echo base_url('');?>shareholder/edit_dividend"><i class="fa fa-angle-double-right"></i>Edit Dividend Profit</a></li>
                            </ul>

                        </li>
                        <li class="treeview">
                            <a href="#">

                        <i class="fa fa-gear"></i>
                                <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <?php 
                              
                                $query_blocked_report = mysqli_query($conn,"SELECT *,count(id) from blocked where status = 'blocked'");                  
                                $blocked_report_row = mysqli_fetch_array($query_blocked_report);

                                ?>
                                
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/blocked_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Blocked Report<?php if($blocked_report_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $blocked_report_row['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query_pledged_report = mysqli_query($conn,"SELECT *,count(id) from pludge where pledged_status = 'pledged'");                  
                                $pledged_row = mysqli_fetch_array($query_pledged_report);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/pledged_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Pledged Report<?php if($pledged_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $pledged_row['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query_transfer_report = mysqli_query($conn,"SELECT *,count(id) from transfer where status_of_transfer = 'authorized' AND total_share != 'NIB'");                  
                                $transfer_row = mysqli_fetch_array($query_transfer_report);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/transfer_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Transfer Report<?php if($transfer_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $transfer_row['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query_closed_report = mysqli_query($conn,"SELECT *,count(id) from shareholders where status = 'closed'");                  
                                $closed_row = mysqli_fetch_array($query_closed_report);

                                ?>                               
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/closed_report?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Closed Report<?php if($closed_row['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $closed_row['count(id)']; ?><?php } ?></a></li>
                                <?php 
                              
                                $query_transfer_from_nib = mysqli_query($conn,"SELECT *,count(id) from transfer where status_of_transfer = 'authorized' and total_share = 'NIB'");                  
                                $transfer_nib = mysqli_fetch_array($query_transfer_from_nib);

                                ?>
                                <li class="active"><a href="<?php echo base_url('');?>shareholder/transfer_from_nib?from=<?php echo $from; ?>&to=<?php echo $to; ?>"><i class="fa fa-angle-double-right"></i>Transfer From NIB<?php if($transfer_nib['count(id)'] == '0'){ } else { ?><span class="badge bg-red"><?php echo $transfer_nib['count(id)']; ?><?php } ?></a></li>
             
                            </ul>

                        </li>

                       
</ul>

<?php } ?>