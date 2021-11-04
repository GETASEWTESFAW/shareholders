<?php
        $conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {
        
        $username = $this->session->userdata['logged_in']['username'];
        $role = $this->session->userdata['logged_in']['role'];  
            
        } 
?> 
    <?php if(isset($_GET['pledged'])){ ?>
    
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> Shareholder pledged Successfully!.
                                    </div>
    
    <?php } ?>
    <?php if(isset($_GET['pledged_rejected'])){ ?>
    
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Pledge Request Rejected Successfully!.</b>
                                    </div>
    
    <?php } ?>
     <?php if(isset($_GET['pledged_release'])){ ?>
    
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Pledge Request Released Successfully!.</b>
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
                                               
                                                <th>No.</th>
                                                <th>Account number</th>
                                                <th>Shareholder Name</th>
                                                
                                                <th>Pledged Amount</th>
                                                <th>Reason</th>
                                                <th>Status</th>
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
       $query = mysqli_query($conn,"SELECT * FROM pludge WHERE 
      pledged_status = 'pledged' order by year DESC") or die(mysqli_error($conn));
                                            
                                            $a = 0;
                                            
                                            while ($rows = mysqli_fetch_array($query)) {
                                                $a = $a + 1;
                                                
                                            ?>
                                            <tr>

                                                
                                                <td><?php echo $a; ?></td>
                                                
                                                <td><?php echo $rows['account_no']; ?></td>
                                                <td><?php echo $rows['name']; ?></td>
                                                <?php //echo number_format($rows['total_paidup_capital'],2); ?>
                                                <td><?php echo number_format($rows['plamount'],2);?></td>
                                                <td><?php echo $rows['pledged_reason']; ?></td>
                                                <td><?php
                                                    if($rows['pledged_status'] == 'pending'){
                                                        
                                                        ?>
                                                        
                                                        <span class="badge bg-red"><?php echo $rows['pledged_status']; ?></span>
                                                        
                                                        <?php
                                                        
                                                    } else {
                                                        
                                                        ?>
                                                        
                                                        <span class="badge bg-blue"><?php echo $rows['pledged_status']; ?></span>
                                                        
                                                        <?php
                                                        
                                                        }
                                                        
                                                        ?></td>
                                            
                                            
                                                  <?php } ?>
                                                
                                            </tr>
                                            
                                        </tbody>
                                   
                                                       
                                        <br><br>
                                    </table>
                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         
                                   