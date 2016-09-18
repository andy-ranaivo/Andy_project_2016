<div id="content"><h1 class="content-heading bg-white border-bottom hidden">TRAITEMENT</h1> 
<div class="innerAll">

    	
<!-- CONTENT -->


<div style="margin-top:40px;"class="row">
	<!--<div class="col-lg-3">
	    <div class="list-unstyled" style="margin-top:80px;" class="row">
			<?php 
				
					foreach ($categories as $val_cat) {
			?>
			<div class="active_menu" style=" padding:15px; margin-bottom:2px;" class="col-lg-12">
			<?php 
			    if($val_cat->cey_categorie_id==1){
				  $res='fa fa-lightbulb-o';
				  }else if($val_cat->cey_categorie_id==2){
					$res='fa fa-warning'; 
				  }else if($val_cat->cey_categorie_id==3){
					  $res='fa fa-group';
				  }else if($val_cat->cey_categorie_id==4){
					  $res='fa fa-phone';
				}?>
				<span><?php echo '<i class="'.$res.'"></i> '.ascii_to_entities($val_cat->info_categorie);?></span>
			</div>
			<hr style="background-color:red;">
					<?php }?>
		</div>
	</div>	-->
	<div class="col-lg-10 col-lg-offset-1">	
		<div class="row">
			
		
			<?php 
				if(!empty($traitement)){
					
					foreach ($traitement as $val_trait) {
							
					
			?>
			
				
							<div class="col-lg-6 dashboard clearfix">
								<ul class="tiles">
								<span style="position:absolute; z-index:10000; font-size:4.5rem; top:-10px;left:20px;"></span>
								<a style="text-decoration:none!important; font-size:5rem;"id="ico" style="font-size:6em;"class=" 
								  <?php echo $val_trait->icone;
								  
								  ?>"></a>
								<?php 
								if($val_trait->process_id == "0"){
								?>
								<div class="col1 clearfix">
								  <li class="tile tile-big tile-1 slideTextUp" data-page-type="r-page" data-page-name="random-r-page">
									<div><p><a href="<?php echo site_url('front/accueil_operation/'.$val_trait->cey_traitement_id) ?>" class="titre_bouton"><?php echo ascii_to_entities($val_trait->info_traitement);?></a></p></div>
									
								  </li>
								</div>
								
									
								
								<?php 
								}else{
								?>
								<div class="col1 clearfix">
								  <li class="tile tile-big tile-1 slideTextUp" data-page-type="r-page" data-page-name="random-r-page">
									<div><p><a href="<?php echo site_url('front/accueil_processus/'.$val_trait->process_id) ?>" class="titre_bouton"><?php echo ascii_to_entities($val_trait->info_traitement);?></a></p></div>
									
								  </li>
								</div>

									

								<?php 
								}
								?>					
								</ul>
							</div>	
						
			<?php 
					}
				}
			?>
			<div class="col-md-1">
			</div>
			
		</div>
	</div>
	<div class="col-lg-1">
	</div>
</div>
<!-- END CONTENT -->
		
		