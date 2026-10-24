<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	
	public function view_tax_bills()
	{
		$results=$this->db->query("SELECT * FROM `tax_invoice` ORDER BY created_date ASC")->result_array();
		$data['page_name']='general/view_tax_bills';
		$data['page_data']=$results;
		$this->load->view('template',$data);
	}

	public function add_job_sheet()
	{
		$data['page_name']='general/add_job_sheet';
		$data['page_data']='';
		$this->load->view('template',$data);
	}

	public function create_job_sheet()
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}
		$post_data=$this->input->post();
		
		$data=array(
				'customer_name'=>$post_data['customer_name'],
				'customer_mobile'=>$post_data['customer_mobile'],
				'address'=>$post_data['address'],
				'bill_date'=>date('Y-m-d'),
				'apply_gst'=>isset($post_data['apply_gst'])?1:0,
				'gst_per'=>$post_data['gst_per'],
				'discount'=>$post_data['discount'],
				'created_date'=>date('Y-m-d h:i:s'),
				'created_by'=>$user_details['user_id']
				);
		$this->db->insert('invoices', $data);
		$invoice_no=$this->db->insert_id();
		$invoice_products=array();
		if($invoice_no){
			foreach ($post_data['desciption'] as $key => $value) {
				$rate=(float)$post_data['rate'][$key];
				$invoice_products[]=array(
				    'invoice_no'=>$invoice_no,
					'desciption'=>$post_data['desciption'][$key],
					'amount'=>$post_data['amount'][$key],
					'created_date'=>date('Y-m-d'),
					'ceated_by'=>$user_details['user_id'],
				);				
			}
			$this->db->insert_batch('job_items',$invoice_products);
		}
		redirect('invoice/view_job_sheet/'.$invoice_no);
	}

	public function view_job_sheet($bill_no="")
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}
		if($bill_no!=""){
			$invoices_query="SELECT inv.*,inp.* FROM invoices as inv LEFT JOIN job_items as inp ON inp.invoice_no=inv.invoice_no WHERE inv.invoice_no='$bill_no'";
			$results=$this->db->query($invoices_query)->result_array();
			$main_details=$results[0];
			$this->load->view('share/trusted_view_jobsheet', array('details'=>$main_details,'alldetails'=>$results));
		}
	}
	
	public function edit_job_sheet($bill_no="")
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}

		if($bill_no!=""){
			$invoices_query="SELECT inv.*,inp.*,inp.invoice_no as pro_inv_no, inv.invoice_no as invoice_no  FROM invoices as inv LEFT JOIN job_items as inp ON inp.invoice_no=inv.invoice_no WHERE inv.invoice_no='$bill_no'";
			$results=$this->db->query($invoices_query)->result_array();
// 			print_r($results);exit;
		    $main_details=$results[0];
		  //  print_r($main_details);exit;
			$data['page_name']='general/edit_jobsheet';
    		$data['page_data']=array('details'=>$main_details,'alldetails'=>$results);
    		$this->load->view('template',$data);
			
		}
	}
	public function edit_invoice($bill_no="")
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}

		if($bill_no!=""){
			$invoices_query="SELECT inv.*,inp.*,inp.invoice_no as pro_inv_no, inv.invoice_no as invoice_no  FROM invoices as inv LEFT JOIN invoice_products as inp ON inp.invoice_no=inv.invoice_no WHERE inv.invoice_no='$bill_no'";
			
			$results=$this->db->query($invoices_query)->result_array();
			
		    $main_details=$results[0];
		  //  print_r($main_details);exit;
			$data['page_name']='general/edit_invoice';
    		$data['page_data']=array('details'=>$main_details,'alldetails'=>$results);
    		$this->load->view('template',$data);
			
		}
	}


	public function view_invoice($bill_no="")
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}

		if($bill_no!=""){
		    
			$invoices_query="SELECT inv.*,inp.desciption,inp.rate,inp.created_date FROM invoices as inv LEFT JOIN invoice_products as inp ON inp.invoice_no=inv.invoice_no WHERE inv.invoice_no='$bill_no'";
			$results=$this->db->query($invoices_query)->result_array();
			
			$main_details=$results[0];
			 // $html = $this->load->view('share/trusted_invoice', array('details'=>$main_details,'alldetails'=>$results), true);
			 // $stylesheet = $this->load->view('share/invoice_css', '', true);
    //         echo '<style>'.$stylesheet.'</style>'.$html.'<p style="text-align:center">Note : This is computer generated bill and it doesn\'t require signature.</p>';
			$this->load->view('share/trusted_view_invoice', array('details'=>$main_details,'alldetails'=>$results));
		}
	}

	
	public function download_job_sheet($bill_no="")
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}

		if($bill_no!=""){
		    
			$invoices_query="SELECT inv.*,inp.* FROM invoices as inv LEFT JOIN job_items as inp ON inp.invoice_no=inv.invoice_no WHERE inv.invoice_no='$bill_no'";
			$results=$this->db->query($invoices_query)->result_array();
			
			$main_details=$results[0];
			 $html = $this->load->view('share/trusted_jobsheet', array('details'=>$main_details,'alldetails'=>$results), true);
			 $stylesheet = $this->load->view('share/invoice_css', '', true);
            // echo $stylesheet;exit;
            // echo $html;exit;
            
			
			$this->load->library('m_pdf');
			$mpdf=$this->m_pdf->pdf;

			$mpdf->SetTitle(strtoupper($main_details['buyer_name']));

			$mpdf->SetDisplayMode('fullpage');

			$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
			$mpdf->SetHTMLFooter('<p style="text-align:center">Note : This is computer generated bill and it doesn\'t require signature.</p>');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html,2);
    			
			ob_clean();
			$mpdf->Output('trusted'.time().'.pdf','I');
		}
	}

	public function download_invoice($bill_no="")
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}

		if($bill_no!=""){
		    
			$invoices_query="SELECT inv.*,inp.desciption,inp.rate,inp.created_date FROM invoices as inv LEFT JOIN invoice_products as inp ON inp.invoice_no=inv.invoice_no WHERE inv.invoice_no='$bill_no'";
			$results=$this->db->query($invoices_query)->result_array();
			
			$main_details=$results[0];
			 $html = $this->load->view('share/trusted_invoice', array('details'=>$main_details,'alldetails'=>$results), true);
			 $stylesheet = $this->load->view('share/invoice_css', '', true);
            // echo $stylesheet;exit;
            // echo $html;exit;
            
			
			$this->load->library('m_pdf');
			$mpdf=$this->m_pdf->pdf;

			$mpdf->SetTitle(strtoupper($main_details['buyer_name']));

			$mpdf->SetDisplayMode('fullpage');

			$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
			$mpdf->SetHTMLFooter('<p style="text-align:center">Note : This is computer generated bill and it doesn\'t require signature.</p>');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html,2);
    			
			ob_clean();
			$mpdf->Output('trusted'.time().'.pdf','I');
		}
	}


	public function update_jobsheet()
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}
		$post_data=$this->input->post();
		$invoice_no=$post_data['invoice_no'];
		$data=array(
				'customer_name'=>$post_data['customer_name'],
				'customer_mobile'=>$post_data['customer_mobile'],
				'address'=>$post_data['address'],
				'bill_date'=>date('Y-m-d'),
				'apply_gst'=>isset($post_data['apply_gst'])?1:0,
				'gst_per'=>$post_data['gst_per'],
				'discount'=>$post_data['discount'],
				);
		$this->db->update('invoices', $data,array('invoice_no'=>$invoice_no));
		
		$invoice_products=array();
		if($invoice_no){
			foreach ($post_data['desciption'] as $key => $value) {
				$rate=(float)$post_data['rate'][$key];
				$invoice_products[]=array(
				    'invoice_no'=>$invoice_no,
					'desciption'=>$post_data['desciption'][$key],
					'amount'=>$post_data['amount'][$key],
					'created_date'=>date('Y-m-d'),
					'ceated_by'=>$user_details['user_id'],
				);				
			}
			$this->db->delete('job_items',array('invoice_no'=>$invoice_no));
			$this->db->insert_batch('job_items',$invoice_products);
		}
		redirect('invoice/view_job_sheet/'.$invoice_no);
	}
    
    public function update_invoice()
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}
		$post_data=$this->input->post();
		$invoice_no=$post_data['invoice_no'];
		$data=array(
				'customer_name'=>$post_data['customer_name'],
				'customer_mobile'=>$post_data['customer_mobile'],
				'address'=>$post_data['address'],
				'bill_date'=>date('Y-m-d'),
				'apply_gst'=>isset($post_data['apply_gst'])?1:0,
				'gst_per'=>$post_data['gst_per'],
				'discount'=>$post_data['discount'],
				);
		$this->db->update('invoices', $data,array('invoice_no'=>$invoice_no));
		
		$invoice_products=array();
		if($invoice_no){
			foreach ($post_data['desciption'] as $key => $value) {
				$rate=(float)$post_data['rate'][$key];
				$invoice_products[]=array(
				    'invoice_no'=>$invoice_no,
					'desciption'=>$post_data['desciption'][$key],
					'rate'=>$rate,
					'created_date'=>date('Y-m-d'),
					'ceated_by'=>$user_details['user_id'],
				);				
			}
			// print_r($invoice_products);exit;
			$this->db->delete('invoice_products',array('invoice_no'=>$invoice_no));
			$this->db->insert_batch('invoice_products',$invoice_products);
		}
		redirect('invoice/view_invoice/'.$invoice_no);
	}

	public function generate_bill()
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}
		$post_data=$this->input->post();
		
		$data=array(
				'customer_name'=>$post_data['customer_name'],
				'customer_mobile'=>$post_data['customer_mobile'],
				'address'=>$post_data['address'],
				'bill_date'=>date('Y-m-d'),
				'apply_gst'=>isset($post_data['apply_gst'])?1:0,
				'gst_per'=>$post_data['gst_per'],
				'discount'=>$post_data['discount'],
				'created_date'=>date('Y-m-d h:i:s'),
				'created_by'=>$user_details['user_id']
				);
		$this->db->insert('invoices', $data);
		$invoice_no=$this->db->insert_id();
		$invoice_products=array();
		if($invoice_no){
			foreach ($post_data['desciption'] as $key => $value) {
				$rate=(float)$post_data['rate'][$key];
				$invoice_products[]=array(
				    'invoice_no'=>$invoice_no,
					'desciption'=>$post_data['desciption'][$key],
					'rate'=>$rate,
					'created_date'=>date('Y-m-d'),
					'ceated_by'=>$user_details['user_id'],
				);				
			}
			$this->db->insert_batch('invoice_products',$invoice_products);
		}
		redirect('invoice/view_invoice/'.$invoice_no);
	}
	
    public function mobile_invoice()
	{
	    header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        // print_r('Shaik');exit;
        $request = json_decode(file_get_contents ("php://input"),1);
        
        if(isset($request['UserDetails']) && count($request['UserDetails'])>1){
            $email=$request['UserDetails']['email'];
            $password=$request['UserDetails']['password'];
            $user_details=$this->db->query("SELECT * FROM `user` WHERE `status`=1 AND `email`='$email' AND `password`='$password'")->result_array();
            if(count($user_details)>0){
                $user_details=$user_details[0];
                if(isset($request['InvoiceDetails']) && count($request['InvoiceDetails'])>0){
                    if(isset($request['ItemDetails']) && count($request['ItemDetails'])>0){
                        $post_data=$request['InvoiceDetails'];
                        $data=array(
                				'customer_name'=>$post_data['customer_name'],
                				'customer_mobile'=>$post_data['customer_mobile'],
                				'address'=>$post_data['address'],
                				'bill_date'=>date('Y-m-d'),
                				'apply_gst'=>($post_data['apply_gst']==TRUE)?1:0,
                				'gst_per'=>$post_data['gst_per'],
                				'discount'=>$post_data['discount'],
                				'created_date'=>date('Y-m-d h:i:s'),
                				'created_by'=>$user_details['user_id']
                				);
                	    
                		$this->db->insert('invoices', $data);
                		$invoice_no=$this->db->insert_id();
                		$invoice_products=array();
                		if($invoice_no){
                			foreach ($request['ItemDetails'] as $k => $v) {
                				$rate=(float)$v['amount'];
                				$invoice_products[]=array(
                				    'invoice_no'=>$invoice_no,
                					'desciption'=>$v['description'],
                					'rate'=>$rate,
                					'created_date'=>date('Y-m-d'),
                					'ceated_by'=>$user_details['user_id'],
                				);				
                			}
                			$this->db->insert_batch('invoice_products',$invoice_products);
                		}
                	    echo json_encode(array('status'=>200,'message'=>'Invoice Details Stored','data'=>array('invoice_no'=>$invoice_no)));
                    }else{
                        echo json_encode(array('status'=>500,'message'=>'Invalid Item Details','data'=>''));
                    }
                }else{
                    echo json_encode(array('status'=>500,'message'=>'Invalid Invoice Details','data'=>''));
                }
            }else{
                echo json_encode(array('status'=>500,'message'=>'Invalid Login Details','data'=>''));
            }
        }else{
            echo json_encode(array('status'=>500,'message'=>'Invalid Login Details','data'=>''));
        }
		
	}
	public function view_bills($from=0,$to=20,$page_no=1){
		$q="";
		if($this->input->get('q')){
			$q=$this->input->get('q');
			$condition="WHERE customer_mobile LIKE '%$q%' OR address LIKE '%$q%' OR customer_name LIKE '%$q%'";
		}
		if($q==""){
			$results=$this->db->query("SELECT * FROM `invoices`  ORDER BY invoice_no DESC LIMIT $from,$to")->result_array();
		}else{
			$results=$this->db->query("SELECT * FROM `invoices` $condition  ORDER BY invoice_no DESC LIMIT $from,$to")->result_array();	
		}
		$total_records=$this->db->query("SELECT count(*) as count FROM `invoices` ORDER BY invoice_no DESC")->result_array()[0]['count'];
		$no_of_pages=ceil($total_records/RECORD_LIMIT);
		$data['page_name']='general/view_invoice';
		$data['page_data']=$results;
		$data['no_of_pages']=$no_of_pages;
		$data['total_records']=$total_records;
		$data['page_no']=$page_no;
		$data['from']=$from;
		$data['to']=$to;
		$this->load->view('template',$data);
	}
	public function number_to_words($num){
		$number = $num;
		$no = floor($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'one', '2' => 'two',
	    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
	    '7' => 'seven', '8' => 'eight', '9' => 'nine',
	    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
	    '13' => 'thirteen', '14' => 'fourteen',
	    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
	    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
	    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
	    '60' => 'sixty', '70' => 'seventy',
	    '80' => 'eighty', '90' => 'ninety');
	   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
	   while ($i < $digits_1) {
	     $divider = ($i == 2) ? 10 : 100;
	     $number = floor($no % $divider);
	     $no = floor($no / $divider);
	     $i += ($divider == 10) ? 1 : 2;
	     if ($number) {
	        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
	        $str [] = ($number < 21) ? $words[$number] .
	            " " . $digits[$counter] . $plural . " " . $hundred
	            :
	            $words[floor($number / 10) * 10]
	            . " " . $words[$number % 10] . " "
	            . $digits[$counter] . $plural . " " . $hundred;
	     } else $str[] = null;
	  }
	  $str = array_reverse($str);
	  $result = implode('', $str);
	  $points = ($point) ?
	    "." . $words[$point / 10] . " " . 
	          $words[$point = $point % 10] : '';
	   if($points==""){
			return strtoupper($result . "Rupees Only");
	   }else{
			return strtoupper($result . "Rupees  " . $points . " Paise Only");
	   }
	  
	}


	public function add_tax_invoice(){
		$data['page_name']='general/add_tax_invoice';
		$data['page_data']='';
		$this->load->view('template',$data);
	}
	public function generate_tax_invoice(){

		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}
		$post_data=$this->input->post();

		$data=array(
				'invoice_no'=>$post_data['invoice_no'],
				'name'=>$post_data['name'],
				'address'=>$post_data['address'],
				'gst_number'=>$post_data['gst_number'],
				'bill_date'=>$post_data['bill_date'],
				'status'=>1,
				'created_date'=>date('Y-m-d h:i:s'),
				'created_by'=>$user_details['user_id']
				);
		$this->db->insert('tax_invoice', $data);
		$tax_invoice_id=$this->db->insert_id();
		$tax_invoice_products=array();
		if($tax_invoice_id){
			foreach ($post_data['hsn'] as $key => $value) {
				$gst=(float)$post_data['gst'][$key];
				$taxable_value=$post_data['taxable_val'][$key];
				$amount=($taxable_value/100)*$gst;
				$tax_invoice_products[]=array(
					'tax_invoice_id'=>$tax_invoice_id,
					'hsn'=>$post_data['hsn'][$key],
					'taxable_value'=>$taxable_value,
					'gst_amt'=>$gst,
					'c_rate'=>$gst,
					'c_amount'=>$amount,
					's_rate'=>$gst,
					's_amount'=>$amount,
					'status'=>1,
					'created_date'=>date('Y-m-d'),
					'created_by'=>$user_details['user_id'],
				);				
			}
			// print_r($tax_invoice_products);exit;
			$this->db->insert_batch('tax_invoice_products',$tax_invoice_products);
		}
		redirect('invoice/view_tax_invoice/'.$tax_invoice_id);
	}
	


	public function view_tax_invoice($bill_no="")
	{
		if($user_details=$this->session->has_userdata('user_details')){
			$user_details=$this->session->userdata('user_details');	
		}else{
			redirect('general/login');
		}

		if($bill_no!=""){
			$invoices_query="SELECT inv.tax_invoice_id, inv.invoice_no, inv.name,inv.address, inv.gst_number, inv.bill_date, inv.created_date,inp.tax_invoice_id,inp.hsn,inp.gst_amt,inp.c_rate,inp.taxable_value,inp.c_amount,inp.s_rate,inp.s_amount FROM tax_invoice as inv INNER JOIN tax_invoice_products as inp ON inp.tax_invoice_id=inv.tax_invoice_id WHERE inv.tax_invoice_id='$bill_no'";
			$results=$this->db->query($invoices_query)->result_array();
			

			$main_details=$results[0];
			$invoice_data=array('main_details'=>$main_details,'data'=>$results,'controller'=> $this);
			$html=$this->load->view('general/tax_invoice',$invoice_data,TRUE);
			
			$this->load->library('m_pdf');
			$mpdf=$this->m_pdf->pdf;

			$mpdf->SetTitle(strtoupper($main_details['name']));

			$mpdf->SetDisplayMode('fullpage');
			$mpdf->AddPage('L');

			$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

			// LOAD a stylesheet
			$stylesheet = file_get_contents('extras/system/css/invoice.css');
			$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

			$mpdf->WriteHTML($html,2);
			ob_clean();
			$mpdf->Output('ijas/'.time().'.pdf','I');
		}
	}
}
