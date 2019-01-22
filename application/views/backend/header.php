<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo PROYECTO_NOMBRE; ?> :: <?php echo $titlePage; ?> </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        
         <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <!-- MetisMenu CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/metisMenu/dist/metisMenu.min.css'); ?>">
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tirexpress/css/sb-admin-2.css'); ?>" >
        <!-- Morris Charts CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/morrisjs/morris.css'); ?>" >
        <!-- Custom Fonts -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bower_components/font-awesome/css/font-awesome.min.css'); ?>" >
        <?php /*
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Dosis:300,400,500">
        */ ?>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Maven+Pro">



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


        <?php if ( ( $this->router->method != "verUsuariosOnline" ) || ( $this->router->method != "verUsuariosOnline" ) ): ?>
            <?php if (isset($css_files)): ?>
                <!-- grocerycrud -->
                <?php foreach($css_files as $file): ?>
                    <link rel="stylesheet" type="text/css" href="<?php echo $file; ?>" />
                <?php endforeach; ?>
                <!-- grocerycrud -->
            <?php endif ?>
        <?php endif ?>


        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tirexpress/css/estilo-admin.css'); ?>">

        <!-- The fav icon -->
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/tirexpress/img/favicon.png'); ?>">

        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';

            var js_site_url = function( urlText ){
                var urlTmp = "<?php echo site_url('" + urlText + "'); ?>";
                return urlTmp;
            }

            var js_base_url = function( urlText ){
                var urlTmp = "<?php echo base_url('" + urlText + "'); ?>";
                return urlTmp;
            }
        </script>

    </head>
    <body>
        <div id="wrapper">