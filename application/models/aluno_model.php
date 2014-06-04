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

    public function get_all(){
        $query = $this->db->get("alunos");
        return $query->result_array();
    }

    public function ativar_aluno($id){
        $this->db->update('alunos',array('ativo'=> TRUE), array('id' => $id));
        return true;
    }

    public function desativar_aluno($id){
        $this->db->update('alunos',array('ativo'=> FALSE), array('id' => $id));
        return true;
    }


    public function get_aluno_by_id($id){
        $query = $this->db->get_where('alunos', array ('id' => $id));
        $aluno = $query->row_array();
        if(!$aluno){
            throw new Exception();
        }
        $aluno['presencas'] = $this->get_presencas_aluno($id);
        $aluno['avaliacoes'] = $this->avaliacao_model->get_avaliacoes_by_aluno($id);
        return $aluno;
    }

    public function get_presencas_aluno($id){
        $query = $this->db->get_where('presencas_alunos', array('aluno_id' => $id));
        $presencas = $query->result_array();
        return $presencas;
    }

}
