<?php
//print_invoice.php
$result1 = $this->db->get('invoice_order')->result_array();
$result1 = $this->db->get_where('invoice_order', array('order_id' => $param2))->result_array();
$company = $this->db->get_where('settings', array('type' => 'company'))->row()->description;
if($result1 > 0)
{
 require_once 'pdf.php';
 $output = '';
 
	foreach ($result1 as $row) 
	{
	  $output .= '
	   <table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
		 <td colspan="2" align="center" style="font-size:18px"><b>'.$company.'</b></td>
		</tr>
		<tr>
		 <td colspan="2">
		  <table width="100%" cellpadding="5">
		   <tr>
			<td width="65%">
			 To,<br />
			 <b>RECEIVER (BILL TO)</b><br />
			 Name : '.$row["order_receiver_name"].'<br /> 
			 Billing Address : '.$row["order_receiver_addr"].'<br />
			</td>
			<td width="35%">
			 Reverse Charge<br />
			 Invoice No. : '.$row["order_no"].'<br />
			 Invoice Date : '.$row["order_date"].'<br />
			</td>
		   </tr>
		  </table>
		  <br />
		  <table width="100%" border="1" cellpadding="5" cellspacing="0">
		   <tr>
			<th>Sr No.</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Actual Amt.</th>
			<th colspan="2">Tax1 (%)</th>
			<th colspan="2">Tax2 (%)</th>
			<th colspan="2">Tax3 (%)</th>
			<th rowspan="2">Total</th>
		   </tr>
		   <tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>Rate</th>
			<th>Amt.</th>
			<th>Rate</th>
			<th>Amt.</th>
			<th>Rate</th>
			<th>Amt.</th>
		   </tr>';
		$result2 = $this->db->get_where('invoice_order_item', array('order_id' => $param2))->result_array();
		$count = 0;
		foreach($result2 as $sub_row)
		{
		   $count++;
		   $output .= '
		   <tr>
			<td>'.$count.'</td>
			<td>'.$sub_row["item_name"].'</td>
			<td>'.$sub_row["order_item_quantity"].'</td>
			<td>'.$sub_row["order_item_price"].'</td>
			<td>'.$sub_row["order_item_actual_amount"].'</td>
			<td>'.$sub_row["order_item_tax1_rate"].'</td>
			<td>'.$sub_row["order_item_tax1_amount"].'</td>
			<td>'.$sub_row["order_item_tax2_rate"].'</td>
			<td>'.$sub_row["order_item_tax2_amount"].'</td>
			<td>'.$sub_row["order_item_tax3_rate"].'</td>
			<td>'.$sub_row["order_item_tax3_amount"].'</td>
			<td>'.$sub_row["order_item_final_amount"].'</td>
		   </tr>
		   ';
		  }
		  $output .= '
		  <tr>
		   <td align="right" colspan="11"><b>Total</b></td>
		   <td align="right"><b>'.$row["order_total_after_tax"].'</b></td>
		  </tr>
		  <tr>
		   <td colspan="11"><b>Total Amt. Before Tax :</b></td>
		   <td align="right">'.$row["order_total_before_tax"].'</td>
		  </tr>
		  <tr>
		   <td colspan="11">Add : Tax1 :</td>
		   <td align="right">'.$row["order_total_tax1"].'</td>
		  </tr>
		  <tr>
		   <td colspan="11">Add : Tax2 :</td>
		   <td align="right">'.$row["order_total_tax2"].'</td>
		  </tr>
		  <tr>
		   <td colspan="11">Add : Tax3 :</td>
		   <td align="right">'.$row["order_total_tax3"].'</td>
		  </tr>
		  <tr>
		   <td colspan="11"><b>Total Tax Amt.  :</b></td>
		   <td align="right">'.$row["order_total_tax"].'</td>
		  </tr>
		  <tr>
		   <td colspan="11"><b>Total Amt. After Tax :</b></td>
		   <td align="right">'.$row["order_total_after_tax"].'</td>
		  </tr>

		  ';
		  $output .= '
      </table>
     </td>
    </tr>
   </table>
  ';
 }
 $pdf = new Pdf();
 $file_name = 'Invoice-'.$row["order_no"].'.pdf';
 $pdf->loadHtml($output);
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}
?>