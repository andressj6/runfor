<h2>Cadastre-se!</h2>
    <?php echo validation_errors(); ?>

    <?php echo form_open('aluno/form_post') ?>

    <h3> Dados de Acesso </h3>
    
	<label for="nome">Nome:</label>
	<input type="text" class="form-control" name="nome" /><br />

    <label for="senha">Data de Nascimento: (DD/MM/AAAA)</label>
    <input type="text" class="form-control" name="dataNascimento" /><br />

    <label for="email">Email:</label>
    <input type="text" class="form-control" name="email" /><br />

    <label for="senha">Senha:</label>
    <input type="password" class="form-control" name="senha" /><br />

    <label for="telefone">Telefone</label>
    <input type="text" name="telefone" class="form-control"/>

    <label for="atividade_fisica">Pratica atividades Físicas? Se sim, quais e há quanto tempo</label>
    <textarea name="atividade_fisica" class="form-control"></textarea> <br />

    <label for="refeicoes">Faz quantas refeições por dia?</label>
    <input type="text" name="refeicoes" class="form-control"/>

    <label for="dieta">Faz alguma dieta ou suplementação orientada?</label>
    <input type="text" name="dieta" class="form-control" />

    <label for="dormir">Dorme quantas horas por dia?</label>
    <input type="text" name="dormir" class="form-control" />

    <label for="fumante">Fumante? Consome bebidas alcoólicas? Quantas vezes por semana?</label> <br/>
    <textarea name="fumante" class="form-control"></textarea>

    <label for="cardiaco">Possui alguma alteração cardíaca? Algum parente com problemas cardíacos? </label>
    <input type="text" name="cardiaco" class="form-control" />

    <label for="medicamento">Toma algum tipo de medicamento? Qual?</label>
    <input type="text" name="medicamento" class="form-control" />

    <label for="cirurgia">Fez alguma cirurgia? Qual?</label>
    <input type="text" name="cirurgia" class="form-control" />

    <label for="dores">Apresenta dores na coluna, articulações ou dores musculares?</label>
    <input type="text" name="dores" class="form-control" />

	<input type="submit" class="btn btn-default" name="submit" value="Enviar!" />

</form>