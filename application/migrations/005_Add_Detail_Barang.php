<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Detail_Barang extends CI_Migration {

    public function up(){
        $this->dbforge->add_field(array(
            'id_detail_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
			'nama_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
			'kondisi_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
			'jumlah_barang' => array(
                'type' => 'INT',
                'constraint' => '50'
            ),
			'created_at' => array(
				'type' => "VARCHAR",
				'constraint' => "255"
			),
			'updated_at' => array(
				'type' => 'VARCHAR',
				'constraint' => "14"
			),
 			'id_ruang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'id_jenis' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
        ));
        $this->dbforge->add_key('id_ruang');
        $this->dbforge->add_key('id_jenis');
        $this->dbforge->add_key('id_detail_barang', TRUE);
        $this->dbforge->create_table('detail_barang');
        $this->db->query("ALTER TABLE `detail_barang` ADD FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE ");
        $this->db->query("ALTER TABLE `detail_barang` ADD FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE ");
    }

    public function down(){
            $this->dbforge->drop_table('detail_barang');
    }
}