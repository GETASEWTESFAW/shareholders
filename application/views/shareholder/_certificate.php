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
        xmlhttp.open("GET","<?php echo base_url();?>shareholder/getusers?q="+str,true);
        xmlhttp.send();
    }
}
</script>

<?php
    if(isset($_GET['status'])){
    ?>
    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> certificate created succesfully!.
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

                                            <select name="account_no" class="form-control" required onchange="showUser(this.value)">
                                                <option value="">Select Shareholder Name</option>
                                        
                                        <?php

                                        $from = $_GET['from']; 
                    
                                        $to = $_GET['to'];

                                        $result = mysqli_query($conn,"SELECT * FROM shareholders WHERE shareholders.status != 'closed' AND (shareholders.year BETWEEN '$from' and '$to') and shareholders.cert_status = '' order by shareholders.account_no");
                                        
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
                                            <label>prepared certificate</label>
                                            <input type="text" onKeyPress="return event.charCode > 47 && event.charCode < 58;" name="prepared_share_certificate" class="form-control" placeholder="Enter prepared certificate..." required/>
                                      
                                        </div>                       
                                        <input type="hidden" readonly="" name="issued_share_certificate" value="0" class="form-control"/>
                                        <input type="hidden" readonly="" name="tsubscribed_share" class="form-control"/>                        
                                        <input type="hidden" readonly="" value="<?php echo $username;?>" name="blocked_by" class="form-control"/>
                                        <input type="hidden" readonly="" value="<?php //echo $_GET['id'];?>" name="id" class="form-control"/>
                                      
                                        <div class="box-footer">
                                     
                                        <button type="submit" class="btn btn-primary" name="submit">submit</button>
                                    </div>
                                    
                                    <?php 
                                        if(isset($_POST['submit'])){
                                            
                                            $from = $_GET['from'];

                                            $to = $_GET['to'];
                                            
                                            $issued_share = $_POST['issued_share_certificate'];

                                            $prepared_share = $_POST['prepared_share_certificate'];

                                            $account_no = $_POST['account_no'];
                                            
                                            mysqli_query($conn,"INSERT into certificate (issued_share_certificate,prepared_share_certificate,account_no) 
                                                values ('$issued_share','$prepared_share',$account_no)") or die(mysqli_error($conn));

                                            mysqli_query($conn,"UPDATE shareholders set cert_status = 'prepared' where account_no = '$account_no'") or die(mysqli_error($conn));

                                            header('location:http://172.23.2.174/shareholder_test/shareholder/certificate?status=success&from='.$from.'&to='.$to);                             
                                            

                                            ?>
                                    
                                        <?php
                                    }

                                        ?>
                                    
                                     </form>
                                </div><!-- /.box-body -->
                           
                     </div>
                    
             