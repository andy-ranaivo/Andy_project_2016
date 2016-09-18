
						<?php 
								$row = $lst_proc;
						?>
						

        				<div class="tab-pane" id="tab<?php echo $row->fte_process_id; ?>">

        					<div class="row">
        						<div class="col-md-12">
									<label for="txt_libelle_<?php echo $row->fte_process_id; ?>">Libelle</label>
									<input type="text" id="txt_libelle_<?php echo $row->fte_process_id; ?>" class="form-control" value="<?php  echo ascii_to_entities($row->libelle);  ?>"/>
								</div>
							</div>
							<br>
						
							<div class="row">
        						<div class="col-md-12">
									<textarea id='area_html_<?php echo $row->fte_process_id; ?>' class='form-control' rows='10' style='resize:none;'><?php echo ascii_to_entities($row->text_html) ;?></textarea>
								</div>
							</div>
							
							<hr>
							
							<div class="row">
								<div class="col-md-12">
	        						<button class="btn btn-primary pull-right" style="margin-left:15px;" onclick="ajout_procs(<?php echo $row->campagne_id; ?>, <?php echo $dern_ordre; ?>)">AJOUTER PROCESSUS <i class="fa fa-lg fa-arrow-right"></i></button>
	        						<a href="#ajout-bouton" data-toggle="modal"  style="margin-left:15px;" class="btn btn-info pull-right" onclick="nouveau_bouton(<?php echo $row->fte_process_id; ?>);">AJOUTER BOUTON</a>
	        						<a href="#visu<?php echo $row->fte_process_id; ?>" data-toggle="modal" class="btn btn-success pull-left">VISUALISER LE PROCESSUS</a>
	        						<button class="btn btn-success pull-left" onclick="get_data_tab(<?php echo $row->fte_process_id; ?>);" style="margin-left:15px;">VALIDER </button>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<?php
									if(!empty($lst_acts)){ 
										foreach ($lst_acts as $row_act): 
									?>
	        						<button class="btn btn-info pull-right" style="margin-left:15px;"><?php echo $row_act->libelle;?></button>
	        						<?php 
	        							endforeach; 
	        						}
	        						?>
								</div>
							</div>

						</div>

						

						<a href="#edtion-procs" data-toggle="modal" id="edition_valid" class="hidden"></a>

						<!-- MODAL -->
						<div class="modal fade" id="edtion-procs">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- MODAL HEADER -->
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h3 class="modal-title">Edition</h3>
									</div>
									<!-- END MODAL HEADER -->

									<!-- MODAL BODY -->
									<div class="modal-body">
										<p class="astuce"><i class="fa fa-check"></i> Edition du processus bien terminer</p>
									</div>
									<!--  END MODAL BODY -->

									<!-- MODAL FOOTER -->
									<div class="modal-footer">
										<a href="<?php echo site_url('back/processus'); ?>" class="btn btn-block btn-success"> OK</a>
									</div>
									<!--  END MODAL FOOTER -->
								
								</div>
							</div> 
						</div>
						<!-- END MODAL -->
			
			







						
