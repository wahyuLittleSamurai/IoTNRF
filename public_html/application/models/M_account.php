  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');
 
  class M_account extends CI_Model{

       function insertSensor($data)
       {
			$this->db->set('temperature', $data["temperature"]);
			$this->db->set('humidity', $data["humidity"]);
			$this->db->set('soil', $data["soil"]);
			$this->db->set('timeIn', $data["timeIn"]);
			$this->db->where('idNode',$data["idNode"]);
			$this->db->update('tblSensor'); 
			
            $this->db->insert('tblReport',$data);
			
			echo "sukses";
			/*
			echo $data["idSlave"]; echo "\t";
			echo $data["firstSensor"];	echo "\t";
			echo $data["secondSensor"]; echo "\t";
			echo $data["timeIn"]; echo "\t";
			*/
       }
	   function getSensor($selectNode)
	   {
			 $this->db->select("temperature,humidity,soil"); 
			 $this->db->from('tblSensor');
			 $this->db->where('idNode',$selectNode);
			 $query = $this->db->get();
			 return $query->result();
	   }
	   function collection_dataAll()
	   {
			 $this->db->select("id,idNode,temperature,humidity,soil,timeIn"); 
			 $this->db->from('tblReport');
			 $query = $this->db->get();
			 return $query->result();
	   }
	  
  }