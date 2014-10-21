<script>
var state="<?php echo $red; ?>";
var url="<?php echo siteUrlCounter('register_newAgent','created'); ?>";
if (state == 1){
 setTimeOut(function(){window.location=url},3000);
}
</script>

<?php 
if(isset($edit)){
 foreach($provider->result() as $r){
	$kode=$r->kode_provider;
	$nama=$r->nama_provider;
	$nomor=$r->nomor;
	$saldo=$r->sisa_saldo;
	$action=siteUrlCounter('editProvider','id='.$kode);
	$arr=array('0'=>'Not active','1'=>'Active');
	$activated='
	<div class="control-group">
	  <label class="control-label" for="typeahead">Status</label>
	  <div class="controls">'.
	   form_dropdown('status',$arr,$r->status)
	  .'</div>
	</div>';
	$head_title="Edit New Agent";
	$readonly="readonly='true'";
 }

}else{
	$kode='';
	$nama='';
	$nomor='';
	$saldo='';
	$status='';
	$action=siteUrlCounter('register_newProvider');
	$arr=array('0'=>'Not active','1'=>'Active');
	$activated='
	<div class="control-group">
	  <label class="control-label" for="typeahead">Status</label>
	  <div class="controls">'.
	   form_dropdown('status',$arr,'')
	  .'</div>
	</div>';
	$head_title="Insert New Provider";
	$readonly="";
}
 ?>

			<div id="content" class="span10">
			<!-- content starts -->
			<?php  get_content_menu_atas("Pulsa","Agent"); ?>
			
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well">
						<h2><i class="icon-th"></i><?php echo $head_title; ?></h2>
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
								  <label class="control-label" for="typeahead">Kode Provider </label>
								  <div class="controls">
									<input type="text" value="<?php echo $kode; ?>" name='kode' class="span6 typeahead" id="typeahead" autocomplete=off <?php echo $readonly; ?>>
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Nama Provider </label>
								  <div class="controls">
									<input type="text" value="<?php echo $nama; ?>" name='nama' class="span6 typeahead" id="typeahead" autocomplete=off data-provide="typeahead" data-items="4" >
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Nomor Provider</label>
								  <div class="controls">
									<input type="text" name='nomor' autocomplete=off class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $nomor; ?>">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Sisa Saldo</label>
								  <div class="controls">
									<input type="text" name='saldo' autocomplete=off class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" value="<?php echo $saldo; ?>">
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
