<?php

function get_content_menu_atas($menu1,$menu2){
 echo  "<div>
		<ul class='breadcrumb'>
			<li>
				<a href='#'>".$menu1."</a> <span class='divider'>/</span>
			</li>
			<li>
				<a href='#'>".$menu2."</a>
			</li>
		</ul>
	</div>";
}

function get_footer_content(){
echo '<footer>
		<p class="pull-left">&copy; <a href="#" target="_blank">REZSTORE</a> '.date('Y').'</p>
		<p class="pull-right">Powered by: <a href="#">Rohman Ahmad</a></p>
	</footer>';
}

function autocomplete_userAgent(){
  $a=array("'sdasd'","xvasd","bsasd","awasd","aqasd","'awasd'");
  foreach($a as $r){
   $r .=','.$r;
  }
  return $r;
}

function getExternalSource(){
 	echo "<script src='". base_url('assets/js/jquery-1.7.2.min.js')."'></script>";
 	echo "<script src='". base_url('assets/css-style/bootstrap-cerulean.css')."'></script>";
	# jQuery UI -->
	echo "<script src='". base_url('assets/js/jquery-ui-1.8.21.custom.min.js')."'></script>";
	# transition / effect library -->
	echo "<script src='". base_url('assets/js/bootstrap-transition.js')."'></script>";
	# alert enhancer library -->
	echo "<script src='". base_url('assets/js/bootstrap-alert.js')."'></script>";
	# modal / dialog library -->
	echo "<script src='". base_url('assets/js/bootstrap-modal.js')."'></script>";
	# custom dropdown library -->
	echo "<script src='". base_url('assets/js/bootstrap-dropdown.js')."'></script>";
	# scrolspy library -->
	echo "<script src='". base_url('assets/js/bootstrap-scrollspy.js')."'></script>";
	# library for creating tabs -->
	echo "<script src='". base_url('assets/js/bootstrap-tab.js')."'></script>";
	# library for advanced tooltip -->
	echo "<script src='". base_url('assets/js/bootstrap-tooltip.js')."'></script>";
	# popover effect library -->
	echo "<script src='". base_url('assets/js/bootstrap-popover.js')."'></script>";
	# button enhancer library -->
	echo "<script src='". base_url('assets/js/bootstrap-button.js')."'></script>";
	# accordion library (optional, not used in demo) -->
	echo "<script src='". base_url('assets/js/bootstrap-collapse.js')."'></script>";
	# carousel slideshow library (optional, not used in demo) -->
	echo "<script src='". base_url('assets/js/bootstrap-carousel.js')."'></script>";
	# autocomplete library -->
	echo "<script src='". base_url('assets/js/bootstrap-typeahead.js')."'></script>";
	# tour library -->
	echo "<script src='". base_url('assets/js/bootstrap-tour.js')."'></script>";
	# library for cookie management -->
	echo "<script src='". base_url('assets/js/jquery.cookie.js')."'></script>";
	# calander plugin -->
	echo "<script src='". base_url('assets/js/fullcalendar.min.js')."'></script>";
	# data table plugin -->
	echo "<script src='". base_url('assets/js/jquery.dataTables.min.js')."'></script>";/**/

	# chart libraries start -->
	echo "<script src='". base_url('assets/js/excanvas.js')."'></script>";
	echo "<script src='". base_url('assets/js/jquery.flot.min.js')."'></script>";
	echo "<script src='". base_url('assets/js/jquery.flot.pie.min.js')."'></script>";
	echo "<script src='". base_url('assets/js/jquery.flot.stack.js')."'></script>";
	echo "<script src='". base_url('assets/js/jquery.flot.resize.min.js')."'></script>";
	# chart libraries end -->

	# select or dropdown enhancer -->
	echo "<script src='". base_url('assets/js/jquery.chosen.min.js')."'></script>";
	# checkbox, radio, and file input styler -->
	echo "<script src='". base_url('assets/js/jquery.uniform.min.js')."'></script>";
	# plugin for gallery image view -->
	echo "<script src='". base_url('assets/js/jquery.colorbox.min.js')."'></script>";
	# rich text editor library -->
	echo "<script src='". base_url('assets/js/jquery.cleditor.min.js')."'></script>";
	# notification plugin -->
	echo "<script src='". base_url('assets/js/jquery.noty.js')."'></script>";
	# file manager library -->
	echo "<script src='". base_url('assets/js/jquery.elfinder.min.js')."'></script>";
	# star rating plugin -->
	echo "<script src='". base_url('assets/js/jquery.raty.min.js')."'></script>";
	# for iOS style toggle switch -->
	echo "<script src='". base_url('assets/js/jquery.iphone.toggle.js')."'></script>";
	# autogrowing textarea plugin -->
	echo "<script src='". base_url('assets/js/jquery.autogrow-textarea.js')."'></script>";
	# multiple file upload plugin -->
	echo "<script src='". base_url('assets/js/jquery.uploadify-3.1.min.js')."'></script>";
	# history.js for cross-browser state change on ajax -->
	echo "<script src='". base_url('assets/js/jquery.history.js')."'></script>";
	# application script for Charisma demo -->
	echo "<script src='". base_url('assets/js/charisma.js')."'></script>";
}



//end of file table-helper.php
