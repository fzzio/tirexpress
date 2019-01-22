<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-cdr">
                <div class="panel-heading  text-center">
                    <img class="img-responsive obj-centrar" src="<?php echo base_url('assets/tirexpress/img/logo_llantas.png'); ?>">
                    <br />
                    <h4 class="panel-title">Por favor ingrese su usuario y contraseña:</h4>
                    <br />
                </div>
                <div class="panel-body">
                    <?php echo form_open('backend/autentificar' , array('class' => 'form-horizontal', 'id' => 'frm-login')); ?>  
                        <fieldset>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <?php echo form_input(array(
                                    'name' => 'email',
                                    'value' => '',
                                    'placeholder' => 'Email',
                                    'class' => 'form-control input-sgl',
                                ));?>
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <?php echo form_password(array(
                                    'name' => 'password',
                                    'value' => '',
                                    'placeholder' => 'contraseña',
                                    'class' => 'form-control input-sgl',
                                ));?>
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Recuerdame" id="remember"> Recuérdame
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="input-group pull-right">
                                <button type="submit" class="btn btn-cdr btn-sgl">Iniciar sesión</button>
                            </div>
                        </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>