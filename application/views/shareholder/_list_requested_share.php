<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
		if (isset($this->session->userdata['logged_in'])) {
		
		$username = $this->session->userdata['logged_in']['username'];
			
		} 
?> 
	<?php

	if(isset($_GET['block'])){
	
	?>
	<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> Shareholder Released Successfully!.
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
                                            	
                                            	                                           
                                                <th>No.</th>
                                                
                                                <th>Full Name</th>
                                                <th>year</th>
                                               
                                                <th>Total Share Requested</th>
                                                <th></th>
                                       			<th>Status</th>
                                       														
                                        </thead>
                                        <tbody>
                                        	
                                        	<?php
                                        	
       $query = mysqli_query($conn,"SELECT * from new_request order by name") or die(mysqli_error($conn));
                                        	
                                        	$a = 0;
                                        	
                                        	while ($rows = mysqli_fetch_array($query)) {
                                        		$a = $a + 1;
                                        		
                                        	?>
                                            <tr>
                                            	
                                            	<td><?php echo $rows['account_no']; ?></td>
                                            	<td><?php echo $rows['name']; ?></td>                                                
                                                <td><?php echo $rows['year']; ?></td>     
                                                <td><?php echo $rows['total_share']; ?></td>
                                                <td><a href="<?php echo base_url();?>shareholder/edit_requested_share?id=<?php echo $rows['account_no']; ?>">Edit</td> 
                                                <td><?php
                                                	if($rows['status'] == 'waiting'){
                                                		
														?>
														
												<span class="badge bg-blue"><?php echo $rows['status']; ?></span>
														
														<?php
														
													} else {
														
														?>
														
												<span class="badge bg-red"><?php echo $rows['status']; ?></span>
														
														<?php
														
														}
														
														?></td>

                                              
                                            <input type="hidden" name="registration_no" value="<?php //echo $rows['registration_no']; ?>">

                                            <input type="hidden" name="full_name" value="<?php echo $rows['name']; ?>">

                                               <?php } ?>
                                                
                                            </tr>
                                            
                                        </tbody>
                                   
                                     <br><br>
                                    </table>
                                   
                            <?php
						            /*  
									if (isset($_POST['release'])){
                                    
                                    $id=$_POST['applist'];
														
									$N = count($id);

									for($i=0; $i < $N; $i++)
									{	
									   
                $result = mysqli_query($conn,"UPDATE shareholders SET total_share_subscribed = '$total',status = 'active' where account_no='$id[$i]'") or die(mysqli_error($conn));

                $result = mysqli_query($conn,"UPDATE pludge SET status = 'pludge_released' where account_no='$id[$i]'") or die(mysqli_error($conn));
                                
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
         