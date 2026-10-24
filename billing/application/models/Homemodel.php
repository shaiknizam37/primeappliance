<?php

class Homemodel extends CI_Model 
{
    function __construct() {
        parent::__construct(); 
        
    }

    function allposts_count()
    {   

        foreach ($this->db_col as $k => $v) {
            $column=$this->columns[$k];
            $this->db->or_like($column,$v);
        }
        $query = $this->db->get('invoices');
        return $query->num_rows();  

    }
    
    function allposts($limit,$start,$col,$dir)
    {   
        foreach ($this->db_col as $k => $v) {
            $column=$this->columns[$k];
            $this->db->or_like($column,$v);
        }
        
        $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('invoices');
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
   
    function posts_search($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->like('invoice_no',$search)
                ->or_like('bill_date',$search)
                ->or_like('customer_name',$search)
                ->or_like('customer_mobile',$search)
                ->or_like('address',$search)
                ->or_like('created_date',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('invoices');       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count($search)
    {
        $query = $this
                ->db
                ->like('invoice_no',$search)
                ->or_like('bill_date',$search)
                ->or_like('customer_name',$search)
                ->or_like('customer_mobile',$search)
                ->or_like('address',$search)
                ->or_like('created_date',$search)
                ->get('invoices');
    
        return $query->num_rows();
    } 
   
}
