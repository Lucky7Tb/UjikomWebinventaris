<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_room extends CI_Model
{
    public function CountRoom(){
        return $this->db->get('ruang')->num_rows();
    }

    public function GetAllRooms($limit, $start){
        return $this->db->order_by('nama_ruang')->get('ruang', $limit, $start)->result();
    }

    public function GetOneRoom($id){
        return $this->db->get_where('ruang', ['id_ruang' => $id])->result();
    }

    public function AddRoomData($data){
        $this->db->insert('ruang', $data);
    }

    public function DeleteRoomData($id){
        $this->db->delete('ruang', ['id_ruang' => $id]);
    }

    public function UpdateRoomData($data, $id){
        $this->db->where('id_ruang', $id);  
        $this->db->update('ruang', $data);
    }

    public function RulesFormRoom()
    {
        return [
            [
                'field' => 'room_name',
                'rules' => 'required|alpha_numeric_spaces|min_length[10]|max_length[50]'
            ],
            [
                'field' => 'room_desc',
                'rules' => 'alpha_numeric_spaces|min_length[15]|max_length[150]'
            ],
        ];
    }

    public function ErrorMessageRoom()
    {
        return [
            'room_name' => form_error('room_name'),
            'room_desc' => form_error('room_desc'),
        ];
    }
}