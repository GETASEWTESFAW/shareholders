<?php
        $conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {
        $username = $this->session->userdata['logged_in']['username'];
        $role = $this->session->userdata['logged_in']['role'];  
        } 
?> 
    <?php if(isset($_GET['authorize'])){ ?>
    
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> Request Authorized Successfully!.
                                    </div>
    
    <?php } ?>

     <?php if(isset($_GET['reject'])){ ?>
    
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> Request Rejected Successfully!.
                                    </div>
    
    <?php } ?>
    <?php if(isset($_GET['delete'])){ ?>
    
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Request Rejected Successfully!.
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
                                                <th>Member</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                               </tr>
                                        </thead>
                                        <tbody>
                                          <?php
       $from = $_GET['from'];
       $to =$_GET['to']; 

       $query = mysqli_query($conn,"SELECT * from shareholders where 
        status_of_new_share = 'rejected' and (year BETWEEN '$from' and '$to')") or die(mysqli_error($conn));
                                            
                                            $a = 0;
                                            
                                            while ($rows = mysqli_fetch_array($query)) {
                                                $a = $a + 1;
                                                
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><input type="checkbox" name="applist[]" value="<?php echo $rows['account_no'];?>"></td>
                                                <input type="hidden" name="from" value="<?php echo $_GET['from'];?>">
                                                <input type="hidden" name="to" value="<?php echo $_GET['to'];?>">


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
                                         
                                                
                                               <?php } ?>
                                                
                                            </tr>
                                            
                                        </tbody>
                                                                                    
                                <?php if($role == 'Authorizer') { ?>      
                                    <fieldset>
                                        <button type="submit" name="delete" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Delete</button>
                                        
                                    </fieldset>
 
                                <?php } ?>        <br><br>
                                    </table>

                                    <?php 

                                    if (isset($_POST['delete'])){
                                        
                                        $id=$_POST['applist'];                                                                    
                                        $N = count($id);
                                        $from = $_POST['from'];
                                        $to = $_POST['to'];
                                                                                                    
                                        for($i=0; $i < $N; $i++)
                                        {   
                                            $result = mysqli_query($conn,"DELETE FROM shareholders where account_no='$id[$i]'");
                                            
                                            header("location:rejected_report?delete=true&from=".$from."&to=".$to."");
     
                                        }
                            
                                }
                                    ?>

                                    
                           
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         











