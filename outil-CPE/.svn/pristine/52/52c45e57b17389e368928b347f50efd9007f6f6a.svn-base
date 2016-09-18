<?php


class Processus extends CI_Controller
{


    
    public function __construct()
    {
        //  Obligatoire
        parent::__construct();

        $this->load->model('fte_traitement','traits');
        $this->load->model('fte_processus','procs');
        $this->load->model('fte_action','acts');

    }

    

    public function index()
    {

        $this->processus();

    }

    // INSERTION DES PROCESSUS
    public function processus()
    {
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == "admin"){

            //** CODE **

            //** END CODE **
			
            //** PARAMETRE VUE **
            $data['titre'] = 'PROCESSUS';
            $data['css'] = array('admin/module.admin.page.form_wizards.min','admin/module.global','admin/module.admin.page.modals.min');
            $data['js'] = array('js/admin_processus.js','js/admin_processus_edit.js');
            $data['level'] = $level;
            //** END PARAMETRE VUE **
        


            $fin_proc = $this->procs->liste_processus_dern($this->session->userdata('traitement_id'));

            foreach ($fin_proc as $val_fin) {
                $dern = $val_fin->fte_process_id;
                $dern_ordre = $val_fin->ordre;
            }

            $data_send_pcs['dern'] = $dern;
            $data['dern'] = $dern;
            $data_send_pcs['dern_ordre'] = $dern_ordre;

            //** APPEL VUE **
            $this->load->view('includes/header.php', $data);
            $this->load->view('includes/menu_vertical.php', $data);
            //$this->load->view('back/processus_view.php', $data);
            //$this->load->view('includes/menu_horizental.php');

            // GESTION MODIFICATION PROCESSUS
            $pcs = $this->procs->liste_processus($this->session->userdata('traitement_id'));

        
            $data_pcs["lst_proc"] = $pcs;
            $this->load->view('back/processus_head_wizard_view.php');
            $this->load->view('back/processus_menu_wizard_view.php', $data_pcs);
            
            foreach ($pcs as $proc_row) {
                
                $proc_row_id = $proc_row->fte_process_id;           
                $data_act_res = $this->acts->liste_action($proc_row_id);
                $data_send_pcs["lst_proc"] = $proc_row;
                $data_send_pcs["lst_acts"] = $data_act_res;

                $this->load->view('back/processus_content_wizard_view.php', $data_send_pcs);

                $pcs = $this->procs->get_processus_by_id($proc_row_id);
                $data_procs_visu['lst_pcs'] = $pcs;
                $this->load->view('back/processus_popup_visualiser_view.php', $data_procs_visu);
            }


            $this->load->view('back/processus_foot_wizard_view.php');

            $list = array();
            foreach($pcs as $row)  {
                $list[$row->fte_process_id] = $row->alias;
            }
            $list[0] = "FIN DE TRAITEMENT";
            $data_procs["list_pcs"]  = $list;
            $this->load->view('back/processus_popup_bouton_ajout_view.php', $data_procs);





            // END GESTION MODIFICATION PROCESSUS


            $this->load->view('includes/footer.php');
            $this->load->view('includes/js.php');
            //** END APPEL VUE **

            
        }else{
            redirect('login');
        }

    }


    // EDITER PROCESSUS POUR AJOUTER DES PROCESS OU ACTION
    public function editer_processus() {
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == "admin"){

            $libe = $this->input->post("txt_libelle");
            $htm = $this->input->post("area_html");

            $data_send = array(
                "text_html" => $htm
                ,"libelle" => $libe
            );

            $proc_id = $this->input->post("procid");
            $this->procs->editer_processus($data_send,$proc_id);

        }else{
            redirect('login');
        }
    }

    // PERMET D'AJOUTER DES BOUTON DANS LE PROCESSUS
    public function ajbtn()
    {
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == "admin"){
            
            $lib_in = $this->input->post("txt_libelle");
            $procid_in = $this->input->post("procid");
            $proc_red_id_in = $this->input->post("procred");
            $traitement_id_in = $this->session->userdata('traitement_id');
            
            $data_new = array(
                "libelle" => $lib_in
                , "process_id" => $procid_in
                , "process_redirect_id" => $proc_red_id_in
                , "traitement_id" => $traitement_id_in
            );
            
            $ret = $this->acts->ajouter_action($data_new);
            echo site_url('back/processus');

        }else{
            redirect('login');
        }
    }


    // AJOUTER PROCESSUS POUR L'EDITER
    public function ajouter_processus() {
        $level = $this->session->userdata('level');
        if($this->session->userdata('loggin') && $level == "admin"){

            $id_camp = $this->input->post("id_camp");
            $ordre = $this->input->post("ordre");

            $ordre_alias = (int)$ordre+1;

            $alias = "P".$ordre_alias;

            $data_ajout = array(
                "campagne_id" => $id_camp
                ,"parent_id" => 0
                ,"commentaire_id" => 0
                ,"ordre" => $ordre+1
                ,"alias" => $alias
            );

            $id_process = $this->procs->ajouter_processus($data_ajout);
            echo site_url('back/processus');

        }else{
            redirect('login');
        }
    }




}