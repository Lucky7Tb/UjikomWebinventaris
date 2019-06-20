<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Barang extends CI_Migration {

    public function up(){
        $this->dbforge->add_field(array(
            'id_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'id_detail_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            )
        ));
        $this->dbforge->add_key('id_detail_barang');
        $this->dbforge->add_key('id_barang', TRUE);
        $this->dbforge->create_table('barang');
        $this->db->query("ALTER TABLE `barang` ADD FOREIGN KEY (`id_detail_barang`) REFERENCES `detail_barang` (`id_detail_barang`) ON DELETE CASCADE ON UPDATE CASCADE ");
    }

    public function down(){
        $this->dbforge->drop_table('barang');
    }
}