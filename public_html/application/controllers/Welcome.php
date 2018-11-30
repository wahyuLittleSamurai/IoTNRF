<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	function __construct(){
         parent::__construct();
		 
		 $this->load->helper('date');
         $this->load->model('m_account'); 
		 $this->load->helper(array('url','form'));
    }
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function getData($idNode, $temperature, $humidity, $soil)
	{
		//iotnrf.hostingerapp.com/index.php/welcome/getData/1/24/25/26
		date_default_timezone_set('Asia/Jakarta');
 
		$datestring = '%Y/%m/%d - %h:%i %a';
		$time = time();
		$currentTime = mdate($datestring, $time);
			
		$data["idNode"] = $idNode;
		$data["temperature"] = $temperature;
		$data["humidity"] = $humidity;
		$data["soil"] = $soil;
		$data["timeIn"] = $currentTime;
		
		$this->m_account->insertSensor($data);
	}
	public function getSensor($idNode)
	{
		$valueDataRead = $this->m_account->getSensor($idNode);
		
		$valueTemperature = NULL;
		$valueHumidity = NULL;
		$valueSoil = NULL;
		foreach($valueDataRead as $post)
		{
			$valueTemperature = $post->temperature;
			$valueHumidity = $post->humidity;
			$valueSoil = $post->soil;
		}
		
		
		echo "{ \"temperature\":\"".$valueTemperature."\",\"humidity\":\"".$valueHumidity."\",\"soil\":\"".$valueSoil."\"
			}";
	}
}
