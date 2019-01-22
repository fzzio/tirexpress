        </div><!-- fin #wrapper -->

        <div class="modal fade" id="cdrModal" tabindex="-1" role="dialog" aria-labelledby="cdrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3 id="cdrModalTitle"></h3>
                    </div>
                    <div class="modal-body" id="cdrModalMensaje">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-wbx2" data-dismiss="modal" id="cdrModalCerrar">Cerrar</a>
                    </div>
                </div>
            </div>
        </div><!-- fin #cdrModal -->


        <div class="container-fluid">
            <hr>
            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">
                    &copy; <a href="<?php echo PROYECTO_DESARROLLADOR_LINK; ?>" target="_blank"><?php echo PROYECTO_DESARROLLADOR; ?></a> <?php echo date('Y') ?>
                </p>

                <p class="col-md-3 col-sm-3 col-xs-12 powered-by">
                    Desarrollado por: <strong><?php echo PROYECTO_AUTOR; ?></strong>
                </p>
            </footer>
        </div><!-- fin container-fluid-->

        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>        
        <!-- Custom Theme JavaScript -->
        <script type="text/javascript" src="<?php echo base_url('assets/tirexpress/js/sb-admin-2.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('assets/tirexpress/js/script-admin.js'); ?>"></script>

    </body>
</html>