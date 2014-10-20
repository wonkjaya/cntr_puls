<?php

function jqueryUI(){
  echo "<script src='". base_url('assets/js/jquery-1.7.2.min.js')."'></script>";
  echo "<script src='". base_url('assets/js/jquery-ui-1.8.21.custom.min.js')."'></script>";
}

function get_table_content_of_agents($datas,$val){
 echo "<table width='100%' border='1'>";
 echo "<tr> <th colspan=10 style='text-align:left'>
 	<a class='btn' href='?new=1' style='float:left'> <i class='icon-download-alt icon-black'></i></a>
 	<a class='btn' href='?refresh' style='float:left'> <i class='icon-refresh icon-black'></i></a>
 	<form method='GET' style='float:left;width:400px'>
	  <div class='controls'>
		&nbsp;<input style='float:left;width:200px' type='text' name='nama' class='span6 typeahead' id='typeahead'  data-provide='typeahead' data-items='4' value=".$val.">
		<input type='submit' class='btn btn-primary' value='cari'>
	  </div>
 	</form>
 	 </th> </tr>";
 echo "<tr> <th>NO</th> <th>Username</th> <th>Nomor</th> <th>Nama Cell</th> <th>Code-auth</th> <th>Saldo</th> 
 	<th>Status</th> <th colspan=3>Actions</th> </tr>";
 $no=1;
 foreach($datas->result() as $r){
 	$nomor="<b>".substr($r->nomorHp,0,4)." - </b>".substr($r->nomorHp,4,12);
 	$name=ucwords($r->name);
 	$user=ucwords($r->user_agent);
 	$code=$r->code;
 	$saldo=str_replace(',','.',number_format($r->saldo));
 	$active=$r->activated;
 	if($no%2 == 1 )$bg="";else $bg="#ABCBDB";
 	if($active == 0){$activated="Not Active"; $bgc="red";}elseif($active == 1){$activated="Active"; $bgc="green";}else{$activated="Banned";$bgc="yellow";}
 	echo "<tr bgcolor=".$bg."> <td>".$no."</td> <td>".$user."</td> <td>".$nomor."</td> <td>".$name."</td> <td>".$code.
 		"</td> <td style='text-align:right'>".$saldo."</td> <td style='text-align:center;color:$bgc'>".$activated."</td> 
 		<td width=40><a class='btn' href='".siteUrlCounter('editUser','id='.$r->user_agent)."' title='Edit User'><i class='icon-edit icon-black'></i></a></td> 
 		<td width=40><a class='btn' href='#' onclick='delete_confirm(\"$r->user_agent\")' title='Delete User'><i class='icon-remove icon-black'></i></a></td>
 		<td width=40><a class='btn' href='".siteUrlCounter('AktivitasUser','id='.$r->user_agent)."' title='Aktivitas'><i class='icon-zoom-in icon-black'></i></a></td> </tr>";
 	$no++;
 	
 }
 echo "<tr>
 	<td colspan=10>
 	 &nbsp;
 	</td>
 	</tr>";
 echo "</table>";
}

