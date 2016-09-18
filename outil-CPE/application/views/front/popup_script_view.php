	<?php 
		foreach ($lst_scps as $val_script) {
			$corps = ascii_to_entities($val_script->text_html_script);			
			$id = $val_script->cey_script_id;				
			$libelle = ascii_to_entities($val_script->libelle_script);				
		}
	?>

	<!-- MODAL -->
	<div class="modal fade" id="popup<?php echo $id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- MODAL HEADER -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?php echo ascii_to_entities($libelle); ?></h3>
				</div>
				<!-- END MODAL HEADER -->

				<!-- MODAL BODY -->
				<div class="modal-body">
					<div class="innerAll">
						<div>
							<?php
								echo $corps;
							?>
						</div>
					</div>
				</div>
				<!--  END MODAL BODY -->
			
			</div>
		</div> 
	</div>
	<!-- END MODAL -->