<?php

class Aluno_model extends CI_Model {

    #dados de login
    var $id;
    var $nome;
    var $login;
    var $senha;
    var $email;
    var $ativo;
    
    #dados pessoais
    var $endereco;
    var $bairro;
    var $complemento;
    var $cidade;
    var $estado;
    
    var $telefone;
    var $dataNascimento;
    
    #dados médicos
    var $peso;
    var $altura;
    var $imc;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
    }
    
    public function save_aluno(){
    	$data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => do_hash($this->input->post('nome')),
            'ativo' => false,
            'endereco' => $this->input->post('endereco'),
            'bairro' => $this->input->post('bairro'),
            'complemento' => $this->input->post('complemento'),
            'cidade' => $this->input->post('cidade'),
            'estado' => $this->input->post('estado'),
            'telefone' => $this->input->post('telefone')
            #'dataNascimento' => $this->input->post('dataNascimento')
        );
    	return $this->db->insert('alunos', $data);
        return false;
    }
    
    public function get_aluno_by_credentials($email, $senha){
        $query = $this->db->get_where('alunos',
            array(
                'email' => $email,
                'senha' => do_hash($senha),
                #'ativo' => 1,
            )
        );
        $aluno = $query->row_array();
	    return $aluno;
    }

}
