
<script>
	function sendAgain(ID,classname,no){
	 var confr=confirm("Kirim Ulang Transaksi dengan id= " + ID + classname + "???");
	 var url="<?php echo siteUrlCounter('kirim_ulang_deposit','id="+ ID +"&classno="+ no +"'); ?>";
	 if (confr == true){
	  execution_script(classname,url);
	  $(classname).attr("id","cancel" + no);
	 }
	}
	
	function cancel(ID,classname,no){
	 var url="<?php echo siteUrlCounter('cancel_deposit','id="+ ID +"&classno="+ no +"'); ?>";
	// var conf=confirm("Cancel Transaksi dengan id= " + ID + classname +"???");
	 if (confirm("Cancel Transaksi dengan id= " + ID + classname +"???") === true){
	  execution_script(classname,url);
	  $(classname).attr("id","sendAgain" + no);
	 }
	}
	
	function deleteRecord(ID,classname){
	 var conf=confirm("Hapus Transaksi dengan id= " + ID + classname +"???");
	 var url="<?php echo siteUrlCounter('delete_deposit','id="+ ID +"'); ?>";
	 if (conf == true){
	  execution_script(classname,url);
	 }
	 
	}

	 function denied(){
	  alert("Anda Tidak Mempunyai akses untuk menhapus data ini");
	 }
	
	function execution_script(classname,url){
	 //alert(url);
	 $(classname).load(url);
	}
</script>
			<div id="content" class="span10">
			<!-- content starts -->
			<?php  get_content_menu_atas("Pulsa","Deposit"); ?>
			
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well">
						<h2><i class="icon-th"></i> Deposit Pulsa</h2>
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
						<?php 
							get_table_content_of_deposit($deposit_datas,$this->input->get('id'));
						?>
						</div>
					</div>
				</div><!--/span-->
				</div><!--/fluid-row-->
		<?php get_footer_content(); ?>
		
	</div><!--/.fluid-container-->

<script>
Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));
    
    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

$("#number").onChange(function (){
	numbers[i].format(2, 3, '.', ',')
});
</script>
		
</body>
</html>
