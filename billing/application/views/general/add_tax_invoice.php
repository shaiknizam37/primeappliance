		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<form action="<?=base_url()?>index.php/invoice/generate_tax_invoice" method="POST"> 
<!------ Include the above in your HEAD tag ---------->
<div class="row" style="margin-left: 10px;margin-right:10px">
   
        <center><h1>SEHAR FURNITURES TAX INVOICE</h1></center>
        <div class="form-group col-md-6">
             <label>Invoice Number</label>
            <input type="text" name="invoice_no" class="form-control" required/>
        </div>
        <div class="form-group col-md-6">
             <label>Party Name</label>
            <input type="text" name="name" class="form-control" required/>
        </div>
        <div class="form-group col-md-6">
            <label>Vendor Address </label>
            <textarea class="form-control" name="address" rows="5" required></textarea>
        </div>
       
        <div class="form-group col-md-6">
             <label>Party GST Number</label>
            <input type="text" name="gst_number" class="form-control" required/>
        </div>
        <div class="form-group col-md-6">
             <label>Bill Date</label>
            <input type="text" name="bill_date" class="form-control" id="datepicker" autocomplete="off" required/>
        </div>        

</div>
<div class="row" style="margin-left: 10px;margin-right:10px;overflow: scroll;">
   <center> <input type="button" class="btn btn-sm btn-danger " id="addrow" value="Add Row" /></center>
    <table id="myTable" class="table order-list" >
    <thead>
        <tr>
            <td>HSN/SAC</td>
            <td>Taxable Value</td>
            <td>GST %</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 30%;" class="col-sm-2"><input     type="text" class="form-control" name="hsn[]" required/></td>
            <td style="width: 30%;" class="col-sm-2"><input   autocomplete="off" type="text" class="form-control" name="taxable_val[]" required/></td>
            <td style="width: 30%;" class="col-sm-2"><input   autocomplete="off" type="text" class="form-control" name="gst[]" required/></td>
            <td class="col-sm-2"><a class="deleteRow"></a></td>
        </tr>
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
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td style="width: 30%;" class="col-sm-2"><input  type="text" class="form-control" name="hsn[]" required/></td>';
        cols += '<td style="width: 30%;" class="col-sm-2"><input autocomplete="off" type="text" class="form-control" name="taxable_val[]" required/></td>';
        cols += '<td style="width: 30%;" class="col-sm-2"><input autocomplete="off" type="text" class="form-control" name="gst[]" required/></td>';
        
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});



function calculateRow(row) {
    var price = +row.find('input[name^="amount"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="amount"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
  

 