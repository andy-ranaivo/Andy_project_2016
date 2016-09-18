<div id="content"><h1 class="content-heading bg-white border-bottom hidden">OPERATION</h1> 
<div class="innerAll">

    	
<!-- CONTENT -->
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="row">
			<?php 
				if(!empty($operation)){
					foreach ($operation as $val_op) {
					
			?>
				<div class="col-md-3 columns">
					<?php

					if($val_op->process_id == "0"){
					
					?>
						<div class="button"><a href="<?php echo site_url('front/accueil_action/'.$val_op->cey_operation_id); ?>" class="titre_bouton"><?php echo ascii_to_entities($val_op->info_operation);?></a></div>	   
					<?php
					
					}else{
					
					?>
						<div class="button"><a href="<?php echo site_url('front/accueil_processus/'.$val_op->process_id); ?>" class="titre_bouton"><?php echo ascii_to_entities($val_op->info_operation);?></a></div>	   
					<?php
					
					}
					
					?>
				</div>
			<?php 
					}
				}
			?>
		</div>
	</div>
</div>
<!-- END CONTENT -->
		
		