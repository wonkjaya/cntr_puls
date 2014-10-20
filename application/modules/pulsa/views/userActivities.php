
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php  get_content_menu_atas("Pulsa","Agent"); ?>
			
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well">
						<h2><i class="icon-th"></i> Aktivitas User</h2>
						<div style="float:right;left:200px;">
						 <a class="btn" href="<?php echo siteUrlCounter('AktivitasUser','id='.$id.'&clue=topup'); ?>">
							<i class="icon-zoom-in icon-white"></i>  
							 TopUp                   
						 </a>
						 <a class="btn" href="<?php echo siteUrlCounter('AktivitasUser','id='.$id.'&clue=deposit'); ?>">
							<i class="icon-edit icon-white"></i>  
							  Deposit                          
						 </a>
						</div>
					</div>
					<div class="box-content">
						<div id="myTabContent" class="tab-content">
						<script>
						 function denied(){
						  alert("Anda Tidak Berhak Menghapus Data Ini, Harap Hubungi Admin");
						 }
						</script>
						<?php 
						if(isset($clue) and $clue=="topup"){
							get_table_content_of_transaksi_topup($activities,$this->input->get('id'));
						}else{
							get_table_content_of_deposit($activities,$this->input->get('id'));
						
						}
						?>
						</div>
					</div>
				</div><!--/span-->
				
						
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://usman.it" target="_blank">Muhammad Usman</a> 2012</p>
			<p class="pull-right">Powered by: <a href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
		</footer>
		
	</div><!--/.fluid-container-->
		
</body>
</html><d
