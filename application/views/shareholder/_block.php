<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
		if (isset($this->session->userdata['logged_in'])) {
		$username = $this->session->userdata['logged_in']['username'];
        $role = $this->session->userdata['logged_in']['role'];	
		} 
?> 
	<?php
	if(isset($_GET['block'])){
	?>
	<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> Shareholder Blocked Successfully!.
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
                                               
												<th>Reason</th>
                                                <th>Status</th>
												
												
                                        </thead>
                                        <tbody>

                
                                        	<?php
                                        	
                                        	$query = mysqli_query($conn,"SELECT * from blocked,shareholders where blocked.status = 'pending' && blocked.account_no = shareholders.account_no order by blocked.id ASC") or die(mysqli_error($conn));
                                        	
                                        	$a = 0;
                                        	
                                        	while ($rows = mysqli_fetch_array($query)) {
                                        		$a = $a + 1;
                                        		
                                        	?>
                                            <tr>
                                            	<td></td>
                                            	<td><input type="checkbox" name="applist[]" value="<?php echo $rows['id'];?>"></td>
                                            	<td><?php echo $a; ?></td>
                                            	
                                                <td><?php echo $rows['account_no']; ?></td>
                                                <td><?php echo $rows['name']; ?></td>
                                                <td><?php echo $rows['total_share_subscribed']; ?></td>                                                                                          
                                                <td><?php echo $rows['total_paidup_capital_inbirr']; ?></td>                                               
                                              	<td><?php echo $rows['block_remark']; ?></td>
                                                <td>

                                                    <?php
                                                	if($rows['blocked_status'] == 'blocked'){
                                                		
														?>
														
														<span class="badge bg-red"><?php echo $rows['blocked_status']; ?></span>
														
														<?php
														
													} else {
														
														?>
														
														<span class="badge bg-red"><?php echo $rows['blocked_status']; ?></span>
														
														<?php
														
														}?>
												
                                                <input type="hidden" readonly="" value="<?php echo $rows['account_no'];?>" name="account_no" class="form-control"/>
                                                <input type="hidden" readonly="" value="<?php echo $rows['name'];?>" name="name" class="form-control"/>
                                                <input type="hidden" readonly="" value="<?php echo $rows['total_paidup_capital_inbirr'];?>" name="total_paidup_capital_inbirr" class="form-control"/>
                                                <input type="hidden" readonly="" value="<?php echo $rows['blocked_in_birr'];?>" name="total_paidup_capital_inbirr" class="form-control"/>
                                                
														</td>
                                                
                                             
                                               <?php } ?>
                                                
                                            </tr>
                                        
                                         
                                        
                                        </tbody>


                                <?php if($role == 'Authorizer'){?>      
                                  <button type="submit" name="authorize" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Authorize</button>
                                <?php } ?>
                                    <br><br>
                                    </table>
                                    
                                    <?php
						
									if (isset($_POST['release'])){
										
									$id=$_POST['applist'];
																	
									$N = count($id);
									
									for($i=0; $i < $N; $i++)
									{	
										$result = mysqli_query($conn,"UPDATE shareholders SET blocked_status = 'active',blocked_by = $username where id='$id[$i]'");
										
										header('location:listed?active=true');
										
									}
							
									}
                                    if (isset($_POST['authorize'])){


                                     $id = $_POST['id'];
                                            $reason = $_POST['reason'];

                                            $account_no = $_POST['account_no'];
                                            $name = $_POST['name'];
                                            $blocked_year = $_POST['blocked_year'];
                                         
                                            $total_paidup_capital_inbirr = $_POST['total_paidup_capital_inbirr'];

                                            $update_blocked_amount = $total_paidup_capital_inbirr - $blocked_amount;

                                            echo $update_blocked_amount;
                                            
                                            $blocked_by = $_POST['blocked_by'];

                                            $blocked_year = date('Y');

                                            
                                        
                                    $id=$_POST['applist'];
                                                                    
                                    $N = count($id);
                                    
                                    for($i=0; $i < $N; $i++)
                                    {   
                                        
                                        $query = mysqli_query($conn,"UPDATE shareholders SET blocked_status = 'blocked' where id='$id[$i]'") or die(mysqli_error($conn));
                                           
                                        $result = mysqli_query($conn,"UPDATE blocked SET status = 'blocked',authorized_by = '$username'  where id='$id[$i]'");
                                        
                                        header('location:block?blocked=true');
                                        
                                    }
                            
                                    }
									?>
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         
