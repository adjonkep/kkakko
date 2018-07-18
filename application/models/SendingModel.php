<?php
class sendingModel extends CI_Model {
 
 function getInfo(){
  $this->db->select("cityName, country"); 
  $this->db->from('city');
  $query = $this->db->get();
  return $query->result();
 }
 
}