function get_table_content_of_deposit($datas,$val=""){
 echo "<table width='96%' border='1'>";
 echo "<tr> <th colspan=9 style='text-align:left'>
 	<form method='GET' style='float:left;width:400px'>
	  <div class='controls'>
		&nbsp;<input style='float:left;width:200px' type='text' name='id' 
		class='span6 typeahead' id='typeahead'  data-provide='typeahead' 
		data-items='4' value=".$val.">
		<input type='submit' class='btn btn-primary' value='cari'>
	  </div>
 	</form>
 	 </th> </tr>";
 echo "<tr> <th>ID</th> <th>Ref. Trans</th> <th>Tanggal</th> <th>Kasir</th> <th>User Agent</th>
 	<th>Nominal </th> <th>Status</th> <th colspan=2>Actions</th> </tr>";
 $no=1;
 foreach($datas->result() as $r){
 	$ID=$r->ID_deposit;
 	$tgl=$r->tanggal_deposit;
 	$user="<b>".ucwords($r->user_agent)."</b>";
 	$user_kasir=$r->username;
 	$nominal=str_replace(',','.',number_format($r->nominal));
 	$st=$r->status;
	$remove= "onclick=deleteRecord('$ID');";
 	if($no%2 == 1)$bg="#ABCBDB";else $bg="";
 	if($st == 0){
 		$link="sendAgain('$ID','#sendAgain$no',$no);";
 		$id="id='sendAgain$no'";
 		$status="<b style='color:red;'>Not Send</b>";
 		$object="<i class='icon-refresh icon-black' onclick=".$link." title='Kirim Ulang'></i>";
 		$remove= "onclick=deleteRecord('$ID','#sendAgain$no');";
 	}elseif($st==1){
 		$link="Success('$ID');";
 		$id='';
 		$status="<b style='color:green;' >Terkirim</b>";
 		$object="<i class='icon-edit icon-black' onclick=".$link." title='Terkirim'></i>"; 
 		$remove= "onclick=denied();";
 	}elseif($st==3){ //status dalam keadaan sedang menunggu status pesan terkirim Pada perangkat 
 		$link="";
 		$id='';
 		$status="<b style='color:green;' >Wait...</b>";
 		$object="<i class='icon-edit icon-black' title='Terkirim'></i>"; 
 		$remove= "onclick=denied();";
 	}else{
 		$link="cancel('$ID','#cancel$no',$no);";
 		$id="id='cancel$no'";
 		$status="<b style='color:yellow;'>Pending</b>";
 		$object="<i class='icon-minus-sign icon-black' onclick=".$link." title='Batalkan'></i>";
 		$remove= "onclick=deleteRecord('$ID','#cancel$no');";
 		
 	}
 	echo "<tr bgcolor='".$bg."' $id> <td>".$no."</td> <td>".$ID."</td> <td>".$tgl."</td> <td>".$user_kasir."</td> <td>".$user.
 		"</td> <td style='text-align:right'>".$nominal."</td> <td style='text-align:center'>".$status."</td> 
 		<td width=40><a class='btn' onclick=".$link.">".$object."</a></td> 
 		<td width=40><a class='btn' $remove><i class='icon-remove icon-black'></i></a></td> </tr>";
 	$no++;
 }
 echo "<tr><td colspan='9'></td></tr></table>";
}

function getDepositContentWhere($data,$no){
 foreach($data->result() as $r){
  $ID=$r->ID_deposit;
  $tgl=$r->tanggal_deposit;
  $user="<b>".ucwords($r->user_agent)."</b>";
  $user_kasir=$r->username;
  $nominal=str_replace(',','.',number_format($r->nominal));
  $st=$r->status;
  
  if($no%2 == 1)$bg="#ABCBDB";else $bg="";
 	if($st == 0){
 		$link="sendAgain('$ID','#sendAgain$no',$no);";
 		$id="id='sendAgain$no'";
 		$status="<b style='color:red;'>Not Send</b>";
 		$object="<i class='icon-refresh icon-black' onclick=".$link." title='Kirim Ulang'></i>";
 		$remove= "onclick=deleteRecord('$ID','#sendAgain$no');";
 	}elseif($st==1){ // kedaan pesan sudah terkirim dan mendapat respon berhasil
 		$link="Success('$ID');";
 		$id='';
 		$status="<b style='color:green;' >Terkirim</b>";
 		$object="<i class='icon-edit icon-black' onclick=".$link." title='Terkirim'></i>"; 
 		$remove= "onclick=denied();";
 	}elseif($st==3){ //status dalam keadaan sedang menunggu balasan dari server pusat
 		$link="";
 		$id='';
 		$status="<b style='color:green;' >Wait...</b>";
 		$object="<i class='icon-edit icon-black' title='Terkirim'></i>"; 
 		$remove= "onclick=denied();";
 	}else{
 		$link="cancel('$ID','#cancel$no',$no);";
 		$id="id='cancel$no'";
 		$status="<b style='color:yellow;'>Pending</b>";
 		$object="<i class='icon-minus-sign icon-black' onclick=".$link." title='Batalkan'></i>";
 		$remove= "onclick=deleteRecord('$ID','#cancel$no');";
 	}
 	echo "<td>".$no."</td> <td>".$ID."</td> <td>".$tgl."</td> <td>".$user_kasir."</td> <td>".$user.
 		"</td> <td style='text-align:right'>".$nominal."</td> <td style='text-align:center'>".$status."</td> 
 		<td width=40><a class='btn' onclick=".$link.">".$object."</a></td> 
 		<td width=40><a class='btn' $remove><i class='icon-remove icon-black'></i></a></td> ";
 }
}

