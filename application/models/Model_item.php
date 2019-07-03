<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_item extends CI_Model
{

    public function AddItemData($data)
    {
        $this->db->insert('detail_barang', $data);
    }

    public function UpdateItemData($data, $id){
        $this->db->where('id_detail_barang', $id);  
        $this->db->update('detail_barang', $data);
    }

    public function DeleteItemData($id){
        $this->db->delete('detail_barang', ['id_detail_barang' => $id]);
    }

    public function GetAllItem($limit, $start, $keyword = null)
    {
        if($keyword){
            $this->db->like('nama_barang', $keyword);
        }
        return $this->db->order_by('nama_barang', 'ASC')->get('detailbarangview', $limit, $start)->result();
    }

    public function GetOneItem($id)
    {
        return $this->db->get_where('detail_barang', ['id_detail_barang' => $id])->result();
    }

    public function GetItemByName($keyword)
    {
        if($keyword){
            $this->db->like('nama_barang', $keyword);
        }
        return $this->db->order_by('nama_barang', 'ASC')->get('detailbarangview')->result();
    }

    public function GetItemType()
    {
        return $this->db->get('jenis')->result();
    }

    public function GetRooms()
    {
        return $this->db->get('ruang')->result();
    }

    public function CountItem(){
        return $this->db->get('detail_barang')->num_rows();
    }

    public function RulesFormItem()
    {
        return [
            [
                'field' => 'itemname',
                'rules' => 'required|alpha_numeric_spaces'
            ],
            [
                'field' => 'itemammount',
                'rules' => 'required|numeric|greater_than[0]'
            ],
        ];
    }

    public function ErrorMessageItem()
    {
        return [
            'itemname' => form_error('itemname'),
            'itemammount' => form_error('itemammount'),
        ];
    }
}
