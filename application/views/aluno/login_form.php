<h2>Entrar!</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('aluno/login_post') ?>

	<label for="login">Nome de Usuário:</label>
	<input type="login" name="login" /><br />

	<label for="senha">Senha:</label>
	<input type="text" name="senha" /><br />

	<input type="submit" name="submit" value="Entrar" />

</form>