<?php if(!empty($msg)) : ?>
<div class="alert alert-<?php echo $tipo; ?>">
    <?php echo $msg; ?>
</div>
<?php endif; ?>


<?php echo form_open('aluno/reset_password_post') ?>

	<label for="email">Senha Atual:</label>
	<input type="password" class="form-control" name="senha_atual" /><br />

	<label for="senha">Nova Senha:</label>
	<input type="password" class="form-control" name="senha" /><br />

	<label for="confirma_senha">Confirmar nova senha:</label>
	<input type="password" class="form-control" name="confirma_senha" /><br />

	<input type="submit" name="submit" value="Entrar" />

</form>