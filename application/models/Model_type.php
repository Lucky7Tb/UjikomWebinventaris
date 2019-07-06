<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_type extends CI_Model
{
    public function CountType(){
        return $this->db->get('jenis')->num_rows();
    }

    public function GetAllTypes($limit, $start){
        return $this->db->order_by('nama_jenis')->get('jenis', $limit, $start)->result();
    }

    public function GetOneType($id){
        return $this->db->get_where('jenis', ['id_jenis' => $id])->result();
    }

    public function AddTypeData($data){
        $this->db->insert('jenis', $data);
    }

    public function DeleteTypeData($id){
        $this->db->delete('jenis', ['id_jenis' => $id]);
    }

    public function UpdateTypeData($data, $id){
        $this->db->where('id_jenis', $id);  
        $this->db->update('jenis', $data);
    }

    public function RulesFormType()
    {
        return [
            [
                'field' => 'type_name',
                'rules' => 'required|alpha_numeric_spaces|min_length[10]|max_length[50]'
            ],
        ];
    }

    public function ErrorMessageType()
    {
        return [
            'type_name' => form_error('type_name'),
        ];
    }
}