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
            if (preg_match("/[a-zA-Z]/", $item)) {
                if (preg_match("/[0-9]/", $itemammount)) {
                    $result['message'] = "Data Berhasil Di masukan";
                    $result['token'] = $this->security->get_csrf_hash();
                    $result['status'] = "success";
                    $data = [
                        'id_detail_barang' => uniqid(),
                        'nama_barang' => $item,
                        'kondisi_barang' => $conditions,
                        'jumlah_barang' => $itemammount,
                        'id_ruang' => $room,
                        'id_jenis' => $type
                    ];
                    $this->Barang->AddData($data);
                } else if ($itemammount == '') {
                    $result['message'] = "Form item ammount harus di isi";
                    $result['status'] = "failed";
                    $result['token'] = $this->security->get_csrf_hash();
                } else {
                    $result['message'] = "Form item ammount harus numeric";
                    $result['status'] = "failed";
                    $result['token'] = $this->security->get_csrf_hash();
                }
            } else if ($item == '') {
                $result['message'] = "Form item harus di isi";
                $result['status'] = "failed";
                $result['token'] = $this->security->get_csrf_hash();
            } else {
                $result['message'] = "Form item harus alphabet";
                $result['status'] = "failed";
                $result['token'] = $this->security->get_csrf_hash();
            }
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
