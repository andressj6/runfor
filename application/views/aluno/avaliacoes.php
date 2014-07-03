
<?php
    $aluno = $this->session->userdata('aluno');
?>

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
            <td><?php echo $avaliacao['observacoes']; ?></td>
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
        <th>Observações</th>
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
            <td><?php echo $avaliacao['observacoes']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
