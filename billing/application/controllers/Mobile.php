<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

	public function login()
	{
    $post_data = json_decode(file_get_contents('php://input'), true);
    
    if(isset($post_data['email']) && isset($post_data['password'])){
      $this->load->model('user_model');
      $result=$this->user_model->login($post_data['email'],$post_data['password']);
      if(count($result)>0){
        $date=date("Y-m-d H:i:s");
        $token=md5(json_encode($result[0]));
        $session_exist=$this->db ->select('*')->where('user_id', $result[0]["user_id"])->get('session')->row();
        if($session_exist){
             $this->db->where('user_id',$result[0]["user_id"])->update('session',array(
            "session_token"=>$token,
            "expire_at"=>date("Y-m-d H:i:s",strtotime("+30 days")),
            "created_at"=>$date,
            ));
        }else{
             $this->db->insert('session',array(
            "user_id"=>$result[0]["user_id"],
            "session_token"=>$token,
            "expire_at"=>date("Y-m-d H:i:s",strtotime("+30 days")),
            "created_at"=>$date,
            ));
        }
        header('Content-Type: application/json');
        echo json_encode(array(
            "status"=>true,
            "message"=>"Loggedin Successfully",
            "data"=>array("token"=>$token),
            ));
      }else{
        header('Content-Type: application/json');
         echo json_encode(array(
            "status"=>false,
            "message"=>"Invalid Credentials",
            "data"=>[],
            ));
      }
    }else{
        header('Content-Type: application/json');
       echo json_encode(array(
            "status"=>false,
            "message"=>"Email/Password is not set",
            "data"=>[],
            ));
    }
    
	}

  public function login_success()
  {
    if($this->session->has_userdata('user_details')){
      $data['page_name']='general/dashboard';
      $data['page_data']='';
      $this->load->view('template',$data);
    }else{
      redirect('general/index');
    }
    
  }
  
  public function getinvoices()
	{
		$this->load->model('Homemodel');
    $filter_column=$this->input->get('columns');
    $db_col=array();
    foreach ($filter_column as $flk => $flv) {
      $col=$flk-1;
      if($col<0){
        $col=0;
      }
      if(!empty($flv['search']['value'])){
        $db_col[$col]=$flv['search']['value'];  
      }
    }
    $this->db_col=$db_col;
		$columns = array( 
						'invoice_no', 
            'bill_date',
						'customer_name',
						'customer_mobile',
						'address',
						'created_date',
                        );
    $this->columns=$columns;
		$limit = $this->input->get('length');
        $start = $this->input->get('start');
        $order = $columns[$this->input->get('order')[0]['column']];

        $dir = $this->input->get('order')[0]['dir'];
       
        $totalData = $this->Homemodel->allposts_count();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->get('search')['value']))
        {            
            $posts = $this->Homemodel->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->get('search')['value']; 

            $posts =  $this->Homemodel->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Homemodel->posts_search_count($search);
        }
        $data = array();
        if(!empty($posts))
        {
        	$i=0;
            foreach ($posts as $post)
            {
            	$data[$i][] = '<a target="_blank" class="btn btn-sm btn-success" href="'.base_url('index.php/invoice/view_invoice/'.$post->invoice_no).'"><i class="fa fa-eye"></i></a>
		                <a target="_blank" class="btn btn-sm btn-primary" href="'.base_url('index.php/invoice/download_invoice/'.$post->invoice_no).'"><i class="fa fa-download"></i></a>
		                <a target="_blank" class="btn btn-sm btn-danger" href="'.base_url('index.php/invoice/edit_invoice/'.$post->invoice_no).'"><i class="fa fa-edit"></i></a>';
                $data[$i][] = $post->invoice_no;
                $data[$i][] = $post->bill_date;
                $data[$i][] = $post->customer_name;
                $data[$i][] = $post->customer_mobile;
                $data[$i][] = $post->address;
                $data[$i][] = date('j M Y h:i a',strtotime($post->created_date));
				$i++;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->get('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
}
  
   public function logout()
  {
    if($this->session->has_userdata('user_details')){
      $this->session->unset_userdata('user_details');
    }
    redirect('/');
  }

}