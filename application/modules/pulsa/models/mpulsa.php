<?php

class Mpulsa extends CI_Model{

 function select_all_request(){
 
 }
 
 function check_agentExists($username){
  $username=$this->db->escape($username);
  $sql="SELECT * FROM ".T_AGENT." WHERE user_agent=$username";
  $query=$this->executeSQL($sql);
  return $query->num_rows();
 }
 
 function update_user($username,$nama,$nomor,$privateCode,$saldo,$active){
	 $username=$this->db->escape($username);
	 $nama=$this->db->escape($nama);
	 $nomor=$this->db->escape($nomor);
	 $privateCode=$this->db->escape($privateCode);
	 $saldo=$this->db->escape($saldo);
	 $sql="UPDATE ".T_AGENT." SET `name`=$nama ,`code`=$privateCode,`nomorHp`=$nomor,`saldo`=$saldo, `activated`=$active WHERE `user_agent`=$username";
	 $this->executeSQL($sql);
 }

 function check_table_data_exists($tablename,$colname,$id){
  $id=$this->db->escape($id);
  $sql="SELECT * FROM $tablename WHERE $colname=$id";
  $query=$this->executeSQL($sql);
  return $query;
 }
 
 function delete($table,$col,$value){
  $sql="DELETE FROM $table WHERE $col=$value ";
  $this->executeSQL($sql);
 }
 
 function backup($table,$sql){
   $table=$this->db->escape($table);
   $sql=$this->db->escape($sql);
   $sql="INSERT INTO ".T_TRASH." (`table_name`,`backup`) VALUES ($table,$sql)";
   return $this->executeSQL($sql);
 }
 
 function insert_new_userAgent($username,$nomor,$nama,$privateCode,$saldo){
  $username=$this->db->escape($username);
  $nama=$this->db->escape($nama);
  $nomor=$this->db->escape($nomor);
  $privateCode=$this->db->escape($privateCode);
  $saldo=$this->db->escape($saldo);
  $sql="INSERT INTO ".T_AGENT." (`user_agent`,`nomorHp`,`name`,`code`,`saldo`,`activated`) 
  	VALUES ($username,$nomor,$nama,$privateCode,$saldo,1)";
  $this->executeSQL($sql);
 }
 
 function insert_new_kasir($username,$password){
 	$username=$this->db->escape($username);
 	$password=$this->db->escape($password);
 	$sql="INSERT INTO `".T_KASIR."` (`username`,`password`) VALUES ($username,$password)";
 	$this->executeSQL($sql);
 }
 
 function transaksi(){
 	$sql="SELECT * FROM `".T_TRTOP."` WHERE 1 ORDER BY status ASC";
 	return $this->executeSQL($sql);
 }
 
 function getLastTransaksi(){
 	$sql="SELECT no_transaksi FROM `".T_TRTOP."` ORDER BY no_transaksi DESC LIMIT 1";
 	return $this->executeSQL($sql);
 }
 
 function getLastDeposit(){
 	$sql="SELECT ID_deposit FROM `".T_DEPOS."` ORDER BY ID_deposit DESC LIMIT 1";
 	return $this->executeSQL($sql);
 }
 
 function select_id_type(){
	$sql="SELECT ID_jenis FROM `".T_TYTRX."` WHERE status=1";
	return $this->executeSQL($sql);
 }
 
 function select_id_agent(){
	$sql="SELECT user_agent,name FROM ".T_AGENT." WHERE activated=1";
	return $this->executeSQL($sql);
 }

 function getActivitiesForTopup($id){
 	$user=$this->db->escape($id);
 	$sql="SELECT * FROM `".T_TRTOP."` WHERE user_agent = $user ORDER BY status ASC";
 	return $this->executeSQL($sql); 
 }
 
 function getActivitiesForDeposit($id){
 	$user=$this->db->escape($id);
 	$sql="SELECT * FROM `".T_DEPOS."` WHERE user_agent = $user ORDER BY status ASC";
 	return $this->executeSQL($sql); 
 }

