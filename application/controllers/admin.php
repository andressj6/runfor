<?php

class Admin extends CI_Controller {

    public function __construct () {
        parent::__construct();

    }

    public function login(){
        $this->load->view("templates/header");
        $this->load->view("admin/login");
        $this->load->view("templates/footer");
    }

    public function logout(){
        $this->session->unset_userdata('admin_info');
        $this->login();
    }

    public function login_post(){

        $login = $this->input->post('login');
        $senha = do_hash($this->input->post('senha'));

        $query = $this->db->get_where('admin_users', array ('login' => $login, 'senha' => $senha));
        $adminUser = $query->row_array();

        if(!$adminUser) {
            $this->load->view("templates/header");
            $data = array ('error' => 'Usuário ou senha Inválidos');
            $this->load->view("admin/login", $data);
            $this->load->view("templates/footer");
        } else {
            $admin_data = array('user' => $login, 'logged_in' => TRUE);
            $this->session->set_userdata(array('admin_info' => $admin_data));
            $this->listar_alunos();
        }

    }

    /** Lista de Alunos */
    public function listar_alunos(){
        if(!$this->check_login()){
            return;
        }
        $data['alunos'] = $this->aluno_model->get_all();

        $this->load->view("templates/header");
        $this->load->view("admin/list_alunos",$data);
        $this->load->view("templates/footer");
    }

    public function ver_aluno(){
        if(!$this->check_login()){
            return;
        }
        $id = $this->uri->segment(3); #admin/ver_aluno/$id
        $aluno = $this->aluno_model->get_aluno_by_id($id);
        $this->load->view("templates/header");
        $this->load->view("admin/ver_aluno",
            array('aluno' => $aluno, 'error' => "")
        );
        $this->load->view("templates/footer");
    }

    public function ativar_aluno() {
        if(!$this->check_login()){
            return;
        }
        $id = $this->uri->segment(3); #admin/ativar_aluno/$id
        $this->aluno_model->ativar_aluno($id);
        $this->session->set_flashdata('mensagem',array('conteudo' => 'Aluno Ativado com Sucesso!', 'tipo' => 'success'));
        $this->listar_alunos();
    }

    public function desativar_aluno() {
        if(!$this->check_login()){
            return;
        }
        $id = $this->uri->segment(3); #admin/ativar_aluno/$id
        $this->aluno_model->desativar_aluno($id);
        $this->session->set_flashdata('mensagem',array('conteudo' => 'Aluno Desativado com Sucesso!', 'tipo' => 'success'));
        $this->listar_alunos();
    }

    public function upload_treino(){

        if(!$this->check_login()){
            return;
        }

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
        if(!$this->check_login()){
            return;
        }
        $id = $this->uri->segment(3); #admin/ver_aluno/$id
        $aluno = $this->aluno_model->get_aluno_by_id($id);
        $this->load->view("templates/header");
        $this->load->view("admin/avaliar_aluno",
            array('aluno' => $aluno, 'error' => "")
        );
        $this->load->view("templates/footer");
    }

    public function editar_avaliacao() {
        if(!$this->check_login()){
            return;
        }
        $id = $this->uri->segment(3); #admin/editar_avaliacao/$id_avaliacao

        $avaliacao = $this->avaliacao_model->get_by_id($id);

        $aluno = $this->aluno_model->get_aluno_by_id($avaliacao['aluno_id']);
        $this->load->view("templates/header");
        $this->load->view("admin/avaliar_aluno",
            array('aluno' => $aluno, 'error' => "", 'avaliacao' => $avaliacao)
        );
        $this->load->view("templates/footer");
    }

    public function save_avaliacao(){
        if(!$this->check_login()){
            return;
        }
        $data = $this->input->post();
        $id_avaliacao = isset($data['avaliacao_id']) ? $data['avaliacao_id'] : NULL;
        if($data['tipo_avaliacao'] == 0) {
            $this->avaliacao_model->salvar_avaliacao_3200($data['aluno_id'], $data['3200_tempo'], $id_avaliacao);
        } else {
            $this->avaliacao_model->salvar_avaliacao_soccer($data['aluno_id'], $data['soccer_estagio'], $data['soccer_frequencia'], $id_avaliacao);
        }
        $aluno = $this->aluno_model->get_aluno_by_id($data['aluno_id']);
        $this->load->view("templates/header");
        $this->load->view("admin/ver_aluno",
            array('aluno' => $aluno, 'mensagem' => "Avaliação Editada com Sucesso")
        );
        $this->load->view("templates/footer");


    }

    public function check_login(){
        $admin_data = $this->session->userdata('admin_info');
        if(!isset($admin_data) || $admin_data['logged_in'] == FALSE) {
            $this->load->view("templates/header");
            $data = array ('error' => 'Você precisa estar logado para acessar essa área');
            $this->load->view("admin/login", $data);
            $this->load->view("templates/footer");
            return false;
        }
        return true;
    }

}