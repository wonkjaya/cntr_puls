<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->helper('html','url');
 $this->load->model('mapi');
}

function topupPulsa(){
 //url	=> http://.../index.php/pulsa/api/topupPulsa/[nomor_tujuan]?user=0897787767&code=1234&jml=5
 $user=$this->input->get('user');
 $code=$this->input->get('code');
 $jml=str_replace($this->input->get('jml'),'-','');
 $nomor=$this->uri->segment(4);
 $user=$this->check_user($user,$code);
 $provider=$this->get_provider_fromNomor($nomor);
 if ($user['saldo'] >= $jml){ //return jumlah saldo pada user
  //insert to topup table
  if ($user != ""){
   echo "s";
  }
 }
}

function get_provider_fromNomor($nomor){
 if ($nomor != ""){echo "f";
  $data=$this->mapi->get_Providertype_fromNomor($nomor);
  foreach ($data->result() as $r){
   $res['type']=$r->trxType;
  }
 }
}

function check_user($user,$code){
 $res=array();
 if ($user !='' and $code != ''){
  $data=$this->mapi->check_user($user,$code);
  foreach($data->result() as $r){
   $res['user_agent']=$r->user_agent;
   $res['saldo']=$r->saldo;
  }
 }
 return $res;
}

function loginAccount(){
 
}




}
//end of file
