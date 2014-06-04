<h2>Lista de Alunos</h2>
<?php if($this->session->flashdata('mensagem')): ?>

<?php endif; ?>
<table class="table">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Ativo</th>
        <th>Ver</th>
        <th>Adicionar Avaliação</th>
        <th>Desativar</th>
    </tr>
    </thead>
    <?php foreach ($alunos as $aluno):?>
        <tr>
            <td><?php echo $aluno['nome']; ?></td>
            <td><?php echo $aluno['email']; ?></td>
            <td>
                <?php if($aluno['ativo']): echo anchor('admin/desativar_aluno/'.$aluno['id'], 'Sim');?>
                <?php else: echo anchor('admin/ativar_aluno/'.$aluno['id'], 'Não'); ?>
                <?php endif; ?>
            </td>
            <td><?php echo anchor("/admin/ver_aluno/".$aluno['id'], "Ver"); ?></td>
            <td><?php echo anchor("/admin/avaliar_aluno/".$aluno['id'], "Avaliar"); ?></td>
            <td><?php echo "Desativar"?></td>
        </tr>

    <?php endforeach; ?>
</table>