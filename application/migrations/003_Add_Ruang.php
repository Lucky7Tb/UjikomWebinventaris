<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Ruang extends CI_Migration {

    public function up(){
        $this->dbforge->add_field(array(
            'id_ruang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
			'nama_ruang' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
			'keterangan' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
        ));
        $this->dbforge->add_key('id_ruang', TRUE);
        $this->dbforge->create_table('ruang');
    }

    public function down(){
            $this->dbforge->drop_table('ruang');
    }
}