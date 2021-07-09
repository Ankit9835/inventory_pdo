			<footer class="main-footer">
				<div class="pull-right hidden-xs"><b>Version</b> 2.4.0</div>
				<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Ankit Sinha</a>.</strong> All rights reserved.
			</footer>
		</div>		
		<!-- ./wrapper -->
		<!-- jQuery 3 -->
		<script src="plugins/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
				<!-- iCheck -->
		<script src="file/iCheck/icheck.min.js"></script>

		
		<!-- DataTables -->
		<script src="plugins/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

		<script src="plugins/select2/dist/js/select2.full.min.js"></script>
		
		<!-- SlimScroll -->
		<script src="plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="plugins/fastclick/lib/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="assets/js/adminlte.min.js"></script>


		<!-- AdminLTE for demo purposes -->
		<script src="assets/js/demo.js"></script>
		<!-- page script -->
		<script>
		$(function () {
			$('#example1').DataTable()
			$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
			})
		})
		</script>
	</body>
</html>