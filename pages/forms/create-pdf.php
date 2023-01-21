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
				<div style='height:30px; border: 1px solid black; width:720px;'>
					<div style='width:243px; margin-top:5px; margin-left:5px; height:25px; black;'>
					GSTIN: ".$user_data['gstin_no']."
					</div>
					<div style='position: relative; left: 243px; top: -25px;width:243px; height:25px; black;text-align:center'>
					<b>TAX INVOICE</b>
					</div>
					<div style='position: relative; left: 490px; top: -50px;width:225px; height:25px; black;text-align:right; font-size: 12px'>
					ORIGINAL FOR RECIPIENT
					</div>
				</div>
				<div style='height:20px; border: 1px solid black; width:320px; text-align:center;font-size: 12px; margin-top: -1px;padding-top: 5px;'>
				Customer Detail
				</div>
				<div style='height:150px; border: 1px solid black; width:320px; text-align:center;font-size: 12px; margin-top: -1px;padding-top: 5px;'>
					<div style='height:17px; width:50px; font-size: 12px;'><b>M/S</b></div>
					<div style='height:45px; width:50px; font-size: 12px;'><b>Address</b></div>
					<div style='height:17px; width:50px; font-size: 12px;'><b>PHONE</b></div>
					<div style='height:17px; width:50px; font-size: 12px;'><b>GSTIN</b></div>
					<div style='height:17px; width:50px; font-size: 12px;'><b>PAN</b></div>
					<div style='height:17px; width:50px; font-size: 12px;'><b>Place of Supply</b></div>
					<div style='position: relative; top:-135px; left: 70px; height:150px; width:250px; text-align:left;font-size: 12px; margin-top: -1px;padding-top: 5px;'>
						<div style='height:17px; width:250px; font-size: 12px;'>".$cust_data['name']."</div>
						<div style='height:45px; width:250px; font-size: 12px;'>".$cust_data['address']."</div>
						<div style='height:17px; width:250px; font-size: 12px;'>".$cust_data['phone_no']."</div>
						<div style='height:17px; width:250px; font-size: 12px;'>".$cust_data['gstin_no']."</div>
						<div style='height:17px; width:250px; font-size: 12px;'>".$cust_data['pan_no']."</div>
						<div style='height:17px; width:250px; font-size: 12px;'>".$cust_data['place_of_supply']."</div>
					</div>
				</div>
				<div style='position: relative; top: -182px; left: 321px; height:176px; border: 1px solid black; width:394px; text-align:left;font-size: 12px; margin-top: -1px;padding-top: 5px; padding-left: 5px;'>
					<div style='height:20px; width:100px; font-size: 12px;'>Invoice No.</div>
					<div style='height:20px; width:100px; font-size: 12px;'>Date</div>
					<div style='position: relative; top: -40px; left: 100px; height:20px; width:100px; font-size: 12px;'><b>".$invoice_no."</b></div>
					<div style='position: relative; top: -40px; left: 100px; height:20px; width:100px; font-size: 12px;'>".$invoice_date."</div>
				</div>
				<div style='position: relative; top: -182px; height:40px; border: 1px solid black; text-align: center; width:720px; font-size: 10px; margin-top: -1px;'>
					<div style='float: left; height:40px; width:20px; border-right: 1px solid black;'>Sr No</div>
					<div style='float: left; height:40px; width:200px; border-right: 1px solid black;'>Name of Product / Service</div>
					<div style='float: left; height:40px; width:50px; border-right: 1px solid black;'>HSN / SAC</div>
					<div style='float: left; height:40px; width:50px; border-right: 1px solid black;'>Qty</div>
					<div style='float: left; height:40px; width:50px; border-right: 1px solid black;'>Rate</div>
					<div style='float: left; height:40px; width:80px; border-right: 1px solid black;'>Taxable Value</div>
					<div style='float: left; height:40px; width:90px; border-right: 1px solid black;'>CGST</div>
					<div style='float: left; height:40px; width:90px; border-right: 1px solid black;'>SGST</div>
					<div style='float: left; height:40px; width:80px;'>Total</div>
				</div>
				<div style='position: relative; top: -182px; height:350px; border: 1px solid black; text-align: center; width:720px; font-size: 10px; margin-top: -1px;'>
					<div style='float: left; height:350px; width:20px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:200px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:50px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:50px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:50px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:80px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:90px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:90px; border-right: 1px solid black;'></div>
					<div style='float: left; height:350px; width:80px;'></div>
				</div>
				<div style='position: relative; top: -533px; height:20px; border: 1px solid; text-align: center; width:720px; font-size: 10px; margin-top: -1px; padding-top: 5px;'>
					<div style='float: left; height:20px; width:20px;'>1</div>
					<div style='float: left; height:20px; width:200px;'>R ANMOL</div>
					<div style='float: left; height:20px; width:50px;'>5602</div>
					<div style='float: left; height:20px; width:50px;'>46.11</div>
					<div style='float: left; height:20px; width:50px;'>250.00</div>
					<div style='float: left; height:20px; width:80px;'>11,527.50</div>
					<div style='float: left; height:20px; width:90px;'></div>
					<div style='float: left; height:20px; width:90px;'></div>
					<div style='float: left; height:20px; width:80px;'>12,910.80</div>
				</div>
				<div style='position: relative; top: -208px; height:200px; border: 1px solid black; text-align: center; width:720px; font-size: 10px; margin-top: -1px;'>
				
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