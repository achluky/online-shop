<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
    @ahmadluky
*/
class Login extends CI_Controller {
    public $session_data; 
    function __construct() {
        parent::__construct();
        $this->session_data = $this->session->userdata('logged_in');
        if (count($this->session->userdata('logged_in'))) { 
          if($this->session_data['customer_id']=="admin"){
            redirect(URL_.'admin/home', 'refresh');
          }else{
            redirect(URL_.'dashbroadFMC', 'refresh'); 
          }
        }
        $this->load->model('Model_customer');
    }

    public function index() {
        $data = array('error_msg' => '');
        $this->load->view('login');
    }

    public function dashbroad(){
        $data = array('title'=> 'Dashbroad');
        $this->load->view('dashbroad');
    }

    public function auth(){
        if (isset($_POST['user']) and $_POST['user'] != NULL) {
            if(isset($_POST['pwd']) and $_POST['pwd'] != NULL){
                if ( $user = $this->Model_customer->get($_POST['user'], $_POST['pwd']) ) {
                    if ($user!=NULL) {
                        if ($user == 'admin') {
                            $sess_array = array(
                                'customer_id' => 'admin',
                                'user' => 'admin',
                                'nama' => 'Administrator',
                                'accses' => -1,
                                'last_login' => date("Y-m-d")
                            );

                        $this->session->set_userdata('logged_in', $sess_array);
                        redirect(URL_.'admin/home', 'refresh');
                        } else {
                          if ($user->userlevel == 3 OR $user->userlevel == 4) {
                              $user_list = array();
                              $users = $this->Model_customer->getUserlist($user->CustomerID);
                              foreach ($users->result() as $v) {
                                  array_push($user_list, $v->CustomerID);
                              }
                              $sess_array = array(
                                  'customer_id' => $user_list,
                                  'user' => $user->login,
                                  'nama' => $user->Name,
                                  'accses' => $user->userlevel,
                                  'userfmc' => $user->fmc,
                                  'fmcsite' => $user->grouploc,
                                  'last_login' => date("Y-m-d")
                              );
                          } else {
                              $sess_array = array(
                                  'customer_id' => $user->CustomerID,
                                  'user' => $user->login,
                                  'nama' => $user->Name,
                                  'accses' => $user->userlevel,
                                  'userfmc' => $user->fmc,
                                  'fmcsite' => $user->grouploc,
                                  'last_login' => date("Y-m-d")
                              );
                          }

                        $this->session->set_userdata('logged_in', $sess_array);
                        redirect(URL_.'dashbroadFMC', 'refresh');
                        }
                    } else {
                        $data['error_msg']  = "Invalid username and password";
                    }
                }else{
                    $data['error_msg']  = "Invalid password";
                }
            }else{
                $data['error_msg']  = "Invalid username or password";
            }
        }else{
            $data['error_msg']  = "Invalid username or password";
        }
        $this->load->view('login', $data);
    }


    public function logout(){
        $this->session->sess_destroy();
        redirect($this->config->item('base_url').'', 'refresh');
    }

}
