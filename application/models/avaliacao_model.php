<?php

class Avaliacao_model extends CI_Model {

    var $id;
    var $aluno_id;
    var $dataAvaliacao;

    /**
     * @param $idAluno
     * @return array
     */
    public function get_avaliacoes_by_aluno($idAluno){
        $query_avaliacoes = $this->db->get_where('avaliacao_alunos', array('aluno_id' => $idAluno));
        $avaliacoes = array('3200' => array(), 'soccer' => array());
        foreach($query_avaliacoes->result_array() as $avaliacao){
            array_push($avaliacoes[$avaliacao['tipo_avaliacao'] == 0 ? '3200' : 'soccer'],
                $this->get_resultados_avaliacao($avaliacao));
        }
        return $avaliacoes;
    }


    public function get_by_id($avaliacao_id){
        $query = $this->db->get_where('avaliacao_alunos', array ('id' => $avaliacao_id));
        $res = $query->row_array();
        $res['data_avaliacao'] = date('d/m/y', strtotime($res['data_avaliacao']));
        return $res;

    }

    private function get_resultados_avaliacao($avaliacao){
        if($avaliacao['tipo_avaliacao'] == 0) {
            return $this->get_resultados_avaliacao_3200($avaliacao);
        } else if($avaliacao['tipo_avaliacao'] == 1){
            return $this->get_resultados_avaliacao_soccer($avaliacao);
        }
    }

    /**
     * @param $avaliacao avaliação
     * @return avaliação preenchida
     */
    private function get_resultados_avaliacao_soccer($avaliacao) {
        $avaliacao_processada = array();
        $avaliacao_processada['id'] = $avaliacao['id'];
        #distancia: =(INT(estagio)*240)+(estagio-INT(B5))*600
        $avaliacao_processada['estagio'] = $avaliacao['soccer_estagio'];
        $avaliacao_processada['frequencia'] = $avaliacao['soccer_frequencia'];
        $avaliacao_processada['distancia'] = ((int) $avaliacao['soccer_estagio'] * 240) + (($avaliacao['soccer_estagio'] - (int) $avaliacao['soccer_estagio'])*600);
        #velocidade: (int) estagio + 8
        $avaliacao_processada['velocidade'] = ((int) $avaliacao['soccer_estagio']) + 8;
        #VO2Max=12,159+0,032*(D5-150)
        $avaliacao_processada['vo2max'] = 12.159 + 0.032*($avaliacao_processada['distancia'] - 150);
        $avaliacao_processada['metMax'] = $avaliacao_processada['vo2max']/3.5;
        $avaliacao_processada['observacoes'] = $avaliacao['observacoes'];
        return $avaliacao_processada;
    }

    /**
     * @param $avaliacao
     * @return array
     */
    private function get_resultados_avaliacao_3200($avaliacao) {
        $avaliacao_processada = array();
        $avaliacao_processada['id'] = $avaliacao['id'];
        $tempo = $avaliacao['3200_tempo'];
        $avaliacao_processada['tempo'] = $tempo;
        #velMax = 3200 / tempo / 16.7
        $avaliacao_processada['velMax']  = 3200 / $tempo / 16.7;
        #velMaxMetros 3200/tempo
        $avaliacao_processada['velMaxMts'] = 3200 / $tempo;
        #velMin sem correção = 60/velMax
        $avaliacao_processada['velMaxSemCorrecao'] = 60 /$avaliacao_processada['velMax'];
        #pace =(E4-INT(E4))*0,6+INT(E4)
        $avaliacao_processada['pace'] = ($avaliacao_processada['velMaxSemCorrecao'] - ((int) $avaliacao_processada['velMaxSemCorrecao'])) * 0.6 + ((int) $avaliacao_processada['velMaxSemCorrecao']);
        #vo2Max = =118,4-(4,77*B4)
        $avaliacao_processada['vo2max'] = 118.4 - (4.77 * $tempo);
        $avaliacao_processada['observacoes'] = $avaliacao['observacoes'];
        return $avaliacao_processada;

    }

    public function salvar_avaliacao_3200($aluno_id, $tempo3200, $observacoes, $avaliacao_id = NULL) {
        $data = array (
          'tipo_avaliacao' => 0,
          'data_avaliacao' => date('Y-m-d'),
          'aluno_id' => $aluno_id,
          '3200_tempo' => $tempo3200,
          'observacoes' => $observacoes
        );

        if(!$avaliacao_id) {
            $this->db->insert('avaliacao_alunos', $data);
        } else {
            $this->db->update('avaliacao_alunos', $data, array ('id' => $avaliacao_id));
        }
        return TRUE;
    }

    public function salvar_avaliacao_soccer($aluno_id, $estagio, $frequencia, $observacoes, $avaliacao_id = NULL) {
        $data = array(
            'tipo_avaliacao' => 1,
            'data_avaliacao' => date('Y-m-d'),
            'aluno_id' => $aluno_id,
            'soccer_estagio' => $estagio,
            'soccer_frequencia' => $frequencia,
            'observacoes' => $observacoes
        );

        if(!$avaliacao_id) {
            $this->db->insert('avaliacao_alunos', $data);
        } else {
            $this->db->update('avaliacao_alunos', $data, array ('id' => $avaliacao_id));
        }
        return TRUE;
    }

}