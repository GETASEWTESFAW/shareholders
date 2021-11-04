<?php
		$conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {
		$username = $this->session->userdata['logged_in']['username'];
        $role = $this->session->userdata['logged_in']['role'];	
		} 
?>
<?php if(isset($_GET['block_check'])){ ?>
    
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    Please check the check box before clicking release button.
</div>
<?php } ?>
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

if(isset($_GET['release_blocked_share'])){

?>
  
  <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Request sent to authorization</a>
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
                                              
                                                <th>Total paid up capital in birr</th>
                                               
												<th>Reason</th>
                                                <th>Status</th>
												
												
                                        </thead>
                                        <tbody>

<?php

    $account_no = $_GET['acct'];
    $query = mysqli_query($conn,"SELECT * from blocked where status = 'blocked' AND account_no = '$account_no' order by id ASC") or die(mysqli_error($conn));
    
    $num_rows = mysqli_num_rows($query);
    if($num_rows == '0'){
      ?>
             <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Authorize the blocked shareholder first before release.                                 </div>
    <?php }

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
                                                    
                                                <td><?php echo $rows['total_paidup_capital_inbirr']; ?></td>
                                               
                                              	<td><?php echo $rows['block_remark']; ?></td>
                                                <td>

                                                <?php
               if($rows['status'] == 'please_release_share'){
                                                		
														?>
														
					<span class="badge bg-red"><?php echo $rows['status']; ?></span>
														
														<?php
														
													} else {
														
														?>
				    <span class="badge bg-red"><?php echo $rows['status']; ?></span>
														
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


                                  
        <button type="submit" name="release_share" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Release Share</button>
                               
                                    <br><br>
                                    </table>
                                    
                                    <?php
						
			if (isset($_POST['release_share'])){
										
				$id = $_POST['applist'];
        $account_no = $_GET['acct'];
				$N = count($id);

        if($_POST['applist'] == NULL){
          header('location:release_blocked_share?block_check=true&acct='.$account_no);   
        } else { 
									
				for($i=0; $i < $N; $i++)
				{	
				
         $result2 = mysqli_query($conn,"UPDATE blocked SET status = 'please_release_share' where id='$id[$i]'");
										
				header('location:release_blocked_share?release_blocked_share&acct='.$account_no);
										
				}
							
			}
  }

             if (isset($_POST['reject'])){

                                         $id=$_POST['applist'];
                                                                            
                                            $N = count($id);
                                            
                                            for($i=0; $i < $N; $i++)
                                            {   

            $result2 = mysqli_query($conn,"UPDATE blocked SET status = 'rejected' where account_no='$id[$i]'")or die(mysqli_error($conn));
                                            
                                              header('location:release_blocked?reject=true');
                                                
                                            }
                                    }                           
                                 
									?>
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         
