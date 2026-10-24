<div id="page-wrapper">
	<div class="main-page">
		<div class="tables">
		<div class="bs-example widget-shadow" data-example-id="contextual-table"> 
			<h4>Invoice Tax List</h4>
			<table class="table">
			   <thead>
			      <tr>
			         <th>#</th>
			         <th>Invoice Number</th>
			         <th>Name</th>
			         <th>Address</th>
			         <th>GST number</th>
			         <th>Bill Date</th>			        
			         <th>Created Date</th>
			         <th>Action</th>
			      </tr>
			   </thead>
			   <tbody>
			   	<?php 
			   	if(count($page_data)>0){
			   	foreach ($page_data as $key => $val) { ?>
			   		<tr class="active">
			         <th scope="row"><?=($key+1)?></th>
			         <td><?=$val['invoice_no']?></td>
			         <td><?=$val['name']?></td>
			         <td><?=$val['address']?></td>
			         <td><?=$val['gst_number']?></td>			        
			         <td><?=$val['bill_date']?></td>			        		        
			         <td><?=$val['created_date']?></td>	
			         <td><a target="_blank" class="btn btn-sm btn-success" href="<?=base_url()?>index.php/invoice/view_tax_invoice/<?=$val['tax_invoice_id']?>">View Invoice</a></td>		        
			         			        
			      </tr>
			   	<?php }
			   	}else{
			   		echo '<tr class="active"><td colspan="8">No Invoices Found</td></tr>';
			   	}
			   	?>
			      
			   </tbody>
			</table>
		</div>
	</div>
	</div>
</div>