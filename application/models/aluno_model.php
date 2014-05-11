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
    
    public function add_aluno(){
    	$data = array();
    	return $this->db->insert('aluno_model', $data);
    }
    
    public function get_aluno_by_credentials($login, $senha){
        $query = $this->db->get_where('aluno_model', 
            array(
                'login' => $login, 
                'senha' => do_hash($senha)
            )
        );
	    return $query->row_array();
    }
}


?>