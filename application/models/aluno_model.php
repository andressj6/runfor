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
            'data_nascimento' => $this->input->post('dataNascimento'),
            'telefone' => $this->input->post('telefone'),
            'atividade_fisica' => $this->input->post('atividade_fisica'),
            'refeicoes' => $this->input->post('refeicoes'),
            'dieta' => $this->input->post('dieta'),
            'dormir' => $this->input->post('dormir'),
            'fumante' => $this->input->post('fumante'),
            'cardiaco' => $this->input->post('cardiaco'),
            'medicamento' => $this->input->post('medicamento'),
            'cirurgia' => $this->input->post('cirurgia'),
            'dores' => $this->input->post('dores')
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

    public function get_aluno_by_email($email){
        $query = $this->db->get_where('alunos', array('email' => $email));
        $aluno = $query->row_array();
        return isset($aluno) ? $aluno : NULL;
    }

    public function get_presencas_aluno($id){
        $query = $this->db->get_where('presencas_alunos', array('aluno_id' => $id));
        $presencas = $query->result_array();
        return $presencas;
    }

    public function add_presenca($idAluno){
        $data = array (
            'aluno_id' => $idAluno,
            'data_presenca' => date("Y-m-d", time())
        );
        $query = $this->db->insert('presencas_alunos', $data);
        return $data;
    }

    public function validate_email($email){
        if(empty($email)){
            return false;
        }
        $data = array (
            'email' => $email
        );
        $query = $this->db->get_where('alunos', $data);
        return empty($query->row_array());
    }

    public function send_recovery_email($email){
        $novaSenha = random_string('alnum', 12);
        $aluno = $this->get_aluno_by_email($email);
        $mensagem = <<<EOT
Olá!

Você está recebendo essa mensagem porque uma nova senha foi solicitada.
Sua nova senha de acesso é $novaSenha. Você deve mudá-la imediatamente para uma senha de sua escolha.
Obrigado!

Equipe Runfor
EOT;

        $this->load->library('email');
        $this->email->from('noreply@runfor.net.br', 'Runfor');
        $this->email->to($email);
        $this->email->subject('Runfor - Recuperar Senha');
        $this->email->message($mensagem);
        $this->email->send();

        $data = array('senha' => do_hash($novaSenha));
        $query = $this->db->update('alunos',$data,array( "id" => $aluno['id']));



    }

}
