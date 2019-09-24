<?php
//print_invoice.php
$result1 = $this->db->get_where('invoice_order', array('order_id' => $param2))->result_array();
$company = $this->db->get_where('settings', array('type' => 'company'))->row()->description;
$address = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
$phone = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
if($result1 > 0)
{
 require_once 'pdf.php';
 $output = '';
 
	foreach ($result1 as $row) 
	{
	  $output .= '
	   <table width="100%" border="1" cellpadding="5" cellspacing="0">
		
		<tr>
		 <td colspan="2">
		  <table width="100%" cellpadding="5">
		  <tr><td colspan="8" style="text-align:center;"><b>'.$company.'</b><br/>'.$address.'<br/>'.$phone.'</td></tr>
		   <tr>
			<td width="50%">
			 
			 To,<br />
			 <b>RECEIVER (BILL TO)</b><br />
			 Name : '.$row["order_receiver_name"].'<br /> 
			 Billing Address : '.$row["order_receiver_addr"].'<br />
			 Phone No.: '.$row["order_receiver_phone"].'<br />
			</td>
			<td width="50%">
			 Invoice No. : '.$row["order_no"].'<br />
			 Invoice Date : '.$row["order_date"].'<br />
			 Date-Time : '.$row["order_datetime"].'<br />
			</td>
		   </tr>
		  </table>
		  <br />
		  <table width="100%" border="1" cellpadding="5" cellspacing="0">
		   <tr>
			<th width="6%">Sr No.</th>
			<th width="15%">Name</th>
			<th width="15%">Photo Type</th>
			<th width="15%">Photo Size</th>
			<th width="8%">Qty</th>
			<th>Price</th>
			<th>Amount</th>
			<th rowspan="2">Total</th>
		   </tr>
		   <tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
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
			<td>'.$sub_row["order_photo_type"].'</td>
			<td>'.$sub_row["order_photo_size"].'</td>
			<td>'.$sub_row["order_item_quantity"].'</td>
			<td>'.$sub_row["order_item_price"].'</td>
			<td>'.$sub_row["order_item_actual_amount"].'</td>
			<td>'.$sub_row["order_item_actual_amount"].'</td>
		   </tr>
		   ';
		  }
		  $output .= '
		 
		  <tr>
		   <td colspan="7"><b>Invoice Total :</b></td>
		   <td align="right"><b>'.$row["order_total"].'</b></td>
		  </tr>
		  <tr>
		   <td colspan="7"><b>Amount Paid :</b></td>
		   <td align="right"><b>'.$row["paid"].'</b></td>
		  </tr>
		  <tr>
		   <td colspan="7"><b>Balance :</b></td>
		   <td align="right"><b>'.$row["balance"].'</b></td>
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