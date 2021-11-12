<?php

$conn=mysqli_connect('localhost','root','software','shareholder_test');
if (isset($this->session->userdata['logged_in'])) {

$username = $this->session->userdata['logged_in']['username'];

} 

?>
<script>function format(input){
var num = input.value.replace(/\,/g,'');
if(!isNaN(num)){
if(num.indexOf('.') > -1){
num = num.split('.');
num[0] = num[0].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1').split('').reverse().join('').replace(/^[\,]/,'');
if(num[1].length > 2){
alert('You may only enter two decimals!');
num[1] = num[1].substring(0,num[1].length-1);
} input.value = num[0]+'.'+num[1];
} else {
input.value = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1').split('').reverse().join('').replace(/^[\,]/,'') };
} else {
alert('You may enter only Decimal numbers in this field!');
input.value = input.value.substring(0,input.value.length-2);
}
}
</script>
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
if(isset($_GET['update_allotement'])){
?>
<div class="alert alert-danger alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
 <b>Allotment must be updated for this account number before paying cash </b> .
</div>
<?php } ?>
<?php
if(isset($_GET['cash'])){
?>
<div class="alert alert-success alert-dismissable">
<i class="fa fa-ban"></i>
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
 <b>Cash payment sent for authorization</b> .
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
        
$budget_query = mysqli_query($conn,"SELECT * FROM budget_year_status WHERE budget_status = 'active'");
$budget_result = mysqli_fetch_array($budget_query);
$from="";
$to="";
if($budget_result){
$from = $budget_result['budget_from'];
$to = $budget_result['budget_to'];
}
$result = mysqli_query($conn,"SELECT * FROM shareholders WHERE status != 'closed' AND (year BETWEEN '$from' and '$to') order by account_no");
while($row = mysqli_fetch_array($result))
    {
        echo '<option value="'.$row['account_no'].'">';
        echo $row['account_no']. "-". $row['name'];
        echo '</option>';
    }
?>
        
    </select>
   
</div>
<div id="txtHint"></div>                     
<div class="form-group">
    <label>Cash Amount in Birr</label>
    <input type="text" onkeyup = "javascript:this.value=Comma(this.value);" name="capitalized_in_birr" class="form-control" placeholder="Enter ..." required/>
    
</div>
 
<div class="form-group">
    <label>Value Date</label><br>
    <input type="text" readonly onKeyPress="return event.charCode > 47 && event.charCode < 58;" name="value_date" class="tcal" placeholder="Enter ..." required/>
    
</div>
                       
<input type="hidden" readonly="" value="<?php echo $username;?>" name="blocked_by" class="form-control"/>
<input type="hidden" readonly="" value="<?php //echo $_GET['id'];?>" name="id" class="form-control"/>

<div class="box-footer">

<button type="submit" class="btn btn-primary" name="submit">Pay</button>
</div>

<?php 
if(isset($_POST['submit'])){
    
$name = $_POST['name'];
$capitalized_in_birr_result = $_POST['capitalized_in_birr'];
$capitalized_in_birr = preg_replace('/[ ,]+/', '', trim($capitalized_in_birr_result));
$capitalized_share = $capitalized_in_birr/500;
$account_no = $_POST['account_no'];

$select_budget_year = mysqli_query($conn,"SELECT * FROM budget_year_status WHERE budget_status = 'active'");
$budget_row = mysqli_fetch_array($select_budget_year);
$startd = $budget_row['budget_from'];
$endd = $budget_row['budget_to'];  
$value_date = $_POST['value_date'];
$currentDate = $value_date;
$currentDate = date('Y-m-d', strtotime($currentDate));
$today = date('Y-m-d');

$divisible = $capitalized_in_birr%500;

if(($currentDate < $startd) || ($currentDate > $endd)){

echo '<script>alert("Value date is out of budget year!");</script>';

} else {
    $value_date = $_POST['value_date'];
    $year = date('Y-m-d');
    $check = mysqli_query($conn,"SELECT * FROM allotment WHERE account_no = '$account_no' and allot_status = 'authorized'") or die(mysqli_error($conn));
    $check_row = mysqli_fetch_array($check);
    $check_allot = $check_row['allotment']*500;
    $allot_date = $check_row['allot_year'];
  
    if($capitalized_in_birr <= $check_allot){
    
    $query_cap = mysqli_query($conn,"SELECT *,sum(capitalized_in_share) from capitalized where 
    capitalized_status = 'pending' and type = 'cash' and account_no = '$account_no'")or die(mysqli_error($conn));

    while($row_cap = mysqli_fetch_array($query_cap)){
        
    $cap_share = $row_cap['sum(capitalized_in_share)'];
    $check_allot_row = $check_row['allotment'];
    $cap_share = $cap_share+$capitalized_share;    

    }

    if($cap_share <= $check_allot_row){

    mysqli_query($conn,"INSERT into capitalized (name,capitalized_in_share,capitalized_in_birr,value_date,type,account_no,year,capitalized_status) values ('$name','$capitalized_share','$capitalized_in_birr','$value_date','capitalized','$account_no','$year','pending')") or die(mysqli_error($conn));
    
    //mysqli_query($conn,"UPDATE shareholders set total_share_subscribed = total_share_subscribed + '$capitalized_share',total_share_subscribed_inbirr = total_share_subscribed_inbirr + '$capitalized_in_birr' where name = '$name'") or die(mysqli_error($conn));
    //mysqli_query($conn,"UPDATE shareholders set total_paidup_capital_inbirr = total_paidup_capital_inbirr + '$capitalized_in_birr' where name = '$name'") or die(mysqli_error($conn));

    header('location:http://172.23.2.174/shareholder/shareholder/cash_payment?cash=paid');                             
} else {
    echo '<script language="javascript">';
    echo 'alert("Capitalize payment more than the alloted amount is not allowed")';
    echo '</script>';
}
} elseif($value_date < $allot_date){
    echo '<script language="javascript">';
    echo 'alert("Value date of capitalized payment must be greater than alloted start date")';
    echo '</script>';

}elseif($divisible > 0){
    echo '<script language="javascript">';
    echo 'alert("Capitalized payment amount must be divisible by 500.")';
    echo '</script>';
} else{
    
    echo '<script language="javascript">';
    echo 'alert("Allotment must be updated for this account number before capitalizing")';
    echo '</script>';
      
}

    ?>


<?php
}
}

?>

</form>
</div><!-- /.box-body -->

</div>

