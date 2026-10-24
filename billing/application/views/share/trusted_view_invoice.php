<!doctype html>
<html>
<style>
body{
    font-family: 'Times New Roman', Times, serif;
    background: white;
    width: 100%;
    max-width: 820px;
    min-height: 1158px;
    margin: 105px auto 30px auto;
    -moz-box-shadow: 0px 0px 20px rgba(80,80,80,0.7);
    -webkit-box-shadow: 0px 0px 20px rgba(80,80,80,0.7);
    box-shadow: 0px 0px 20px rgba(80,80,80,0.7)
}
/*.invoice-box{
    padding: 0 22%;
}*/
.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
    padding: 2%;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: left;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.top table td.project-name {
    font-size: 30px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #B8B8B8;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}
li{
    margin:5px;
}
@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }
    
    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
    text-align: right;
}

.rtl table tr td:nth-child(2) {
    text-align: left;
}
</style>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td colspan="3" align="center"><a href="<?=base_url()?>index.php/invoice/download_invoice/<?=$details['invoice_no']?>">Download Invoice</a></td>
                        </tr>
                        <tr>
                            <td class="title" colspan="2" align="center">INVOICE </td>
                        </tr>
                        <tr>
                            <td class="project-name" style="color:#052973">
                                <?=PROJECT_NAME?>
                            </td>
                            <td style="text-align:right">
                                <b>Invoice #:</b> <?php echo $details['invoice_no'];?><br>
                                <b>Invoice Date : </b> <?php echo date('d-M-Y',strtotime($details['bill_date']))?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                <b>Head office : </b> <br>
                                No. 1190 HBR Layout 1st stage 3rd block Near Narendra Tent HBR Layout Bengaluru -560043<br>
                                <b>Contact Number : </b><?php echo CUSTOMER_CARE_NUMBER?> <br>
                                <b>Website :</b> www.primeappliancecare.in<br>
                                <?php 
                                    if($details['apply_gst']==1){ ?>
                                 <b>GSTIN :</b> 29QMFPS8144Q1ZL
                                    <?php } 
                                 ?>
                            </td>
                            
                             <td align="left">
                                 <b>Bill To </b> <br>
                                <b>Customer Details : </b> <br>
                                 <b>Name : </b><?php echo $details['customer_name'];?><br>
                                 <b>Mobile Number :</b><?php echo $details['customer_mobile'];?>
                                 <br>
                                 <b>Address : </b><?php echo $details['address'];?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td style="width:5%">
                    Sl.No
                </td>
                <td>
                    Item
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <?php 
            $gst_amount=0;
            $total_amount=0;
            $discount=$details['discount'];
            foreach($alldetails as $i =>$val){ ?>
               <tr class="item">
                <td>
                   <?php echo ($i+1)?>
                </td>
                <td>
                   <?php echo $val['desciption'];?>
                </td>
                <td>
                   Rs. <?php echo number_format($val['rate'],2);?>
                </td>
            </tr> 
            <?php
            $total_amount+=$val['rate'];
            }
            if($details['apply_gst']==1){ ?>
            <tr class="item">
                <td></td>
                <td>
                   GST Amount
                </td>
                <td>
                   Rs. <?php 
                   $gst_per=$details['gst_per'];
                   $gst_amount=($total_amount/100)*$gst_per;
                   echo number_format($gst_amount,2);?>
                </td>
            </tr> 
            <?php }
            if($details['discount']>0){ ?>
            <tr class="item">
                <td></td>
                <td>
                   Discount (<?php echo $discount;?>%)
                </td>
                <td>
                   - Rs. <?php 
                   $discount=$details['discount'];
                   $final_total=$total_amount+$gst_amount;
                   $discount_amt=($final_total/100)*$discount;
                   $grand_total=($final_total-$discount_amt);
                   echo number_format($discount_amt,2);?>
                </td>
            </tr> 
            <?php }else{
                $grand_total=$total_amount+$gst_amount;
            }
            
            ?>
           
            <tr class="total" style="border:1px solid;">
                <td></td>
                <td>Total : 
                <?php
                    echo ucwords(strtolower(number_to_words(($grand_total))));
                ?>
                </td>
                <td>
                    Rs. <?php echo number_format(($grand_total),2);?>
                </td>
            </tr>
        </table>
        
    </div>
    <p style="margin-left:5%">Terms & Conditions</p>
    <ul>
        <li>Warranty is applicable only on spare parts listed under warranty.</li>
        <li>The above listed spare parts which is under warranty stands void if any physical damage is occured.</li>
        <li>If any non functioning of the appliance on the replaced under warranty spare parts with in 30 Days "Service Charges" <br>is not applicable, After which "Service Charge" is applicable</li>
    </ul>
    <p style="text-align:center">Note : This is computer generated bill and it doesn't require signature.</p>
</body>
</html>