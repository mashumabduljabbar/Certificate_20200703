<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('m_general');
		$this->load->library('ciqrcode');
		$this->filename = date("Y-m-d-H-i-s");
	}
	public function index()
    {
		$this->load->view("v_import");	
    }
	
	public function upload()
    {
        // Load plugin PHPExcel nya
		$upload = $this->m_general->upload_csv($this->filename);
		if($upload['result'] == "success"){
			
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			$data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('./excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			$numrow = 1;
			foreach($sheet as $row){
							$id_terakhir = $this->m_general->bacaidterakhir("tbl_attenders", "attenders_id");
							$getNomor = $this->m_general->getNomor();
							$urutan = sprintf("%03d",(substr($getNomor,-7))+1);
							$attenders_number = $urutan."/PK.1/Sert/BAAK-AKD/06.2020";
							$url = "https://github.com/multimediary/Certificate_20200703/blob/master/file/sertifikat_".$id_terakhir.".pdf";
							$config['cacheable']	= true;
							$config['cachedir']		= './assets/';
							$config['errorlog']		= './assets/';
							$config['imagedir']		= './assets/'; 
							$config['quality']		= true;
							$config['size']			= '512';
							$config['black']		= array(224,255,255); 
							$config['white']		= array(70,130,180);
							$this->ciqrcode->initialize($config);
							$attenders_qr=$id_terakhir.'.png';
							$params['data'] = $url;
							$params['level'] = 'L';
							$params['size'] = 10;
							$params['savename'] = FCPATH.$config['imagedir'].$attenders_qr;
							$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
                            if($numrow > 1){
								$data = array(
									'attenders_id' => $id_terakhir,
									'attenders_number' => $attenders_number,
									'attenders_name'  => $row['A'],
									'attenders_as'  => 'PARTICIPANT',
									'attenders_email'  => $row['B'],
									'attenders_nim'  => $row['C'],
									'attenders_surveykepuasan'  => $row['D'],
									'attenders_saranperbaikan'  => $row['E'],
									'attenders_trainingyangdiharapkan'  => $row['F'],
									'attenders_qr'  => $attenders_qr,
								);
								$this->m_general->add("tbl_attenders", $data);
							}
						$numrow++;
                    }
           
            $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            redirect('import/');

        } else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
            redirect('import/');

        }
    }
}