<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
	 parent::__construct();
	 $this->load->helper(array('html','url','table','content','url-counter'));
	 $this->load->library(array('session'));
	 $this->load->model('mpulsa');
	}
	
	function get_session(){
	 $this->check_session();
	 $user_session=$this->session->userdata('user_kasir');
	 return $user_session;
	}
	
	function check_session($state=0){
	 $user=$this->session->userdata('user_kasir');
	 if($state==0){
	  if ($user=="")redirect('pulsa/main/login'); 
	 }
	}
	
	function set_userdata($username){
	 $this->session->set_userdata("user_kasir",$username);
	}
	
	public function index()
	{
		$user=$this->get_session();
		$this->load->view('layar_utama');
	}
	
	function check_login($username,$password){
		$this->load->library('encrypt');
		 $err="username dan password SALAH";
		 $pass="";
		 $cek=$this->mpulsa->check_user_login($username);
		 if($cek->num_rows() == 1){
		  foreach($cek->result() as $r){echo $pass=$this->encrypt->decode($r->password);}
		   if($pass == $password){
			  $this->set_userdata($username);
			  redirect("pulsa/main/view_transaksi_deposit");
		   }else{}
		 }
		return $err;
	}
	
	function check_available($username){
		$err="";
		$cek=$this->mpulsa->check_user_login($username);
		if($cek->num_rows() == 1){
		  $err="Maaf username Sudah Ada Sebelumnya!!! coba yang lain";
		}
		return $err;
	}
	
	public function login()
	{
		$this->load->helper('form');
		$this->check_session(1);
		$err="";
		if($_POST){
		 $username=$this->input->post('kasir_username');
		 $password=$this->input->post('kasir_password');
		 $err=$this->check_login($username,$password);
		}
		$data['err']=$err;
		$this->load->view('login',$data);
	}

	function logout_user(){
		$this->session->unset_userdata('user_kasir');
		$this->index();
	}
	
	function cek_login(){
		if($_POST){
		 $username=$this->input->post('username');
		 $password=$this->input->post('password');
		}else{
		 redirect('pulsa/main');
		}
	}
	
	function check_agentExists($username){
		$check=$this->mpulsa->check_agentExists($username);
		if($check >= 1)return true;else return false;
	}
	
	function register_newAgent(){
		$this->load->helper('form');
		$err="";
		$data['red']="0";
		if($_POST){
		 $username=$this->input->post('username');
		 $nama=$this->input->post('nama');
		 $nomor=$this->input->post('nomor');
		 $privateCode=$this->input->post('code');
		 $saldo=$this->input->post('saldo');
		 $err=$this->check_agentExists($username);//boolean
		 if ($username != "" and $username and $nomor!="" and $nama != "" and $privateCode != "" and $saldo >= 50000){
		  if(substr($username,0,4) != "REZ-")$username = "REZ-".$username;
		  if($err == false){
			 $this->mpulsa->insert_new_userAgent($username,$nomor,$nama,$privateCode,$saldo);
			 $data['success']="User baru dengan username [<b>$username</b>] berhasil di buat!!!";
		  }else{
		  	$err="Data Sudah ada sebelumnya. harap masukkan username lainnya.";
			$data['red']="1";
		  }
		 }else{
		  $err="Data Tidak sesuai dengan perintah. Harap coba kembali";
		 }
		}
		$data['err']=$err;
		$data['title']="Register";
		$data['ctrl']=$this;
		$this->load_header_left_side($data);
		$this->load->view('newUser',$data);
		//if($_POST)redirect(siteUrlCounter('register_newAgent','created'));
	}
	
	function editUser(){
	 $this->load->helper('form');
	 $id=$this->input->get('id');
	 if($_POST){
	  $usr=$this->input->get('id');
	  $nama=$this->input->post('nama');
	  $nomor=$this->input->post('nomor');
	  $privateCode=$this->input->post('code');
	  $saldo=$this->input->post('saldo');
	  $active=$this->input->post('activated');
		  if($usr == $id){
		   $this->mpulsa->update_user($usr,$nama,$nomor,$privateCode,$saldo,$active);
		  }
	   redirect(siteUrlCounter('agents'));
	 }
	 $check=$this->mpulsa->check_table_data_exists('agents','user_agent',$id);
	 if($check->num_rows() >= 1){
	   $data['edit_data']=$check;
	 }
		$data['title']="Edit Agent";
		$data['ctrl']=$this->get_controller();
		$this->load_header_left_side($data);
		$this->load->view('newUser',$data);
	 
	}
	
	function get_controller(){
	 return $this;
	}
	
	function backup_agent($user,$name,$code,$saldo){
	 $user=$this->db->escape($user);
	 $name=$this->db->escape($name);
	 $code=$this->db->escape($code);
	 $saldo=$this->db->escape($saldo);
	 $sql_write="INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES ($user,$name,$code,$saldo)";
	 $q=$this->mpulsa->backup('agents',$sql_write);
	 if($q)$this->delete('agents','user_agent',$user);
	}
	
	function delete($table,$col,$value){
	  $this->mpulsa->delete($table,$col,$value); // delete pada table tertentu dengan syarat tertentu
	  return ;
	}
	
	function deleteUser(){
	  $id=$this->input->get('id');
	  $check=$this->mpulsa->check_table_data_exists('agents','user_agent',$id);
	  if($check->num_rows() >= 1){
	    foreach($check->result() as $r){
	      $this->backup_agent($r->user_agent,$r->name,$r->code,$r->saldo);
	    }
	  }
	  redirect (siteUrlCounter('agents'));
	}
	
	function load_header_left_side($data){
	 $this->get_session();
	 $this->load->view('header',$data);
	 $this->load->view('left-side');
	}
	
	function getUsernameForNewUser(){
	 $hasil=$this->mpulsa->getUsernameForNewUser();
	 foreach($hasil->result() as $r){
	  $LastUser=$r->user_agent;
	  $l=substr($LastUser,-4)+1;
	  $nol="0000";
	  $cursor=strlen($nol)-strlen($l);
	  return "REZ-".substr($nol,0,$cursor).$l;
	 }
	}
	
	function getNewNoTransaksi(){
	 $hasil=$this->mpulsa->getLastTransaksi();
	 foreach($hasil->result() as $r){
	  $LastUser=$r->no_transaksi;
	  $l=substr($LastUser,-5)+1;
	  $nol="000000";
	  $cursor=strlen($nol)-strlen($l);
	  return "DEP-".substr($nol,0,$cursor).$l;
	 }
	}
	
	function getNewNoDeposit(){
	 $hasil=$this->mpulsa->getLastDeposit();
	 if ($hasil->num_rows() == 0){return "DEP-00000000001";}
	 foreach($hasil->result() as $r){
	  $LastUser=$r->ID_deposit;
	  $l=substr($LastUser,-10)+1;
	  $nol="00000000000";
	  $cursor=strlen($nol)-strlen($l);
	  return "DEP-".substr($nol,0,$cursor).$l;
	 }
	}
	
	function getPrivateCode(){
		$m=microtime() + date('ds');
		return substr($m,-5);
	}
	
	function agents(){
	 $this->get_session();
	 $data["title"]="Data Agen";
	 if($_GET){
	  $nama=$this->input->get('nama');
	 }else{
	  $nama="";
	 }
	 $data['agent_datas']=$this->mpulsa->get_all_agents($nama);
	 $data['ctrl']=$this->get_controller();
	 $this->load_header_left_side($data);
	 $this->load->view('agents',$data);
	}
	
	function view_transaksi_deposit(){
	 $this->get_session();
	 $this->load->helper('form');
	 $data["title"]="Data Transaksi Deposit";
	 $order="`tanggal_deposit` DESC";
	 $data['deposit_datas']=$this->mpulsa->get_all_deposits($order);
	 $this->load_header_left_side($data);
	 $this->load->view('transaksi_deposit',$data);
	}
	
	function kirim_ulang_deposit(){
	 $id=$this->input->get('id');
	 $class=$this->input->get('classno');
	 $saldo=$this->mpulsa->getDepositNominalWhere($id,0);
	 if ($saldo->num_rows() > 0){
		 $prov_saldo=$this->mpulsa->get_provider_saldo("SAL_SERV");
		 foreach($saldo->result() as $s){
		  $saldo_akhir= $prov_saldo - $s->nominal;
		  if($saldo_akhir >= 1){ //pulsa minimal di server
			 $this->mpulsa->update_stateToPending("DEP",$id);
			 $this->mpulsa->updateConfig("SAL_SERV",$saldo_akhir);
		  }
		 }
		 $data=$this->mpulsa->selectDepositWhere($id);
		 getDepositContentWhere($data,$class);//get from helper	 
	 }
	}
		
	function kirim_ulang_topup(){
	 $id=$this->input->get('id');
	 $class=$this->input->get('classno');
	 $this->mpulsa->update_stateToPending('TOPUP',$id);
	 $trxInfo=$this->mpulsa->getTopupNominalWhere($id);//mendapatkan user_agent dan jumlah nominal dari id transaksi
	 foreach($trxInfo->result() as $r){
	  $harga_jual=$r->harga_jual;
	  $user_saldo=$this->mpulsa->get_UserSaldo($r->user_agent);//lookup data on agents table
	 }
	}

	
	function cancel_deposit(){
	 $id=$this->input->get('id');
	 $class=$this->input->get('classno');
	 $data=$this->mpulsa->getDepositstateWhere($id,2);
	 if($data == 1){
		 $saldo=$this->mpulsa->getDepositNominalWhere($id);
		 $prov_saldo=$this->mpulsa->get_provider_saldo("SAL_SERV");
		 if ($prov_saldo != ""){
		 	foreach($saldo->result() as $r){
			 $saldo_server=$r->nominal + $prov_saldo;
			 $saldo_user=$r->saldo + $r->nominal;
			 $this->mpulsa->updateConfig("SAL_SERV",$saldo_server);
			 $this->mpulsa->updateSaldoUser($r->user_agent,$saldo_user);
			 $this->mpulsa->update_stateToCancel($id);
		 	}
		 }
	 }
	 $data=$this->mpulsa->selectDepositWhere($id);
	 getDepositContentWhere($data,$class);//get from helper
	}
	
	function delete_deposit(){
	 $id=$this->input->get('id');
	 $data=$this->mpulsa->getDepositstateWhere($id,2);
	 if($data == 1){
		 $saldo=$this->mpulsa->getDepositNominalWhere($id);
		 $prov_saldo=$this->mpulsa->get_provider_saldo("SAL_SERV");
		 if ($prov_saldo != ""){
		 	foreach($saldo->result() as $r){
			 $saldo_server=$r->nominal + $prov_saldo;
			 $this->mpulsa->updateConfig("SAL_SERV",$saldo_server);
		 	}
		 }
	 }
	 $this->mpulsa->delete_deposit($id);
	}
	
	function newTransaksi(){
	 $this->get_session();
	 $user=$this->session->userdata('user_kasir');
	 $prov_saldo=$this->mpulsa->get_provider_saldo("SAL_SERV");
	 $data['saldo_server']=$prov_saldo;
	 if($_POST){
	  $id=$this->input->post('id');
	  $tgl=date("d-M-Y g:i:s");
	  $agent=$this->input->post('agent');
	  $nominal=$this->input->post('nominal');
	  if($id != "" and $agent != "" and $nominal != "" ){
	   $saldo_akhir=$prov_saldo - $nominal;
	   if ($saldo_akhir >= 0){
		$this->mpulsa->insert_new_deposit($id,$agent,$nominal,$user);
		$this->mpulsa->insert_new_message('DEP',$tgl,$nominal,$agent);
		$this->mpulsa->update_config_saldo_provider("SAL_SERV",$saldo_akhir);
		$this->Put_log($user,"Input transaksi baru dengan id=$id,agent=$agent, nominal = $nominal");
		redirect(siteUrlCounter("newTransaksi"));
	   }else{
	    $data['err']="Saldo Server = ".number_format($prov_saldo)." ,Tidak Cukup !!!";
	   }
	  }else{
	   $data['err']="Tidak boleh ada yang kosong";
	  }
	 }
	 $this->load->helper('form');
	 $data["title"]="Input Deposit";
	 $data['no']=$this->getNewNoDeposit();
	 $data['agent']=$this->mpulsa->select_id_agent();
	 $this->load_header_left_side($data);
	 $this->load->view('new_deposit',$data);
	}
	
	function providers(){
	 $this->get_session();
	 $data["title"]="Providers";
	 $order="`nama_provider` ASC";
	 $data['provider_datas']=$this->mpulsa->get_all_providers($order);
	 $this->load_header_left_side($data);
	 $this->load->view('provider',$data);
	}
	
	function editProvider(){
	 $this->get_session();
	 if($_POST){
	  $id=$this->input->post('kode');
	  $nama=$this->input->post('nama');
	  $nomor=$this->input->post('nomor');
	  $saldo=$this->input->post('saldo');
	  $status=$this->input->post('status');
	  if ($id != "" and $nama != ""){
	  	$this->mpulsa->update_provider($id,$nama,$nomor,$saldo,$status);
	  	redirect(siteUrlCounter('providers'));
	  }
	 }
	 $data['title']="";
	 $this->load->helper('form');
	 $id=$this->input->get('id');
	 $data['edit']="enable";
	 $data['provider']=$this->mpulsa->getProviderWhere($id);
	 $this->load_header_left_side($data);
	 $this->load->view('newProvider',$data);
	}
	 
	function register_newProvider(){
	   $this->get_session();
	   if($_POST){
	    $kode=$this->input->post('kode');
	    $nama=$this->input->post('nama');
	    $nomor=$this->input->post('nomor');
	    $saldo=$this->input->post('saldo');
	    $status=$this->input->post('status');
	    if ($kode == "" or $saldo == '' or $nomor == ''){
	     $data['err']="Harap Mengisi Semua Kolom yang telah disediakan";
	    }else{
		    $check=$this->mpulsa->getProviderWhere($kode);
		    if($check->num_rows() == 0){
			    $this->mpulsa->insert_newProvider($kode,$nama,$nomor,$saldo,$status);
		    }else{$data['err']="Data Duplikasi Terdeteksi, Harap Masukkan Data Dengan Kode lainnya.";}
	    }
	   }
	    $data['title']="NEW Provider";
		 $this->load->helper('form');
		 $this->load_header_left_side($data);
		 $this->load->view('newProvider',$data);
	}
	
	function deleteProvider(){
	  $this->get_session();
	  $id=$this->input->get('id');
	  $this->mpulsa->delete_provider($id);
	  redirect(siteUrlCounter('providers'));
	}
	
	function trxType(){
	 $this->get_session();
	 $data["title"]="TRX Type";
	 $data['trxType']=$this->mpulsa->get_trx_type();
	 $this->load_header_left_side($data);
	 $this->load->view('trxType',$data);
	}
	
	function register_newType(){
	 $this->get_session();
	 if($_POST){
	  $kode=$this->input->post('kode');
	  $prov=$this->input->post('nama');
	  $nominal=$this->input->post('nominal');
	  $hbeli=$this->input->post('hbeli');
	  $hjual=$this->input->post('hjual');
	  $state=$this->input->post('status');
	  if ($kode == "" or $nominal=="" or $hbeli =="" or $hjual==""){
	   $data['err']="Harap Mengisi Kolom yang telah disediakan";
	  }else{
	   $check=$this->mpulsa->get_typeFromKode($kode);
	   if ($check->num_rows() == 0){
	    $this->mpulsa->insert_newType($kode,$prov,$nominal,$hbeli,$hjual,$state);
	    redirect(siteUrlCounter('trxType'));
	   }else{
	    $data['err']="Duplikat data terdeteksi.";
	   }
	  }
	 }
	 $this->load->helper('form');
	 $data['title']="NEW Trx Type";
	 $data['prov']=$this->mpulsa->get_provider_datas();
	 $this->load_header_left_side($data);
	 $this->load->view('new_trxType',$data);
	}
	
	function editType(){
	 $id=$this->input->get('id');
	 if ($_POST){
	  $kode=$this->input->post('kode');
	  $prov=$this->input->post('nama');
	  $nominal=$this->input->post('nominal');
	  $hbeli=$this->input->post('hbeli');
	  $hjual=$this->input->post('hjual');
	  $state=$this->input->post('status');
	  $this->mpulsa->updateType($kode,$prov,$nominal,$hbeli,$hjual,$state);
	  redirect(siteUrlCounter('trxType'));
	 }
	 if($id != ""){
	   $data['edit']="edit";
	   $data['title']="EDIT Trx Type";
	   $data['prov']=$this->mpulsa->get_provider_datas();
	   $data['type']=$this->mpulsa->get_typeFromKode($id);
	   $this->load->helper('form');
	   $this->load_header_left_side($data);
	   $this->load->view('new_trxType',$data);
	 }
	}
	
	function transaksi(){
	 $this->get_session();
	 $data['title']="Transaksi";
	 $data['transaksi_topup']=$this->mpulsa->transaksi();
	 //echo var_dump($data['transaksi_topup']->result());
	 $this->load_header_left_side($data);
	 $this->load->view('transaksi',$data);
	}
	
	function AktivitasUser(){
	 $this->get_session();
	 $id=$this->input->get('id');
	 $clue=$this->input->get('clue');
	 $data['title']="Aktivitas";
	 if($clue == "topup"){
	 	$data['activities']=$this->mpulsa->getActivitiesFortopup($id);
	 }else{
	 	$data['activities']=$this->mpulsa->getActivitiesFordeposit($id);
	 }
	 $data['id']=$id;
	 $data['clue']=$clue;
	 $this->load_header_left_side($data);
	 $this->load->view('userActivities',$data);
	}
	
	function Put_log($user,$activity){
	  if($user != "" and $activity != ""){
	   $this->mpulsa->insert_log($user,$activity);
	  }
	  return ;
	}
	
	function numberReferences(){
	 $this->get_session();
	 $data['title']="Referensi Nomor";
	 $data['nomor']=$this->mpulsa->referensi_nomor();
	 $this->load_header_left_side($data);
	 $this->load->view('referensi_nomor',$data);
	}
	
	function register_references(){
	 $this->get_session();
	 if($_POST){
	  $prefix=$this->input->post('prefix');
	  $kode=$this->input->post('kode_provider');
	  $st=$this->input->post('status');
	  $this->mpulsa->insert_new_reference($prefix,$kode,$st);
	  redirect('pulsa/main/numberReferences');
	 }
	 $this->load->helper('form');
	 $data['title']="New Referensi Nomor";
	 $data['new']="set";
	 $data['provider']=$this->mpulsa->get_provider_datas();
	 $this->load_header_left_side($data);
	 $this->load->view('referensi_nomor',$data);
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
