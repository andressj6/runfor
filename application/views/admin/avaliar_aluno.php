<?php
#date_default_timezone_set('America/Sao_Paulo');
?>
<style type="text/css">
    .form-soccer {
        /*display: none;*/
    }

</style>

<script type="text/javascript">
    $(document).ready(function(){
       $(".radio_tipo").change(function(){
           if($(this).val() == 0) {
               $(".form-3200").show();
               $(".form-soccer").hide();
           } else {
               $(".form-3200").hide();
               $(".form-soccer").show();
           }
       }) ;
    });
</script>

<?php echo form_open('admin/save_avaliacao'); ?>
<input type="hidden" name="aluno_id" value="<?php echo $aluno['id']; ?>"/>
<?php if(isset($avaliacao)): ?>
<input type="hidden" name="avaliacao_id" value="<?php echo $avaliacao['id']; ?>" />
<?php endif; ?>


Nome: <?php echo $aluno['nome']; ?> <br/>
<hr/>
<div class="form-group">
    <label for="data_avaliacao">Data: <?php ?> </label> <?php if(isset($avaliacao)): echo $avaliacao['data_avaliacao']; else: echo date("d/m/Y", time()); endif;?>
</div>
<!-- tipos de avaliação -->
<div class="radio" <?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): ?>style="display: none;"<?php endif; ?>>
    <label>
        <input type="radio" name="tipo_avaliacao" id="optionsRadios1" class="radio_tipo" value="0" <?php if(!isset($avaliacao) || $avaliacao['tipo_avaliacao'] == 0): ?>checked<?php endif; ?>>3200 Metros
    </label>
</div>
<div class="radio" <?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 0): ?>style="display: none" <?php endif; ?>>
    <label>
        <input type="radio" name="tipo_avaliacao" id="optionsRadios2" value="1" class="radio_tipo" <?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): ?>checked<?php endif; ?>>Soccer Test
    </label>
</div>

<div class="form-group form-3200" <?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): ?>style="display: none;"<?php endif;?>>
    <label for="tempo ">Tempo: </label>
    <input type="text" name="3200_tempo" value="<?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): echo $avaliacao['3200_tempo']; endif;?>" />
</div>
<div class="form-group form-soccer" <?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): ?>style="display: block;"<?php else: ?> style="display: none;"<?php endif;?>>
    <label for="soccer_estagio">Estágio:</label>
    <input type="text" name="soccer_estagio" class="form-control" value="<?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): echo $avaliacao['soccer_estagio']; endif;?>"/>
</div>

<div class="form-group form-soccer" <?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): ?>style="display: block;"<?php else: ?> style="display: none;"<?php endif;?>>
    <label for="soccer_frequencia">Frequência Cardíaca</label>
    <input type="text" name="soccer_frequencia" class="form-control" value="<?php if(isset($avaliacao) && $avaliacao['tipo_avaliacao'] == 1): echo $avaliacao['soccer_frequencia']; endif;?>"/>
</div>


<input type="submit" value="Enviar Avaliação" class="btn btn-success" />

</form>