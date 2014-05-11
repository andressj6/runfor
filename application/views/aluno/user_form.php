<h2>Cadastre-se!</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('aluno/form_post') ?>

    <h3> Dados de Acesso </h3>
    
	<label for="nome">Nome:</label>
	<input type="text" name="nome" /><br />

	<label for="email">Email:</label>
	<input type="text" name="email" /><br />
    
    <label for="senha">Email:</label>
	<input type="password" name="senha" /><br />
    <hr />
    
    <h3> Endereço </h3>
    <label for="endereco">Endereço:</label>
	<input type="text" name="endereco" /><br />
	
	<label for="bairro">Bairro:</label>
	<input type="text" name="bairro" /><br />
	
	<label for="complemento">Complemento:</label>
	<input type="text" name="complemento" /><br />
	
	<label for="cidade">Cidade:</label>
	<input type="text" name="cidade" /><br />
	
	<label for="estado">Estado:</label>
	<select name="estado">
	    <option value="GO">Goiás</option>
	</select><br />
	<hr />
	
    <h3>Dados Médicos</h3>	
    
    <label for="altura">Altura:</label>
	<input type="text" name="altura" /><br />
	
	<label for="peso">Peso:</label>
	<input type="text" name="peso" /><br />
	
	<input type="submit" name="submit" value="Enviar!" />

</form>