 function check_user_login($username){
  $username=$this->db->escape($username);
  $sql="SELECT * FROM `".T_KASIR."` WHERE `username`=$username LIMIT 1";
  $query=$this->executeSQL($sql);
  return $query;
 }
 
 function get_all_agents($nama=""){
  if($nama != ""){
   $nama=$this->db->escape('%'.$nama.'%');
   $where="user_agent LIKE $nama OR nomorHp LIKE $nama OR name LIKE $nama";
  }else{
   $where=1;
  }
  $sql="SELECT * FROM ".T_AGENT." WHERE $where";
  $query=$this->executeSQL($sql);
  return $query;
 }
 
 function get_all_providers($order){
  $sql="SELECT * FROM `".T_PROVI."` WHERE 1 ORDER BY $order";
  return $this->executeSQL($sql);
 }
 
 function getProviderWhere($id){
  $id=$this->db->escape($id);
  $sql="SELECT * FROM `".T_PROVI."` WHERE kode_provider=$id LIMIT 1";
  return $this->executeSQL($sql);
 }
 
 function update_provider($id,$nama,$nomor,$saldo,$status){
  $id=$this->db->escape($id);
  $nama=$this->db->escape($nama);
  $nomor=$this->db->escape($nomor);
  $saldo=$this->db->escape($saldo);
  $status=$this->db->escape($status);
  $sql="UPDATE `".T_PROVI."` SET nama_provider=$nama ,nomor=$nomor ,sisa_saldo=$saldo ,status=$status WHERE kode_provider=$id LIMIT 1";
  $this->executeSQL($sql);
 }
 
 function getLastCodeProvider(){
  $sql="SELECT kode_provider fROM `".T_PROVI."` ORDER BY kode_provider DESC LIMIT 1";
  return $this->executeSQL($sql);
 }
 
 function delete_provider($id){
  $kode=$this->db->escape($id);
  $sql="DELETE FROM `".T_PROVI."` WHERE kode_provider=$kode LIMIT 1";
  $this->executeSQL($sql);
 }
 
 function executeSQL($sql){
   try{ 
    return $this->db->query($sql);
   }catch (Exception $err){
    $err->getMessage();
   }
 }
 
 function insert_newProvider($kode,$nama,$nomor,$saldo,$state){
  $kode=$this->db->escape($kode);
  $nama=$this->db->escape($nama);
  $nomor=$this->db->escape($nomor);
  $saldo=$this->db->escape($saldo);
  $state=$this->db->escape($state);
  $sql="INSERT INTO `".T_PROVI."` (`kode_provider`,`nama_provider`,`nomor`,`sisa_saldo`,`status`) 
  	VALUES ($kode,$nama,$nomor,$saldo,$state)";
  $this->executeSQL($sql);
 }
 
 function get_provider_datas(){
  $sql="SELECT * FROM `".T_PROVI."` ORDER BY nama_provider ASC";
  return $this->executeSQL($sql);
 }
 
 function get_typeFromKode($kode){
  $kode=$this->db->escape($kode);
  $sql="SELECT * FROM `".T_TYTRX."` WHERE ID_jenis=$kode LIMIT 1";
  return $this->executeSQL($sql);
 }
 
 function insert_newType($kode,$prov,$nominal,$hbeli,$hjual,$state){
  $kode=$this->db->escape($kode);
  $prov=$this->db->escape($prov);
  $nominal=$this->db->escape($nominal);
  $hb=$this->db->escape($hbeli);
  $hj=$this->db->escape($hjual);
  $state=$this->db->escape($state);
  $sql="INSERT INTO `".T_TYTRX."`(`ID_jenis`,`kode_provider`,`nominal`,`harga_beli`,`harga_jual`,`status`) 
  	VALUES ($kode,$prov,$nominal,$hb,$hj,$state)";
  $this->executeSQL($sql);
 }
 
