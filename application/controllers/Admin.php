<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang', 'Barang');
        $this->load->library('form_validation');
        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }
    }

    public function table()
    {
        if (!$this->session->has_userdata('login')) {
            redirect('admin/index', 'refresh');
        } else {
            $datas['datas'] = $this->Barang->GetAllBarang();
            $datas['types'] = $this->Barang->GetJenisBarang();
            $datas['rooms'] = $this->Barang->GetRuangan();
            $this->load->view('admin/table', $datas);
        }
    }

    public function index()
    {
        $datas['datas'] = $this->Barang->GetAllBarang();
        $datas['types'] = $this->Barang->GetJenisBarang();
        $datas['rooms'] = $this->Barang->GetRuangan();
        $title['title'] = "Home";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/index', $datas);
        $this->load->view('layout/footer');
    }

    public function adddata()
    {
        if (!$this->session->has_userdata('login')) {
            redirect('admin/index', 'refresh');
        } else {
            $item = $this->input->post('itemname', TRUE);
            $conditions =  $this->input->post('conditions', TRUE);
            $itemammount =  $this->input->post('itemammount', TRUE);
            $room = $this->input->post('room', TRUE);
            $type = $this->input->post('type', TRUE);
            $result = array(
                'token' => $this->security->get_csrf_hash()
            );
            $data = [
                'id_detail_barang' => uniqid(),
                'nama_barang' => $item,
                'kondisi_barang' => $conditions,
                'jumlah_barang' => $itemammount,
                'id_ruang' => $room,
                'id_jenis' => $type
            ];
            $this->Barang->AddData($data);
            echo json_encode($result);
        }
    }

    public function test()
    {
        $title['title'] = "Test";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/test');
        $this->load->view('layout/footer');
    }
}
