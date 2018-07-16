<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Orders extends CI_Controller {

  /**
  * Index Page for this controller.
  *
  * Maps to the following URL
  * 		http://example.com/index.php/welcome
  *	- or -
  * 		http://example.com/index.php/welcome/index
  *	- or -
  * Since this controller is set as the default controller in
  * config/routes.php, it's displayed at http://example.com/
  *
  * So any other public methods not prefixed with an underscore will
  * map to /index.php/welcome/<method_name>
  * @see https://codeigniter.com/user_guide/general/urls.html
  */

  function __construct()
  {
    parent::__construct();

    if (!$this->ion_auth->logged_in()) {
      // redirect them to the login page
      redirect('auth/login', 'refresh');
    }
  }

  public function index(){
    $this->load->view("orders/index");
  }
  public function add(){

    $this->form_validation->set_rules('order', "order", 'required');
    if($this->form_validation->run()===TRUE){
      $data = '{ "order": "username",
        "ordered_by": "random",
        "status": "pending"}';

        $url = "https://test-cbee9.firebaseio.com/orders/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        $jsonResponse = curl_exec($ch);
        if(curl_errno($ch))
        {
          echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
      }else{

        $this->load->view("orders/add");
      }
    }
  }
