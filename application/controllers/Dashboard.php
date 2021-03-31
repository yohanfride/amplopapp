<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();   
		if(!$this->session->userdata('amplop_session')) 
			redirect(base_url() . "auth/login");
		$this->load->model('lingkungan_m');
		$this->load->model('umat_m');
		$this->load->model('rekaplingkungan_m');
		$this->load->model('rekapamplop_m');
		$this->load->model('user_m');
    }

	public function index()
	{        
		$data=array();
		$data['menu']='dashboard';
		$data['chart']=true;
		$data['user_now'] =  $this->session->userdata('amplop_session');
		$data['title'] ='Dashboard Page';
		$data['jumlah_kk'] = $this->umat_m->count_data_all('');
		$data['jumlah_amplop'] = $data['jumlah_kk'] * 7;
		$data['jumlah_amplop_terhitung'] = $this->umat_m->jumlah_rekap_terhitung()->jumlah_amplop;
		$data['jumlah_kk_terhitung'] = ceil($data['jumlah_amplop_terhitung'] / 7);
		$data['data'] = $this->rekapamplop_m->rekap_per_tanggal(18);
		foreach ($data['data'] as $d) {
			$data['label'][] = date_format(date_create($d->date_add), 'd/m/Y');	 
			$data['item'][] = $d->total;
		}
		$data['linkungan_tertinggi'] = $this->rekaplingkungan_m->jumlah_rekap_lingkungan_dashboard(" (jumlah_terhitung/jumlah_amplop) DESC",5);
		$data['linkungan_terendah'] = $this->rekaplingkungan_m->jumlah_rekap_lingkungan_dashboard(" (jumlah_terhitung/jumlah_amplop) ASC",5);
		///Jumlah Amplop Total;
		///Jumlah Amplop yang terhitung
		///Presentase Amplop (menggunakann pie chart)
		///5 Lingkungan dengan persentase perhitungan amplop terbanyak
		///5 Lingkungan dengan persentase perhitungan amplop tersedikit
		///Grafik Rekapitulasi Amplop Coklat pertanggal
        $this->load->view('dashboard_v', $data);
	}	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
