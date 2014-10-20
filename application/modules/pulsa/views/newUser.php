<script>
var state="<?php echo $red; ?>";
var url="<?php echo siteUrlCounter('register_newAgent','created'); ?>";
if (state == 1){
 setTimeOut(function(){window.location=url},3000);
}
</script>

<?php 
if(isset($edit_data)){
 foreach($edit_data->result() as $r){
	$lastName=ucwords($r->user_agent);
	$nama=ucwords($r->name);
	$privatecode=$r->code;
	$saldo=$r->saldo;
	$nomor=$r->nomorHp;
	$action=siteUrlCounter('editUser','act=update&id='.$lastName);
	$arr=array('0'=>'Not active','1'=>'Active','2'=>'Banned');
	$activated='
	<div class="control-group">
	  <label class="control-label" for="typeahead">Status</label>
	  <div class="controls">'.
	   form_dropdown('activated',$arr,$r->activated)
	  .'</div>
	</div>';
	$head_title="Edit New Agent";
 }

}else{
	$username='';
	$nama='';
	$code='';
	$saldo='';
	$nomor="";
	$action=siteUrlCounter('register_newAgent');
	$activated='';
	$lastName=$ctrl->getUsernameForNewUser();
	$privatecode=$ctrl->getPrivateCode();
	$head_title="Insert New Agent";
}
 ?>

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
						<h2><i class="icon-th"></i> <?php echo $head_title; ?></h2>
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
								  <label class="control-label" for="typeahead">Username </label>
								  <div class="controls">
									<input type="text" readonly='true' value="<?php echo $lastName; ?>" name='username' class="span6 typeahead" id="typeahead" autocomplete=off data-provide="typeahead" data-items="4" data-source=''>
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Nomor Hp </label>
								  <div class="controls">
									<input type="text" value="<?php echo $nomor; ?>" name='nomor' class="span6 typeahead" id="typeahead" autocomplete=off data-provide="typeahead" data-items="4" >
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Nama</label>
								  <div class="controls">
									<input type="text" name='nama' autocomplete=off class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source="[<?php echo autocomplete_userAgent(); ?>]" value="<?php echo $nama; ?>">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Kode Rahasia</label>
								  <div class="controls">
									<input type="text" value="<?php echo $privatecode; ?>" name='code' class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Saldo Awal</label>
								  <div class="controls">
									<input type="text" name="saldo" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source="<?php  ?>" value="<?php echo $saldo; ?>">
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
