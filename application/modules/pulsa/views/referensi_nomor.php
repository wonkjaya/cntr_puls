			<div id="content" class="span10">
			<!-- content starts -->
			<?php  get_content_menu_atas("Pulsa","Referensi Nomor"); ?>
			
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well">
						<h2><i class="icon-th"></i> Nomor referensi</h2>
						<div style="float:right;left:200px;">
						 <a class="btn" href="<?php echo siteUrlCounter('numberReferences'); ?>">
							<i class="icon-zoom-in icon-white"></i>  
							View                   
						 </a>
						 <a class="btn" href="<?php echo siteUrlCounter('register_references'); ?>">
							<i class="icon-edit icon-white"></i>  
							New Type                                  
						 </a>
						</div>
					</div>
					<div class="box-content">
						<div id="myTabContent" class="tab-content">
						<?php 
							if (isset($nomor)){
							 get_table_references($nomor);
							}
							if (isset($new)){
							 get_register_references($provider);
							}
						?>
						</div>
					</div>
				</div><!--/span-->
				
<script>
	function deleteConfirm(d){
	 var url="<?php echo site_url('pulsa/main/delete_nomor/'.'" + d + "'); ?>";
	 var alt=confirm("Hapus???");
	 if (alt == true ){
		document.location(url);
	 }
	}
</script>				
				</div><!--/fluid-row-->
		<?php get_footer_content(); ?>		
		
	</div><!--/.fluid-container-->
</body>
</html>
