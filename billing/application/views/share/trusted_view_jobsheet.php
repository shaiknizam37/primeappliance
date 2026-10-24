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

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #879dcc;
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
                            <td class="title" colspan="3" align="center">Job Sheet
                             <br><a href="<?php echo base_url()?>index.php/invoice/download_job_sheet/<?php echo $details['invoice_no'];?>">Download Job Sheet</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="title" style="color:#052973">
                                Trusted Service Centre 
                            </td>
                            
                            <td>
                                <b>Job Sheet #:</b> <?php echo $details['invoice_no'];?><br>
                                <b>job Sheet Date : </b> <?php echo date('d-M-Y',strtotime($details['bill_date']))?><br>
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
                                221 HBR layout first block 1st main<br>
                                Bangalore 560043<br>
                                <b>Contact Number : </b><?php echo CUSTOMER_CARE_NUMBER?> <br>
                                <b>Website :</b> www.trustedservicecenter.in
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
                <td style="width:60%">
                    Spare Part
                </td>
                <td style="width:35%">
                    Estimated Price of Spare Part
                </td>
            </tr>
            <?php 
            if(isset($alldetails[0]['id']) && $alldetails[0]['id']!=""){
            foreach($alldetails as $i =>$val){ ?>
               <tr class="item">
                <td>
                   <?php echo $i+1;?>
                </td>
                <td>
                   <?php echo $val['desciption'];?>
                </td>
                <td>
                     <?php echo $val['amount'];?>
                </td>
            </tr> 
            <?php
                }      
            }
            ?>
             <tr>
                <td  colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3"><b>Declaration : </b> This Job sheet is to declare that "Trusted Service Center" technician has took the above listed spare parts of your appliance to inspect at "Trusted Service Center", the status of the spare parts will be updated with in 48 Hrs after the spare parts is received.</td>
            </tr>
        </table>
    </div>
</body>
</html>