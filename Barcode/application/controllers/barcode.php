<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Barcode extends CI_Controller {

      public function index()
      {


          $data['title']=" Barcode ";


          $data['barcode']=$this->barcode_model->get_barcodes();

          $this->load->view('templates/header');
          $this->load->view('barcode/index',$data);
          $this->load->view('templates/footer');
      }

      public function ShowAllbarcode()
        {
          $result =  $this->barcode_model->get_barcodes();
          echo json_encode($result);
        }



      public function create()
      {
        $data['title']="Create barcode ";



             $code=$this->input->post('barcode_name');

             $this->load->library('zend');
             $this->zend->load('Zend/Barcode');
             $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
             //$code = time().$code;
             $store_image = imagepng($file,"./asset/images/barcode/{$code}.png");
             $bar_code  = $code.'.png';

            $result =  $this->barcode_model->create_barcode($bar_code);

            $msg['success']=false;
            if($result)
            {
              $msg['success']=true;
            }
            echo json_encode($msg);


      }




}
