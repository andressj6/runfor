<style>
    .table th {
        text-align: center;
    }
</style>

<h2>Lista de Alunos</h2>
<?php if($this->session->flashdata('mensagem')):
    $mensagem = $this->session->flashdata('mensagem'); ?>
<div class="alert alert-<?php echo $mensagem['tipo'];?>">
    <?php echo $mensagem['conteudo']; ?>
</div>
<?php endif; ?>
<?php echo form_open_multipart('admin/multi_upload_treino');?>
    <table class="table">
        <thead>
            <tr>
                <th>Treinos em Massa?</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ver</th>
                <th>Adicionar Avaliação</th>
                <th>Excluir aluno</th>
            </tr>
        </thead>
        <?php foreach ($alunos as $aluno):?>
            <tr>
                <td><input type="checkbox" name="alunos_treinos[]" value="<?php echo $aluno['id']; ?>" /></td>
                <td><?php echo $aluno['nome']; ?></td>
                <td><?php echo $aluno['email']; ?></td>
                <td><?php echo anchor("/admin/ver_aluno/".$aluno['id'], "Ver"); ?></td>
                <td><?php echo anchor("/admin/avaliar_aluno/".$aluno['id'], "Avaliar"); ?></td>
                <td>
                    <a onclick="return confirm('Deseja realmente excluir esse aluno?')" href="<?php echo site_url('admin/desativar_aluno/'.$aluno['id']); ?>">Excluir?</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
    <hr />
    <div class="container form-input-750" >
        <h3>Enviar Treino para Alunos Selecionados</h3>
        <div class="form-group">
            <label for="treino"></label> <input type="file" name="treino" size="20" />
        </div>
        <div class="form-group">
            <input type="submit" value="upload" class="btn btn-success"/>
        </div>
    </div>
</form>