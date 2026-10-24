	<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<form action="<?=base_url()?>index.php/invoice/update_jobsheet" method="POST"> 
<!------ Include the above in your HEAD tag ---------->
<div class="row" style="margin-left: 10px;margin-right:10px">
   
        <center><h1>Edit Job Sheet</h1></center>
        
        <div class="form-group col-md-6">
             <label>Customer Name</label>
             <input type="hidden" name="invoice_no" class="form-control" required value="<?php echo isset($details['invoice_no'])?$details['invoice_no']:'';?>"/>
            <input type="text" name="customer_name" class="form-control" required value="<?php echo isset($details['customer_name'])?$details['customer_name']:'';?>"/>
        </div>
        <div class="form-group col-md-6">
             <label>Customer Mobile</label>
            <input type="text" name="customer_mobile" class="form-control" required value="<?php echo isset($details['customer_mobile'])?$details['customer_mobile']:'';?>"/>
        </div>
        <div class="form-group col-md-6">
            <label>Customer Address </label>
            <textarea class="form-control" name="address" rows="5" required><?php echo isset($details['address'])?$details['address']:'';?></textarea>
        </div>
          
        <div class="form-group col-md-6">
             <label>Apply GST</label>
            <input type="checkbox" name="apply_gst" style="width: 20px;height: 20px" />
        </div>
        <div class="form-group col-md-6 gst_section" style="display:none">
            <label>GST %</label>
            <input type="text" name="gst_per" class="form-control"/>
        </div>
        <div class="form-group col-md-6 gst_section" >
            <label>Discount %</label>
            <input type="number" name="discount" class="form-control"  value="<?php echo isset($details['discount'])?$details['discount']:'';?>" max="50" min="0"/>
        </div>
        
</div>
<div class="row" style="margin-left: 10px;margin-right:10px;overflow: scroll;">
   <center> <input type="button" class="btn btn-sm btn-danger " id="addrow" value="Add Row" /></center>
    <table id="myTable" class="table order-list" >
    <thead>
        <tr>
            <td>Description of Goods</td>
            <td>Estimated Amount</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        if($alldetails[0]['id']!=""){

        foreach($alldetails as $k=>$v){ ?>
        <tr>
            <td>
                <input  type="text" class="form-control" name="desciption[]" required value="<?php echo $v['desciption']?>"/>
               
            </td>
             <td>
                <input  type="text" class="form-control" name="amount[]"  value="<?php echo $v['amount']?>"/>
            </td>
            <td><i class="fa fa-trash ibtnDel"></i></td>
        </tr>
        <?php }
        }else{?>
        <tr>
            <td>
                <input  type="text" class="form-control" name="desciption[]" required value=""/>
            </td>
             <td>
                <input  type="text" class="form-control" name="amount[]"  value=""/>
            </td>
            <td><i class="fa fa-trash ibtnDel"></i></td>
        </tr>
        <?php }
        ?>
       
    </tbody>
    <tfoot>
        
        <tr>
        </tr>
    </tfoot>
</table>
<center><input type="submit" class="btn btn-lg btn-success" value="Submit" /></center>
</div>
</form>
</div>
</div>

<script>
    $(document).ready(function () {
        $('[name="apply_gst"]').click(function(){
            var is_checked=$(this).prop('checked');
            if(is_checked){
                $('.gst_section').css('display','block');
            }else{
                $('.gst_section').css('display','none');
            }
        });
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

       
        cols += '<td><input  type="text" class="form-control" name="desciption[]" required/></td>';
        cols += '<td><input  type="text" class="form-control" name="amount[]"/></td>';
       
        
      
        cols += '<td><i class="fa fa-trash ibtnDel"></i></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });
    
    $(document).on('keyup','[name="rate[]"]',function(){
      if (/\D/g.test(this.value))
      {
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '');
      }
    });


});

//   $( function() {
//     $( "#datepicker" ).datepicker();
//   } );
</script>
  

 