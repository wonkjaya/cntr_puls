<script>
function deleteConfirm(id){
 var conf=confirm("Hapus Proveder ("+ id +")");
 if (conf == true){
  document.location="<?php echo siteUrlCounter('deleteProvider','id="+ id +"'); ?>";
 }
}
</script>
			<div id="content" class="span10">
			<!-- content starts -->

			<?php  get_content_menu_atas("Pulsa","provider"); ?>

			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well">
						<h2><i class="icon-th"></i>Data Provider</h2>
						<div style="float:right;left:200px;">
						 <a class="btn" href="<?php echo siteUrlCounter('providers'); ?>">
							<i class="icon-zoom-in icon-white"></i>  
							View                   
						 </a>
						 <a class="btn" href="<?php echo siteUrlCounter('register_newProvider'); ?>">
							<i class="icon-edit icon-white"></i>  
							New User                                  
						 </a>
						</div>
					</div>
					<div class="box-content">
						<div id="myTabContent" class="tab-content">
						<?php 
						if (isset($edit)){
							edit_provider($provider);
						}else{
							get_providers($provider_datas); 
						}?>
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
