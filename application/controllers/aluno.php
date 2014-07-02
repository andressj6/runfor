<?php

class Aluno extends CI_Controller {
    
    public function __construct() {
		parent::__construct();

        $this->form_validation->set_error_delimiters('<div class="alert-warning">', '</div>');
	}
	
	/** Logins */
	public function login(){
        $this->load->library('form_validation');

	    $this->load->view('templates/header');
        $this->load->view('aluno/login');
		$this->load->view('templates/footer');
	}
    
    public function login_post(){
        $this->load->helper('form');
    	$this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
	    $this->form_validation->set_rules('senha', 'Senha', 'required');

        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
	    $view = "";
        if($this->form_validation->run() === FALSE){
            $view = "aluno/login";
        } else {
            $aluno = $this->aluno_model->get_aluno_by_credentials($email, $senha);
            if(!$aluno){
                $data['error'] = "Email ou Senha Inválidos";
                $view = "aluno/login";
            } else {
                $aluno = $this->aluno_model->get_aluno_by_id($aluno['id']);
                $aluno['logged_in'] = true;
                $this->session->set_userdata('aluno',$aluno);
                $data['aluno'] = $aluno['nome'];
                $view = "aluno/index";
            }
        }
	    
	    $this->load->view('templates/header');
        $this->load->view($view, $data);
		$this->load->view('templates/footer');
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->login();
    }
    
    public function forgotpassword(){
        $this->load->view('templates/header');
        $this->load->view('aluno/forgotpassword');
        $this->load->view('templates/footer');
    }
    
    public function forgotpassword_post(){
        $this->load->view('templates/header');
        $email = $this->input->post('email');
        if($this->aluno_model->validate_email($email)){
            $this->aluno_model->send_recovery_mail($email);
            $this->load->view('aluno/recovery_success');
        } else {
            $this->load->view('aluno/forgotpassword', array( "error" => "Email não encontrado!"));
        }
        $this->load->view('templates/footer');
    }


    public function reset_password(){
        if(!$this->check_login()){
            return;
        }
        $this->load->view('templates/header');
        $this->load->view('aluno/reset_password');
        $this->load->view('templates/footer');
    }

    public function reset_password_post(){
        $aluno = $this->session->userdata('aluno');
        $res = array();       
        $senhaAtual = do_hash($this->input->post('senha_atual'));
        if(strcmp($senhaAtual, do_hash($aluno['senha'])) == 0) {
            $res['tipo'] = 'danger';
            $res['msg'] = "A senha atual está incorreta";
        } else {
            $novaSenha = $this->input->post('senha');
            $confirmaSenha = $this->input->post('confirma_senha');
            if($novaSenha != $confirmaSenha){
                $res['tipo'] = 'warning';
                $res['msg'] = "As senhas não conferem.";
            } else {
                $this->db->update('alunos', array('senha' => do_hash($novaSenha)), array('id' => $aluno['id']));
                $res['tipo'] = 'success';
                $res['msg'] = 'Senha alterada com Sucesso';
            }
        }
        $this->load->view('templates/header');
        $this->load->view('aluno/reset_password', $res);
        $this->load->view('templates/footer');
    }


    
    /** Cadastro / Edição */
    public function novo(){
        $this->load->view('templates/header');
        $this->load->view('aluno/user_form');
		$this->load->view('templates/footer');
    }
    
    public function edit(){
        
    }
    
    /** Mesmo Post pros dois Casos */
    public function form_post(){

        $this->load->view('templates/header');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Usuário', 'required');
        $this->form_validation->set_rules('email', 'E-Mail', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('aluno/user_form');
        } else {
            $this->aluno_model->save_aluno();
            $this->load->view('aluno/success');
        }
        $this->load->view('templates/footer');
    }
    
    /** Após o login */
    public function index(){
        if(!$this->check_login()){
            return;
        }
        $data ['title'] =  "Área do Aluno";

        $this->load->view('templates/header', $data);
        $this->load->view('aluno/index');
        $this->load->view('templates/footer');
    }
    
    /** Mostra os treinos do Aluno */
    public function ver_treino(){
        if(!$this->check_login()){
            return;
        }
        $this->load->view('templates/header');
        $this->load->view('aluno/treinos');
        $this->load->view('templates/footer');
    }

    public function treinar(){
        if(!$this->check_login()){
            return;
        }
        $aluno = $this->session->userdata('aluno');
        $presenca = $this->aluno_model->add_presenca($aluno['id']);
        array_push($aluno['presencas'], $presenca);
        $this->session->set_userdata('aluno', $aluno);
        $this->load->view('templates/header');
        $this->load->view('aluno/treinos', array("mensagem" => "Treino adicionado com sucesso!!"));
        $this->load->view('templates/footer');
    }
    
    /** Dados da avaliação física */
    public function ver_avaliacoes(){
        if(!$this->check_login()){
            return;
        }
        $this->load->view('templates/header');
        $this->load->view('aluno/avaliacoes');
        $this->load->view('templates/footer');
    }


    public function check_login(){
        $aluno_logado = $this->session->userdata('aluno');
        if(!isset($aluno_logado) || $aluno_logado['logged_in'] == FALSE) {
            $this->load->view("templates/header");
            $data = array ('error' => 'Você precisa estar logado para acessar essa área');
            $this->load->view("aluno/login", $data);
            $this->load->view("templates/footer");
            return false;
        }
        return true;
    }

    public function calendario(){
        if(!$this->check_login()){
            return;
        }
        $this->load->view('templates/header');
        $this->load->view('aluno/calendario');
        $this->load->view('templates/footer');
    }
}

?>