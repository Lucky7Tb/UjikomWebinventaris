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
            $response['token'] = $this->security->get_csrf_hash();
            $this->form_validation->set_rules($this->Barang->RulesFormBarang());
            if (!$this->form_validation->run()) {
                $response['message'] = $this->Barang->MessageErrorBarang();
                $response['status'] = "failed";
            } else {
                $response['message'] = "Data berhasil di masukan";
                $response['status'] = "success";
                $response['table'] = $this->Barang->GetAllBarang();
                $room = $this->input->post('room', TRUE);
                $type = $this->input->post('type', TRUE);
                $item = $this->input->post('itemname', TRUE);
                $conditions =  $this->input->post('conditions', TRUE);
                $itemammount =  $this->input->post('itemammount', TRUE);
                $data = [
                    'id_detail_barang' => uniqid(),
                    'nama_barang' => $item,
                    'kondisi_barang' => $conditions,
                    'jumlah_barang' => $itemammount,
                    'id_ruang' => $room,
                    'id_jenis' => $type
                ];
                $this->Barang->AddData($data);
            }
            echo json_encode($response);
        }
    }

    public function getdata()
    {
        $response['token'] = $this->security->get_csrf_hash();
        $id = $this->input->post('id', TRUE);
        $response['barang'] = $this->Barang->GetOneBarang($id);
        echo json_encode($response);
    }

    public function test()
    {
        $title['title'] = "Test";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/test');
        $this->load->view('layout/footer');
    }
}
