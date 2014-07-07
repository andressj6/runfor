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

<?php echo form_open_multipart('aluno/treinar');?>
<h3>Adicionar Treino</h3>
<div class="form-group">
    <label for="data_treino" class="control-label">Data:</label>
    <input type="text" class="form-control" name="data_treino" style="width: 300px;" />
    <input type="submit" value="Salvar" class="btn btn-success" />
</div>
</form>
