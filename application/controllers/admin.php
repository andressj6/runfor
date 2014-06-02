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
        $this->load->view("admin/ver_aluno",
            array('aluno' => $aluno, 'error' => "")
        );
        $this->load->view("templates/footer");
    }

    public function authorizeAluno() {

    }

    public function upload_treino(){

        $idAluno = $this->input->post('id_aluno');
        $config['upload_path'] = './images/treinos';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '300';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['file_name'] = $idAluno.".png";
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('treino')) {
            $error = $this->upload->display_errors();
            $aluno = $this->aluno_model->get_aluno_by_id($idAluno);

            $this->load->view("templates/header");
            $this->load->view("admin/ver_aluno",
                array('aluno' => $aluno, 'error' => $error)
            );
            $this->load->view("templates/footer");
        } else {
            $data = array('id_aluno' => $idAluno);
            $this->load->view("templates/header");
            $this->load->view('admin/upload_success', $data);
            $this->load->view("templates/footer");
        }
    }

    public function avaliar_aluno() {
        $id = $this->uri->segment(3); #admin/ver_aluno/$id
        $aluno = $this->aluno_model->get_aluno_by_id($id);
        $this->load->view("templates/header");
        $this->load->view("admin/avaliar_aluno",
            array('aluno' => $aluno, 'error' => "")
        );
        $this->load->view("templates/footer");
    }



}


?>