function get_table_content_of_transaksi_topup($datas,$values_forSearch=""){
 echo "<table width='96%' border='1'>";
 echo "<tr> <th colspan=9 style='text-align:left'>
 	 <form method='GET' style='float:left;width:400px'>
	  <div class='controls'>
		&nbsp;<input style='float:left;width:200px' type='text' name='nama' class='span6 typeahead' id='typeahead'  data-provide='typeahead' data-items='4' value=".$values_forSearch.">
		<input type='submit' class='btn btn-primary' value='cari'>
	  </div>
 	</form>
 	</th> </tr>";
 echo "<tr> <th>ID</th> <th>No-transaksi</th> <th>Tanggal</th> <th>User Agent</th>
 	<th>Type-TRX</th> <th>Status</th> <th colspan=2>Actions</th> </tr>";
 $no=1;
 foreach($datas->result() as $r){
 	$no_transaksi=$r->no_transaksi;
 	$tgl=$r->tanggal;
 	$user=$r->user_agent;
 	//$kode_server=$r->kode_server;
 	$trx_type=$r->kode_type;
 	$st=$r->status;
 	if($no%2 == 1)$bg="#ABCBDB";else $bg="";
 	if($st == 0){
 		$link="sendAgain('$no_transaksi','#sendAgain$no',$no);";
 		$id="id='sendAgain$no'";
 		$status="<b style='color:red;'>Not Send</b>";
 		$object="<i class='icon-refresh icon-black' onclick=".$link." title='Kirim Ulang'></i>";
 		$remove= "onclick=denied();";
 	}elseif($st==1){ // kedaan pesan sudah terkirim dan mendapat respon berhasil
 		$link="Success('$no_transaksi');";
 		$id='';
 		$status="<b style='color:green;' >Terkirim</b>";
 		$object="<i class='icon-edit icon-black' onclick=".$link." title='Terkirim'></i>"; 
 		$remove= "onclick=denied();";
 	}elseif($st==3){ //status dalam keadaan sedang menunggu balasan dari server pusat
 		$link="";
 		$id='';
 		$status="<b style='color:green;' >Wait...</b>";
 		$object="<i class='icon-edit icon-black' title='Terkirim'></i>"; 
 		$remove= "onclick=denied();";
 	}else{
 		$link="cancel('$no_transaksi','#cancel$no',$no);";
 		$id="id='cancel$no'";
 		$status="<b style='color:yellow;'>Pending</b>";
 		$object="<i class='icon-minus-sign icon-black' onclick=".$link." title='Batalkan'></i>";
 		$remove= "onclick=denied();";
 	}
 	echo "<tr bgcolor='".$bg."' $id> <td>".$no."</td> <td>".$no_transaksi."</td> <td>".$tgl."</td> 
 		<td>".$user."</td>  <td>".$trx_type."</td>
 		<td style='text-align:center'>".$status."</td>
 		<td width=40><a class='btn'>$object</a></td> 
 		<td width=40><a class='btn' $remove><i class='icon-remove icon-black'></i></a></td> </tr>";
 	$no++;
 }
 echo "</table>";
}

function get_trxType($datas){
 echo "<table width='96%' border='1'>";
 echo "<tr> <th>ID</th> <th>Type</th> <th>Provider</th> <th>Nominal</th> <th>Harga Jual</th> <th>Harga Beli</th>
 	<th>Hasil</th> <th>Status</th> <th colspan=3>Actions</th> </tr>";
 $no=1;
 foreach($datas->result() as $r){
 	$kodeTrx=$r->ID_jenis;
 	$nama=$r->nama_provider;
 	$harga_j=str_replace(',','.',number_format($r->harga_jual));
 	$nominal=str_replace(',','.',number_format($r->nominal));
 	$harga_b=str_replace(',','.',number_format($r->harga_beli));
 	$hasil=$r->harga_jual-$r->harga_beli;
 	$st=$r->status;
 	if($no%2 == 1)$bg="#ABCBDB";else $bg="";
 	if($st == 0)$status="<font color='red'>not active</font>"; else $status="active";
 	echo "<tr bgcolor=".$bg."> <td>".$no."</td> <td>".$kodeTrx."</td> <td>".$nama."</td> 
 		<td style='text-align:right'>".$nominal.
 		"</td> <td style='text-align:right'>".$harga_j."</td>
 		<td style='text-align:right'>".$harga_b."</td>
 		<td style='text-align:right'>"."+ ".$hasil."</td>
 		<td style='text-align:center'>".$status."</td>
 		<td width=40><a class='btn' href='".siteUrlCounter('editType','id='.$kodeTrx)."'><i class='icon-edit icon-black'></i></a></td> 
 		<td width=40><a class='btn' href='".siteUrlCounter('removeTRX','id='.$kodeTrx)."'><i class='icon-remove icon-black'></i></a></td> </tr>";
 	$no++;
 }
 echo "</table>";
}


