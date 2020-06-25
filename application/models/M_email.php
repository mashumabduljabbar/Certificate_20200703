<?php
class M_email extends CI_Model {
    var $host_email ="";
    var $port_email ="";
	var $account_email ="";
	var $password_email ="";
	var $crypto_email ="";
	var $protocol_email ="";
	var $from_email ="";
	var $noreply_email ="";
	public function __construct() { 
        parent::__construct(); 
        $this->load->library('email'); 
		$this->load->model('m_general');
		$tbl_email = $this->m_general->view_by("tbl_email",array("id_email >"=>0));
		$this->host_email = $tbl_email->host_email;
		$this->port_email = $tbl_email->port_email;
		$this->account_email = $tbl_email->account_email;
		$this->password_email = $tbl_email->password_email;
		$this->crypto_email = $tbl_email->crypto_email;
		$this->protocol_email = $tbl_email->protocol_email;
		$this->from_email = $tbl_email->from_email;
		$this->noreply_email = $tbl_email->noreply_email;
    }
	
    public function send($message, $penerima, $subject)
    {
        $ci = get_instance();
        $config['protocol'] = $this->protocol_email;
		$config['smtp_crypto'] = $this->crypto_email;
        $config['smtp_host'] = $this->host_email;
        $config['smtp_port'] = $this->port_email;
        $config['smtp_user'] = $this->account_email;
        $config['smtp_pass'] = $this->password_email;
        $config['charset'] = "utf-8";
		$config['smtp_timeout']='30';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		$config['validation'] = TRUE;
		$config['use_ci_email'] = TRUE; 
        $ci->email->initialize($config);
        $ci->email->from($this->from_email, $this->noreply_email);
        $list = array($penerima);
		$ci->email->to(implode(',', $list));
        $ci->email->subject($subject);
        $ci->email->message($message);
        $ci->email->send();
    }
	
	public function attachment($message, $penerima, $subject, $attenders_id)
    {
		$data['attenders'] = $this->db->query("select * from tbl_attenders where attenders_id='$attenders_id'")->row();
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
		$mpdf->SetTitle("Certificate");
		$halaman = $this->load->view('v_cetak_id',$data,true);
		$mpdf->SetDefaultBodyCSS('background', "url('./assets/2020-06-23-Sertifikat-POLKAM.jpg')");
		$mpdf->SetDefaultBodyCSS('background-image-resize', 6);
		$mpdf->WriteHTML($halaman);
		$content = $mpdf->Output('', 'S');
		$filename = "E-Certificate-Studium-Generale-$attenders_id.pdf";
        ob_start();
		$ci = get_instance();
        $config['protocol'] = $this->protocol_email;
		$config['smtp_crypto'] = $this->crypto_email;
        $config['smtp_host'] = $this->host_email;
        $config['smtp_port'] = $this->port_email;
        $config['smtp_user'] = $this->account_email;
        $config['smtp_pass'] = $this->password_email;
        $config['charset'] = "utf-8";
		$config['smtp_timeout']='30';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		$config['validation'] = TRUE;
		$config['use_ci_email'] = TRUE; 
        $ci->email->initialize($config);
        $ci->email->from($this->from_email, $this->noreply_email);
		$ci->email->attach($content, 'attachment', $filename, 'application/pdf');
        $list = array($penerima);
		$ci->email->to(implode(',', $list));
        $ci->email->subject($subject);
        $ci->email->message($message);
        ob_get_clean();
		$ci->email->send();
		$ci->email->clear(TRUE);
    }
}