<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    public function RulesLogin()
    {
        return [
            [
                'field' => 'username',
                'rules' => 'required|alpha_numeric'
            ],
            [
                'field' => 'password',
                'rules' => 'required|alpha_numeric'
            ]
        ];
    }

    public function RulesRegister()
    {
        return [
            [
                'field' => 'username',
                'rules' => 'required|alpha_numeric|is_unique[user.username]'
            ],

            [
                'field' => 'name',
                'rules' => 'required|alpha'
            ],

            [
                'field' => 'email',
                'rules' => 'required|valid_email|is_unique[user.email]'
            ],

            [
                'field' => 'phone',
                'rules' => 'required|numeric|is_unique[user.no_telpon]'
            ],

            [
                'field' => 'password',
                'rules' => 'required|alpha_numeric|matches[confpass]'
            ],
            [
                'field' => 'confpass',
                'rules' => 'required|alpha_numeric|matches[password]'
            ]
        ];
    }

    public function AddUser()
    {
        if ($this->input->post('level') == '') {
            $level = 3;
        } else {
            $level = $this->input->post('level', TRUE);
        }
        $DataUser = [
            'id_user' => 'user-' . mt_rand(),
            'nama_user' =>  $this->input->post('name'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => $this->input->post('email'),
            'no_telpon' => $this->input->post('phone'),
            'level' => $level
        ];
        $this->db->insert('user', $DataUser);
    }

    public function GetUser($Username)
    {
        return $this->db->get_where('user', ['username' => $Username])->row_array();
    }
}
