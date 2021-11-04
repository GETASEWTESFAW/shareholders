	<?php
		
		$conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {	
		$username = $this->session->userdata['logged_in']['username'];
			
		} 
	?>
  <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","<?php echo base_url();?>shareholder/getaccountno?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<?php
  if(isset($_GET['sharerequest'])){
  ?>
  <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b> Share Requested successfully!.
                                    </div>
  <?php } ?>

  <?php
  if(isset($_GET['sharerequestupdate'])){
  ?>
  <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b> Share request updated successfully!.
                                    </div>
  <?php } ?>
                            <!-- general form elements disabled -->
                      <div class="box box-warning">
                          <div class="col-md-12">
                        	<div class="col-md-6">
                                <div class="box-body">
                                         <!-- display message -->
								   	<?php
										if (isset($message_display)) { ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<?php 
											echo "<div class='message'>";
											echo $message_display;
											echo "</div>";
										?>
				   					</div> 
				   					<?php } ?> 
				   					
				   					<?php
										if (isset($message_success)) { ?>
									<div class="alert alert-success alert-dismissable" role="alert">
										<?php 
											echo "<div class='message'>";
											echo $message_success;
											echo "</div>";
										?>
				   					</div> 
				   					<?php } ?> 

                    <?php if($this->session->flashdata('flashError')): ?>
                   
                  <p class='flashMsg flashError alert alert-danger alert-dismissable'> <?php echo $this->session->flashdata('flashError')?> </p>
                  <?php endif ?>
                       
                
                         				 <form action="" method="POST" role="form">
                                        <!-- text input -->
                                        <!-- textarea -->
                                       
                                   <div class="form-group">
                                            
                                            Shareholder Name
                                            <select name="shareholder_name" class="form-control" onchange="showUser(this.value)">
                                              <option value="">Select Name of Shareholder</option>
                                              <?php
                    
                                      $result = mysqli_query($conn,"SELECT * FROM shareholders group by name order by account_no");
                                      while($row2 = mysqli_fetch_array($result))
                                        {
                                          echo '<option value="'.$row2['account_no'].'">';
                                          echo $row2['account_no']." - ".$row2['name'];
                                          echo '</option>';
                                        }
                                      ?>
                                      </select>
                                      </div>

                                        <div id="txtHint"></div>
                                         <div class="form-group">
                                            <label>Application Date</label>
                                            <input type="text" readonly="" name="application_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter ..."/>
                                 			
                                        </div>      

                                       <div class="form-group">
                                            <label>Total Share Needed</label>
                                            <input type="text" name="total_share" autofocus="" value="<?php echo set_value('total_share'); ?>" class="form-control" plactaeholder="Enter ..."/>
                                 				<?php echo form_error('total_share'); ?>
                                        </div>
                                        
                                        <input type="hidden" readonly="" value="waiting" name="status" class="form-control"/>
                                        
                                        <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </div>
                                </form>
                           </div><!-- /.box-body -->
                     </div>
                    
                    <?php 

                    if(isset($_POST['submit'])){

                        $shareholder_name = $_POST['name'];
                        $account_no = $_POST['account_no'];
                        $application_date = $_POST['application_date'];
                        $total_share = $_POST['total_share'];
                        $status = $_POST['status'];
                        $year = DATE('Y');

                        $result2 = mysqli_query($conn,"SELECT * FROM new_request WHERE account_no = '$account_no' AND year = '$year'");
                        
                        if(mysqli_num_rows($result2) > 0){

                        $row = mysqli_fetch_array($result2);

                        $share_requested = $row['total_share'];

                        $total_share = $_POST['total_share'] + $share_requested;

                        $result = mysqli_query($conn,"UPDATE new_request SET total_share = '$total_share',application_date = '$application_date' WHERE account_no = '$account_no'") or die(mysqli_error($conn));
                        header('location:sharerequest?sharerequestupdate=true');    
                    } else {
                        $result = mysqli_query($conn,"INSERT INTO new_request (account_no,name,year,total_share,status,application_date) VALUES ('$account_no','$shareholder_name','$year','$total_share','$status','$application_date')") or die(mysqli_error($conn));
                        header('location:sharerequest?sharerequest=true');    
                 
                     }
                   }
                    ?>