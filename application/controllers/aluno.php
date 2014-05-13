<?php

class Aluno extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
	}
	
	/** Logins */
	public function login(){
        $this->load->library('form_validation');

	    $this->load->view('templates/header');
        $this->load->view('aluno/login_form');
		$this->load->view('templates/footer');
	}
    
    public function loginPost(){
        $this->load->helper('form');
    	$this->load->library('form_validation');

        $this->form_validation->set_rules('usuario', 'Usuário', 'required');
	    $this->form_validation->set_rules('senha', 'Senha', 'required');

        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');


	    $aluno = $this->aluno_model->get_aluno_by_credentials($usuario, $senha);
	    
	    $view = "";
	    if(!$aluno){
	        $data['error'] = "Usuário o Senha Inválidos";
	        $view = "aluno/login_form";
	    } else {
	        $aluno['logged_in'] = true;
	        $this->session->set_userdata($aluno);
	        $view = "aluno/home";
	    }
	    
	    $this->load->view('templates/header');
        $this->load->view($view);
		$this->load->view('templates/footer');
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
            $this->load->view('aluno/add_success');
        }
        $this->load->view('templates/footer');
    }
    
    /** Após o login */
    public function index(){

        $data ['title'] =  "Área do Aluno";

        $this->load->view('templates/header', $data);
        $this->load->view('aluno/index');
        $this->load->view('templates/footer');
    }
    
    /** Mostra os treinos do Aluno */
    public function treinos(){
        
    }
    
    /** Dados da avaliação física */
    public function avaliacao(){
        
    }

}

?>