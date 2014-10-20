<?php
if(isset($edit)){
 $action=siteUrlCounter('newTransaksi','edit=1');
 $noTrans="";
 $title_head="Edit Deposit";
}else{
 $noTrans=$no;
 $action='';
 $title_head="New Deposit";
}
?>
<script>
 $('.date').datepicker();
</script>
	<div id="content" class="span10">
	<!-- content starts -->
	<?php  get_content_menu_atas("Pulsa","New Deposit"); ?>
	
	<div class="row-fluid sortable">
		<div class="box span4">
		 <div class="box-header well">
			<h2><i class="icon-th"></i> <?php echo $title_head; ?></h2>
			<div style="float:right;left:200px;">
			 <a class="btn" href="<?php echo siteUrlCounter('view_transaksi_deposit'); ?>">
				<i class="icon-edit icon-white"></i>
				View
			 </a>
			 <a class="btn" href="<?php echo siteUrlCounter('newTransaksi'); ?>">
				<i class="icon-edit icon-white"></i>  
				New
			 </a>
			</div>
		 </div>
		<div class="box-content">
			<div id="myTabContent" class="tab-content">
			 <div class="box-content">
			  	<div style="right:70px;position:absolute;margin-top:-20px;"><b>Saldo Server :</b> <?php if(isset($saldo_server)) echo str_replace(',','.',number_format($saldo_server)); ?></div>
				<form class="form-horizontal" method="POST" action="<?php echo $action; ?>">
				  <fieldset>
					<div class="alert alert-info">
					<?php
					if(isset($err) AND $err!=""){
					echo "<b style='color:red;'>$err</b>";
					}elseif(isset($success)){
					echo $success;
					}else{
					echo "Isikan kolom Sesuai Dengan namanya.";
					}
					?>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Transaksi Id </label>
					  <div class="controls">
						<input type="text" readonly='true' value="<?php echo $noTrans; ?>" name='id' autocomplete=off >
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Agent</label>
					  <div class="controls">
						<?php 
						$arr_agen[""]="Pilih Agent";
						foreach($agent->result() as $r){
						 $arr_agen[$r->user_agent]=$r->user_agent." | ".$r->name;
						}
						echo form_dropdown('agent',$arr_agen,''); ?>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Nominal</label>
					  <div class="controls">
						<input type="text" value="<?php echo ''; ?>" name='nominal'>
					  </div>
					</div>
					<div class="form-actions">
					  <button type="submit" class="btn btn-primary">Save changes</button>
					  <button type="reset" class="btn" onclick="history.go(-1);">Cancel</button>
					</div>
				  </fieldset>
				</form>   
			 </div>
			</div>
		  </div>
		</div><!--/span-->
		
				
		</div><!--/fluid-row-->
<?php get_footer_content(); ?>

</div><!--/.fluid-container-->


		
</body>
</html>
