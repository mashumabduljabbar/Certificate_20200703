<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_general');
		$this->load->model('m_email');
	}
	
	public function single($attenders_id="")
    {
		$attenders = $this->db->query("select * from tbl_attenders where attenders_id='$attenders_id'")->row();
		
		$message = "Dear $attenders->attenders_name,<br><br>Terlampir E-Certificate kegiatan Studium Generale dengan tema 'How to Prepare Yourself with IT Skills for the Future of Work'.<br><br>Best Regards,<br>Ma'shum Abdul Jabbar";
		$penerima = $attenders->attenders_email;
		$subject = "E-Certificate Studium Generale";
		$this->m_email->attachment($message, $penerima, $subject, $attenders->attenders_id);
    }
	
	public function bulk()
    {
		$tbl_attenders = $this->db->query("select * from tbl_attenders order by attenders_id ASC")->result();
		
		foreach($tbl_attenders as $attenders){
			$message = "Dear $attenders->attenders_name,<br><br>Terlampir E-Certificate kegiatan Studium Generale dengan tema 'How to Prepare Yourself with IT Skills for the Future of Work'.<br><br>Best Regards,<br>Ma'shum Abdul Jabbar";
			$penerima = $attenders->attenders_email;
			$subject = "E-Certificate Studium Generale";
			$this->m_email->attachment($message, $penerima, $subject, $attenders->attenders_id);
		}
    }
}