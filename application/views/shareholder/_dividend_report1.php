<?php
    $conn=mysqli_connect('localhost','root','software','shareholder_test');
    if (isset($this->session->userdata['logged_in'])) {
    
    $username = $this->session->userdata['logged_in']['username'];
      
    } 
    
?> 
<?php

  if(isset($_GET['active'])){
  
  ?>
  
  <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> Shareholder Released Successfully!.
                                    </div>
  
  <?php } ?>
  
                <!-- Main content -->
                
                
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                           <div class="box">

                            <div align="center">
                            <form method="post" action="">

                              <select name="name" required>
            <option value="">Select Shareholder</option>
            <?php
            
            $result = mysqli_query($conn,"SELECT * FROM shareholders group by name order by name");
            while($row = mysqli_fetch_array($result))
              {
                echo '<option value="'.$row['name'].'">';
                echo $row['name'];
                echo '</option>';
              }
            ?>
            
            
            
            </select>

                              <button type="submit" name="search" class="btn btn-primary btn-sm">Search</button>

                            </form>

                          </div>
                                
                                <div class="box-body table-responsive">
                                <form action="" method="POST">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              
                                              
                                                <th>No.</th>

                                                <th>SC_No</th>

                                                <th>Account number</th>

                                                <th>Shareholder Name</th>

                                                <th>Total Paidup Capital in Birr (<?php $y = date('Y', strtotime(date('Y')." -1 year")); echo date('30 M'); echo $y; ?>)</th>

                                                <th>Amount Transfered</th>

                                                <th>Adjusted Balance</th>

                                                <th>Dividend Capitalized</th>

                                                <th>Dividend Payable Capitalized</th>

                                                <th>Cash Payment</th>

                                                <th>Total Raised</th>

                                                <th>Total Paid-Up Capital</th>

                                                <th>Value Date</th>

                                                <th>Breakdown</th>

                                                <th>Average Paidup Capital</th>

                                                <th>Sum of the Average Paidup Capital</th>

                                                <th>Total Paid-up capital utilized during the Year</th>

                                                <th>Ratio</th>

                                                <th>Portion of Ordinary Dividend</th>

                                                <th></th>

                                                <th></th>
                                        </thead>
                                        <tbody>
                                          
                                          <?php

                                          if(isset($_POST['search'])) {

                                            $name = $_POST['name'];
                                          
                                          $query = mysqli_query($conn,"SELECT * from shareholders where name = '$name' group by name order by id ASC") or die(mysqli_error($conn));
                                          
                                          $a = 0;
                                          
                                          while ($rows = mysqli_fetch_array($query)) {
                                              
                                            $a = $a + 1;
                      
                                          ?>
                                            <tr>
                                            
                                                <td><?php echo $a; ?></td>

                                                <td><?php echo $rows['sc_no']; ?></td>

                                                <td><?php echo $rows['account_no']; ?></td>

                                                <td><?php echo $rows['name']; ?></td>

                                                <td><?php echo number_format($rows['total_share_subscribed_inbirr'],2); ?></td>

                                                <?php

                                                $result = mysqli_query($conn,"SELECT *,sum(total_share_transfered_in_birr) from transfer where name = '$name'") or die(mysqli_error($conn));

                                                while($row = mysqli_fetch_array($result)){

                                                $result1 = mysqli_query($conn,"SELECT *,sum(total_share_transfered_in_birr) from transfer where rname = '$name'") or die(mysqli_error($conn));

                                                while($fetch = mysqli_fetch_array($result1)){

                                                ?>

                                                <td>&nbsp;<?php echo number_format($fetch['sum(total_share_transfered_in_birr)'],2); ?><br>(<?php echo number_format($row['sum(total_share_transfered_in_birr)'],2); ?>)</td>

                                                <td><?php echo number_format($rows['total_share_subscribed_inbirr'] - $row['sum(total_share_transfered_in_birr)'] + $fetch['sum(total_share_transfered_in_birr)'],2); ?></td>

                                                <?php

                                                $result = mysqli_query($conn,"SELECT *,sum(capitalized_in_birr) from capitalized where name = '$name' and type = 'capitalized'") or die(mysqli_error($conn));

                                                while($cap = mysqli_fetch_array($result)){

                                                ?>

                                                <td><?php echo number_format($cap['sum(capitalized_in_birr)'],2); } ?></td>
                                               
                                                <td></td>

                                                <?php

                                                $result = mysqli_query($conn,"SELECT *,sum(capitalized_in_birr) from capitalized where name = '$name' and type = 'cash'") or die(mysqli_error($conn));

                                                while($cap = mysqli_fetch_array($result)){

                                                ?>

                                                <td><?php echo number_format($cap['sum(capitalized_in_birr)'],2); } ?></td>

                                                <?php

                                                $result = mysqli_query($conn,"SELECT *,sum(capitalized_in_birr) from capitalized where name = '$name'") or die(mysqli_error($conn));

                                                while($cap = mysqli_fetch_array($result)){

                                                ?>

                                                <td><?php echo number_format($cap['sum(capitalized_in_birr)'],2); ?></td>
                                                     
                                                <td><?php echo number_format($rows['total_share_subscribed_inbirr'] - $row['sum(total_share_transfered_in_birr)'] + $fetch['sum(total_share_transfered_in_birr)'] + $cap['sum(capitalized_in_birr)'],2); ?></td>  
                                              

                                                <td><?php

                                                $resultv = mysqli_query($conn,"SELECT * from capitalized where name = '$name'") or die(mysqli_error($conn));

                                                while($value = mysqli_fetch_array($resultv)) {

                                                ?><br>__________<br><?php echo $value['value_date']; } ?></td> 

                                                
                                                <td><?php

                                                $resultp = mysqli_query($conn,"SELECT * from capitalized where name = '$name'") or die(mysqli_error($conn));

                                                while($cash = mysqli_fetch_array($resultp)) {

                                                ?><br>__________<br><?php echo number_format($cash['capitalized_in_birr'],2); } ?></td>  

                                                <td><?php

                                                $resultp = mysqli_query($conn,"SELECT * from capitalized where name = '$name'") or die(mysqli_error($conn));

                                                while($cash = mysqli_fetch_array($resultp)) {

                                                  $db_date = $cash['value_date'];

                                                  $month = 7; $year = date('Y');
$datediff = date("Y-m-t", mktime(0, 0, 0, $month - 1, 1, $year));
                                      
                                                    if (!function_exists("dateDiff")){

                                                    function dateDiff($start, $end) {
                                                    $start_ts = strtotime($start);
                                                    $end_ts = strtotime($end);
                                                    $diff = $end_ts - $start_ts;
                                                    return round($diff / 86400);
                                                  }
                                                }

                                                  $diff = dateDiff($db_date, $datediff);

                                                  //$arcash = array($cash['capitalized_in_birr']);

                                                  //echo $diff;
                                                       //print_r(array_sum($arcash)); 
                                                ?>
                                                <br>__________<br><?php echo number_format(round($cash['capitalized_in_birr'] * $diff / 365 ,3),2);  } ?></td>  

                                                <td><?php

                                                $resultp = mysqli_query($conn,"SELECT *,SUM(average) from capitalized where name = '$name'") or die(mysqli_error($conn));

                                                while($cash = mysqli_fetch_array($resultp)) {

                                                  $db_date = $cash['value_date'];

                                                  $month = 7; $year = date('Y');
                                                  $datediff = date("Y-m-t", mktime(0, 0, 0, $month - 1, 1, $year));
                                      
                                                    if (!function_exists("dateDiff")){

                                                    function dateDiff($start, $end) {
                                                    $start_ts = strtotime($start);
                                                    $end_ts = strtotime($end);
                                                    $diff = $end_ts - $start_ts;
                                                    return round($diff / 86400);
                                                  }
                                                }

                                                  $diff = dateDiff($db_date, $datediff);

                                                  //echo $diff;

                                                  $sum = $cash['capitalized_in_birr'] * $diff / 365;

                                                  

                                                ?>
                                                <br>__________<br><?php echo number_format($cash['SUM(average)'],2); } ?></td>  

                                                <td><?php

                                                $resultp = mysqli_query($conn,"SELECT *,SUM(average) from capitalized where name = '$name'") or die(mysqli_error($conn));

                                                while($cash = mysqli_fetch_array($resultp)) {

                                                  $db_date = $cash['value_date'];

                                                  $month = 7; $year = date('Y');
                                                  $datediff = date("Y-m-t", mktime(0, 0, 0, $month - 1, 1, $year));
                                      
                                                    if (!function_exists("dateDiff")){

                                                    function dateDiff($start, $end) {
                                                    $start_ts = strtotime($start);
                                                    $end_ts = strtotime($end);
                                                    $diff = $end_ts - $start_ts;
                                                    return round($diff / 86400);
                                                  }
                                                }

                                                  $diff = dateDiff($db_date, $datediff);

                                                  //echo $diff;

                                                  $sum = $cash['capitalized_in_birr'] * $diff / 365;

                                                  

                                                ?><?php echo number_format($rows['total_share_subscribed_inbirr'] - $row['sum(total_share_transfered_in_birr)'] + $fetch['sum(total_share_transfered_in_birr)'] + $cash['SUM(average)'],2); } ?></td>  

                                                <td></td>  

                                                <td></td>  

                                                <td><?php

                                                    $average = mysqli_query($conn,"SELECT * from capitalized where name = '$name'") or die(mysqli_error($conn));

                                                    while($av = mysqli_fetch_array($average)){
                
                                                    $db_date = $av['value_date'];

                                                    $month = 7; $year = date('Y');
                                                    $datediff = date("Y-m-t", mktime(0, 0, 0, $month - 1, 1, $year));
                                      
                                                   
                                                    ?><br>__________<br><?php 

                                                    if (!function_exists("dateDiff")){

                                                    function dateDiff($start, $end) {
                                                    $start_ts = strtotime($start);
                                                    $end_ts = strtotime($end);
                                                    $diff = $end_ts - $start_ts;
                                                    return round($diff / 86400);
                                                  }
                                                }

                                                  $diff = dateDiff($db_date, $datediff);

                                                  echo $diff;

                                                   } ?></td>  

                                                <td><br>__________<br><?php $month = 7; $year = date('Y');
echo date("Y-m-t", mktime(0, 0, 0, $month - 1, 1, $year)); ?></td>     

                                               <?php } } } } } ?>
                                                
                                            </tr>
                                            
                                        </tbody>
                                       
                                    </table>

                                    
                                    
                                   </form> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
         
