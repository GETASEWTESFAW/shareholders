<?php

session_start(); //we need to start session in order to access it through CI

Class Shareholder extends CI_Controller {
	public $conn= "";

public function __construct() {
	$this->conn=mysqli_connect('localhost','root','software','shareholder_test');
parent::__construct();

// Load form helper library
$this->load->helper('html');
$this->load->helper('form');
$this->load->helper('url');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');

// Load database
$this->load->model('shareholder_model');
$this->load->model('login_database');

}
public function index(){
	
	/*
	$this->load->library('pagination');
	$this->load->model('foreign_model');
	$data['query'] = $this->foreign_model->foreign_detail();
	$config['base_url'] = 'http://127.0.0.1/foreign/';
	$config['total_rows'] = $this->db->get('exchange_info')->num_rows();
	$config['per_page'] = 10;
	$config['num_links'] = 5;
	$config['full_tag_open'] = '<div id="pagination">';
	$config['full_tag_close'] = '</div>'; 
	$this->pagination->initialize($config);
	$data['records'] = $this->db->get('exchange_info',$config['per_page'],$this->uri->segment(3));
	$this->load->view('foreign/index',$data);
	
	 */	

	
	 $this->load->helper('url');
	 $this->load->view('sessions/login_form');
}

public function view_tender(){
		
	$this->load->library('pagination');
	$this->load->library('table');
	//$this->table->set_heading('Id','Tender Title');
	
	$config['base_url'] = 'http://127.0.0.1/fetanjobs/index.php/tenders/view_tender';
	$config['total_rows'] = $this->db->get('tender')->num_rows();
	$config['per_page'] = 5;
	$config['num_links'] = 5;
	$config['full_tag_open'] = '<div id="pagination">';
	$config['full_tag_close'] = '</div>'; 
	
	$this->pagination->initialize($config);
	$data['records'] = $this->db->get('tender',$config['per_page'],$this->uri->segment(3));
	$this->load->view('tender/view_tender',$data);

}
public function cash_rev_report() {
	$this->load->view('shareholder/cash_rev_report');
}
public function list_allotment() {
	$this->load->view('shareholder/list_allotment');
}
public function authorize_allotment() {
	$this->load->view('shareholder/authorize_allotment');
}
public function create_shareholder_from_existing() {
	$this->load->view('shareholder/create_shareholder_from_existing');
}
public function choose_shareholder() {
	$this->load->view('shareholder/choose_shareholder');
}
public function type_of_transfer() {
	$this->load->view('shareholder/type_of_transfer');
}
public function query() {
	$this->load->view('shareholder/query');
}
public function share_for_resale() {
	$this->load->view('shareholder/share_for_resale');
}
public function transfer_share_for_sale() {
	$this->load->view('shareholder/transfer_share_for_sale');
}
public function dev_rev_report() {
	$this->load->view('shareholder/dev_rev_report');
}
public function payable_rev_report() {
	$this->load->view('shareholder/payable_rev_report');
}
public function transfer_to_existing() {
	$this->load->view('shareholder/transfer_to_existing');
}
//certificate mgt
public function manage_allotement() {
	$this->load->view('shareholder/manage_allotement');
}
public function add_paidup() {
	$this->load->view('shareholder/add_paidup');
}
public function edit_requested_share() {
	$this->load->view('shareholder/edit_requested_share');
}
public function edit_certificate() {
	$this->load->view('shareholder/edit_certificate');
}
public function upload_certificate() {
	$this->load->view('shareholder/upload_certificate');
}
public function upload_balance() {
	$this->load->view('shareholder/upload_balance');
}
public function shareholder_excel() {
	$this->load->view('shareholder/shareholder_excel');
}
public function transfer_share_from_nib_excel() {
	$this->load->view('shareholder/transfer_share_from_nib_excel');
}

public function update_certificate() {
	$this->load->view('shareholder/update_certificate');
}
public function rejected_report() {
	$this->load->view('shareholder/rejected_report');
}
public function dividend_cap() {
	$this->load->view('shareholder/dividend_cap');
}
public function pledged_report() {
	$this->load->view('shareholder/pledged_report');
}
public function blocked_report() {
	$this->load->view('shareholder/blocked_report');
}
public function release_blocked_share() {
	$this->load->view('shareholder/release_blocked_share');
}
public function closed_transfer_share() {
	$this->load->view('shareholder/closed_report');
}
public function closed_share() {
	$this->load->view('shareholder/closed_share');
}
public function release_pledge() {
	$this->load->view('shareholder/release_pledge');
}
public function transfer_share_excel() {
	$this->load->view('shareholder/transfer_share_excel');
}
public function transfer_bank_report() {
	$this->load->view('shareholder/transfer_bank_report');
}
public function authorize_cash_share_bank() {
	$this->load->view('shareholder/authorize_cash_share_bank');
}
public function transfer_report() {
	$this->load->view('shareholder/transfer_report');
}
public function closed_report() {
	$this->load->view('shareholder/closed_report');
}
public function transfer_from_nib() {
	$this->load->view('shareholder/transfer_from_nib');
}
public function authorize_new_shareholder() {
	$this->load->view('shareholder/authorize_new_shareholder');
}
public function authorize_blocked() {
	$this->load->view('shareholder/authorize_blocked');
}
public function authorize_transfer() {
	$this->load->view('shareholder/authorize_transfer');
}
public function authorize_cashpayment() {
	$this->load->view('shareholder/authorize_cashpayment');
}
public function authorize_capitalized() {
	$this->load->view('shareholder/authorize_capitalized');
}
public function authorize_payable() {
	$this->load->view('shareholder/authorize_payable');
}

public function release_blocked() {
	$this->load->view('shareholder/release_blocked');
}

public function pledged_release() {
	$this->load->view('shareholder/pledged_release');
}
public function distribute_capcash() {
	$this->load->view('shareholder/distribute_capcash');
}
public function transfer_cap_cash_pay() {
	$this->load->view('shareholder/transfer_cap_cash_pay');
}
public function edit_distribute() {
	$this->load->view('shareholder/edit_distribute');
}
public function edit_paidup() {
	$this->load->view('shareholder/edit_paidup');
}
public function edit_dividend() {
	$this->load->view('shareholder/edit_dividend');
}
public function add_dividend() {
	$this->load->view('shareholder/add_dividend');
}
public function paidup_calc() {
	$this->load->view('shareholder/paidup_calc');
}
public function certificate() {
	$this->load->view('shareholder/certificate');
}
public function edit_cap_dividend() {
	$this->load->view('shareholder/edit_cap_dividend');
}
public function certificate_report(){
	$this->load->view('shareholder/certificate_report');
}
public function edit_capitalized(){
	$this->load->view('shareholder/edit_capitalized');
}
//end certificate mgt

//dividend payable mgt
public function dividend_payable() {
	$this->load->view('shareholder/dividend_payable');
}

//end dividend payable mgt
public function authorizetransfer() {
	$this->load->view('shareholder/printslip');
}

public function top_shareholders() {
	$this->load->view('shareholder/top_shareholders');
}

public function layouts() {
	$this->load->view('layouts/admin_page');
}

public function allotment_update() {
	$this->load->view('shareholder/allotment_update');
}

public function statement() {
	$this->load->view('shareholder/statement');
}

public function edit_shareholder(){
	$this->load->view('shareholder/edit_shareholder');
}

public function dividend_calculation() {
	$this->load->view('shareholder/dividend_calculation');
}

public function dividend_report() {
	$this->load->view('shareholder/dividend_report');
}

public function cash_payment() {
	$this->load->view('shareholder/cash_payment');
}

public function dividend_capitalized() {
	$this->load->view('shareholder/dividend_capitalized');
}

public function calculate() {
	$this->load->view('shareholder/calculate');
}
public function viewdetail() {
	$this->load->view('shareholder/viewdetail');
}
public function pledged() {
	$this->load->view('shareholder/pledged');
}
public function convertnum() {
	$this->load->view('foreign/convertnum');
}
public function blockconfirm() {
	$this->load->view('shareholder/blockconfirm');
}
public function sharerequest() {
	$this->load->view('shareholder/sharerequest');
}
public function pledgeconfirm() {
	$this->load->view('shareholder/pledgeconfirm');
}
public function allocate_money() {
	$this->load->view('foreign/allocate_money');
}
public function login() {
	$this->load->view('sessions/login_form');
}
public function edir() {
	$this->load->view('Shareholder/edir');
}
public function list_company() {
	$this->load->view('Shareholder/list_company');
}
public function ngo() {
	$this->load->view('Shareholder/ngo');
}
public function individual() {
	$this->load->view('Shareholder/individual');
}

public function list_church() {
	$this->load->view('Shareholder/list_church');
}
public function listed() {
	$this->load->view('shareholder/listed');
}
public function upload_shareholder() {
	$this->load->view('shareholder/upload_shareholder');
}
public function block() {
	$this->load->view('shareholder/block');
}
public function dividend() {
	$this->load->view('shareholder/dividend');
}
public function returned() {
	$this->load->view('foreign/returned');
}

public function upload_sharerequest(){
	$this->load->view('shareholder/upload_sharerequest');
}

public function list_requested_share() {
	$this->load->view('shareholder/list_requested_share');
}
public function transfer() {
	$this->load->view('shareholder/transfer');
}

public function transfer_blocked_message() {
	$this->load->view('shareholder/transfer_blocked_message');
}

public function getaccountuser() {
				
	
$q = intval($_GET['q']);

$result = mysqli_query($this->conn,"SELECT * FROM shareholders WHERE account_no = '".$q."'");

$allot_result = mysqli_query($this->conn,"SELECT * FROM allotment WHERE allot_status = 'authorized' and account_no = '".$q."'");
$allot_row = mysqli_fetch_array($allot_result);
	
while($row = mysqli_fetch_array($result)) {

	?>

	<div class="form-group">
          <label>Account No</label>
          <input type="text" readonly name="account_no" id="txtHint" value="<?php echo $row['account_no']; ?>" class="form-control" placeholder="Enter ..."/>
          <input type="hidden" name="name" class="form-control" value="<?php echo $row['name']; ?>">
           <?php echo form_error('account_no'); ?>
     </div>

     <div class="form-group">
          <label>Total paid up capital in birr</label>
          <input type="text" readonly name="total_paidup_capital_inbirr" id="txtHint" value="<?php echo $row['total_paidup_capital_inbirr']; ?>" class="form-control" placeholder="Enter ..."/>
           <?php echo form_error('total_paidup_capital_inbirr'); ?>
     </div>

     <div class="form-group">
          <label>Subscribed Total Share</label>
          <input type="text" id="txtHint" readonly name="tsubscribed_share" value="<?php echo $row['total_share_subscribed']; ?>" class="form-control" placeholder="Enter ..."/>
           <?php echo form_error('tsubscribed_share'); ?>
     </div>

     <div class="form-group">
          <label>Alloted Amount</label>
          <input type="text" readonly name="allot_amount" id="txtHint" value="<?php echo $allot_row?$allot_row['allotment']:0; ?>" class="form-control" placeholder="Enter ..."/>
           
     </div>
<?php
	
	//
	
}
}


public function getaccountno() {
				
	
$q = intval($_GET['q']);

$result = mysqli_query($this->conn,"SELECT * FROM shareholders WHERE account_no = '".$q."'");

while($row = mysqli_fetch_array($result)) {
	
	?>

	<div class="form-group">
          <label>Account No</label>
          <input type="text" readonly name="account_no" id="txtHint" value="<?php echo $row['account_no']; ?>" class="form-control" placeholder="Enter ..."/>
           <?php echo form_error('account_no'); ?>
          <input type="hidden" readonly name="name" id="txtHint" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Enter ..."/>
          <?php echo form_error('account_no'); ?>
     </div>
		<?php  
		$prev_request = mysqli_query($this->conn,"SELECT * FROM new_request WHERE account_no = '$q'");
		$prev_row = mysqli_fetch_array($prev_request);
		?>
		<div class="form-group">
		<label>Total Share Requested Before</label>
		<input type="text" readonly autofocus="" value="<?php echo $prev_row['total_share']; ?>" class="form-control" plactaeholder="Enter ..."/>
		<?php echo form_error('total_share'); ?>
		</div>

<?php
	
	//
	
}
}

public function getusers() {

		
$q = intval($_GET['q']);

$result = mysqli_query($this->conn,"SELECT * FROM shareholders WHERE account_no = '".$q."'");

while($row = mysqli_fetch_array($result)) {
						
						$acct =$q;

                        $year = date('Y');
                                            
                        $query2 = mysqli_query($this->conn,"SELECT * from allotment where account_no = '$acct' and allot_year = '$year' order by id ASC") or die(mysqli_error($this->conn));
                                           
                        $rows2 = mysqli_fetch_array($query2);
												
	?>

	<div class="form-group">
          <label>Account No</label>
          <input type="text" readonly name="taccount_no" id="txtHint" value="<?php echo $row['account_no']; ?>" class="form-control" placeholder="Enter ..."/>
          <input type="hidden" name="rname" class="form-control" value="<?php echo $row['name']; ?>">
           <?php echo form_error('taccount_no'); ?>
     </div>
     <?php if($row['total_share_subscribed'] == 0 && $row['total_paidup_capital_inbirr'] == 0.00 ){ ?>
     	
     <div class="form-group">
          <label>Total paid up capital in birr</label>
          <input type="text" readonly name="buyyer_paidup" id="txtHint" value="<?php echo $row['total_paidup_capital_inbirr']; ?>" class="form-control" placeholder="Enter ..."/>
          <input type="hidden" name="rname" class="form-control" value="<?php echo $row['name']; ?>">
           <?php echo form_error('taccount_no'); ?>
     </div> 
     <div class="form-group">
          <label>Subscribed Share</label>
          <input type="text" readonly id="txtHint" name="tsubscribed_share" value="<?php echo $row['total_share_subscribed'] + $rows2['allotment_update']; ?>" class="form-control" placeholder="Enter ..."/>
           <?php echo form_error('tsubscribed_share'); ?>
     </div>
     <div class="form-group">
          <label>Allotment Amount</label>
          <input type="text" readonly id="txtHint" name="allotment_amount" value="" class="form-control" placeholder="Enter ..."/>
           <?php echo form_error('allotment_amount'); ?>
     </div>

    <?php } else { ?>

     <div class="form-group">
          <label>Total paid up capital in birr</label>
          <input type="text" readonly name="buyyer_paidup" id="txtHint" value="<?php echo $row['total_paidup_capital_inbirr']; ?>" class="form-control" placeholder="Enter ..."/>
          <input type="hidden" name="rname" class="form-control" value="<?php echo $row['name']; ?>">
           <?php echo form_error('taccount_no'); ?>
     </div>
     
     <div class="form-group">
          <label>Subscribed Total Share</label>
          <input type="text" readonly id="txtHint" name="tsubscribed_share" value="<?php echo $row['total_share_subscribed'] + $rows2['allotment_update']; ?>" class="form-control" placeholder="Enter ..."/>
           <?php echo form_error('tsubscribed_share'); ?>
     </div>
     
<?php
   }
}
}
public function returnedtorequest() {
	$this->load->view('foreign/returnedtorequest');
}
public function npregister() {
	$this->load->view('foreign/npregister');
}

public function authorize() {
	$this->load->view('foreign/authorize');
}
public function canvassing_excel() {
	$this->load->view('foreign/canvassing_excel');
}

public function authorize_request() {

	$this->load->view('foreign/slipprint');
	
}

public function tradefinance() {
	
	$this->load->view('foreign/tradefinance');
}

public function authorized() {
	
	$this->load->view('foreign/authorized');
}

public function audit() {
	
	$this->load->view('foreign/audit');
}
public function audited() {
	
	$this->load->view('foreign/audited');
}

public function add_prefix() {
	
	$this->load->view('foreign/add_prefix');
}

public function branch() {
	
	$this->load->view('foreign/branch');
}
public function upload_allotement() {
	
	$this->load->view('shareholder/upload_allotement');
}


public function priority() {
	
	$this->load->view('foreign/priority');
}

public function changepass() {
	
	$this->load->view('sessions/changepass');
}

public function allocate_lists_for_manager(){
	$this->load->view('foreign/allocate_lists_for_manager');
}
public function editauthorised_request(){
	$this->load->view('foreign/editauthorize');
}
public function allocatedlist(){
	$this->load->view('foreign/allocatedlist');
}
public function edittf(){
	$this->load->view('foreign/edittf');
}
public function allocatelist(){
	$this->load->view('foreign/allocatelist');
}
public function slipprint(){
	$this->load->view('shareholder/slipprint');
}
public function createshareholder(){
	$this->load->view('shareholder/createshareholder');
}

// Validate and store registration data in database
public function allocated_request() {

	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	// Check validation for user input in SignUp form
	//$this->form_validation->set_rules('registration_no','Registration number','trim|required|xss_clean');
	$this->form_validation->set_rules('idnum','ID','trim|required|xss_clean');
	$this->form_validation->set_rules('allocated_date','Allocated date','trim|required|xss_clean');
	$this->form_validation->set_rules('allocated_amount','Allocated','trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) 
	{
	echo "error";
	
	} 
else {

	$data = array(
	
	//'registration_no' => $this->input->post('registration_no'),
	'id' => $this->input->post('idnum'),
	'allocated_date' => $this->input->post('allocated_date'),
	'allocated' => $this->input->post('allocated_amount'),
	'status' => $this->input->post('allocate_status')
	
	);

//$registration = $this->foreign_model->select_rforeign($data['registration_no'],$data);

//if($registration == FALSE){
	
$result = $this->foreign_model->create_allocate($data);

if ($result == TRUE) 
	{
	
	$this->load->view('foreign/allocated', $data);
	$data['message_display'] = ' Allocated Successfully !';
	 //redirect(current_url());
	} 
else 
	{
	
	$this->load->view('foreign/allocated', $data);
	$data['message_display'] = 'There is a problem of creating allocation!';	
}
/*} else {
	
	$data['message_display'] = 'Request Created Successfully !';
	$this->load->view('foreign/register', $data);
	 //redirect(current_url());
}*/


}
}



public function reason_shareholder() {

// Check validation for user input in SignUp form
$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

$this->form_validation->set_rules('reason', 'reason', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
$this->load->view('shareholder/blockconfirm');
} else {
$data = array(
'remark' => $this->input->post('reason')
);

$result = $this->priority_model->create_reason($data);

if ($result == TRUE) {
	
$data['message_display'] = 'Shareholder Blocked Successfully !';
$this->load->view('shareholder/block', $data);
	 //redirect(current_url());

} else {
$data['message_display'] = 'Username already exist!';
$this->load->view('sessions/user', $data);
}
}
}


public function new_branch() {

// Check validation for user input in SignUp form
$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

$this->form_validation->set_rules('branch', 'Branch', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
$this->load->view('foreign/branch');
} else {
$data = array(
'name' => $this->input->post('branch')
);

$result = $this->branch_model->create_branch($data);

if ($result == TRUE) {
	
$data['message_display'] = 'Branch Created Successfully !';
$this->load->view('foreign/branch', $data);
	 //redirect(current_url());

} else {
$data['message_display'] = 'Username already exist!';
$this->load->view('sessions/user', $data);
}
}
}

public function change_pass() {

// Check validation for user input in SignUp form
$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

$this->form_validation->set_rules('newpass', 'New password', 'trim|required|matches[confirmpass]|xss_clean');
$this->form_validation->set_rules('confirmpass', 'Confirm Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
	
$this->load->view('sessions/changepass');

} else {
	
$data = array(

'oldpass' => $this->input->post('oldpass'),
'newpass' => $this->input->post('newpass'),
'confirmpass' => $this->input->post('confirmpass'),
'username' => $this->input->post('username')
);

$confirm_pass = $data['confirmpass'];
$username = $data['username'];

if($data['oldpass'] == $data['newpass']){

	$data['message_display'] = 'New password must be different from old password !';
	
} elseif($data['newpass'] != $data['confirmpass']){
	
	$data['message_display'] = 'New password must be the same from confirm password !';
}

$result = $this->login_database->change_pass($confirm_pass,$username);

if ($result == TRUE) {
	
$data['message_display'] = 'Password Changed Successfully !';
$this->load->view('sessions/login_form', $data);
	 //redirect(current_url());

} else {
$data['message_display'] = 'Username already exist!';
$this->load->view('sessions/user', $data);
}
}
}


public function new_prefix() {

// Check validation for user input in SignUp form
$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

$this->form_validation->set_rules('prefix', 'Prefix', 'trim|required|xss_clean');
$this->form_validation->set_rules('branch', 'Branch', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
$this->load->view('foreign/add_prefix');
} else {
$data = array(
'code' => $this->input->post('prefix'),
'branch' => $this->input->post('branch')
);

$result = $this->prefix_model->create_prefix($data);

if ($result == TRUE) {
	
$data['message_display'] = 'Prefix Created Successfully !';
$this->load->view('foreign/add_prefix', $data);
	 //redirect(current_url());

} else {
$data['message_display'] = 'Username already exist!';
$this->load->view('sessions/user', $data);
}
}
}

public function edit_authorised_foreign_registration() {


	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	// Check validation for user input in SignUp form
	//$this->form_validation->set_rules('registration_no','Registration number','trim|required|xss_clean');
	/*$this->form_validation->set_rules('prefix','Prefix','trim|required|xss_clean');
	$this->form_validation->set_rules('branch_name','Branch Name','trim|required|xss_clean');
	$this->form_validation->set_rules('application_date','Application date','trim|required|xss_clean');*/
	$this->form_validation->set_rules('applicant_name','Applicant Name','trim|required|xss_clean');
	$this->form_validation->set_rules('account_no','Account No','trim|required|xss_clean');
	$this->form_validation->set_rules('amount_in_no','Amount in No','trim|required|xss_clean');
	$this->form_validation->set_rules('amount_in_word','Amount in Words','trim|required|xss_clean');
	$this->form_validation->set_rules('tin_no','Tin No','trim|required|xss_clean');
	$this->form_validation->set_rules('currency','Currency','trim|required|xss_clean');
	
	$this->form_validation->set_rules('nbe_account_no','NBE Account No','trim|required|xss_clean');
	$this->form_validation->set_rules('mode_of_payment','Mode of Payment','trim|required|xss_clean');
	//$this->form_validation->set_rules('proforma_invoice_no','Proforma invoice no','trim|required|xss_clean');
	$this->form_validation->set_rules('proforma_invoice_date','Proforma invoice no','trim|required|xss_clean');
	//$this->form_validation->set_rules('proforma_invoice_amount','Proforma invoice amount','trim|required|xss_clean');
	
	$this->form_validation->set_rules('supplier_name','Supplier Name','trim|required|xss_clean');
	$this->form_validation->set_rules('description','Description','trim|required|xss_clean');
	
	//$this->form_validation->set_rules('priority','Priority','trim|required|xss_clean');
	//$this->form_validation->set_rules('remark','Remark','trim|required|xss_clean');

	
if ($this->form_validation->run() == FALSE) 
	{
	$this->load->view('foreign/register');
	
	} 
else {

	$data = array(
	
	'id' => $this->input->post('id'),
	//'prefix' => $this->input->post('prefix'),
	//'application_time' => $this->input->post('time'),
	//'branch_name' => $this->input->post('branch_name'),
	//'application_date' => $this->input->post('application_date'),
	'applicant_name' => $this->input->post('applicant_name'),
	'account_no' => $this->input->post('account_no'),
	'amount_in_no' => $this->input->post('amount_in_no'),
	'amount_in_word' => $this->input->post('amount_in_word'),
	'tin_no' => $this->input->post('tin_no'),
	'currency' => $this->input->post('currency'),
	'nbe_account_no' => $this->input->post('nbe_account_no'),
	'mode_of_payment' => $this->input->post('mode_of_payment'),
	//'proforma_invoice_no' => $this->input->post('proforma_invoice_no'),
	'proforma_invoice_date' => $this->input->post('proforma_invoice_date'),
	//'proforma_invoice_amount' => $this->input->post('proforma_invoice_amount'),
	'supplier_name' => $this->input->post('supplier_name'),
	'description' => $this->input->post('description'),
	//'requested_by' => $this->input->post('requested_by'),
	//'approved_by' => $this->input->post('approved_by'),
	//'approved_date' => $this->input->post('approved_date'),
	//'status' => $this->input->post('status'),
	//'priority' => $this->input->post('priority'),
	'remark' => $this->input->post('remark')
	
	);

//$registration = $this->foreign_model->select_rforeign($data['registration_no'],$data);

//if($registration == FALSE){
	
$result = $this->foreign_model->edit_authorised_data($data);

if ($result == TRUE) 
	{
	$data['message_display'] = 'Request Edited Successfully !';
	$this->load->view('foreign/authorized', $data);
	 //redirect(current_url());
	} 
else
	{
	$data['message_display'] = 'There is a problem of creating Request!';
	$this->load->view('foreign/register', $data);
	}
/*} else {
	
	$data['message_display'] = 'Request Created Successfully !';
	$this->load->view('foreign/register', $data);
	 //redirect(current_url());
}*/
}
}

public function update_shareholder() {

	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
	
	$this->form_validation->set_rules('total_share_subscribed','total share subscribed','trim|required|xss_clean');
	$this->form_validation->set_rules('total_share_subscribed_inbirr','total share subscribed in birr','trim|required|xss_clean');
	$this->form_validation->set_rules('city','city','trim|required|xss_clean');
	$this->form_validation->set_rules('sub_city','sub_city','trim|required|xss_clean');
	$this->form_validation->set_rules('woreda','woreda','trim|required|xss_clean');
	$this->form_validation->set_rules('house_no','house no','trim|required|xss_clean');
	$this->form_validation->set_rules('pobox','pobox','trim|required|xss_clean');
	$this->form_validation->set_rules('telephone_residence','telephone residence','trim|required|xss_clean');
	$this->form_validation->set_rules('telephone_office','telephone_office','trim|required|xss_clean');
	$this->form_validation->set_rules('mobile','mobile','trim|required|xss_clean');

	
if ($this->form_validation->run() == FALSE) 
	{
	  $this->load->view('shareholder/edit_shareholder');
	
	} else {

	$data = array(
	
	
	'id' => $this->input->post('id'),
	'total_share_subscribed' => $this->input->post('total_share_subscribed'),
	'total_share_subscribed_inbirr' => $this->input->post('total_share_subscribed_inbirr'),
	'city' => $this->input->post('city'),
	'sub_city' =>$this->input->post('sub_city'),
	'woreda' => $this->input->post('woreda'),
	'house_no' => $this->input->post('house_no'),
	'pobox' => $this->input->post('pobox'),
	'telephone_residence' => $this->input->post('telephone_residence'),
	'telephone_office' => $this->input->post('telephone_office'),
	'mobile' => $this->input->post('mobile'),
	
	);

$result = $this->shareholder_model->edit_shareholder($data);

if ($result == TRUE) 
	{
	$data['message_display'] = 'Request Edited Successfully !';
	$this->load->view('shareholder/edit_shareholder', $data);
	 //redirect(current_url());
	} 
else
	{
	$data['message_display'] = 'There is a problem of editing shareholder!';
	$this->load->view('shareholder/edit_shareholder', $data);
	}
/*} else {
	
	$data['message_display'] = 'Request Created Successfully !';
	$this->load->view('foreign/register', $data);
	 //redirect(current_url());
}*/
}
}

public function edit_tf_list() {


	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	// Check validation for user input in SignUp form
	//$this->form_validation->set_rules('registration_no','Registration number','trim|required|xss_clean');
	/*$this->form_validation->set_rules('prefix','Prefix','trim|required|xss_clean');
	$this->form_validation->set_rules('branch_name','Branch Name','trim|required|xss_clean');
	$this->form_validation->set_rules('application_date','Application date','trim|required|xss_clean');*/
	$this->form_validation->set_rules('applicant_name','Applicant Name','trim|required|xss_clean');
	$this->form_validation->set_rules('account_no','Account No','trim|required|xss_clean');

	$this->form_validation->set_rules('loan','Loan','trim|required|xss_clean');
	$this->form_validation->set_rules('deposit','Deposit','trim|required|xss_clean');
	$this->form_validation->set_rules('account_active_period','account_active_period','trim|required|xss_clean');


	$this->form_validation->set_rules('amount_in_no','Amount in No','trim|required|xss_clean');
	$this->form_validation->set_rules('amount_in_word','Amount in Words','trim|required|xss_clean');
	$this->form_validation->set_rules('tin_no','Tin No','trim|required|xss_clean');
	$this->form_validation->set_rules('currency','Currency','trim|required|xss_clean');
	
	$this->form_validation->set_rules('nbe_account_no','NBE Account No','trim|required|xss_clean');
	$this->form_validation->set_rules('mode_of_payment','Mode of Payment','trim|required|xss_clean');
	$this->form_validation->set_rules('proforma_invoice_no','Proforma invoice no','trim|required|xss_clean');
	$this->form_validation->set_rules('proforma_invoice_date','Proforma invoice no','trim|required|xss_clean');
	//$this->form_validation->set_rules('proforma_invoice_amount','Proforma invoice amount','trim|required|xss_clean');
	
	$this->form_validation->set_rules('supplier_name','Supplier Name','trim|required|xss_clean');
	$this->form_validation->set_rules('description','Description','trim|required|xss_clean');
	
	//$this->form_validation->set_rules('priority','Priority','trim|required|xss_clean');
	//$this->form_validation->set_rules('remark','Remark','trim|required|xss_clean');

	
if ($this->form_validation->run() == FALSE) 
	{
	$this->load->view('foreign/allocated');
	
	} 
else {

	$data = array(
	
	'id' => $this->input->post('id'),
	//'prefix' => $this->input->post('prefix'),
	//'application_time' => $this->input->post('time'),
	//'branch_name' => $this->input->post('branch_name'),
	//'application_date' => $this->input->post('application_date'),
	'applicant_name' => $this->input->post('applicant_name'),
	'account_no' => $this->input->post('account_no'),

	'loan' => $this->input->post('loan'),
	'deposit' => $this->input->post('deposit'),
	//'account_no' => $this->input->post('account_no'),
	'life_time' => $this->input->post('account_active_period'),

	'amount_in_no' => $this->input->post('amount_in_no'),
	'amount_in_word' => $this->input->post('amount_in_word'),
	'tin_no' => $this->input->post('tin_no'),
	'currency' => $this->input->post('currency'),
	'nbe_account_no' => $this->input->post('nbe_account_no'),
	'mode_of_payment' => $this->input->post('mode_of_payment'),
	'proforma_invoice_no' => $this->input->post('proforma_invoice_no'),
	'proforma_invoice_date' => $this->input->post('proforma_invoice_date'),
	//'proforma_invoice_amount' => $this->input->post('proforma_invoice_amount'),
	'supplier_name' => $this->input->post('supplier_name'),
	'description' => $this->input->post('description'),
	//'requested_by' => $this->input->post('requested_by'),
	//'approved_by' => $this->input->post('approved_by'),
	//'approved_date' => $this->input->post('approved_date'),
	//'status' => $this->input->post('status'),
	//'priority' => $this->input->post('priority'),
	'remark' => $this->input->post('remark')
	
	);

//$registration = $this->foreign_model->select_rforeign($data['registration_no'],$data);

//if($registration == FALSE){
	
$result = $this->foreign_model->edit_tf_data($data);

if ($result == TRUE) 
	{
	$data['message_display'] = 'Request Edited Successfully !';
	$this->load->view('foreign/allocated', $data);
	 //redirect(current_url());
	} 
else
	{
	$data['message_display'] = 'There is a problem of creating Request!';
	$this->load->view('foreign/allocated', $data);
	}
/*} else {
	
	$data['message_display'] = 'Request Created Successfully !';
	$this->load->view('foreign/register', $data);
	 //redirect(current_url());
}*/
}
}

public function edit_foreign_registration() {


	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	// Check validation for user input in SignUp form
	//$this->form_validation->set_rules('registration_no','Registration number','trim|required|xss_clean');
	/*$this->form_validation->set_rules('prefix','Prefix','trim|required|xss_clean');
	$this->form_validation->set_rules('branch_name','Branch Name','trim|required|xss_clean');
	$this->form_validation->set_rules('application_date','Application date','trim|required|xss_clean');*/
	$this->form_validation->set_rules('applicant_name','Applicant Name','trim|required|xss_clean');

	$this->form_validation->set_rules('account_no','Account No','trim|required|xss_clean');
	$this->form_validation->set_rules('loan','Loan','trim|required|xss_clean');
	$this->form_validation->set_rules('deposit','Deposit','trim|required|xss_clean');
	$this->form_validation->set_rules('account_active_period','account_active_period','trim|required|xss_clean');

	$this->form_validation->set_rules('amount_in_no','Amount in No','trim|required|xss_clean');
	$this->form_validation->set_rules('amount_in_word','Amount in Words','trim|required|xss_clean');
	$this->form_validation->set_rules('tin_no','Tin No','trim|required|xss_clean');
	$this->form_validation->set_rules('currency','Currency','trim|required|xss_clean');
	
	$this->form_validation->set_rules('nbe_account_no','NBE Account No','trim|required|xss_clean');
	$this->form_validation->set_rules('mode_of_payment','Mode of Payment','trim|required|xss_clean');
	$this->form_validation->set_rules('proforma_invoice_no','Proforma invoice no','trim|required|xss_clean');
	$this->form_validation->set_rules('proforma_invoice_date','Proforma invoice no','trim|required|xss_clean');
	//$this->form_validation->set_rules('proforma_invoice_amount','Proforma invoice amount','trim|required|xss_clean');
	
	$this->form_validation->set_rules('supplier_name','Supplier Name','trim|required|xss_clean');
	$this->form_validation->set_rules('description','Description','trim|required|xss_clean');
	
	//$this->form_validation->set_rules('priority','Priority','trim|required|xss_clean');
	//$this->form_validation->set_rules('remark','Remark','trim|required|xss_clean');

	
if ($this->form_validation->run() == FALSE) 
	{
	$this->load->view('foreign/register');
	
	} 
else {

	$data = array(
	'id' => $this->input->post('id'),
	//'prefix' => $this->input->post('prefix'),
	//'application_time' => $this->input->post('time'),
	//'branch_name' => $this->input->post('branch_name'),
	//'application_date' => $this->input->post('application_date'),
	'applicant_name' => $this->input->post('applicant_name'),
	'loan' => $this->input->post('loan'),
	'deposit' => $this->input->post('deposit'),
	'account_no' => $this->input->post('account_no'),
	'life_time' => $this->input->post('account_active_period'),

	'amount_in_no' => $this->input->post('amount_in_no'),
	'amount_in_word' => $this->input->post('amount_in_word'),
	'tin_no' => $this->input->post('tin_no'),
	'currency' => $this->input->post('currency'),
	'nbe_account_no' => $this->input->post('nbe_account_no'),
	'mode_of_payment' => $this->input->post('mode_of_payment'),
	'proforma_invoice_no' => $this->input->post('proforma_invoice_no'),
	'proforma_invoice_date' => $this->input->post('proforma_invoice_date'),
	//'proforma_invoice_amount' => $this->input->post('proforma_invoice_amount'),
	'supplier_name' => $this->input->post('supplier_name'),
	'description' => $this->input->post('description'),
	//'requested_by' => $this->input->post('requested_by'),
	//'approved_by' => $this->input->post('approved_by'),
	//'approved_date' => $this->input->post('approved_date'),
	//'status' => $this->input->post('status'),
	//'priority' => $this->input->post('priority'),
	'remark' => $this->input->post('remark')
	
	);

//$registration = $this->foreign_model->select_rforeign($data['registration_no'],$data);

//if($registration == FALSE){
	
$result = $this->foreign_model->edit_data($data);

if ($result == TRUE) 
	{
	$data['message_display'] = 'Request Edited Successfully !';
	$this->load->view('foreign/listed', $data);
	 //redirect(current_url());
	} 
else
	{
	$data['message_display'] = 'There is a problem of creating Request!';
	$this->load->view('foreign/register', $data);
	}
/*} else {
	
	$data['message_display'] = 'Request Created Successfully !';
	$this->load->view('foreign/register', $data);
	 //redirect(current_url());
}*/
}
}

public function request_exists($key)
{
    $this->foreign_model->request_exists($key);
}

public function new_shareholder_from_existing(){
	
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	$this->form_validation->set_rules('account_no','account no','trim|required|xss_clean|numeric');
	$this->form_validation->set_rules('name','name','trim|required|xss_clean');
	$this->form_validation->set_rules('share_type','Share Type','trim|required|xss_clean');
	$this->form_validation->set_rules('city','city','trim|required|xss_clean');
	$this->form_validation->set_rules('sub_city','sub_city','trim|xss_clean');
	$this->form_validation->set_rules('woreda','woreda','trim|required|xss_clean');
	$this->form_validation->set_rules('house_no','house no','trim|xss_clean');
	$this->form_validation->set_rules('pobox','pobox','trim|xss_clean');
	$this->form_validation->set_rules('telephone_residence','telephone residence','trim|xss_clean|numeric');
	$this->form_validation->set_rules('telephone_office','telephone_office','trim|xss_clean|numeric');
	$this->form_validation->set_rules('mobile','mobile','trim|xss_clean|numeric');
	$this->form_validation->set_rules('member','member','trim|xss_clean');
	$this->form_validation->set_rules('remark','remark','trim|xss_clean');
	$this->form_validation->set_rules('status_of_new_share','status_of_new_share','trim|xss_clean');
	

if ($this->form_validation->run() == FALSE) 
	{
	  $this->load->view('shareholder/createshareholder');
	
	} else {

	$data = array(
	
	//'registration_no' => $this->input->post('registration_no'),
	'account_no' => $this->input->post('account_no'),
	'name' => $this->input->post('name'),
	'share_type' => $this->input->post('share_type'),
	'city' => $this->input->post('city'),
	'sub_city' =>$this->input->post('sub_city'),
	'woreda' => $this->input->post('woreda'),
	'transfer_date' => $this->input->post('transfer_date'),
	'value_date' => $this->input->post('value_date'),
	'house_no' => $this->input->post('house_no'),
	'pobox' => $this->input->post('pobox'),
	'telephone_residence' => $this->input->post('telephone_residence'),
	'telephone_office' => $this->input->post('telephone_office'),
	'mobile' => $this->input->post('mobile'),
	'member' => $this->input->post('member'),
	'remark' => $this->input->post('remark'),
	'status_of_new_share' => $this->input->post('status_of_new_share'),
	'year' => $this->input->post('year'),
	'data_created_at' => $this->input->post('data_created_at'),
	'data_created_by' => $this->input->post('data_created_by'),
	'type_of_creation' => $this->input->post('type_of_creation'),
	);

$check = $this->shareholder_model->check_account_no($data);
if($check == TRUE){

header('location:create_shareholder_from_existing?message_display=true');

}elseif($data['total_share_subscribed'] == 0 && $data['total_paidup_capital_inbirr'] == 0){

$result = $this->shareholder_model->create_new_shareholder($data);
$data['message_display'] = 'Shareholder Created Successfully!';
header('location:create_shareholder_from_existing?cash=created');

}
	}
}

public function new_shareholder() {

	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	$this->form_validation->set_rules('account_no','account no','trim|required|xss_clean|numeric');
	$this->form_validation->set_rules('name','name','trim|required|xss_clean');
	$this->form_validation->set_rules('total_share_subscribed','total share subscribed','trim|required|xss_clean|numeric');

	$this->form_validation->set_rules('total_paidup_capital_inbirr','total paidup capital inbirr','trim|required|xss_clean|numeric');
	$this->form_validation->set_rules('share_type','Share Type','trim|required|xss_clean');
	$this->form_validation->set_rules('city','city','trim|required|xss_clean');
	$this->form_validation->set_rules('sub_city','sub_city','trim|xss_clean');
	$this->form_validation->set_rules('woreda','woreda','trim|required|xss_clean');
	$this->form_validation->set_rules('house_no','house no','trim|xss_clean');
	$this->form_validation->set_rules('pobox','pobox','trim|xss_clean');
	$this->form_validation->set_rules('telephone_residence','telephone residence','trim|xss_clean|numeric');
	$this->form_validation->set_rules('telephone_office','telephone_office','trim|xss_clean|numeric');
	$this->form_validation->set_rules('mobile','mobile','trim|xss_clean|numeric');
	$this->form_validation->set_rules('member','member','trim|xss_clean');
	$this->form_validation->set_rules('remark','remark','trim|xss_clean');
	$this->form_validation->set_rules('status_of_new_share','status_of_new_share','trim|xss_clean');
	

if ($this->form_validation->run() == FALSE) 
	{
	  $this->load->view('shareholder/createshareholder');
	
	} else {

	$data = array(
	
	//'registration_no' => $this->input->post('registration_no'),
	'account_no' => $this->input->post('account_no'),
	'name' => $this->input->post('name'),
	'total_share_subscribed' => $this->input->post('total_share_subscribed'),
	'total_paidup_capital_inbirr' => $this->input->post('total_paidup_capital_inbirr'),
	'share_type' => $this->input->post('share_type'),
	'city' => $this->input->post('city'),
	'sub_city' =>$this->input->post('sub_city'),
	'woreda' => $this->input->post('woreda'),
	'transfer_date' => $this->input->post('transfer_date'),
	'value_date' => $this->input->post('value_date'),
	'house_no' => $this->input->post('house_no'),
	'pobox' => $this->input->post('pobox'),
	'telephone_residence' => $this->input->post('telephone_residence'),
	'telephone_office' => $this->input->post('telephone_office'),
	'mobile' => $this->input->post('mobile'),
	'member' => $this->input->post('member'),
	'remark' => $this->input->post('remark'),
	'status_of_new_share' => $this->input->post('status_of_new_share'),
	'year' => $this->input->post('year'),
	'data_created_at' => $this->input->post('data_created_at'),
	'data_created_by' => $this->input->post('data_created_by'),
	'type_of_creation' => $this->input->post('type_of_creation'),
	);

$check = $this->shareholder_model->check_account_no($data);
$select_budget_year = mysqli_query($this->conn,"SELECT * FROM budget_year_status WHERE budget_status = 'active'");
$budget_row = mysqli_fetch_array($select_budget_year);
$startd = $budget_row['budget_from'];
$endd = $budget_row['budget_to'];  
$value_d = $data['value_date'];

$currentDate = $data['value_date'];
$currentDate = date('Y-m-d', strtotime($currentDate));



if($check == TRUE){

header('location:createshareholder?message_display=true');
} elseif(($data['total_share_subscribed']*500) < ($data['total_paidup_capital_inbirr'])){

header('location:createshareholder?message_warning=true');
}elseif($data['total_share_subscribed'] == 0 && $data['total_paidup_capital_inbirr'] == 0){

$result = $this->shareholder_model->create_new_shareholder($data);
$data['message_display'] = 'Shareholder Created Successfully .But you need to activate!';
header('location:createshareholder?cash=created');

}elseif($data['total_share_subscribed'] > 0 && $data['total_paidup_capital_inbirr'] > 0 && $data['value_date'] == ""){

echo '<script>alert("Value date is empty please enter value date!");</script>';
//header('location:createshareholder?error_value=created');

}elseif(($currentDate < $startd) || ($currentDate > $endd)){

echo '<script>alert("Value date is out of budget year!");</script>';


}elseif($data['total_share_subscribed'] > 0 && $data['total_paidup_capital_inbirr'] > 0){

$result = $this->shareholder_model->create_new_shareholder($data);
$result1 = $this->shareholder_model->create_share_transfer_status($data);
$transfer = $this->shareholder_model->create_transfer_from_nib($data);
$data['message_display'] = 'Shareholder Created Successfully!';
header('location:createshareholder?cash=created');

} 
	}

}


// Validate and store registration data in database
public function new_share_request() {


	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	$this->form_validation->set_rules('account_no','Account No','trim|required|xss_clean');
	$this->form_validation->set_rules('name','Name','trim|required|xss_clean');
	$this->form_validation->set_rules('application_date','Application Date','trim|required|xss_clean');
	$this->form_validation->set_rules('total_share','Total Share Requested','trim|required|xss_clean');
	$this->form_validation->set_rules('status','Status','trim|required|xss_clean');
	
	
if ($this->form_validation->run() == FALSE) 
	{
	  $this->load->view('shareholder/sharerequest');

		
	} else {

	$data = array(
	'account_no' =>$this->input->post('account_no'),
	'name' =>$this->input->post('name'),
	'application_date' => $this->input->post('application_date'),
	'total_share' => $this->input->post('total_share'),
	'status' => $this->input->post('status')
	);

$result = $this->shareholder_model->create_request($data);

if ($result == TRUE) {
	
$data['message_display'] = 'Share Request Created Successfully !';
header('location: http://172.23.2.174/shareholder_final/shareholder/sharerequest');
	 //redirect(current_url());

} else {
$data['message_display'] = 'Share Request Faild to Register ';
$this->load->view('sessions/user', $data);
}
}
}
// Validate and store registration data in database
public function new_foreign_npregistration() {


	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	// Check validation for user input in SignUp form
	//$this->form_validation->set_rules('registration_no','Registration number','trim|required|xss_clean');
	$this->form_validation->set_rules('prefix','Prefix','trim|required|xss_clean');
	$this->form_validation->set_rules('branch_name','Branch Name','trim|required|xss_clean');
	$this->form_validation->set_rules('application_date','Application date','trim|required|xss_clean');
	$this->form_validation->set_rules('applicant_name','Applicant Name','trim|required|xss_clean');
	$this->form_validation->set_rules('account_no','Account No','trim|required|xss_clean');
	$this->form_validation->set_rules('amount_in_no','Amount in No','trim|required|xss_clean');
	$this->form_validation->set_rules('amount_in_word','Amount in Words','trim|required|xss_clean');
	$this->form_validation->set_rules('tin_no','Tin No','trim|required|xss_clean');
	$this->form_validation->set_rules('currency','Currency','trim|required|xss_clean');
	
	$this->form_validation->set_rules('nbe_account_no','NBE Account No','trim|required|xss_clean');
	//$this->form_validation->set_rules('mode_of_payment','Mode of Payment','trim|required|xss_clean');
	$this->form_validation->set_rules('proforma_invoice_no','Proforma invoice no','trim|required|xss_clean');
	$this->form_validation->set_rules('proforma_invoice_date','Proforma invoice no','trim|required|xss_clean');
	//$this->form_validation->set_rules('proforma_invoice_amount','Proforma invoice amount','trim|required|xss_clean');
	
	$this->form_validation->set_rules('loan','Outstanding Loan Balance','trim|required|xss_clean');
	$this->form_validation->set_rules('deposit','Deposit Balance','trim|required|xss_clean');
	$this->form_validation->set_rules('account_active_period','Account Life Time','trim|required|xss_clean');
	$this->form_validation->set_rules('supplier_name','Supplier Name','trim|required|xss_clean');
	$this->form_validation->set_rules('description','Description','trim|required|xss_clean');
	
	$this->form_validation->set_rules('priority','Priority','trim|required|xss_clean');
	//$this->form_validation->set_rules('remark','Remark','trim|required|xss_clean');

	
if ($this->form_validation->run() == FALSE) 
	{
	$this->load->view('foreign/npregister');
	
	} 
else {

	$data = array(
	
	//'registration_no' => $this->input->post('registration_no'),
	'prefix' => $this->input->post('prefix'),
	'application_time' => $this->input->post('time'),
	'branch_name' => $this->input->post('branch_name'),
	'application_date' => $this->input->post('application_date'),
	'applicant_name' => $this->input->post('applicant_name'),
	'account_no' => $this->input->post('account_no'),
	'amount_in_no' => $this->input->post('amount_in_no'),
	'amount_in_word' => $this->input->post('amount_in_word'),
	'tin_no' => $this->input->post('tin_no'),
	'currency' => $this->input->post('currency'),
	'nbe_account_no' => $this->input->post('nbe_account_no'),
	'mode_of_payment' => $this->input->post('mode_of_payment'),
	'proforma_invoice_no' => $this->input->post('proforma_invoice_no'),
	'proforma_invoice_date' => $this->input->post('proforma_invoice_date'),
	//'proforma_invoice_amount' => $this->input->post('proforma_invoice_amount'),
	'loan' => $this->input->post('loan'),
	'deposit' => $this->input->post('deposit'),
	'life_time' => $this->input->post('account_active_period'),
	'supplier_name' => $this->input->post('supplier_name'),
	'description' => $this->input->post('description'),
	'requested_by' => $this->input->post('requested_by'),
	'approved_by' => $this->input->post('approved_by'),
	'approved_date' => $this->input->post('approved_date'),
	'status' => $this->input->post('status'),
	'priority' => $this->input->post('priority'),
	'remark' => $this->input->post('remark')
	
	);

$result = $this->foreign_model->check_deposit($data['tin_no']);		

if($result == TRUE){
		
		$check_tin = $this->foreign_model->count_tin($data['tin_no']);

	if($check_tin == 3){

		$this->session->set_flashdata('flashError', 'You have registered 3 performas!please wait for allocation');
		redirect('foreign/register');
	}
	
$result = $this->foreign_model->create_foreign($data);
	
if ($result == TRUE) 
	{
	$data['message_success'] = 'Request Created Successfully !';
	$this->load->view('foreign/npregister', $data);
	 //redirect(current_url());
} 
else 
	{
	$data['message_display'] = 'There is a problem of creating Request!';
	$this->load->view('foreign/npregister', $data);
	}
}
else{
	
	
	$result = $this->foreign_model->tin_exists($data['tin_no']);
	
	if($result == FALSE){
		
	$result2 = $this->foreign_model->create_foreign($data);
	
	if($result2 == TRUE)	{
		
	$data['message_success'] = 'Request Created Successfully !!';	
	$this->load->view('foreign/npregister', $data);	
	
	/*
	$data['message_display'] = 'Request Created Successfully !';
	$this->load->view('foreign/register', $data);*/
	 //redirect(current_url());
	 }else{
	 	/*
		$data['message_display'] = 'Tin No Already Exist !';
		$this->load->view('foreign/register', $data);	
		*/
	 	$data['message_display'] = 'There is a problem of creating Request!';
		$this->load->view('foreign/npregister', $data);
	 }
	}
else{
	
	$data['message_display'] = 'Applicant Already Registered in Other Branch! New Registration will not allow until the pending request Allocated';
	$this->load->view('foreign/npregister', $data);	
}
}

}
}


// Check for user login process
public function user_login_process() {

$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
		
	$this->load->view('sessions/login_form');
}else{
	
$data = array(
'username' => $this->input->post('username'),
'password' => $this->input->post('password')
);


$result = $this->login_database->login($data);
if ($result == TRUE) {

$username = $this->input->post('username');
$result = $this->login_database->read_user_information($username);

if ($result != false) {
	
$session_data = 
array(
'username' => $result[0]->user_name,
'email' => $result[0]->user_email,
'branch' => $result[0]->branch,
'role' => $result[0]->role,
'password' => $result[0]->user_password,

);

// Add user data in session
$this->session->set_userdata('logged_in', $session_data);

if($this->$session_data['password'] == '123456'){
		
	$this->load->view('foreign/changepass');
	
} else{

$this->load->view('layouts/admin_page');

}
} else {
$data = array(
'error_message' => 'Invalid Username or Password'
);
$this->load->view('sessions/login_form', $data);
}
}
}
}
// Logout from admin page
public function logout() {

// Removing session data
$sess_array = array(
'username' => ''
);
$this->session->unset_userdata('logged_in', $sess_array);
$data['message_display'] = 'Successfully Logout';
$this->load->view('sessions/login_form', $data);

}
}

?>