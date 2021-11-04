	<?php
		
		$conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {
			
		$branch = $this->session->userdata['logged_in']['branch'];
			
		$username = $this->session->userdata['logged_in']['username'];
			
		} 
		
	?>
		      
                            <!-- general form elements disabled -->
                      <div class="box box-warning">
                          <div class="col-md-12">
                        	<div class="col-md-6">
                                <div class="box-body">
                                         <!-- display message -->
								   	<?php
										if (isset($message_display)) { ?>
									<div class="alert alert-info" role="alert">
										<?php 
											echo "<div class='message'>";
											echo $message_display;
											echo "</div>";
										?>
				   					</div> 
				   					<?php } ?> 
				   					
				   			    
                         				 <form action="<?php echo base_url('');?>user_authentication/new_user_registration" method="POST" role="form">
                                        <!-- text input -->
                                        
                                        
                                         <div class="form-group">
                                            <label>FullName</label>
                                            <input type="text" name="fname" autofocus="" value="<?php echo set_value('fname'); ?>" class="form-control" placeholder="Enter ..."/>
                                 				<?php echo form_error('fname'); ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Enter ..."/>
                                 			<?php echo form_error('username'); ?>
                                        </div>
                                  		
                                  		<div class="form-group">
                                            <label>Password</label>
                                            <input type="text" name="password" readonly="" class="form-control" value="123456" placeholder="Enter ..."/>
                                 			
                                        </div>
                                        
                                        <div class="form-group">
                                            
                                            <label>Role</label>
                                            <select name="role" class="form-control">
                                            	<option value="">Select User Role</option>
                                            	<option value="user">User</option>
                                            	<option value="admin">Authorizer</option>
                                            	<option value="auditor">Auditor</option>
                                            	<option value="TF">Trade Finance</option>
                                         
                                            	
                                            </select>
                                 			<?php echo form_error('role'); ?>
                                        </div>
                                        
                                         <div class="form-group">
                                            
                                            <label>Branch</label>
                                            <select name="branch" class="form-control">
                                            	
                                            	<option value="">Select Branch</option>
                                            	<?php
										
										$result = mysqli_query($conn,"SELECT * FROM branch group by name");
										while($row = mysqli_fetch_array($result))
											{
												echo '<option value="'.$row['name'].'">';
												echo $row['name'];
												echo '</option>';
											}
										?>
				                                         
                                            	
                                            </select>
                                 			<?php echo form_error('branch'); ?>
                                        </div>
                                        
                                        
                                     <button type="submit" class="btn btn-primary" name="submit">Register user</button>
                          </div></div>
                        
                                       
                                    </div>
                                    
                                     </form>
                                </div><!-- /.box-body -->
                           
                     </div>
                    
             