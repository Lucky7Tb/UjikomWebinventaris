<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_item', 'Item');
        $this->load->library('form_validation');
        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }
    }

    public function load_table()
    {
        $this->load->library('pagination');
        $config['total_rows'] = $this->Item->CountItem();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $datas['datas'] = $this->Item->GetAllItem($config['per_page'], $this->uri->segment(3));
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $this->load->view('admin/table', $datas);
        }
    }

    public function pagination(){
        $this->load->library('pagination');
        $config['total_rows'] = $this->Item->CountItem();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $this->load->view('admin/pagination');
    }

    public function search_data(){
        $keyword = $this->input->get('keyword');
        $this->load->library('pagination');
        $config['total_rows'] = $this->Item->CountItem();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $datas['datas'] = $this->Item->GetItemByName($keyword);
        $this->load->view('admin/table', $datas);
    }

    public function index()
    {
        $this->load->library('pagination');

        $config['total_rows'] = $this->Item->CountItem();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);

        $datas['datas'] = $this->Item->GetAllItem($config['per_page'], $this->uri->segment(3));
        $datas['types'] = $this->Item->GetItemType();
        $datas['rooms'] = $this->Item->GetRooms();
        $title['title'] = "Dashboard";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/index', $datas);
        $this->load->view('layout/footer');
    }

    public function room()
    {
        $title['title'] = "Management Ruangan";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/room');
        $this->load->view('layout/footer');
    }

    public function add_data()
    {
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $response['token'] = $this->security->get_csrf_hash();
            $this->form_validation->set_rules($this->Item->RulesFormItem());
            if (!$this->form_validation->run()) {
                $response['message'] = $this->Item->ErrorMessageItem();
                $response['status'] = "failed";
            } else {
                $response['message'] = "Data berhasil di masukan";
                $response['status'] = "success";
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
                $this->Item->AddItemData($data);
            }
            echo json_encode($response);
        }
    }

    public function update_data()
    {
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $response['token'] = $this->security->get_csrf_hash();
            $this->form_validation->set_rules($this->Item->RulesFormItem());
            if (!$this->form_validation->run()) {
                $response['message'] = $this->Item->ErrorMessageItem();
                $response['status'] = "failed";
            } else {
                $response['message'] = "Data berhasil di update";
                $response['status'] = "updated";
                $id = $this->input->post('itemid', TRUE);
                $room = $this->input->post('room', TRUE);
                $type = $this->input->post('type', TRUE);
                $item = $this->input->post('itemname', TRUE);
                $conditions =  $this->input->post('conditions', TRUE);
                $itemammount =  $this->input->post('itemammount', TRUE);
                $data = [
                    'nama_barang' => $item,
                    'kondisi_barang' => $conditions,
                    'jumlah_barang' => $itemammount,
                    'id_ruang' => $room,
                    'id_jenis' => $type
                ];
                $this->Item->UpdateItemData($data, $id);
            }
            echo json_encode($response);
        }
    }

    public function delete_data()
    {
        $response['token'] = $this->security->get_csrf_hash();
        $this->Item->DeleteItemData($this->input->post('id', TRUE));
        echo json_encode($response);
    }

    public function get_data()
    {
        $id = $this->input->post('id', TRUE);
        $response['token'] = $this->security->get_csrf_hash();
        $response['item'] = $this->Item->GetOneItem($id);
        echo json_encode($response);
    }
}
