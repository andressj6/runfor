<?php

class Admin extends CI_Controller {
    
    public function __construct () {
        parent::__construct();
    }

    public function login(){

    }

    public function login_post(){

        $data['alunos'] = $this->aluno_model->get_all();

        $this->load->view("templates/header");
        $this->load->view("admin/list_alunos",$data);
        $this->load->view("templates/footer");
    }

    /** Lista de Alunos */
    public function listar_alunos(){
        $data['alunos'] = $this->aluno_model->get_all();

        $this->load->view("templates/header");
        $this->load->view("admin/list_alunos",$data);
        $this->load->view("templates/footer");
    }
    
    public function ver_aluno(){
        $id = $this->uri->segment(3); #admin/ver_aluno/$id
        $aluno = $this->aluno_model->get_aluno_by_id($id);
        $this->load->view("templates/header");
        $this->load->view("admin/ver_aluno", array('aluno' => $aluno));
        $this->load->view("templates/footer");
    }
    
    public function authorizeAluno() {
        
    }
    
    public function addTreino() {
        
    }
    
}


?>