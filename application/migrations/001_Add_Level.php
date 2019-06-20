<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Level extends CI_Migration {

    public function up(){
        $this->dbforge->add_field(array(
            'id_level' => array(
                'type' => 'INT',
                'constraint' => 10,
                'auto_increment' => TRUE
            ),
            'nama_level' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
        ));
        $data = [
            [
                "nama_level" => "administrator"
            ],
            [
                "nama_level" => "operator"
            ],
            [
                "nama_level" => "peminjam"
            ]
        ];
        
        $this->dbforge->add_key('id_level', TRUE);
        $this->dbforge->create_table('level');    
		$this->db->insert_batch('level',$data);
    }

    public function down(){
            $this->dbforge->drop_table('level');
    }
}