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
                    <div class="col-xs-2">
                       <form method="POST" action="<?php echo base_url('');?>shareholder/transfer_share_from_nib_excel" id="form">
                
                    <button id="submit" class="btn btn-success" name="save"><i class="icon-download icon-large"></i>Download Transfer Report From The Bank</button>
                
                    </form>
                        </div><br><br>
                                <div class="box-body table-responsive">
                                <form action="" method="POST">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th></th>
                                                <th>No.</th>
                                                <th>Share transfer from</th>
                                               
                                                <th>Amount of Share Transfered</th>
                                                <th>Share Transfere To</th>
                                                <th>Total Share subscribed before gaining share</th>
                                                <th>Total Share subscribed after gaining share</th>
                        <th>Transfer Date</th>
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
                                $query = mysqli_query($conn,"SELECT * from transfer WHERE status_of_transfer = 'authorized' AND total_share = 'NIB'") or die(mysqli_error($conn));
                                          
                                            $a = 0;
                                          
                                          while ($rows = mysqli_fetch_array($query)) {
                                          $a = $a + 1;
                                          ?>
                                <tr>
                                    <td></td>
                                              
                                  <td><?php echo $a; ?></td>                                  
                                    
                                    <td><?php echo $rows['name']; ?></td>

                                    <td><?php echo number_format($rows['total_share_transfered']); ?></td>

                                    
                                    <td><?php echo $rows['rname']; ?></td>
                                    <td><?php echo number_format($rows['rtotal_share']); ?></td>
                                     <td><?php echo number_format($rows['rtotal_share']+$rows['total_share_transfered']); ?></td>
                                    <td><?php echo $rows['transfer_date']; ?></td>
                                                     
                                                   
                                                    
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
         
