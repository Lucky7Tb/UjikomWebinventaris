<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Jenis extends CI_Migration {

    public function up(){
        $this->dbforge->add_field(array(
            'id_jenis' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
			'nama_jenis' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
        ));
        $this->dbforge->add_key('id_jenis', TRUE);
        $this->dbforge->create_table('jenis');
    }

    public function down(){
            $this->dbforge->drop_table('jenis');
    }
}