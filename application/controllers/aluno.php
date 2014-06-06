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
        
    }
    
    public function forgotpassword_post(){
        
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