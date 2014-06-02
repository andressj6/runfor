<?php

class Avaliacao_model extends CI_Model {

    var $id;
    var $aluno_id;
    var $dataAvaliacao;

    /**
     * @param $idAluno
     */
    public function get_avaliacoes_by_aluno($idAluno){
        
    }

    /**
     * @param $avaliacao
     */
    public function get_resultados_avaliacao($avaliacao) {

    }

    public function salvar_avaliacao_3200($aluno_id, $tempo3200) {
        $data = array (
          'data_avaliacao' => date('Y-m-d'),
          'aluno_id' => $aluno_id,
          ''
        );
    }

    public function salvar_avaliacao_soccer($aluno_id, $estagio, $frequencia) {
        $data = array(
            'data_avaliacao' => date('Y-m-d'),
            'aluno_id' => $aluno_id,
            'estagio' => $estagio,
            'frequencia' => $frequencia
        );
    }
    
}