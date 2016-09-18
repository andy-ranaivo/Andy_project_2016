 
$.fn.wizard = function(config) {
  if (!config) {
    config = {};
  };
  var containerSelector = config.containerSelector || ".wizard-content";
  var stepSelector = config.stepSelector || ".wizard-step";
  var steps = $(this).find(containerSelector+" "+stepSelector);
  var stepCount = steps.size();
  var exitText = config.exit || 'Annuler';
  var backText = config.back || 'Pr\xE9c\xE9dent';
  var nextText = config.next || 'Suivant';
  var finishText = config.finish || 'Enregistrer';
  var isModal = config.isModal || true;
  var validateNext = config.validateNext || function(){return true;};
  var validateFinish = config.validateFinish || function(){return true;};
    //////////////////////
    var step = 1;
    var container = $(this).find(containerSelector);
    steps.hide();
    $(steps[0]).show();
    if (isModal) {
      $(this).on('hidden.bs.modal', function () {
        step = 1;
        $($(containerSelector+" .wizard-steps-panel .step-number")
          .removeClass("done")
          .removeClass("doing")[0])
        .toggleClass("doing");
        
        $($(containerSelector+" .wizard-step")
          .hide()[0])
        .show()
        ;

        btnBack.hide();
        btnExit.show();
        btnFinish.hide();
        btnNext.show();

      });
    };
    $(this).find(".wizard-steps-panel").remove();
    container.prepend('<div class="wizard-steps-panel steps-quantity-'+ stepCount +'"></div>');
    var stepsPanel = $(this).find(".wizard-steps-panel");
    for(s=1;s<=stepCount;s++){
      stepsPanel.append('<div class="step-number step-'+ s +'"><div class="number">'+ s +'</div></div>');
    }
    $(this).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
    //////////////////////
    var contentForModal = "";
    if(isModal){
      contentForModal = ' data-dismiss="modal"';
    }
    var btns = "";
    btns += '<button type="button" class="btn btn-default wizard-button-exit"'+contentForModal+'>'+ exitText +'</button>';
    btns += '<button type="button" class="btn btn-default wizard-button-back">'+ backText +'</button>';
    btns += '<button type="button" class="btn btn-default wizard-button-next" id = "suivant">'+ nextText +'</button>';
    btns += '<button type="button" class="btn btn-primary wizard-button-finish" '+contentForModal+' id = "enregistrer">'+ finishText +'</button>';
    $(this).find(".wizard-buttons").html("");
    $(this).find(".wizard-buttons").append(btns);
    var btnExit = $(this).find(".wizard-button-exit");
    var btnBack = $(this).find(".wizard-button-back");
    var btnFinish = $(this).find(".wizard-button-finish");
    var btnNext = $(this).find(".wizard-button-next");
    //$('#suivant').attr('disabled','disabled');
    
    
    
    
     
     /*if(application !== ''){
         $('#suivant').removeAttr('disabled');
     }*/
    $('#suivant').click(function(){
    //$('#enregistrer').attr('disabled','disabled')
    //alert($('#date_creation').val());
    $('#info_erreur').css('display','none');
     matricule          = $('#matr_plfs').val();
     bu                 = $('#slct_bu').val();
     client             = $('#slct_client').val();
     application        = $('#slct_app').val();
     date1              = $('#date1').val();
     date2              = $('#date2').val();
     temps1             = $('#temps1').val();
     temps2             = $('#temps2').val();
     planning           = $("#lib_pl").text();
     matricule_createur = $("#matr_create").text();
     date_creation      = $("#date_creation").text();
     
     c_matr_create      = $("#c_matr_create").val();
     
     //alert(c_matr_create);
      //alert(planning);
      
      $.ajax({
                  type:'POST',
                  url : '../planification_prod/ajax/get_resultat_step1.php',
                  async : false,
                  data : {
                     matr: matricule,
                     bu:bu,
                     client:client,
                     application:application,
                     date1:date1,
                     date2:date2,
                     matricule_createur,
                     temps1:temps1,
                     temps2:temps2,
                     planning: planning,
                     date_creation:date_creation,
                     matr_creates:c_matr_create
                  },
                  success : function(data){
                        $("#result_etape").html(data) ;
                  }
      });
      
      
      //step++;
      //alert(matricule);
      var dt1          = date1.split("/");
      var dt2          = date2.split("/");
      var dats1        = dt1[2]+'-'+dt1[1]+'-'+dt1[0];
      var dats2        = dt2[2]+'-'+dt2[1]+'-'+dt2[0];
      var dttime1      = new Date(dats1).getTime();
      var dttime2      = new Date(dats2).getTime();
      var dc           = date_creation.split("/");
      var dt_create    = dc[2]+'-'+dc[1]+'-'+dc[0];
      var datecreate   = new Date(dt_create).getTime();
      var time1        = Date.parse('01/01/2011 '+temps1+':00');
      var time2        = Date.parse('01/01/2011 '+temps2+':00');
      
      
      //console.log(time1+'____'+time2);
  
      if(c_matr_create == ''){
         alert('Vous ne pouvez pas plannifier une tache (Veuillez d\'abord vous connecter \xE0 la GPAO)');
         //$('#suivant').attr
         //$('#suivant').attr('disabled','disabled')
      }/*else if(matricule == null){
         alert('Veuillez selectionner au moins une matricule');
      }*//*else if(date_creation == ''){
         alert('Veuillez selectionner la date creation');
      }*/
      else if(application == ''){
         alert('Veuillez selectionner une application');
      }/*else if(planning == ''){
         alert('Veuillez mentionner le nom du planning');
      }*/
      else if(date1 == ''){
         alert('Veuillez selectionner la date debut');
      }else if(date2 == ''){
         alert('Veuilez selectionner la date fin');
      }else if(temps1 == ''){
         alert('Veuillez selectionner heure deb');
      }else if(temps2 == ''){
         alert('Veuillez selectinner heure fin');
      }else if(datecreate > dttime1){
         alert('Date creation devrait inf\xE9ieur ou \xE9gale a date debut');
      }else if(dttime1 > dttime2){
         alert('date debut devrait inf\xE9rieur ou \xE9gale \xE0 date fin');
      }else if((dttime1 == dttime2) && (time1 > time2)){
			 alert('temps debut devrait inf\xE9rieur ou \xE9gale \xE0 temps fin');        
      }else{
         if(!validateNext(step, steps[step-1])){
            return;
         };
         $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing").toggleClass("done");
         step++;
         steps.hide();
         $(steps[step-1]).show();
         $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
         if(step==stepCount){
           btnFinish.show();
           btnNext.hide();
         }
         btnExit.hide();
         btnBack.show();
      }
    })
    
    /*btnNext.on("click", function () {
      //alert('a');
    });*/
        /*btnNext.on("click", function () {
      if(!validateNext(step, steps[step-1])){
        return;
      };
      $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing").toggleClass("done");
      step++;
      steps.hide();
      $(steps[step-1]).show();
      $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
      if(step==stepCount){
        btnFinish.show();
        btnNext.hide();
      }
      btnExit.hide();
      btnBack.show();
    });*/


    

    btnBack.on("click", function () {
      $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing");
      step--;
      steps.hide();
      $(steps[step-1]).show();
      $(container).find(".wizard-steps-panel .step-"+step).toggleClass("doing").toggleClass("done");
      if(step==1){
        btnBack.hide();
        btnExit.show();
      }
      btnFinish.hide();
      btnNext.show();
    });

    /*btnFinish.on("click", function () {
     
      
    })*/
    
    $('#enregistrer').click(function(){
    
         matricule          = $("#val_matricule").val();
         application        = $("#val_application").val();
         date1              = $("#val_date1").val();
         date2              =  $("#val_date2").val();
         temps1             = $("#val_temps1").val();
         temps2             = $("#val_temps2").val();
         planning           = $("#lib_planning").val();
         matricule_createur = $("#val_matricule_createur").val();
         date_creation      = $("#val_d_create").val();
         //alert (matricule_createur);
         if(confirm("\352tes vous sur de vouloir enregistrer")){
               $.ajax({
                        type:'POST',
                        url : '../planification_prod/ajax/save_data.php',
                        async : false,
                        data : {
                           matr: matricule,
                           application:application,
                           date1:date1,
                           date2:date2,
                           temps1:temps1,
                           temps2:temps2,
                           planning:planning,
                           matricule_createur:matricule_createur,
                           date_creation:date_creation
                        }
               }); 
         
               if(!validateFinish(step, steps[step-1])){
                 return;
               };
               if(!!config.onfinish){
                 config.onfinish();
               }
           
      }else{
           alert ('Veuillez donc reselectionner le matricule');
         }
    })
    
    

    btnBack.hide();
    btnFinish.hide();
    return this;
  };
