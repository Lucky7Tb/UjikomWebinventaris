<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang', 'Barang');
        $this->load->library('form_validation');
        $this->output->enable_profiler(TRUE);
        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules($this->Barang->RulesFormBarang());

        if ($this->form_validation->run() == false) {
            $datas['datas'] = $this->Barang->GetAllBarang();
            $datas['types'] = $this->Barang->GetJenisBarang();
            $datas['rooms'] = $this->Barang->GetRuangan();
            $title['title'] = "Home";
            $this->load->view('layout/header', $title);
            $this->load->view('admin/index', $datas);
            $this->load->view('layout/footer');
        }
    }

    public function add()
    {
        $data = [
            'id_detail_barang' => uniqid(),
            'nama_barang' => $this->input->post('item'),
            'kondisi_barang' => $this->input->post('conditions'),
            'jumlah_barang' => $this->input->post('itemammount'),
            'id_ruang' => $this->input->post('room'),
            'id_jenis' => $this->input->post('type')
        ];
        $this->db->insert('detail_barang', $data);
    }

    public function test()
    {
        $title['title'] = "Test";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/test');
        $this->load->view('layout/footer');
    }
}
