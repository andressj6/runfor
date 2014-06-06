<h3>Ver Aluno</h3>
<?php if(!empty($error)):?>
    <div class="alert alert-warning"><?php echo $error; ?></div>
<?php endif;?>

<?php if(!empty($mensagem)):?>
    <div class="alert alert-success"><?php echo $mensagem; ?></div>
<?php endif;?>
Nome: <?php echo $aluno['nome']; ?> <br/>
Email: <?php echo $aluno['email']; ?> <br/>
Telefone: <?php echo $aluno['telefone']; ?> <br/>
Pratica Atividade Fisica: <?php echo $aluno['atividade_fisica']; ?> <br/>
Refeições diárias: <?php echo $aluno['refeicoes']; ?> <br/>
Dieta: <?php echo $aluno['dieta']; ?> <br/>
Horas de Sono diárias: <?php echo $aluno['dormir']; ?> <br/>
Fuma/Bebe: <?php echo $aluno['fumante']; ?> <br/>
Problemas Cardíacos: <?php echo $aluno['cardiaco']; ?> <br/>
Medicamentos: <?php echo $aluno['medicamento']; ?> <br/>
Cirurgias: <?php echo $aluno['cirurgia']; ?> <br/>
Dores: <?php echo $aluno['dores']; ?>

<h3>Treino atual:</h3>

<img src="<?php echo base_url("/images/treinos/".$aluno['id']);?>.png" /><br/>


<?php echo form_open_multipart('admin/upload_treino');?>
<div class="form-group">
    <label for="treino"></label> <input type="file" name="treino" size="20" />
    <input type="hidden" name="id_aluno" value="<?php echo $aluno['id']; ?>" />
</div>
<div class="form-group">
    <input type="submit" value="upload" class="btn"/>
</div>
<hr/>
<h2>Ultimas 5 Presenças: </h2><br />

</form>
    <?php foreach($aluno['presencas'] as $presenca):?>
        <ul>
            <li><?php echo date('d/m/Y', strtotime($presenca['data_presenca'])); ?></li>
        </ul>
    <?php endforeach; ?>
<hr/>

<h2>Ultimas 5 Avaliações 3200M:</h2>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Tempo</th>
        <th>Vel. Max (KM/h) </th>
        <th>Vel. Max metros/min. </th>
        <th>Vel. Max Sem Correção</th>
        <th>PACE</th>
        <th>VO<sup>2</sup> Max.</th>
        <th>Editar</th>
        <th>Remover</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($aluno['avaliacoes']['3200'] as $avaliacao): ?>
        <tr>
            <td><?php echo $avaliacao['tempo']; ?> </td>
            <td><?php echo $avaliacao['velMax']; ?> </td>
            <td><?php echo $avaliacao['velMaxMts']; ?> </td>
            <td><?php echo $avaliacao['velMaxSemCorrecao']; ?> </td>
            <td><?php echo $avaliacao['pace']; ?> </td>
            <td><?php echo $avaliacao['vo2max']; ?> </td>
            <td><?php echo anchor('admin/editar_avaliacao/'.$avaliacao['id'], "Editar"); ?></td>
            <td><?php echo anchor('admin/remover_avaliacao/'.$avaliacao['id'], "Excluir"); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<hr />
<h2>Ultimas 5 Avaliações Soccer</h2>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Estágio</th>
        <th>Frequência Cardíaca</th>
        <th>Distância</th>
        <th>Velocidade</th>
        <th>VO<sup>2</sup> Max</th>
        <th>Met. Max</th>
        <th>Editar</th>
        <th>Remover</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($aluno['avaliacoes']['soccer'] as $avaliacao) :?>
        <tr>
            <td><?php echo $avaliacao['estagio']; ?></td>
            <td><?php echo $avaliacao['frequencia']; ?></td>
            <td><?php echo $avaliacao['distancia']; ?></td>
            <td><?php echo $avaliacao['velocidade']; ?></td>
            <td><?php echo $avaliacao['vo2max']; ?></td>
            <td><?php echo $avaliacao['metMax']; ?></td>
            <td><?php echo anchor('admin/editar_avaliacao/'.$avaliacao['id'], "Editar"); ?></td>
            <td><?php echo anchor('admin/remover_avaliacao/'.$avaliacao['id'], "Excluir"); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo site_url("admin/avaliar_aluno/".$aluno['id']); ?>" class="btn btn-success">Avaliar Aluno</a>