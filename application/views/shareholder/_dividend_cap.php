	<?php
		$conn=mysqli_connect('localhost','root','software','shareholder_test');
		if (isset($this->session->userdata['logged_in'])) {
			
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
        xmlhttp.open("GET","<?php echo base_url();?>shareholder/getaccountuser?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<?php
	if(isset($_GET['cash'])){
	?>
	<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> Dividend Capitalized!.
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
                       
                         				<form action="" method="POST" role="form" name='myForm'>
                                    
                                        <div class="form-group">
                                            
                                            <label> Shareholder Name</label>
                                            <select name="shareholder" class="form-control" required onchange="showUser(this.value)">
                                            	<option value="">Select Shareholder Name</option>
                                            	<?php
										
										$result = mysqli_query($conn,"SELECT * FROM shareholders WHERE status != 'closed' group by name order by account_no");
										
                    while($row = mysqli_fetch_array($result))
											{
												echo '<option value="'.$row['account_no'].'">';
												echo $row['account_no'] .'-'. $row['name'];
												echo '</option>';
											}
										?>
                                           	
                                            </select>
                                           
                                        </div>

                                <div id="txtHint"></div>  
                                      <div class="form-group">
                                            <label>Capitalized Amount in Birr</label>
                                            <input type="text" name="capitalized_in_birr" class="form-control" placeholder="Enter ..." required/>
                                 			
                                        </div>

                                        <div class="form-group">
                                            <label>Value Date</label><br>
                                            <input type="text" name="value_date" class="tcal" placeholder="Enter ..." required/>
                                 			
                                        </div>
										                        
                                        <input type="hidden" readonly="" value="<?php echo $username;?>" name="blocked_by" class="form-control"/>
                                      	<input type="hidden" readonly="" value="<?php //echo $_GET['id'];?>" name="id" class="form-control"/>
                                      
                                        <div class="box-footer">
                                     
                                        <button type="submit" class="btn btn-primary" name="submit">Capitalize</button>
                                    </div>
                                    
                                    <?php 

                                        if(isset($_POST['submit'])){
                                            
    $name = $_POST['name'];
                                        
    $capitalized_share = $_POST['capitalized_in_birr']/500;

    $capitalized_in_birr = $_POST['capitalized_in_birr'];

    $account_no = $_POST['account_no'];
                                            
    $value_date = $_POST['value_date'];

    $year = date('Y');                                      

    mysqli_query($conn,"INSERT into capitalized (name,capitalized_in_share,capitalized_in_birr,value_date,type,account_no,year,status_of_dividendcapitalized) values ('$name','$capitalized_share','$capitalized_in_birr','$value_date','capitilized','$account_no','$year','pending')") or die(mysqli_error($conn));

        header('location:dividend_capitalized?cash=true');                               
                                            } 
                                            ?>

                                   
                                    
                                     </form>
                                </div><!-- /.box-body -->
                           
                     </div>