function get_providers($datas){
 echo "<table width='70%' border='1'>";
 echo "<tr> <th>ID</th> <th>Kode</th> <th>Nama Provider</th> <th>Nomor</th> <th>Sisa Saldo</th> <th>Status</th> <th colspan=2>Actions</th> </tr>";
 $no=1;
 if($datas->num_rows() > 0)
 foreach($datas->result() as $r){
 	$kode=$r->kode_provider;
 	$nama=$r->nama_provider;
 	$nomor=$r->nomor;
 	$st=$r->status;
 	$sisa=number_format($r->sisa_saldo);
 	if($no%2 == 1)$bg="#ABCBDB";else $bg="";
 	if($st == 0)$status="<font color='red' >Nonaktif</font>"; else $status="Aktif";
 	echo "<tr bgcolor=".$bg."> <th>".$no."</th> <td>".$kode."</td> <td>".$nama."</td> <td>".$nomor."</td> <td style='text-align:right'>".$sisa." ,-</td> <td>".$status."</td>
 		<td width=40><a class='btn' href='".siteUrlCounter('editProvider','id='.$kode)."'><i class='icon-edit icon-black'></i></a></td> 
 		<td width=40><a class='btn' onclick='deleteConfirm(\"$kode\");'><i class='icon-remove icon-black'></i></a></td> </tr>";
 	$no++;
 }
 echo "</table>";
}

function edit_provider($datas){
 echo "<table width='50%' border='1'>";
 $no=1;
 if($datas->num_rows() > 0)
 foreach($datas->result() as $r){
 	$kode=form_input('kode',$r->kode_provider,'readonly="true"');
 	$nama=form_input('nama',$r->nama_provider,'');
 	$nomor=form_input('nomor',$r->nomor,'');
 	$st=form_dropdown('status',array('0'=>'Deactive','1'=>'Active'),$r->status);
 	$submit=form_submit('submit','Update');
 	$sisa=form_input('saldo',$r->sisa_saldo);
 	echo form_open();
 	echo "<tr> 
 		<td>Kode</td>	<td>:</td>	<td>".$kode."</td> 
 		</tr><tr>
 		<td>Nama</td>	<td>:</td>	<td>".$nama."</td> 
 		</tr><tr>
 		<td>Nomor</td>	<td>:</td>	<td>".$nomor."</td> 
 		</tr><tr>
 		<td>Saldo</td>	<td>:</td>	<td>".$sisa." ,-</td>
 		</tr><tr>
 		<td>Status</td>	<td>:</td>	<td>".$st."</td>
 		</tr><tr>
 		<td></td>	<td></td>	<td>".$submit."<a class='btn' onclick='history.go(-1);'>Cancel</a></td>
 		</tr>";
 	echo form_close();
 }
 echo "</table>";
}


function get_table_references($datas){
 echo "<table width='70%' border='1'>";
 echo "<tr> <th>ID</th> <th>Prefix</th> <th>Jenis Provider</th> <th>Status</th> <th colspan=2>Actions</th> </tr>";
 $no=1;
 if($datas->num_rows() > 0)
 foreach($datas->result() as $r){
 	$id=$r->id_nomor;
 	$prefix=$r->prefix;
 	$kode_provider=ucwords($r->nama_provider);
 	$st=$r->status;
 	if($no%2 == 1)$bg="#ABCBDB";else $bg="";
 	if($st == 0)$status="<font color='red' >Nonaktif</font>"; else $status="Aktif";
 	echo "<tr bgcolor=".$bg."> <th>".$no."</th> <td>".$prefix."</td> <td>".$kode_provider."</td><td>".$status."</td>
 		<td width=40><a class='btn' href='".siteUrlCounter('editProvider','id='.$id)."'><i class='icon-edit icon-black'></i></a></td> 
 		<td width=40><a class='btn' onclick='deleteConfirm(\"$id\");'><i class='icon-remove icon-black'></i></a></td> </tr>";
 	$no++;
 }
 echo "</table>";
}

function get_register_references($data){
 foreach($data->result() as $r){
  $d[$r->kode_provider]=ucfirst($r->nama_provider);
 }
 echo "<table width='50%' border='0'>";
 	$prefix=form_input('prefix',"",'placeholder="0876"');
 	$kode=form_dropdown('kode_provider',$d,'');
 	$st=form_dropdown('status',array('0'=>'Deactive','1'=>'Active'),1);
 	$submit=form_submit('submit','Simpan');
 	echo form_open();
 	echo "<tr> 
 		<td>Prefix</td>		<td>:</td>	<td>".$prefix."</td> 
 		</tr><tr>
 		<td>kode Provider</td>	<td>:</td>	<td>".$kode."</td>
 		</tr><tr>
 		<td>Status</td>		<td>:</td>	<td>".$st."</td>
 		</tr><tr>
 		<td></td>		<td></td>	<td>".$submit."<a class='btn' onclick='history.go(-1);'>Cancel</a></td>
 		</tr>";
 	echo form_close();
 echo "</table>";
 }
 
 
 
 





//end of file table-helper.php
