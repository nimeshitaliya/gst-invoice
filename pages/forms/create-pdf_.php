<?php
include ("../../DBconfig.php");
$sub_total = $_GET['subtotal'];
$grand_total = $_GET['grandtotal'];
$round_off = $_GET['roundoff'];
$invoice_no = $_GET['invoice_no'];
?>
<?php
	require_once '../../dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	include ("../../DBconfig.php");
	$sql = "SELECT * FROM user_detail WHERE username = 'admin';";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0){
		$user_data = mysqli_fetch_assoc($result);
	}
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql_ = "SELECT cust_id,DATE_FORMAT(date, '%d/%m/%Y') date FROM bill_list WHERE bill_id = $id;";
		$result_ = mysqli_query($conn, $sql_);
		if (mysqli_num_rows($result_) > 0){
			$row_ = mysqli_fetch_assoc($result_);
			$cust_id = $row_['cust_id'];
			$date = $row_['date'];
			$sql_ = "SELECT * FROM customers WHERE cust_id = $cust_id";
			$res = mysqli_query($conn, $sql_);
			if (mysqli_num_rows($res) > 0){
				$row_ = mysqli_fetch_assoc($res);
			}
		}
	}else {
		$sql_ = "SELECT MAX(cust_id) cust_id FROM bill_data;";
		$result_ = mysqli_query($conn, $sql_);
		if (mysqli_num_rows($result_) > 0){
			$row_ = mysqli_fetch_assoc($result_);
			$cust_id = $row_['cust_id'];
			$date = date("d/m/Y");
			$sql_ = "SELECT * FROM customers WHERE cust_id = $cust_id";
			$res = mysqli_query($conn, $sql_);
			if (mysqli_num_rows($res) > 0){
				$cust_data = mysqli_fetch_assoc($res);
			}
		}
	}
	$invoice_no = $_GET['invoice_no'];
	$invoice_date = date("d/m/Y");

	function to_word($number) {
	    $no = round($number);
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $digits_length = strlen($no);
	    $i = 0;
	    $str = array();
	    $words = array(
	        0 => '',
	        1 => 'One',
	        2 => 'Two',
	        3 => 'Three',
	        4 => 'Four',
	        5 => 'Five',
	        6 => 'Six',
	        7 => 'Seven',
	        8 => 'Eight',
	        9 => 'Nine',
	        10 => 'Ten',
	        11 => 'Eleven',
	        12 => 'Twelve',
	        13 => 'Thirteen',
	        14 => 'Fourteen',
	        15 => 'Fifteen',
	        16 => 'Sixteen',
	        17 => 'Seventeen',
	        18 => 'Eighteen',
	        19 => 'Nineteen',
	        20 => 'Twenty',
	        30 => 'Thirty',
	        40 => 'Forty',
	        50 => 'Fifty',
	        60 => 'Sixty',
	        70 => 'Seventy',
	        80 => 'Eighty',
	        90 => 'Ninety');
	    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	    while ($i < $digits_length) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
	        } else {
	            $str [] = null;
	        }
	    }
	    $Rupees = implode(' ', array_reverse($str));
	    $paise = ($decimal) ? "And " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10]) .' Paise '  : '';
	    return ($Rupees ? $Rupees . ' Rupees ' : '') . $paise . " Only";
	}
	$html = "
	<style>
		@page { margin: 25px 25px 25px 25px; }
		#main_div_{
			border: 1px solid black;
			height: 1060px;
		}
		#main_div{
			height: 48%;
			font-family: Arial, Helvetica, sans-serif;			
		}
		#footer{
			height: 25px;
			padding-top: 5px;
		}
		#div_left{
			border: 1px solid black;
		}
		img {
			height: 120px;
			width: 120px;
			vertical-align: bottom;
		}
	</style>
	<div id='main_div'>
		<div id='main_div_'>
			<div style='margin:10px;'>
				<div style='height:120px; width:720px;'>
					<div style='float: left; width:80px; height:120px;'>
					</div>
					<div style='float: left; width:320px; height:120px;'>
						<div style='text-align:left; width:320px; height:30px; margin-top:5px; font-size: 25px;'>
							<b>".$user_data['company_name']."</b>
						</div>
						<div style='text-align:left; padding-top: 20px; width:250px; height:30px;'>
						".$user_data['address']."
						</div>
					</div>
					<div style='float: left; width:270px; height:120px; padding-left:5px;'>
						<div style='text-align:left; width:315px; height:30px; margin-top:5px; text-align:right'>
							Name: ".$user_data['owner_name']."
						</div>
						<div style='text-align:left; width:315px; height:30px; text-align:right'>
							Phone: ".$user_data['phone_no']."
						</div>
						<div style='text-align:left; width:315px; height:30px; text-align:right'>
							Email: ".$user_data['email']."
						</div>
					</div>
				</div>
				<div style='height:30px; border: 1px solid black; padding-top:5px; padding-left:5px; width:715px;'>
					<div style='float:left; width:243px; height:25px; black;'>
					GSTIN: ".$user_data['gstin_no']."
					</div>
					<div style='float:left; width:243px; height:25px; black;text-align:center'>
					<b>TAX INVOICE</b>
					</div>
					<div style='float:left; width:225px; height:25px; black;text-align:right; font-size: 12px'>
					ORIGINAL FOR RECIPIENT
					</div>
				</div>
				<div style='height:180px; border: 1px solid black; width:720px; font-size: 12px; margin-top: -1px;'>
					<div style='height:180px; border: 1px solid black; width:320px; font-size: 12px; margin-top: -1px; margin-left: -1px;'>
						<div style='height:20px; border: 1px solid black; width:320px; text-align:center; font-size: 12px; margin-top: -1px; margin-left: -1px; padding-top: 5px;'>
							Customer Detail
						</div>
						<div style='height:154px; border: 1px solid black; width:320px; font-size: 12px; margin-top: -1px; margin-left: -1px;'>
							<div style='float: left; height:149px; width:50px; font-size: 12px; margin-top: -1px; margin-left: 5px; padding-top: 5px;'>
								<div style='height:17px; width:50px;'><b>M/S</b></div>
								<div style='height:45px; width:50px;'><b>Address</b></div>
								<div style='height:17px; width:50px;'><b>PHONE</b></div>
								<div style='height:17px; width:50px;'><b>GSTIN</b></div>
								<div style='height:17px; width:50px;'><b>PAN</b></div>
								<div style='height:17px; width:50px;'><b>Place of Supply</b></div>
							</div>
							<div style='float: left; height:149px; width:270px; font-size: 12px; margin-top: -1px; margin-left: 10px; padding-top: 5px;'>
								<div style='height:17px; width:250px;'>".$cust_data['name']."</div>
								<div style='height:45px; width:250px;'>".$cust_data['address']."</div>
								<div style='height:17px; width:250px;'>".$cust_data['phone_no']."</div>
								<div style='height:17px; width:250px;'>".$cust_data['gstin_no']."</div>
								<div style='height:17px; width:250px;'>".$cust_data['pan_no']."</div>
								<div style='height:17px; width:250px;'>".$cust_data['place_of_supply']."</div>
							</div>
						</div>
					</div>
					<div style='position: relative; height:180px; left: 320px; top: -180px; width:400px; font-size: 12px; margin-top: -2px;'>
						<div style='height:20px; width:389px; border: 1px solid black; padding-left: 10px'>
							<div style='float: left; height:20px; width:100px;'>Invoice No.</div>
							<div style='float: left; height:20px; width:100px;'><b>".$invoice_no."</b></div>
						</div>
						<div style='height:20px; width:389px; border: 1px solid black; padding-left: 10px; margin-top: -1px;'>
							<div style='float: left; height:20px; width:100px;'>Date.</div>
							<div style='float: left; height:20px; width:100px;'>".$invoice_date."</div>
						</div>
					</div>
				</div>
				<div style='height:440px; border: 1px solid black; width:720px; font-size: 12px; margin-top: -1px;'>
					<div style='height:50px; border: 1px solid black; text-align: center; width:720px; font-size: 12px; margin-top: -1px; margin-left: -1px;'>
						<div style='float: left; height:50px; width:20px; border-right: 1px solid black;'>Sr No</div>
						<div style='float: left; height:50px; width:200px; border-right: 1px solid black;'>Name of Product / Service</div>
						<div style='float: left; height:50px; width:50px; border-right: 1px solid black;'>HSN / SAC</div>
						<div style='float: left; height:50px; width:50px; border-right: 1px solid black;'>Qty</div>
						<div style='float: left; height:50px; width:50px; border-right: 1px solid black;'>Rate</div>
						<div style='float: left; height:50px; width:80px; border-right: 1px solid black;'>Taxable Value</div>
						<div style='float: left; height:50px; width:90px; border-right: 1px solid black;'>
							<div style='height:25px; width:90px; border: 1px solid black; margin-left: -1px; margin-top: -1px;'>
							CGST
							</div>
							<div style='height:25px; width:90px; border-right: 1px solid black;'>
								<div style='height:25px; width:30px; border-right: 1px solid black;'>
								%
								</div>
								<div style='position: relative; top: -25px; left: 30px; height:25px; width:50px;'>
								Amount
								</div>
							</div>
						</div>
						<div style='float: left; height:50px; width:90px; border-right: 1px solid black;'>
							<div style='height:25px; width:90px; border: 1px solid black; margin-left: -1px; margin-top: -1px;'>
							SGST
							</div>
							<div style='height:25px; width:90px; border-right: 1px solid black;'>
								<div style='height:25px; width:30px; border-right: 1px solid black;'>
								%
								</div>
								<div style='position: relative; top: -25px; left: 30px; height:25px; width:50px;'>
								Amount
								</div>
							</div>
						</div>
						<div style='float: left; height:50px; width:80px;'>Total</div>
					</div>
					<div style='height:390px; border: 1px solid black; width:720px; font-size: 12px; margin-top: -1px; margin-left: -1px;'>
						<div style='height:20px; border: 1px solid black; text-align: center; width:720px; font-size: 12px; margin-top: -1px; margin-left: -1px;'>
							<div style='float: left; height:20px; border-right: 1px solid black; width:20px;'>1</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:200px;'>R ANMOL</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:50px;'>5602</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:50px;'>46.11</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:50px;'>250.00</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:80px;'>11,527.50</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:30px;'>6.00</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:59px;'>691.65</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:30px;'>6.00</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:59px;'>691.65</div>
							<div style='float: left; height:20px; border-right: 1px solid black; width:82px;'>12,910.80</div>
						</div>
					</div>					
				</div>
				<div style='height:20px; border: 1px solid black; width:720px; font-size: 12px; margin-top: -1px;'>
					<div style='float: left; text-align: right; height:20px; border-right: 1px solid black; width:270px; padding-right: 5px;'>Total</div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:50px;'>46.11</div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:50px;'></div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:80px;'>11,527.50</div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:30px;'></div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:59px;'>691.65</div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:30px;'></div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:59px;'>691.65</div>
					<div style='float: left; height:20px; text-align: center; border-right: 1px solid black; width:79px;'>12,910.80</div>
				</div>
				<div style='height:240px; border: 1px solid black; width:720px; font-size: 12px; margin-top: -1px;'>
					<div style='float: left; height:241px; border-left: 1px solid black; width:480px; font-size: 12px; margin-top: -1px;'>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:480px;'><b>Total in words</b></div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:480px;'>".to_word(floatval($invoice_no))."</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:480px;'><b>Bank Details</b></div>
						<div style='height:80px; width:480px; margin-top: -1px; margin-left: -2px;'>
							<div style='height:80px; text-align: center; border: 1px solid black; width:100px;'>
								<div style='height:20px; width:100px;'>Name</div>
								<div style='height:20px; width:100px;'>Branch</div>
								<div style='height:20px; width:100px;'>Acc. Number</div>
								<div style='height:20px; width:100px;'>IFSC</div>
							</div>
							<div style='position: relative; top: -80px; left: 100px; height:80px; border: 1px solid black; width:380px;  margin-top: -2px; margin-left: 1px;'>
								<div style='height:20px; padding-left: 5px; width:375px;'>ICICIBANK</div>
								<div style='height:20px; padding-left: 5px; width:375px;'>SURAT UDHANA</div>
								<div style='height:20px; padding-left: 5px; width:375px;'>138505502617</div>
								<div style='height:20px; padding-left: 5px; width:375px;'>ICIC0001385</div>
							</div>
						</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:480px;'><b>Terms and Conditions</b></div>
						<div style='height:78px; text-align: center; border-bottom: 1px solid black; width:480px;'>
						Subject to our home Jurisdiction.
						Our Responsibility Ceases as soon as goods leaves our Premises.
						Goods once sold will not taken back.
						Delivery Ex-Premises.</div>
					</div>
					<div style='float: left; height:241px; border-left: 1px solid black; width:240px; font-size: 12px; margin-top: -1px;'>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:240px;'>
							<div style='height:20px; text-align: left; width:120px; padding: 2px;'>
							<b>Taxable Amount</b>
							</div>
							<div style='position: relative; top: -20px; left: 120px; height:20px; text-align: right; width:110px;'>
							<b>11,527.50</b>
							</div>
						</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:240px;'>
							<div style='height:20px; text-align: left; width:120px; padding: 2px;'>
							<b>Add : CGST</b>
							</div>
							<div style='position: relative; top: -20px; left: 120px; height:20px; text-align: right; width:110px;'>
							<b>691.65</b>
							</div>
						</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:240px;'>
							<div style='height:20px; text-align: left; width:120px; padding: 2px;'>
							<b>Add : SGST</b>
							</div>
							<div style='position: relative; top: -20px; left: 120px; height:20px; text-align: right; width:110px;'>
							<b>691.65</b>
							</div>
						</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:240px;'>
							<div style='height:20px; text-align: left; width:120px; padding: 2px;'>
							<b>Total Tax</b>
							</div>
							<div style='position: relative; top: -20px; left: 120px; height:20px; text-align: right; width:110px;'>
							<b>1,383.30</b>
							</div>
						</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:240px;'>
							<div style='height:20px; text-align: left; width:120px; padding: 2px;'>
							<b>Round off Amount</b>
							</div>
							<div style='position: relative; top: -20px; left: 120px; height:20px; text-align: right; width:110px;'>
							<b>0.20</b>
							</div>
						</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:240px;'>
							<div style='height:20px; text-align: left; width:150px; padding: 2px;'>
							<b>Total Amount After Tax</b>
							</div>
							<div style='position: relative; top: -20px; left: 150px; height:20px; text-align: right; width: 80px; font-size: 15px; margin-top: -2px;'>
							<b>12,911.00</b>
							</div>
						</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; text-align: right; width:230px; padding-right: 10px;'>(E & O.E.)</div>
						<div style='height:20px; text-align: center; border-bottom: 1px solid black; width:240px;'>
							<div style='height:20px; text-align: left; width:190px; padding: 2px;'>
							<b>GST Payable on Reverse Charge</b>
							</div>
							<div style='position: relative; top: -20px; left: 190px; height:20px; text-align: right; width: 40px; margin-top: -2px;'>
							<b>N.A.</b>
							</div>
						</div>
						<div style='height:10px; text-align: center; width:240px; font-size: 8px;'>Certified that the particulars given above are true and correct.</div>
						<div style='height:10px; text-align: center; width:240px; '><b>FOR K P LON JARI</b></div>
						<div style='height:40px; width:240px; border-bottom: 1px solid black;'</div>
						<div style='height:10px; text-align: center; width:240px; font-size: 8px;'>Authorised Signatory</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	";
	$html .= "</body></html>";
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("Weblesson",array("Attachment"=>0));
?>