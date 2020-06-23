<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetak extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	
	public function index()
    {
				$data['tbl_attenders'] = $this->db->query("select * from tbl_attenders order by attenders_id ASC");
				
				$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8', 
				'format' => 'A4-L',
				'margin_left' => 0,
				'margin_right' => 0,
				'margin_top' => 0,
				'margin_bottom' => 0,
				'margin_header' => 0,
				'margin_footer' => 0,
				]); //L For Landscape , P for Portrait
				$mpdf->SetTitle("");
				$halaman = $this->load->view('v_cetak',$data,true);
				$mpdf->SetDefaultBodyCSS('background', "url('./assets/2020-06-23-Sertifikat-POLKAM.jpg')");
				$mpdf->SetDefaultBodyCSS('background-image-resize', 6);
				$mpdf->WriteHTML($halaman);
				$mpdf->Output();
    }
}