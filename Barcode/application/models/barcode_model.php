<?php

class Barcode_model extends CI_Model {

    public function __construct()
    {
      $this->load->database();
    }

    public function create_barcode($store_image)
    {

        $data=  array(
          'barcode_name' =>$this->input->post('barcode_name'),
          'imgbarcode' =>$store_image,
          'created_at'=>date('Y-m-d H:i:s')
         );

          $this->db->insert('barcode',$data);

         if($this->db->affected_rows()>0)
           {
             return true;

           }else {
             return false;
           }

    }

    public function get_barcodes()
    {
    $this->db->order_by('created_at','desc');

      $query= $this->db->get('barcode');
      return $query->result_array();
    }


  }
