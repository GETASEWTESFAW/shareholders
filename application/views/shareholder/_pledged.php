<?php
$conn=mysqli_connect('localhost','root','software','shareholder_test');
if (isset($this->session->userdata['logged_in'])) {

$username = $this->session->userdata['logged_in']['username'];
$role = $this->session->userdata['logged_in']['role'];  
    
} 
?> 
<?php if(isset($_GET['pledged'])){ ?>
    
<div class="alert alert-success alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>Success!</b> Pledged Authorized Successfully!.
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
                                                <th>No.</th>

                                                <th></th>

                                                <th></th>

                                                <th></th>
                                                
                                                <th>Account number</th>

                                                <th>Shareholder Name</th>

                                                <th>Pludged Amount</th>
                                                
                                                <th>Reason</th>

                                               </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            
       $query = mysqli_query($conn,"SELECT * from pludge where 
        pledged_status = 'pending' order by id ASC") or die(mysqli_error($conn));
                                            
                                            $a = 0;
                                            
                                            while ($rows = mysqli_fetch_array($query)) {

                                            $a = $a + 1;
                                                
                                            ?>
                                            <tr>

                                    

                                                <td><?php echo $a; ?></td>

                                                <td><input type="checkbox" name="selector[]" value="<?php echo $rows['id']; ?>"></td>

                                                <td><input type="checkbox" name="applist[]" value="<?php echo $rows['account_no'];?>"></td>

                                                <td></td>
                                                
                                                <td><?php echo $rows['account_no']; ?></td>

                                                <td><?php echo $rows['name']; ?></td>

                                                <td><?php echo $rows['plamount']; ?></td>
                                                
                                                <td><?php echo $rows['pledged_reason']; ?></td>
                                                                                             
                                            </tr>

                                            <?php } ?>
                                            
                                        </tbody>
                                   
                            <?php if($role == 'Authorizer'){?> 
                                    <fieldset> 
                                          <button type="submit" name="authorize" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i> Authorize</button>
                                          <button type="submit" name="reject" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Reject</button>
                                    </fieldset>       
                            <?php } 

                                ?>  

                                <br><br>


                                    </table>

                                    <?php 

                                     if (isset($_POST['authorize']) && isset($_POST['applist'])) {
                                        
                                        
                                        $account_no = $_POST['applist'];
                                        $id = $_POST['selector'];                                
                                        $N = count($account_no);
                                        $count_id = count($id);

                                    for($i=0; $i < $N; $i++)

                                    { 
                                        $result = mysqli_query($conn,"UPDATE shareholders SET pledged_status = 'pledged' where account_no = '$account_no[$i]'") or die(mysqli_error($conn));

                                        $result2 = mysqli_query($conn,"UPDATE pludge SET pledged_status = 'pledged' where id = '$id[$i]'") or die(mysqli_error($conn));  
                                    }

                                        header('location:pledged?pledged=true');
                            
                                    }

                                    if (isset($_POST['reject']) && isset($_POST['applist'])){

                                        
                                         $account_no = $_POST['applist'];
                                        $id = $_POST['selector'];  
                                                                            
                                        $N = count($id);
                                            
                                        for($i=0; $i < $N; $i++)
                                            {   

                                              $result = mysqli_query($conn,"UPDATE pludge 
                                                                        SET 
                                                                            pledged_status = 'rejected',
                                                                            authorized_by = '$username'
                                                                        WHERE 
                                                                    id ='$id[$i]'
                                                                    "
                                                ) or die(mysqli_error($conn));
                                              header('location:pledged?reject=true');
                                                
                                            }
                                    }
                                    ?>
                           
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         