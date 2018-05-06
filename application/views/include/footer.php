  <div align="center" style="margin-top:10px; padding:20px;">&copy; Copyright <?php echo date("Y"); ?>. Developed by <a href="https://ittraders.net" target="_blank" title="ITtraders Pvt Ltd development free portfolio">ITtraders Pvt Ltd</a></div>
  
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/rwd-table.js?v=5.3.1"></script>
        <script>
            $(function() {
                $('#bs-deps').on('hide.bs.collapse show.bs.collapse', function () {
                    $('#bs-deps-toggle').children('span').toggleClass('fa-chevron-down').toggleClass('fa-chevron-up');
                })
            });
        </script>
    </body>
</html>

