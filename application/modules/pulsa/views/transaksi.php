<script>
	function sendAgain(ID,classname,no){
	 var confr=confirm("Kirim Ulang Transaksi dengan id= " + ID + classname + "???");
	 var url="<?php echo siteUrlCounter('kirim_ulang_topup','id="+ ID +"&classno="+ no +"'); ?>";
	 if (confr == true){
	  execution_script(classname,url);
	  $(classname).attr("id","cancel" + no);
	 }
	}
	
	function cancel(ID,classname,no){
	 var url="<?php echo siteUrlCounter('cancel_topup','id="+ ID +"&classno="+ no +"'); ?>";
	 var conf=confirm("Cancel Transaksi dengan id= " + ID + classname +"???");
	 if (conf == true){
	  execution_script(classname,url);
	  $(classname).attr("id","sendAgain" + no);
	 }
	}

	function denied(){
	 alert("Anda Tidak Mempunyai akses untuk menhapus data ini");
	}
	
	function execution_script(classname,url){
	 $(classname).load(url);
	}
</script>
			<div id="content" class="span10">
			<!-- content starts -->
			<?php  get_content_menu_atas("Pulsa","TopUp"); ?>
			
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well">
						<h2><i class="icon-th"></i> TopUp</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div id="myTabContent" class="tab-content">
						<?php 
							get_table_content_of_transaksi_topup($transaksi_topup);
						?>
						</div>
					</div>
				</div><!--/span-->
				
						
				</div><!--/fluid-row-->
			<?php get_footer_content(); ?>
	</div><!--/.fluid-container-->

		
</body>
</html>
