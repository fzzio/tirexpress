        </div><!-- fin #wrapper -->


        <?php if (isset($js_files)): ?>
            <!-- grocerycrud -->
            <?php foreach($js_files as $file): ?>
                <script type="text/javascript" src="<?php echo $file; ?>"></script>
            <?php endforeach; ?>
            <!-- grocerycrud -->
        <?php endif ?>
        
        <!-- Bootstrap Core JavaScript -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script type="text/javascript" src="<?php echo base_url('bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>

        
        <!-- Custom Theme JavaScript -->
        <script type="text/javascript" src="<?php echo base_url('public/assets/js/sb-admin-2.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/assets/js/script-admin.js'); ?>"></script>
    </body>
</html>