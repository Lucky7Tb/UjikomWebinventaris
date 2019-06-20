<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Peminjaman extends CI_Migration {

    public function up(){
        $this->dbforge->add_field(array(
            'id_peminjaman' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'id_user' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'nama_user' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'id_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'jumlah_barang' => array(
                'type' => 'INT',
                'constraint' => '50'
            ),
            'tanggal_pinjam' => array(
                'type' => 'date',
            ),
            'tanggal_pengembalian' => array(
                'type' => 'date',
            ),
            'status_peminjaman' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'Aktif'
            )
        ));
        $this->dbforge->add_key('id_user');
        $this->dbforge->add_key('id_barang');
        $this->dbforge->add_key('id_peminjaman', TRUE);
        $this->dbforge->create_table('peminjaman');
        $this->db->query("ALTER TABLE `peminjaman` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE ");
        $this->db->query("ALTER TABLE `peminjaman` ADD FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE ");
    }

    public function down(){
            $this->dbforge->drop_table('peminjaman');
    }
}