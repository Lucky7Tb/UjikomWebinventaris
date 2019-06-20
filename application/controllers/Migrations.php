<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migrations extends CI_Controller {
    public function __construct() {
        parent::__construct();
         $this->load->library('migration');
    }
    public function index() {
        if ($this->migration->current()===FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo '<script>alert("Migrasi Telah Berhasil")</script>';
        }
    }
}
