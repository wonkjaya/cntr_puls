
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
						<h2><i class="icon-th"></i> Data Agent</h2>
						<div style="float:right;left:200px;">
						 <a class="btn" href="<?php echo siteUrlCounter('agents'); ?>">
							<i class="icon-zoom-in icon-white"></i>  
							View                   
						 </a>
						 <a class="btn" href="<?php echo siteUrlCounter('register_newAgent'); ?>">
							<i class="icon-edit icon-white"></i>  
							New User                             
						 </a>
						</div>
					</div>
					<div class="box-content">
						<div id="myTabContent" class="tab-content">
						<script>
						 function delete_confirm(id){
						  var cdelete=confirm("Hapus Agent Dengan Kode Agent ("+id+")");
						  var url="<?php echo siteUrlCounter('deleteUser','id=" + id + "');?>";
						  if(cdelete==true){
						   window.location=url;
						  }
						 }
						</script>
						<?php 
							get_table_content_of_agents($agent_datas,$this->input->get('nama'));
						?>
						</div>
					</div>
				</div><!--/span-->
				
						
				</div><!--/fluid-row-->

		<?php get_footer_content(); ?>
		
	</div><!--/.fluid-container-->
		
</body>
</html><d
