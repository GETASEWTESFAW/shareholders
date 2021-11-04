<?php
  require_once('OLEwriter.php');
  require_once('BIFFwriter.php');
  require_once('Worksheet.php');
  require_once('Workbook.php');
  //require_once('../conn.php');
  $conn=mysqli_connect('localhost','root','software','shareholder_test'); 
    function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
      }
	  
	  // HTTP headers
	HeaderingExcel('closed_report.csv');// Creating a workbook
	$workbook = new excel("-");
	// Creating the first worksheet
	$worksheet1 =& $workbook->add_worksheet('SHAREHOLDER MANAGEMENT SYSTEM');
	$worksheet1->freeze_panes(1, 1);
  $worksheet1->set_column(0, 0, 25);
  $worksheet1->set_column(1, 1, 20);
  $worksheet1->set_column(1, 2, 20);
  $worksheet1->set_column(1, 3, 20);
  $worksheet1->set_column(1, 4, 20);
  $worksheet1->set_column(1, 5, 20);
  $worksheet1->set_column(1, 6, 20);
  

   $worksheet1->write_string(1,6.15,"NIB International Bank S.C");
   
   
   $worksheet1->write_string(4,6.15,"Shareholder Transfer Report");
   
   $worksheet1->write_string(7,0,"Share transfer from");
   
   $worksheet1->write_string(7,1,"Share subscribed before transfer");
   
   $worksheet1->write_string(7,2,"Share subscribed after transfer");

   $worksheet1->write_string(7,3,"Amount of share transfered");
   
   $worksheet1->write_string(7,4,"Share transfer to");
   
   $worksheet1->write_string(7,5,"Share subscribed before gaining share");

   $worksheet1->write_string(7,6,"Share subscribed after gaining share");
   
   $worksheet1->write_string(7,7,"Date of transfer ");
   
/////////////////
	

	$qryreport = mysqli_query($conn,"select * from transfer where status_of_transfer = 'authorized' and status_of_seller = 'closed' order by transfer_date ASC") or die(mysqli_error($conn));
	
	$sqlrows=mysqli_num_rows($qryreport);
	$j=8;
	
	WHILE ($reportdisp=mysqli_fetch_array($qryreport)) { $id=$reportdisp['id'];
	
	$j=$j+1;
		
			$name = $reportdisp['name'];

			$total_share = $reportdisp['total_share'];

			$total_share_transfered = $reportdisp['total_share_transfered'];

			$seller_total_subscribed_before_transfer = $total_share;

			$seller_total_subscribed_after_transfer = $total_share - $total_share_transfered;

			$transfer_to = $reportdisp['rname'];

			$rtotal_share = $reportdisp['rtotal_share'];

			$buyyer_before_gaining_transfer = $reportdisp['buyyer_paidup_in_birr']/500;

			$buyyer_after_gaining_transfer = $total_share_transfered + $rtotal_share;

			$date = $reportdisp['transfer_date'];


		 $votes_query=mysqli_query($conn,"select * from transfer where status_of_transfer = 'authorized' and status_of_seller = 'closed' order by transfer_date");

	$vote_count=mysqli_num_rows($votes_query);

			$worksheet1->write_string($j,0,"$name");
				
			 $worksheet1->write_string($j,1,"$total_share");
			 
			 $worksheet1->write_string($j,2,"$seller_total_subscribed_after_transfer");

			 $worksheet1->write_string($j,3,"$total_share_transfered");
			 
			 $worksheet1->write_string($j,4,"$transfer_to");
			
			 $worksheet1->write_string($j,5,"$rtotal_share");

			 $worksheet1->write_string($j,6,"$buyyer_after_gaining_transfer");
			 
			 $worksheet1->write_string($j,7,"$date");
			 
	 
	}
	
/////////////////
  
$workbook->close();
?>