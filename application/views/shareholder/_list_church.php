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
    if(isset($_GET['reject_block'])){
    ?>
    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Request Rejected Succesfully!</b> 
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
   <?php

  if(isset($_GET['release_blocked'])){
  
  ?> 
  <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Request Released Succesfully</a>
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
                                                <th>Total paid up capital in birr</th>
                                                
                                            </thead>
                                        <tbody>
                
<?php 

 //$from = $_GET['from']; 
 //$to = $_GET['to'];

$query = mysqli_query($conn,"SELECT * from shareholders where share_type = 'church' and status != 'closed' order by id ASC") or die(mysqli_error($conn));
                                            
                                            $a = 0;
                                            
                                            while ($rows = mysqli_fetch_array($query)) {
                                                $a = $a + 1;
                                                
                                            ?>
                                            <tr>
                                                <td></td>

                                                <td><?php echo $a; ?></td>
                                                
                                                <td><?php echo $rows['account_no']; ?></td>

                                                <td><?php echo $rows['name']; ?></td>
                                                    
                                                <td><?php echo number_format($rows['total_paidup_capital_inbirr'],2); ?></td>

                                               <?php } ?>
                                                
                                            </tr>
                                        </tbody>
       <br><br>
                                    </table>                     
                                    <br><br>
                                    </table>
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         
