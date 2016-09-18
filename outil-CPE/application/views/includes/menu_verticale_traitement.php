<!-- MENU ACTION -->
<div id="menu" class="hidden-print hidden-xs">
	<div style="background-color:#E9F4F5!important; border:none!important; " class="sidebar sidebar-inverse">
		
			<div  style="margin-top:80px;" class="row">
				<?php 
					
						foreach ($nom_categorie as $nom) {
				?>
				<div class="active_menu" style=" padding:10px; font-size:1.5rem!important; background-color:#31b0d5; color:white; border-radius:0 75px 75px 0; box-shadow: 5px 2px 2px rgba(0,0,0,0.4)">
				
					<p><?php echo '<span>'.ascii_to_entities($nom->info_categorie).'</span>';?></p>
				</div>
				<hr style="background-color:red;">
						<?php }?>
			</div>
			
		
		<?php if($titre != "ACCUEIL"){ ?>
		
		<?php } ?>
	</div>
</div>
<!-- END MENU ACTION -->