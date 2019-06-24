<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Barang extends CI_Model
{

    public function AddData($data)
    {
        $this->db->insert('detail_barang', $data);
    }

    public function GetAllBarang()
    {
        return $this->db->order_by('kondisi_barang', 'ASC',)->get('detailbarangview')->result();
    }

    public function GetJenisBarang()
    {
        return $this->db->get('jenis')->result();
    }

    public function GetRuangan()
    {
        return $this->db->get('ruang')->result();
    }

    // public function RulesFormBarang()
    // {
    //     return [
    //         [
    //             'field' => 'itemname',
    //             'rules' => 'required|alpha'
    //         ],
    //         [
    //             'field' => 'itemammount',
    //             'rules' => 'required|numeric'
    //         ],
    //         [
    //             'field' => 'condition',
    //             'rules' => 'required|alpha'
    //         ],
    //         [
    //             'field' => 'type',
    //             'rules' => 'required|alpha'
    //         ],
    //         [
    //             'field' => 'room',
    //             'rules' => 'required|alpha'
    //         ]
    //     ];
    // }
}
