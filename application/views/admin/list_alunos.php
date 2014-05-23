<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ativo</th>
            <th>Ver</th>
            <th>Desativar</th>
        </tr>
    </thead>
    <?php var_dump($alunos); ?>
    <?php foreach ($alunos as $aluno):?>
    <tr>
        <td><?php echo $aluno['nome']; ?></td>
        <td><?php echo $aluno['email']; ?></td>
        <td><?php echo ($aluno['ativo'] ? 'Sim' : 'Não'); ?></td>
        <td><?php echo "Ver" ?></td>
        <td><?php echo "Desativar"?></td>
    </tr>

    <?php endforeach; ?>
</table>