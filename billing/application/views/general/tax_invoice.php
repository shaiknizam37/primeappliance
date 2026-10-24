<table class="border" style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;">
  <tr>
    <th class="no-border" colspan="6" style="text-align: center"><h1>TAX INVOICE</h1></th>
  </tr>
  <tr>
    <td colspan="3" class="no-border">
      Invoice Number : <?=$main_details['invoice_no']?>
    </td>
    <td class="no-border" colspan="3" style="text-align: right;">
      Date : <?=date('d-m-Y',strtotime($main_details['bill_date']))?>
    </td>
  </tr>
   <tr>
    <td colspan="6" class="no-border">
      Vendor Name :  SEHAR FURNITURES
    </td>
    
  </tr>
   <tr>
    <td colspan="6" class="no-border">
      Vendor Address :  <?=$main_details['address']?>
    </td>
  </tr>
  <tr>
    <td colspan="3" class="no-border">
      GST/UIN Number : 29CEDPB85881ZM
    </td>
     <td colspan="3" class="no-border">
      E-Mail : muzammilbaig9739@gmail.com
    </td>
  </tr>
  <tr>
    <td colspan="6" class="no-border">
      Party :  <?=$main_details['name']?>
    </td>
  </tr>
  <tr>
    <td colspan="3" class="no-border">
      GST/UIN Number : <?=$main_details['gst_number']?>
    </td>
    <td colspan="3" class="no-border">
      State Name : Karnataka. State Code : 560045
    </td>
  </tr>
  <tr>
    <td class="border" rowspan="2">HSN/SAC</td>
    <td class="border" rowspan="2">Taxable Value</td>
    <td class="border" colspan="2">Central Tax</td>
    <td class="border" colspan="2">State Tax</td>
  </tr>
   <tr>
    <td class="border">Rate</td>
    <td class="border">Amount</td>
    <td class="border">Rate</td>
    <td class="border">Amount</td>
  </tr>
   
   <?php 
   $c_amount_total=0;
   $s_amount_total=0;
   $taxable_value_total=0;
   	foreach ($data as $k => $v) {
		$c_amount_total+=$v['c_amount'];
		$s_amount_total+=$v['s_amount'];
		$taxable_value_total+=$v['taxable_value'];

   		?>
   		<tr>
			<td class="border"><?=$v['hsn']?></td>
			<td class="border"><?=$v['taxable_value']?></td>
			<td class="border"><?=$v['c_rate']?></td>
			<td class="border"><?=$v['c_amount']?></td>
			<td class="border"><?=$v['s_rate']?></td>
			<td class="border"><?=$v['s_amount']?></td>
		</tr>
   	<?php }
   ?>
  <tr>
    <td class="border">Total</td>
    <td class="border"><?=number_format($taxable_value_total)?></td>
    <td class="border"></td>
    <td class="border"><?=number_format($c_amount_total)?></td>
    <td class="border"></td>
    <td class="border"><?=number_format($s_amount_total)?></td>
  </tr>
  <tr>
    <td class="no-border" colspan="6" style="text-align: left">Amount Chargeable : <b> Rs. <?=number_format($taxable_value_total+$c_amount_total+$s_amount_total)?>.</b> </td>
  </tr>
  <tr>
    <td class="no-border" colspan="5" style="text-align: left">Amount Chargeable In Words : <?=$controller->number_to_words(number_format($taxable_value_total+$c_amount_total+$s_amount_total))?></td>
    <td class="no-border" colspan="1" style="text-align: right">E & OE</td>
  </tr>
</table>

