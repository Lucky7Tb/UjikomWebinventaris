<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_item', 'Item');
        $this->load->model('Model_room', 'Room');
        $this->load->model('Model_type', 'Type');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $config['base_url'] = 'http://localhost/latujikomci/admin/index/';
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
        $config['base_url'] = 'http://localhost/latujikomci/admin/room/';
        $config['total_rows'] = $this->Room->CountRoom();
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        $datas['rooms'] = $this->Room->GetAllRooms($config['per_page'], $this->uri->segment(3));
        $title['title'] = "Management Ruangan";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/room', $datas);
        $this->load->view('layout/footer');
    }

    public function item_type()
    {
        $config['base_url'] = 'http://localhost/latujikomci/admin/item_type/';
        $config['total_rows'] = $this->Type->CountType();
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        $datas['types'] = $this->Type->GetAllTypes($config['per_page'], $this->uri->segment(3));
        $title['title'] = "Management Jenis Barang";
        $this->load->view('layout/header', $title);
        $this->load->view('admin/item_type', $datas);
        $this->load->view('layout/footer');
    }

    public function load_table()
    {
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $urisegment = $this->input->get('uri');
        if($urisegment == ''){
            $urisegment = 0;
        }
        $datas['datas'] = $this->Item->GetAllItem($config['per_page'],$urisegment);
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $this->load->view('admin/table', $datas);
        }
    }
    
    public function load_room_table()
    {
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        $datas['rooms'] = $this->Room->GetAllRooms($config['per_page'], 0);
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $this->load->view('admin/table_room', $datas);
        }
    }

    public function load_type_table()
    {
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        $datas['types'] = $this->Type->GetAllTypes($config['per_page'], 0);
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $this->load->view('admin/table_type', $datas);
        }
    }

    public function pagination(){
        $config['base_url'] = 'http://localhost/latujikomci/admin/index/';
        $config['total_rows'] = $this->Item->CountItem();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $this->load->view('admin/pagination');
    }

    public function room_pagination(){
        $config['base_url'] = 'http://localhost/latujikomci/admin/room/';
        $config['total_rows'] = $this->Room->CountRoom();
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        $this->load->view('admin/pagination');
    }

    public function type_pagination(){
        $config['base_url'] = 'http://localhost/latujikomci/admin/item_type/';
        $config['total_rows'] = $this->Type->CountType();
        $config['per_page'] = 3;
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

    public function add_room()
    {
        if (!$this->session->has_userdata('user')) {
            redirect('admin/room', 'refresh');
        } else {
            $response['token'] = $this->security->get_csrf_hash();
            $this->form_validation->set_rules($this->Room->RulesFormRoom());
            if (!$this->form_validation->run()) {
                $response['message'] = $this->Room->ErrorMessageRoom();
                $response['status'] = "failed";
            } else {
                $response['message'] = "Data berhasil di masukan";
                $response['status'] = "success";
                $room = $this->input->post('room_name', TRUE);
                $room_desc = $this->input->post('room_desc', TRUE);
                $data = [
                    'id_ruang' => uniqid(),
                    'nama_ruang' => $room,
                    'keterangan' => $room_desc,
                ];
                $this->Room->AddRoomData($data);
            }
            echo json_encode($response);
        }
    }

    public function add_type()
    {
        if (!$this->session->has_userdata('user')) {
            redirect('admin/room', 'refresh');
        } else {
            $response['token'] = $this->security->get_csrf_hash();
            $this->form_validation->set_rules($this->Type->RulesFormType());
            if (!$this->form_validation->run()) {
                $response['message'] = $this->Type->ErrorMessageType();
                $response['status'] = "failed";
            } else {
                $response['message'] = "Data berhasil di masukan";
                $response['status'] = "success";
                $type_name = $this->input->post('type_name', TRUE);
                $data = [
                    'id_jenis' => uniqid(),
                    'nama_jenis' => $type_name,
                ];
                $this->Type->AddTypeData($data);
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

    public function update_room()
    {
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $response['token'] = $this->security->get_csrf_hash();
            $this->form_validation->set_rules($this->Room->RulesFormRoom());
            if (!$this->form_validation->run()) {
                $response['message'] = $this->Item->ErrorMessageRoom();
                $response['status'] = "failed";
            } else {
                $response['message'] = "Data berhasil di update";
                $response['status'] = "updated";
                $id = $this->input->post('room_id', TRUE);
                $room_name = $this->input->post('room_name', TRUE);
                $room_desc = $this->input->post('room_desc', TRUE);
                $data = [
                    'nama_ruang' => $room_name,
                    'keterangan' => $room_desc
                ];
                $this->Room->UpdateRoomData($data, $id);
            }
            echo json_encode($response);
        }
    }

    public function update_type()
    {
        if (!$this->session->has_userdata('user')) {
            redirect('admin/index', 'refresh');
        } else {
            $response['token'] = $this->security->get_csrf_hash();
            $this->form_validation->set_rules($this->Type->RulesFormType());
            if (!$this->form_validation->run()) {
                $response['message'] = $this->Type->ErrorMessageType();
                $response['status'] = "failed";
            } else {
                $response['message'] = "Data berhasil di update";
                $response['status'] = "updated";
                $id = $this->input->post('type_id', TRUE);
                $type_name = $this->input->post('type_name', TRUE);
                $data = [
                    'nama_jenis' => $type_name,
                ];
                $this->Type->UpdateTypeData($data, $id);
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

    public function delete_room()
    {
        $response['token'] = $this->security->get_csrf_hash();
        $this->Room->DeleteRoomData($this->input->post('id', TRUE));
        echo json_encode($response);
    }

    public function delete_type()
    {
        $response['token'] = $this->security->get_csrf_hash();
        $this->Type->DeleteTypeData($this->input->post('id', TRUE));
        echo json_encode($response);
    }

    public function get_data()
    {
        $id = $this->input->post('id', TRUE);
        $response['token'] = $this->security->get_csrf_hash();
        $response['item'] = $this->Item->GetOneItem($id);
        echo json_encode($response);
    }
    
    public function get_room()
    {
        $id = $this->input->post('id', TRUE);
        $response['token'] = $this->security->get_csrf_hash();
        $response['room'] = $this->Room->GetOneRoom($id);
        echo json_encode($response);
    }

    public function get_type()
    {
        $id = $this->input->post('id', TRUE);
        $response['token'] = $this->security->get_csrf_hash();
        $response['type'] = $this->Type->GetOneType($id);
        echo json_encode($response);
    }
}
