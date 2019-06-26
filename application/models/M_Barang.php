<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Barang extends CI_Model
{

    public function AddData($data)
    {
        $this->db->insert('detail_barang', $data);
    }

    public function UpdateData($data, $id){
        $this->db->where('id_detail_barang', $id);  
        $this->db->update('detail_barang', $data);
    }

    public function DeleteData($id){
        $this->db->delete('detail_barang', ['id_detail_barang' => $id]);
    }

    public function GetAllBarang()
    {
        return $this->db->order_by('kondisi_barang', 'ASC')->get('detailbarangview')->result();
    }

    public function GetOneBarang($id)
    {
        return $this->db->get_where('detail_barang', ['id_detail_barang' => $id])->result();
    }

    public function GetJenisBarang()
    {
        return $this->db->get('jenis')->result();
    }

    public function GetRuangan()
    {
        return $this->db->get('ruang')->result();
    }

    public function RulesFormBarang()
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

    public function MessageErrorBarang()
    {
        return [
            'itemname' => form_error('itemname'),
            'itemammount' => form_error('itemammount'),
        ];
    }
}
