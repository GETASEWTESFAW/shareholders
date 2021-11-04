<?php
		$conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {
		
		$username = $this->session->userdata['logged_in']['username'];
        $role = $this->session->userdata['logged_in']['role'];  
			
		} 
?> 
<?php if(isset($_GET['pledge_check'])){ ?>
    
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Please check the check box before clicking release button.
    </div>
    
    <?php } ?>
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
     <?php if(isset($_GET['release_pledge'])){ ?>
    
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Pledge request sent for authorization successfully!.</b>
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
                            <th>Total paid up capital in share after pledged</th>
                            <th>Pledged Amount</th>
                            <th>Reason</th>
                            <th>Status</th>
                           </tr>
                    </thead>
                    <tbody>
                    	
                    	<?php
$account_no = $_GET['acct_no'];
$query = mysqli_query($conn,"SELECT * from pludge where 
pledged_status = 'pledged' and account_no ='$account_no'") or die(mysqli_error($conn));
                    	
                    	$a = 0;
                    	
                    	while ($rows = mysqli_fetch_array($query)) {
                    		$a = $a + 1;
                    		
                    	?>
                        <tr>
                            <td><input type="checkbox" name="applist[]" value="<?php echo $rows['id'];?>"></td>                                                
                        	<td><?php echo $a; ?></td>                                            	
                            <td><?php echo $rows['account_no']; ?></td>
                            <td><?php echo $rows['name']; ?></td>
                            <td><?php echo $rows['total_paidup_capital']; ?></td>
                            <td><?php echo $rows['plamount'];?></td>
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
                        
                        
                        <input type="hidden" name="plamount" value="<?php echo $rows['plamount']; ?>">
                        <input type="hidden" name="account_no" value="<?php echo $rows['account_no']; ?>">                        
                        <input type="hidden" name="total_paidup_capital" value="<?php echo $rows['total_paidup_capital']; ?>">                        

                           <?php } ?>
                            
                        </tr>
                        
                    </tbody>
               
        <?php if($role == 'Authorizer'){?> 
        <fieldset> 
              <button type="submit" name="authorize" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i> Authorize</button>
              <button type="submit" name="reject" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Reject</button>
        </fieldset>       
            <?php } 

            ?>
            <button type="submit" name="release" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i> Release</button>
                    <br><br>
                </table>

<?php 
if (isset($_POST['release'])){

if($_POST['applist'] == NULL){

 header('location:release_pledge?pledge_check=true&acct_no='.$account_no);   
} else { 
    
$id = $_POST['applist'];
$N = count($id);
$account_no = $_POST['account_no'];
        
for($i=0; $i < $N; $i++)
{   
    $result2 = mysqli_query($conn,"UPDATE pludge SET pledged_status = 'release_pledged' where id='$id[$i]'")or die(mysqli_error($conn));
}
header('location:release_pledge?release_pledge=true&acct_no='.$account_no);
} }
   
?>
                           
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         