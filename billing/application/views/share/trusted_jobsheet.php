<!doctype html>
<html>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title" colspan="3" align="center">Job Sheet</td>
                        </tr>
                        <tr>
                            <td class="title" style="color:#052973">
                                Trusted Service Centre 
                            </td>
                            
                            <td>
                                <b>Job Sheet #:</b> <?php echo $details['invoice_no'];?><br>
                                <b>Job Sheet Date : </b> <?php echo date('d-M-Y',strtotime($details['bill_date']))?><br>
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
                <td colspan="3"><b>Declaration : </b> This Job sheet is to declare that "Trusted Service Center" technician has took the above listed spare parts of your appliance to inspect at "Trusted Service Center", the status of the spare parts will be updated with in 48 Hrs after the spare parts is received.</td>
            </tr>
        </table>
    </div>
</body>
</html>