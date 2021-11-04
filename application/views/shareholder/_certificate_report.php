<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
		if (isset($this->session->userdata['logged_in'])) {
		$username = $this->session->userdata['logged_in']['username'];	
		} 
?> 
	
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                           <div class="box">
                                
                            <div id="homepage_search">

                                <form method="post" action=""><br>                                                  
                                
                                  <div class="col-xs-6">
                                    <label for="ex3">Please Enter Account No </label>
                                    <input class="form-control" id="ex3" type="text" name="certificate"><br/>
                                    <button type="submit" name="search" id="homepage_search_btn" class="btn btn-primary btn-sm">Search</button>
                             
                                </div>
                                 <div class="col-xs-6">
                                   </div>                           
                                
                                </form>

                              </div>

                                <div class="box-body table-responsive">
                                <form action="" method="POST">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th></th>
                                                <th>No.</th>                                                
                                                <th>Account number</th>
                                                <th>Shareholder Name</th>                                               
                                                <th>Total paid up capital in birr</th>
                                                <th>Total paid up share</th>
                                                <th>Issued share certificate </th>
                                                <th>Prepared share certificate </th>
                                       			<th>Remaining share to be prepared</th>
                                       			
                                                <th></th>
                                                <th></th>
                                       			
                                        </thead>
                                        <tbody>
                                        	
                                        	<?php

                                          if(isset($_POST['search'])){
                                        
                                            $certificate = $_POST['certificate'];
                                        	
                                        	$query = mysqli_query($conn,"SELECT certificate.account_no,certificate.issued_share_certificate,certificate.prepared_share_certificate,shareholders.total_paidup_capital_inbirr,shareholders.name from certificate,shareholders WHERE certificate.account_no = shareholders.account_no and certificate.account_no LIKE '$certificate%' order by certificate.account_no") or die(mysqli_error($conn));
                                                                 	
                                        	$a = 0;
                                        	
                                        	while ($rows = mysqli_fetch_array($query)) {
                                        		$a = $a + 1;
                                        		
                                        	?>
                                            <tr>                                            
                                            <td></td>
                                            <td><?php echo $a; ?></td>                                            
                                            <td><?php echo $rows['account_no']; ?></td>
                                            <td><?php echo $rows['name']; ?></td>                                                
                                            <td><?php echo number_format($rows['total_paidup_capital_inbirr']); ?></td>
                                            <td><?php echo $rows['total_paidup_capital_inbirr']/500; ?></td>   
                                            <td><?php echo $rows['issued_share_certificate']; ?></td>
                                            <td><?php echo $rows['prepared_share_certificate']; ?></td>
                                            <td><?php echo ($rows['total_paidup_capital_inbirr']/500)-($rows['issued_share_certificate'] + $rows['prepared_share_certificate']); ?></td>
                                            
                                            <td><a href="<?php echo base_url();?>shareholder/edit_certificate?id=<?php echo $rows['account_no']; ?>">Update</td>  

                                            <td><a href="<?php echo base_url();?>shareholder/update_certificate?id=<?php echo $rows['account_no']; ?>">Edit Error</td>      
                                               <?php }  } ?>
                                                
                                            </tr>
                                            
                                        </tbody>
                                    
                                    </table>
                                   
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         
