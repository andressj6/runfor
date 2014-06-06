<?php
    $aluno = $this->session->userdata('aluno');
    $treinouHoje = false;
    $dataHoje = date('Y-m-d', time());
    foreach ($aluno['presencas'] as $presenca){
        $dataPresenca = date('Y-m-d', strtotime($presenca['data_presenca']));
        if($dataPresenca == $dataHoje) {
            $treinouHoje = true;
            break;
        }
    }
?>



<h2>Seu Treino</h2>

<img src="<?php echo base_url("/images/treinos/".$aluno['id']);?>.png" /><br/>

<?php if(!$treinouHoje):?>
<a class="btn btn-success" href="<?php echo site_url('aluno/treinar'); ?>">Treinei Hoje!</a>
<?php else: ?>
<button class="btn btn-success" disabled>Já Treinei!</button>
<?php endif; ?>