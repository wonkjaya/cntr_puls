<script>
var state="<?php echo $red; ?>";
var url="<?php echo siteUrlCounter('register_newAgent','created'); ?>";
if (state == 1){
 setTimeOut(function(){window.location=url},3000);
}
</script>

<?php 
foreach($prov->result() as $d){
 $arr_type[$d->kode_provider]=ucwords($d->nama_provider);
}

if(isset($edit)){
 foreach($type->result() as $r){
	$kode=$r->ID_jenis;
	$prov=$r->kode_provider;
	$nominal=$r->nominal;
	$hj=$r->harga_jual;
	$hb=$r->harga_beli;
	$action=siteUrlCounter('editType','id='.$kode);
	$arr=array('0'=>'Not active','1'=>'Active');
	$activated='
	<div class="control-group">
	  <label class="control-label" for="typeahead">Status</label>
	  <div class="controls">'.
	   form_dropdown('status',$arr,$r->status)
	  .'</div>
	</div>';
	$readOnly='readonly';
 }

}else{
	$kode='';
	$prov='';
	$nominal='';
	$hj='';
	$hb='';
	$action=siteUrlCounter('register_newType');
	$arr=array('0'=>'Not active','1'=>'Active');
	$activated='
	<div class="control-group">
	  <label class="control-label" for="typeahead">Status</label>
	  <div class="controls">'.
	   form_dropdown('status',$arr,'')
	  .'</div>
	</div>';
	$readOnly='';
}
 ?>

	<div id="content" class="span10">
	<!-- content starts -->
	<?php  get_content_menu_atas("Pulsa","Agent"); ?>
	
	<div class="row-fluid sortable">
		<div class="box span4">
		 <div class="box-header well">
			<h2><i class="icon-th"></i> Data Type</h2>
			<div style="float:right;left:200px;">
			 <a class="btn" href="<?php echo siteUrlCounter('trxType'); ?>">
				<i class="icon-zoom-in icon-white"></i>  
				View                   
			 </a>
			 <a class="btn" href="<?php echo siteUrlCounter('register_newType'); ?>">
				<i class="icon-edit icon-white"></i>  
				New User                                  
			 </a>
			</div>
		 </div>
			<div class="box-content">
			 <div id="myTabContent" class="tab-content">
				<div class="box-content">
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
					  <label class="control-label" for="typeahead">Kode Type </label>
					  <div class="controls">
						<input type="text" <?php echo $readOnly; ?> maxlength=10 value="<?php echo $kode; ?>" name='kode' class="span6 typeahead" id="typeahead" autocomplete=off data-provide="typeahead" data-items="4" data-source=''>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Nama Provider </label>
					  <div class="controls">
						<?php echo form_dropdown('nama',$arr_type,$prov); ?>
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Nominal</label>
					  <div class="controls">
						<input type="text" name='nominal' autocomplete=off class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $nominal; ?>">
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Harga Beli</label>
					  <div class="controls">
						<input type="text" name='hbeli' autocomplete=off class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $hb; ?>">
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Harga Jual</label>
					  <div class="controls">
						<input type="text" name='hjual' autocomplete=off class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $hj; ?>">
					  </div>
					</div>
					  <?php echo $activated; ?>	
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
</html><d
