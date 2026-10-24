<div id="page-wrapper">
	<div class="main-page">
		<div class="col_3">
        	<div class="col-md-12 widget widget1" style="width:100%">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-file icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo $total_records;?></strong></h5>
                      <span>Total Members</span>
                    </div>
                </div>
        	</div>
        	<div class="clearfix"> </div>
		</div>
		<div class="tables">
		<div class="bs-example widget-shadow" data-example-id="contextual-table" style="overflow-x: scroll;"> 
			<table class="table" id="invoice_table">
			   <thead>
			      <tr>
			      	 <th>Action</th>
			         <th>Invoice No</th>
					 <th>Bill date</th>
			         <th>Customer Name</th>
			         <th>Mobile Number</th>
			         <th>Address</th>
			         <th>Created Date</th>
			      </tr>
			   </thead>
			    <tfoot>
			      <tr>
				  	<th>Action</th>
			         <th>Invoice No</th>
					 <th>Bill date</th>
			         <th>Customer Name</th>
			         <th>Mobile Number</th>
			         <th>Address</th>
			         <th>Created Date</th>
			      </tr>
			   </tfoot>
			</table>
		</div>
	</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script>
	$(document).ready(function() {	
	    $('#invoice_table').DataTable( {
		    initComplete: function () {
	            this.api().columns().every( function () {
	                var column = this;
	                var select = $('<select><option value=""></option></select>')
	                    .appendTo( $(column.footer()).empty() )
	                    .on( 'change', function () {
	                        var val = $.fn.dataTable.util.escapeRegex(
	                            $(this).val()
	                        );
	 
	                        column
	                            .search( val ? val : '', true, false )
	                            .draw();
	                    } );
	 
	                column.data().unique().sort().each( function ( d, j ) {
	                    select.append( '<option value="'+d+'">'+d+'</option>' )
	                } );
	            } );
	        },
	    	"dom": 'Bfrtip',
	        "buttons": [
	            'copy', 'csv', 'excel', 'pdf', 'print','pageLength'
	        ],
	        "order": [[ 0, "desc" ]],
	    	"lengthMenu": [[10, 25, 50,100, 500], [10, 25, 50,100,500]],
	        "processing": true,
	        "serverSide": true,
	        "ajax": "<?=base_url()?>index.php/auth/getinvoices"
	    } );
	    $('#invoice_table').change(function (e) {
        	table.fnDraw();
		});
	} );
</script>