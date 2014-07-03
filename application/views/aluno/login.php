<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RunFor </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
</head>
<body style="background: none;">
	<div class="container" style="background-color: #ccc; border-radius: 10px; margin-top: 50px; width: 300px;">
	<h2><img src="<?php echo base_url() ;?>images/logotipo.png" style="width: 180px;" /></h2>
		<a href="<?php echo site_url('aluno/novo'); ?>" class="btn btn-default btn-login">Cadastre-Se!</a>
		<hr />
		<form accept-charset="utf-8" method="post" action="<?php echo site_url('aluno/login_post')?>" class="form-signin">
			<?php echo validation_errors(); ?>

			<?php if(!empty($error)) : ?>
				<div class="alert alert-danger">
				    <?php echo $error; ?>
				</div>
			<?php endif; ?>

			<label for="email">Email:</label>
			<input type="email" class="form-control" name="email" /><br />

			<label for="senha">Senha:</label>
			<input type="password" class="form-control" name="senha" /><br />
			<a href="<?php echo site_url('aluno/forgotpassword'); ?>"> Esqueci minha senha </a>
			<div style="width: 100%; text-align: right;">
				<input class="btn btn-default btn-login" type="submit" name="submit" value="Entrar" />
			</div>

		</form>
		

	</div>
	</body>
</html>