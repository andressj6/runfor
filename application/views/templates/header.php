<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RunFor </title>

    <!-- Bootstrap -->
    <link href="/runfor/css/bootstrap.min.css" rel="stylesheet">
    <link href="/runfor/css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/runfor/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        $admin_info = $this->session->userdata('admin_info');
        $is_admin = strpos($this->uri->uri_string(),'admin') > -1;
        if(!$is_admin || (!isset($admin_info) || $admin_info['logged_in'] == FALSE)) :
    ?>
    <?php else :?>
    <style type="text/css">
        body {
            padding-top: 50px;
        }
    </style>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">RunFor</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><?php echo anchor('/admin/listar_alunos', "Alunos"); ?></li>
                    <li><?php echo anchor('/admin/logout', 'Logout'); ?></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
    <?php endif; ?>

    <div class="main-content">
        <h1>RunFor</h1>