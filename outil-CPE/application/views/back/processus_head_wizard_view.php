<script> 
	var url_upd_proc = "<?php echo site_url("back/processus/editer_processus")?>";
	var url_ajout_proc = "<?php echo site_url("back/processus/ajouter_processus")?>";
	var url_add_btn = "<?php echo site_url("back/processus/ajbtn")?>";
	var idbout_processus = 0;
</script>	

<div id="content"><h1 class="content-heading bg-white border-bottom hidden">PROCESSUS</h1> 
<div class="innerAll spacing-x2">

    	
<!-- CONTENT -->
<div class="wizard">

    <div class="widget widget-tabs widget-tabs-double widget-tabs-vertical row row-merge widget-tabs-gray">
    		
        <!-- ETAPES PROCESSUS -->
        <div id="rootwizard" class="wizard">
