<?php
class Mapi extends CI_Model{

 function execute($sql){
  if ($sql != ""){
   return $this->db->query($sql);
  }
 }
 
 function escape($string){
  return $this->db->escape($string);
 }

 function check_user($nomor,$code){
  $nomor=$this->escape($nomor);
  $code=$this->escape($code);
  $sql="SELECT * FROM agents WHERE nomorHp=$nomor and code=$code and activated=1";
  return $this->execute($sql);
 }
 
 function get_Providertype_fromNomor($nomor){
  $nomor=$this->escape($nomor);
  $sql="SELECT * FROM nomor.id_nomor , provider. ";
 }
 



}
//end of file
