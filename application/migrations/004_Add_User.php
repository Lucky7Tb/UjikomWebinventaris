<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_User extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id_user' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'nama_user' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'email' => array(
                'type' => "VARCHAR",
                'constraint' => "255"
            ),
            'no_telpon' => array(
                'type' => 'VARCHAR',
                'constraint' => "14"
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => '10'
            ),
        ));
        $this->dbforge->add_key('level');
        $this->dbforge->add_key('id_user', TRUE);
        $this->dbforge->create_table('user');
        $this->db->query("ALTER TABLE `user` ADD FOREIGN KEY (`level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE ");
        $this->db->query("ALTER TABLE `user` ADD UNIQUE( `nama_user`)");
        $data = [
            [
                'id_user' => 'user-' . mt_rand(),
                'nama_user' => "Lucky",
                'username' => "Lucky101",
                'password' => password_hash("123456", PASSWORD_DEFAULT),
                'email' => "luckytribhakti@gmail.com",
                'no_telpon' => "08993970968",
                'level' => 1
            ],
            [
                'id_user' => 'user-' . mt_rand(),
                'nama_user' => "guest",
                'username' => "guest",
                'password' => password_hash("123456", PASSWORD_DEFAULT),
                'email' => "guest@gmail.com",
                'no_telpon' => "08993970969",
                'level' => 2
            ]
        ];
        $this->db->insert_batch('user', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}