 function updateType($kode,$prov,$nominal,$hbeli,$hjual,$state){
  $kode=$this->db->escape($kode);
  $prov=$this->db->escape($prov);
  $nominal=$this->db->escape($nominal);
  $hb=$this->db->escape($hbeli);
  $hj=$this->db->escape($hjual);
  $state=$this->db->escape($state);
  $sql="UPDATE `".T_TYTRX."` SET `kode_provider`=$prov ,`nominal`=$nominal ,`harga_beli`=$hb ,`harga_jual`=$hj ,`status`=$state WHERE ID_jenis=$kode";
  $this->executeSQL($sql);
 }
 
 function get_trx_type(){
  $sql="SELECT `".T_PROVI."`.nama_provider,`".T_TYTRX."`.* FROM `".T_TYTRX."` 
  	LEFT JOIN `".T_PROVI."` ON `".T_PROVI."`.kode_provider=`".T_TYTRX."`.kode_provider WHERE 1";
  $query=$this->executeSQL($sql);
  return $query;
 }
 
 function get_all_deposits($order){
  $sql="SELECT * FROM `".T_DEPOS."` WHERE 1 ORDER BY $order";
  $query=$this->executeSQL($sql);
  return $query;
 }
 
 function selectDepositWhere($id){
  $id=$this->db->escape($id);
  $sql="SELECT * FROM `".T_DEPOS."` WHERE ID_deposit=$id LIMIT 1";
  return $this->executeSQL($sql);
 }
 
 function getUsernameForNewUser(){
  $sql="SELECT  `user_agent` FROM  `".T_AGENT."` ORDER BY  `user_agent` DESC LIMIT 1";
  return $this->executeSQL($sql);
 }
 
 function update_stateToPending($type,$id){
  $id=$this->db->escape($id);
  if($type=="DEP"){
	$sql="UPDATE `".T_DEPOS."` SET `status` = 2 WHERE ID_deposit=$id LIMIT 1";
  }else{
  	$sql="UPDATE `".T_TRTOP."` SET `status` = 2 WHERE no_transaksi=$id LIMIT 1";
  }
  $this->executeSQL($sql);
 }
 
 function update_stateToCancel($id){
  $id=$this->db->escape($id);
  $sql="UPDATE `".T_DEPOS."` SET `status` = 0 WHERE ID_deposit=$id LIMIT 1";
  $this->executeSQL($sql);
 }
 
 function delete_deposit($id){
  $id=$this->db->escape($id);
  $sql="DELETE FROM `".T_DEPOS."` WHERE ID_deposit = $id LIMIT 1";
  $this->executeSQL($sql);
 }
 
 function insert_new_deposit($id,$agent,$nominal,$kasir){
  $id=$this->db->escape($id);
  $agent=$this->db->escape($agent);
  $nominal=$this->db->escape($nominal);
  $user_kasir=$this->db->escape($kasir);
  $sql="INSERT INTO `".T_DEPOS."` (`ID_deposit`,`tanggal_deposit`,`username`,`user_agent`,`nominal`,`status`) 
  	VALUES($id,NOW(),$user_kasir,$agent,$nominal,2)";
  $this->executeSQL($sql);
 }
 
 function get_provider_saldo($kode="SAL_SERV"){
  $kode=$this->db->escape($kode);
  $sql="SELECT value FROM `".T_CONF."` WHERE kode=$kode LIMIT 1";
  $q=$this->executeSQL($sql);
  $return = 0;
  foreach($q->result() as $r){$return =$r->value;}
  return $return;
 }
 
 function update_config_saldo_provider($kode,$saldo_akhir){
  $kode=$this->db->escape($kode);
  $saldo=$this->db->escape($saldo_akhir);
  $sql="UPDATE `".T_CONF."` SET value=$saldo WHERE kode=$kode LIMIT 1";
  $this->executeSQL($sql);
 }
 
