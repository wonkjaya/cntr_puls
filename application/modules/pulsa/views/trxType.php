			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php  get_content_menu_atas("Pulsa","Daftar Harga"); ?>
			
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well">
						<h2><i class="icon-th"></i> TRX Type dan Harga</h2>
						<div style="float:right;left:200px;">
						 <a class="btn" href="<?php echo siteUrlCounter('trxType'); ?>">
							<i class="icon-zoom-in icon-white"></i>  
							View                   
						 </a>
						 <a class="btn" href="<?php echo siteUrlCounter('register_newType'); ?>">
							<i class="icon-edit icon-white"></i>  
							New Type                                  
						 </a>
						</div>
					</div>
					<div class="box-content">
						<div id="myTabContent" class="tab-content">
						<?php 
							get_trxType($trxType);
						
						?>
						</div>
					</div>
				</div><!--/span-->
				
						
				</div><!--/fluid-row-->
		<?php get_footer_content(); ?>		
		
	</div><!--/.fluid-container-->
</body>
</html><d
