<?php
        $conn=mysqli_connect('localhost','root','software','shareholder_test'); if (isset($this->session->userdata['logged_in'])) {
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
    
    $query = mysqli_query($conn,"SELECT * from blocked where status = 'please_release_share' order by id ASC") or die(mysqli_error($conn));
                                            
                                            $a = 0;
                                            
                                            while ($rows = mysqli_fetch_array($query)) {
                                                $a = $a + 1;
                                                
                                            ?>
                                            <tr>
                                                <td></td>
 <td><input type="checkbox" name="applist[]" value="<?php echo $rows['id'];?>"></td>
       <td><input type="checkbox" name="selector[]" value="<?php echo $rows['account_no'];?>"></td>
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
                                                
                                                <input type="hidden" name="account_no" value="<?php echo $rows['account_no']; ?>">
                                                
                                                        </td>
                                        

                                               <?php } ?>
                                                
                                            </tr>
                                        </tbody>

        <?php if($role == 'Authorizer'){?>      
                                  <fieldset>
                                <button type="submit" name="authorize" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Authorize</button>
                                 <button type="submit" name="reject" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Reject</button>
                                </fieldset>
                                <?php } ?>        <br><br>
                                    </table>                     
                                    <br><br>
                                    </table>
                                   
<?php 
if (isset($_POST['authorize'])){
                                        
$id=$_POST['applist'];
                                            
$account_no = $_POST['selector'];

$N = count($id);

for($i=0; $i < $N; $i++)
    {   

        $query = mysqli_query($conn,"SELECT * FROM blocked WHERE account_no = '$account_no[$i]' AND status != 'released' AND status != 'rejected'");

        $count = mysqli_num_rows($query);

        if($count == '1') { 

            $result2 = mysqli_query($conn,"UPDATE blocked SET status = 'released' where id='$id[$i]'")or die(mysqli_error($conn));

            $result23 = mysqli_query($conn,"UPDATE shareholders SET blocked_status = 'active' where account_no = '$account_no[$i]'")or die(mysqli_error($conn));

                            } else {

            $result24 = mysqli_query($conn,"UPDATE blocked SET status = 'released' where id='$id[$i]'")or die(mysqli_error($conn));
                                    }
                                            
    header('location:release_blocked?release_blocked=true');
    
    }
        }
?>
                                     <?php 

                        if (isset($_POST['reject'])){
                                        
                                    $id=$_POST['applist'];

                                    $account_no = $_POST['selector'];
                                                                    
                                    $N = count($id);
                                    
                                    for($i=0; $i < $N; $i++)
                                    {   
                                        $result = mysqli_query($conn,"UPDATE blocked SET status = 'rejected' where id='$id[$i]'");
                                        
                                       header('location:release_blocked?reject_block=true');
 
                                    }
                                        }
                                    ?>
                   
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         