 function insert_new_message($type,$tgl,$nominal,$user){
  if($type=="DEP"){
   $message="Success!!!. Transaksi Deposit dengan Nominal: $nominal Berhasil Dilakukan Pada tanggal $tgl dengan User $user";
  }elseif($type=="TOPUP"){
   $message="Success!!!. Transaksi Top-Up dengan Nominal: $nominal Berhasil Dilakukan Pada tanggal $tgl dengan User $user";
  }
  $message=$this->db->escape($message);
  $user=$this->db->escape($user);
  $sql="INSERT INTO messages (`send_to`,`sender`,`message`) VALUES ($user,'GATOT',$message)";
  $this->executeSQL($sql);
 }
 
 function getDepositstateWhere($id,$status){
  $id=$this->db->escape($id);
  $sql="SELECT ID_deposit FROM `".T_DEPOS."` WHERE ID_deposit=$id AND status=$status LIMIT 1";
  $q=$this->executeSQL($sql);
  return $q->num_rows();
 }
 
 function getNominalFromDeposit($id){
  $id=$this->db->escape($id);
  $sql="SELECT nominal FROM `".T_DEPOS."` WHERE ID_deposit=$id LIMIT 1";
  $q=$this->executeSQL($sql);
  $nominal="";
  foreach($q->result() as $r){$nominal=$r->nominal;}
  return $nominal;
 }
 
 function updateConfig($kode,$saldo_akhir){
  $kode=$this->db->escape($kode);
  $saldo=$this->db->escape($saldo_akhir);
  $sql="UPDATE `".T_CONF."` SET value=$saldo WHERE kode=$kode LIMIT 1";
  $this->executeSQL($sql);
 }
 
 function getDepositNominalWhere($id,$state=2){
  $id=$this->db->escape($id);
  $sql="SELECT `".T_DEPOS."`.`ID_deposit` , `".T_DEPOS."`.`user_agent` , `".T_DEPOS."`.`nominal` , ".T_AGENT.".saldo
	FROM  `".T_DEPOS."`
	LEFT JOIN ".T_AGENT." ON `".T_DEPOS."`.user_agent = ".T_AGENT.".user_agent
	WHERE `".T_DEPOS."`.ID_deposit=$id and `".T_DEPOS."`.status=$state and ".T_AGENT.".activated=1  LIMIT 1 ";
  return $this->executeSQL($sql);
  
 }
 
 function get_UserSaldo($user){
  $user=$this->db->escape($user);
  $sql="SELECT saldo FROM ".T_AGENT." WHERE user_agent=$user and activated=1 LIMIT 1";
  $q=$this->executeSQL($sql);
  foreach($q->result() as $r){return $r->saldo;}
 }
 
 function getTopupNominalWhere($id){
  $id=$this->db->escape($id);
  $sql="SELECT * FROM `".T_TRTOP."` WHERE ID=$id";
  return $this->executeSQL($sql);
 }
 
 function updateSaldoUser($user,$saldo){
  $user=$this->db->escape($user);
  $saldo=$this->db->escape($saldo);
  $sql="UPDATE ".T_AGENT." SET saldo=$saldo WHERE user_agent=$user LIMIT 1";
  $this->executeSQL($sql);
 }
 
 function insert_log($user,$activity){
  $user=$this->db->escape($user);
  $activity=$this->db->escape($activity);
  $sql="INSERT INTO `".T_LOG."` (`user`,`activity`) VALUES ($user,$activity)";
  $this->executeSQL($sql);
 }
 
 function referensi_nomor(){
  $sql="SELECT `".T_NOMOR."`.*,`".T_PROVI."`.nama_provider FROM `".T_NOMOR."` LEFT JOIN `".T_PROVI."` ON nomor.kode_provider=`".T_PROVI."`.kode_provider
		WHERE `".T_NOMOR."`.status=1";
  $q=$this->executeSQL($sql);
  return $q;
 }
 
 function insert_new_reference($prefix,$kode,$st){
  $prefix=$this->db->escape($prefix);
  $kode=$this->db->escape($kode);
  $sql="INSERT INTO `".T_NOMOR."` (`prefix`,`kode_provider`,`status`) VALUES ($prefix,$kode,$st)";
  $this->executeSQL($sql);
 }


}
//end of file
