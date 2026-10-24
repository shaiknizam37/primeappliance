		<!-- main content start-->
		<div id="page-wrapper">
             <!-- <div class="overlay">
                    <img src="https://i.pinimg.com/originals/a2/dc/96/a2dc9668f2cf170fe3efeb263128b0e7.gif" style="width: 81%;" />
                </div> -->
			<div class="main-page">
			<form action="<?=base_url()?>index.php/invoice/create_job_sheet" method="POST"> 
<!------ Include the above in your HEAD tag ---------->
<div class="row" style="margin-left: 10px;margin-right:10px">
   
        <center><h1>Trusted Services Job Sheet</h1></center>
        
        <div class="form-group col-md-6">
             <label>Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required/>
        </div>
        <div class="form-group col-md-6">
             <label>Customer Mobile</label>
            <input type="text" name="customer_mobile" class="form-control" required/>
        </div>
        <div class="form-group col-md-6">
            <label>Customer Address </label>
            <textarea class="form-control" name="address" rows="5" required></textarea>
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
            <input type="number" name="discount" class="form-control" value="0" max="50" min="0"/>
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
        <tr>
            <td ><input  type="text" class="form-control" name="desciption[]" required/></td>
            <td ><input  type="text" class="form-control" name="amount[]" /></td>
            <td ><a class="deleteRow"></a>
            </td>
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
        cols += '<td><input  type="text" class="form-control" name="amount[]" required/></td>';
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
  

 