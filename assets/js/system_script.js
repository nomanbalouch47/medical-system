function candidate_already_check(e)
{
 
  e.which = e.which || e.keyCode;
  if(e.which == 9)
  {
    var form_name = "Candidate Already Check";
    var passport = document.getElementById("passport").value;
    var cnic = document.getElementById("cnic").value;
      $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {

                       form_name : form_name,
                       passport_number : passport,
                       cnic_number : cnic,
                       
                         },
                      success: function(response) {
                        if(response == 'No Record Found'){

                        }else{

                          // Add response in Modal body
                            $('.modal-body').html(response); 

                            // Display Modal
                            $('#empModal').modal('show'); 
                          //$('#check_result').html(data);
                          
                        }
                         
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
  }

}

function check_candidate_history(){
  var form_name = "Candidate Medical History Check";
  var ppno = document.getElementById("passport_number").value;
  $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {

                       form_name : form_name,
                       passport_number : ppno,
                       
                       
                         },
                      success: function(response) {
                         // Add response in Modal body
                            $('.modal-body').html(response); 

                            // Display Modal
                            $('#empModal').modal('show'); 
                          //$('#check_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
}


function set_portion(){

  var reg_id = document.getElementById('regid').value;
  var bplus;
  if(document.getElementById("bplus").checked == true){
    var bplus = "B";
  }else{
    var bplus = 'A';
  }
  var form_name = "Update Portion";

  $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       form_name : form_name,
                       regID : reg_id,
                       Bplus :bplus,
                         },
                      success: function(data) {
                          $('#portion_update').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });

}

function get_candidate_record(e,btnname)
    {
      
      e.which = e.which || e.keyCode;
      if(e.which == 13)
      {
        //alert(btnname);
        //var button_name = btnname;
        var form_name = "Candidate_Info";
        var barcode_num = document.getElementById('barcode').value;
        var serial_num = document.getElementById('serial').value;

        if (document.getElementById('search_with_date')) {
          var date_value = document.getElementById('search_with_date').value;
        } else {
          var date_value = "";
        }
        
        var processID = document.getElementById('processid').value;

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                       process_ID : processID,
                       barcode_num : barcode_num, 
                       serial_num : serial_num,
                       date_value : date_value, 
                       form_name : form_name,
                       btn : btnname,
                       
                         },
                      success: function(data) {
                          $('#cand_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
      }
    }

function lab_result_update()
{
  // console.log('hi');
  $(document).ready(function() {

        var form_name="Lab Result Update";
        var lab_status = "FIT";
        var barcode = document.getElementById("barcode").value;
        var hcv = document.getElementById("hcv").value;
        var hbs_ag = document.getElementById("hbs_ag").value;
        var hiv = document.getElementById("hiv").value;
        var vdrl = document.getElementById("vdrl").value;
        var tpha = document.getElementById("tpha").value;
        var rbs = document.getElementById("rbs").value;
        var bil = document.getElementById("bil").value;
        var alt = document.getElementById("alt").value;
        var ast = document.getElementById("ast").value;
        var alk = document.getElementById("alk").value;
        var creatinine = document.getElementById("creatinine").value;
        var blood_group = document.getElementById("blood_group").value;
        var haemoglobin = document.getElementById("haemoglobin").value;
        var malaria = document.getElementById("malaria").value;
        var micro_filariae = document.getElementById("micro_filariae").value;
        var sugar = document.getElementById("sugar").value;
        var albumin = document.getElementById("albumin").value;
        var helminthes = document.getElementById("helminthes").value;
        var ova = document.getElementById("ova").value;
        var cyst = document.getElementById("cyst").value;
        //alert(haemoglobin);
        var tb_test = document.getElementById("tb_test").value;
        var pragnancy_test = document.getElementById("pragnancy_test").value;
        var polio = document.getElementById("polio").value;
        var poliodate = document.getElementById("poliodate").value;
        var mmr1 = document.getElementById("mmr1").value;
        var mmr1date = document.getElementById("mmr1date").value;
        var mmr2 = document.getElementById("mmr2").value;
        var mmr2date = document.getElementById("mmr2date").value;
        var meningococcal = document.getElementById("meningococcal").value;
        var meningococcaldate = document.getElementById("meningococcaldate").value;
        var regid = document.getElementById("reg_id").value;

        console.log(regid);

        if(hcv == 'positive' || hbs_ag == 'positive' || hiv == 'positive' || vdrl == 'positive' || tpha == 'positive'){
          lab_status = "UNFIT";
        }

        if(bil > 1.20)
          alert("BIL Normal Range is 0.05-1.20");
        if(alt > 40)
          alert("ALT Normal Range is 10-40");
        if(ast > 40)
          alert("AST Normal Range is 10-40");
        if(alk > 200)
          alert("ALK Normal Range is 100-200");
        if(creatinine > 1.20)
          alert("Creatinine Normal Range is 0.05-1.20");
        if(haemoglobin > 17)
          alert("Haemoglobin Normal Range is 12-17");
          
          var form_array = [barcode,hcv,hbs_ag,hiv,vdrl,tpha,rbs,bil,alt,ast,alk,creatinine,blood_group,haemoglobin,malaria,micro_filariae,sugar,albumin,helminthes,ova,cyst,tb_test,pragnancy_test,polio,poliodate,mmr1,mmr1date,mmr2,mmr2date,meningococcal,meningococcaldate,lab_status,regid];

          $.ajax({
                url: '././include/functions.php',
                type: 'POST',
                data: {
                 
                 form_values : form_array, 
                 form_name : form_name,

                   },
                success: function(data) {
                    $('#respond_lab_result').html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //case error                    
                  }
            });

    });

}


function verfiy_barcode_lab_result(e)
{  
    e.which = e.which || e.keyCode;
    if(e.which == 13)
    {
      // console.log('hi');
      //var button_name = btnname;
      var form_name = "Verify Barcode Lab Result";
      var barcode_num = document.getElementById('barcode').value;
      if (document.getElementById('search_with_date')) {
        var date_value = document.getElementById('search_with_date').value;
        var serial_num = document.getElementById('serial').value;
      } else {
        var date_value = "";
        var serial_num = "";
      }
      // var date_value = document.getElementById('search_with_date').value;

      var processID = document.getElementById('processid').value;

      $(document).ready(function() {

                 $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     process_ID : processID,
                     barcode_num : barcode_num, 
                     serial_num : serial_num,
                     date_value : date_value, 
                     form_name : form_name,
                     
                       },
                    success: function(data) {
                        $('#barcode_verification_response').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });
        });
    }
}

function get_candidate_record_lab_result(e)
{
      
      e.which = e.which || e.keyCode;
      if(e.which == 13)
      {
        //alert(btnname);
        //var button_name = btnname;
        var form_name = "Candidate Info Lab Result";
        var barcode_num = document.getElementById('barcode').value;
        var serial_num = document.getElementById('serial').value;
        var date_value = document.getElementById('search_with_date').value;
        var search_from = document.getElementById('search_from').value;

        var processID = document.getElementById('processid').value;

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                       process_ID : processID,
                       barcode_num : barcode_num, 
                       serial_num : serial_num,
                       date_value : date_value, 
                       form_name : form_name,
                       search_from : search_from,
                       
                         },
                      success: function(data) {
                          $('#cand_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
      }
}

// function get_candidate_record(e,btnname)
    // {
      
    //   e.which = e.which || e.keyCode;
    //   if(e.which == 13)
    //   {
    //     //alert(btnname);
    //     //var button_name = btnname;
    //     var form_name = "Candidate_Info";
    //     var barcode_num = document.getElementById('barcode').value;
    //     var serial_num = document.getElementById('serial').value;
    //     var processID = document.getElementById('processid').value;

    //     $(document).ready(function() {

    //                $.ajax({
    //                   url: '././include/functions.php',
    //                   type: 'POST',
    //                   data: {
                       
    //                    process_ID : processID,
    //                    barcode_num : barcode_num, 
    //                    serial_num : serial_num, 
    //                    form_name : form_name,
    //                    btn : btnname,
                       
    //                      },
    //                   success: function(data) {
    //                       $('#cand_result').html(data);
    //                   },
    //                   error: function(XMLHttpRequest, textStatus, errorThrown) {
    //                       //case error                    
    //                     }
    //               });
    //       });
    //   }
    // }

function get_candidate_with_biometric(candidate_code,button_name)
    {
      
       var form_name = "Candidate_Info_Biometric";
        var cand_code = candidate_code;
        var btnname = button_name;

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                      
                       candidatecode : cand_code, 
                       form_name : form_name,
                       btn : btnname,
                       
                         },
                      success: function(data) {
                          $('#cand_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
    }

function get_repeat_case(candidate_code)
{
        var form_name = "Candidate_Info_RepeatCase";
        var cand_code = candidate_code;
        var btnname = 'registration';

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                      
                       candidatecode : cand_code, 
                       form_name : form_name,
                       btn : btnname,
                       
                         },
                      success: function(data) {
                          $('#cand_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });

}

function get_repeat_case2(e,candidate_code)
{
  e.which = e.which || e.keyCode;
      if(e.which == 13)
      {
        var form_name = "Candidate_Info_RepeatCase";
        // var cand_code = candidate_code;
        var cand_code = document.getElementById("cand_identity").value;
        var btnname = 'registration';

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                      
                       candidatecode : cand_code, 
                       form_name : form_name,
                       btn : btnname,
                       
                         },
                      success: function(data) {
                          $('#cand_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
      }

}

function myfunc(data)
{
  return data;
}

function get_biomteric_repeat_case(cad_passport)
  {

        var form_name = "Get_Biometric_Repeat_case";
        var cand_code = cad_passport;
   

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                       cand_code : cand_code, 
                       form_name : form_name,
                       
                         },
                      success: function(result) {
                       
                        $('#cand_template').html(result);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          console.log('error');                  
                        }
                  });
          });
        
  }

function get_biomteric_with_code(candidate_code)
  {

        var form_name = "Get_Biometric";
        var cand_code = candidate_code;
   

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                       cand_code : cand_code, 
                       form_name : form_name,
                       
                         },
                      success: function(result) {
                       
                        $('#cand_template').html(result);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          console.log('error');                  
                        }
                  });
          });
        
  }

function get_candidate_with_biometric_2(templates_arr,template1,processid,button_name)
    {
      
        var form_name = "Candidate_Info_Biometric 2";
        var processID = processid;
        var btnname = button_name;
        //var process_template = [templates_arr];
        console.log(templates_arr);

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                      
                       process_ID : processID, 
                       form_name : form_name,
                       btn : btnname,
                       template : template1,
                       row_biometrics : templates_arr,
                       
                         },
                      success: function(data) {
                          $('#cand_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
    }

function find_candidate(){

  var form_name = "Find Candidate for Report Issue";
  var barcode_num = document.getElementById('barcode').value;
  var btnname = 'issuereport';

  $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                       barcode_num : barcode_num, 
                       form_name : form_name,
                       btn : btnname,
                       
                         },
                      success: function(data) {
                          $('#find_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });
}
// function find_candidate(){
  
//         var form_name = "Candidate Info Print Report";
//         var exam_date = document.getElementById("examination_date").value;
//         var serial = document.getElementById("serial").value;

//         $(document).ready(function() {

//                    $.ajax({
//                       url: '././include/functions.php',
//                       type: 'POST',
//                       data: {
                       
//                        serial_num : serial, 
//                        examination_date : exam_date, 
//                        form_name : form_name,
//                        btn : btnname,
                       
//                          },
//                       success: function(data) {
//                           $('#cand_result2').html(data);
//                       },
//                       error: function(XMLHttpRequest, textStatus, errorThrown) {
//                           //case error                    
//                         }
//                   });
//           });

// }

function check_lab_sticker(e,usertype){
  e.which = e.which || e.keyCode;
      if(e.which == 13){

        var form_name = "Check Lab Sticker";
        var sticker_barcode1 = document.getElementById('sticker_barcode').value;
        var login_id = document.getElementById('loginid').value;

        $(document).ready(function() {

                   $.ajax({
                      url: '././include/functions.php',
                      type: 'POST',
                      data: {
                       
                       form_name : form_name,
                       barcode : sticker_barcode1,
                       loginID : login_id,
                       UserType : usertype,
                       
                         },
                      success: function(data) {
                          $('#barcode_result').html(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          //case error                    
                        }
                  });
          });

      }

}


function allow_duplicate_sticker(sticker1){

  $(document).ready(function() {

    var form_name ="Allow Duplicate Lab Sticker";

    $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                      
                      form_name : form_name,
                      sticker_1 : sticker1,
                    
                       },
                    success: function(data) {
                        $('#duplicate_sticker2').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });

  });

}



// function get_candidate_from_bio()
//     {
      
//       e.which = e.which || e.keyCode;
//       if(e.which == 13)
//       {
//         //alert(btnname);
//         //var button_name = btnname;
//         var form_name = "Candidate_Info";
//         var barcode_num = document.getElementById('barcode').value;
//         var serial_num = document.getElementById('serial').value;

//         $(document).ready(function() {

//                    $.ajax({
//                       url: '././include/functions.php',
//                       type: 'POST',
//                       data: {
                       
//                        barcode_num : barcode_num, 
//                        serial_num : serial_num, 
//                        form_name : form_name,
//                        btn : btnname,
                       
//                          },
//                       success: function(data) {
//                           $('#cand_result').html(data);
//                       },
//                       error: function(XMLHttpRequest, textStatus, errorThrown) {
//                           //case error                    
//                         }
//                   });
//           });
//       }
//     }    

function cand_registration(){

  var form_name ="Registration";
        $(document).ready(function() {
           
              var token = document.getElementById('token_number').value;
              var Barcode_no = document.getElementById('barcode').value;
              var issuedate = document.getElementById('ppissuedate').value;
              var Expiry_date = document.getElementById('ppexpirydate').value;
              var placeofissue = document.getElementById('placeofissue').value;
              var Serial_no = document.getElementById('serialnum').value;
              var Phone1 = document.getElementById('phone').value;
              var Phone2 = document.getElementById('phone1').value;              
              var Agency = document.getElementById('agency').value;
              var Profession = document.getElementById('profession').value;
              var Fees = document.getElementById('fees').value;
              var Disc = document.getElementById('disc').value;
              var canidateName = document.getElementById('candname').value;
              var RegDate = document.getElementById('regdate').value;
              var Son_of = document.getElementById('sonof').value;
              var Passport_no = document.getElementById('passport').value;
              var Country = document.getElementById('country').value;
              var Nationality = document.getElementById('nationality').value;
              var DOB = document.getElementById('dob').value;
              var Gender = document.getElementById('gender').value;
              var MartStatus = document.getElementById('mart_status').value;
              var CNIC = document.getElementById('cnic').value;
              var Remarks = document.getElementById('remarks').value;
             // var pregnancyTest = document.getElementById('pregnancy').value;

              if(document.getElementById('pregnancy').checked == true){

                var  pregnancyTest = 1;
              }else{
                var  pregnancyTest = 0;
              }
              
              var img_name = document.getElementById('img_name').value;
              var slip_expiry = document.getElementById('ref_slip_exp_date').value;
              var slip_issue_date = document.getElementById('ref_slip_issue_date').value;
              var s_o_w = document.getElementById('d_o').value;
              //var finger_template = template_1;
              

              if(canidateName == "" || Serial_no == "" || Passport_no == "" || CNIC == "" || Son_of == "" || RegDate == "")
              {
                setTimeout(function () {
                    document.getElementById("errorclass").style.display='none';
                }, 3000);
                document.getElementById("errorclass").style.display = "block";
              }
              else if(template_1 == null)
              {
                setTimeout(function () {
                    document.getElementById("biometricError").style.display='none';
                }, 3000);
                document.getElementById("biometricError").style.display = "block"; 
              }
              else if(token == "")
              {
                setTimeout(function () {
                    document.getElementById("tokenError").style.display='none';
                }, 3000);
                document.getElementById("tokenError").style.display = "block"; 
              }
              else{

              var form_array = [Barcode_no,issuedate,Expiry_date,placeofissue,Serial_no,Phone1,Phone2,Agency,Profession,Fees,canidateName,RegDate,Son_of,Passport_no,Country,Nationality,DOB,Gender,MartStatus,CNIC,Remarks,template_1,token,Disc,pregnancyTest,img_name,slip_expiry,s_o_w,slip_issue_date];

              $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     form_values : form_array, 
                     form_name : form_name

                       },
                    success: function(data) {
                        $('#reg_result').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });

              }
        });
}

function ppidentification()
  {
    $(document).ready(function() {

              var form_name ="Passport Verification";
              // var token = document.getElementById("cand_token").value; //document.getElementById('token_number').value;   
              var Remarks = document.getElementById('remarks').value;
              var processID = '3';
              var RegID = document.getElementById('reg_id').value;
              
              if (document.getElementById('cand_token')) {
                var token = document.getElementById("cand_token").value;
              } else {
                var token = document.getElementById('token_number3').value;
              }
              
              var form_array = [Remarks,processID,RegID,token];

              $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     form_values : form_array, 
                     form_name : form_name,

                       },
                    success: function(data) {
                        $('#pp_result').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });
                
           
        });

  }


  function cand_medicalofficer(){

  var form_name ="MedicalOfficer";
        $(document).ready(function() {
           
              document.getElementById('medicalofficer').disabled = true;
              var token = document.getElementById("token_number").value;// document.getElementById('token_number').value;
              var ProcessID = document.getElementById('processid').value;
              var RegID = document.getElementById('reg_id').value;
              var ExamDate = document.getElementById('examination_date').value;
              var Height = document.getElementById('height').value;
              var Weight = document.getElementById('weight').value;
              var BMI = document.getElementById('bmi').value;
              var BP = document.getElementById('bp').value;
              var Pulse = document.getElementById('pulse').value; 
              var RR = document.getElementById('rr').value;
              var VURE = '';//document.getElementById('visual_unaided_rt_eye').value;
              var VULE = '';//document.getElementById('visual_unaided_left_eye').value;
              var VARE = '';//document.getElementById('visual_aided_rt_eye').value;
              var VALE = '';//document.getElementById('visual_aided_left_eye').value;
              var DURE = document.getElementById('distant_unaided_rt_eye').value;
              var DULE = document.getElementById('distant_unaided_left_eye').value;
              var DARE = document.getElementById('distant_aided_rt_eye').value;
              var DALE = document.getElementById('distant_aided_left_eye').value;
              var NURE = document.getElementById('near_unaided_rt_eye').value;
              var NULE = document.getElementById('near_unaided_left_eye').value;
              var NARE = document.getElementById('near_aided_rt_eye').value;
              var NALE = document.getElementById('near_aided_left_eye').value;
              var CV_Norm = document.getElementById('cv_norm').value;
              var CV_Doubt = document.getElementById('cv_doubt').value;
              var CV_Defect = document.getElementById('cv_defect').value;
              var HRE = document.getElementById('hearing_rt').value;
              var HLE = document.getElementById('hearing_left').value;
              var Gen_Appearence = document.getElementById('gen_appearence').value;
              var Cardiov = document.getElementById('cardiov').value;
              var Respiratory = document.getElementById('respiratory').value;
              var ENT = document.getElementById('ent').value;
              var Abdomen = document.getElementById('abdomen').value;
              var Hernia = document.getElementById('hernia').value;
              var Hydrocele = document.getElementById('hydrocele').value;
              var Extremeties = document.getElementById('extremeties').value;
              var Back = document.getElementById('back').value;
              var Skin = document.getElementById('skin').value;
              var CNS = document.getElementById('cns').value;
              var Deformities = document.getElementById('deformities').value;
              var Appearence = document.getElementById('appearence').value;
              var Speech = document.getElementById('speech').value;
              var Behaviour = document.getElementById('behaviour').value;
              var Cognition = document.getElementById('cognition').value;
              var Orientation = document.getElementById('orientation').value;
              var Memory = document.getElementById('memory').value;
              var Concentration = document.getElementById('concentration').value;
              var Mood = document.getElementById('mood').value;
              var Thoughts = document.getElementById('thoughts').value;
              var Others = document.getElementById('others').value;
              
              var Remarks = document.getElementById('remarks').value;
              var ColorVision;

              if(document.getElementById('cv_norm').checked){
                ColorVision = CV_Norm;
              }
              else if(document.getElementById('cv_doubt').checked){
                ColorVision = CV_Doubt;
              }else if(document.getElementById('cv_defect').checked){
                ColorVision = CV_Defect;
              }
           
              var form_array = [token,ProcessID,RegID,ExamDate,Height,Weight,BMI,BP,Pulse,RR,VURE,VULE,VARE,VALE,DURE,DULE,DARE,DALE,NURE,NULE,HRE,HLE,Gen_Appearence,Cardiov,Respiratory,ENT,Abdomen,Hernia,Hydrocele,Extremeties,Back,Skin,CNS,Deformities,Appearence,Speech,Behaviour,Cognition,Orientation,Memory,Concentration,Mood,Thoughts,Others,Remarks,ColorVision,NARE,NALE];

              $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     form_values : form_array, 
                     form_name : form_name

                       },
                    success: function(data) {
                        $('#medicalOff_result').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });

              
        });
}


  function xray_verified()
  {
    $(document).ready(function() {
     
              var form_name ="XRAY";
              var token =document.getElementById("cand_token").value; //document.getElementById('token_number').value;
              var processID = '5';
              var RegID = document.getElementById('reg_id').value;

              var form_array = [form_name,token,processID,RegID];

              $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     form_values : form_array, 
                     form_name : form_name,

                       },
                    success: function(response) {

                      $('#xray_result').html(response);
                        
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                       alert(errorThrown);     
                      
                      }
                });
                
          
        });

  }


function samplecollection()
  {
    $(document).ready(function() {
    

              var form_name ="Sample Collection";
              var token = document.getElementById("cand_token").value;
              // var token = document.getElementById('token_number').value;
              //var SampleCCdate = document.getElementById('sampleccdate').value;
              var Remarks = document.getElementById('remarks').value;
              var processID = '4';
              var RegID = document.getElementById('reg_id').value;
              

              var form_array = [Remarks,processID,RegID,token];

              $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     form_values : form_array, 
                     form_name : form_name,

                       },
                    success: function(data) {
                        $('#samplecc_result').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });
                
           
        });

  }
  function issue_report()
  {
    $(document).ready(function() {

              var form_name ="Issue Report";
              var token = document.getElementById('token_number').value;
              var processID = '6';
              var RegID = document.getElementById('reg_id').value;
              

              var form_array = [processID,RegID,token];

              $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     form_values : form_array, 
                     form_name : form_name,

                       },
                    success: function(data) {
                        $('#report_issue').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });
        });

  }

function printlabsticker()
{
   $(document).ready(function() {

              var form_name ="Print Lab Sticker 1";             
              var RegID = document.getElementById('reg_id').value;
              var Serial_NUM = document.getElementById('serial_no').value;
              var Reg_date = document.getElementById('examination_date').value;            
              var form_array = [RegID,Serial_NUM,Reg_date];

              $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                     
                     form_values : form_array, 
                     form_name : form_name,

                       },
                    success: function(data) {
                        $('#printsticker_result').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });
                
            });

}

function print_sticker2(usertype){

  $(document).ready(function() {

    var reg_date = document.getElementById("reg_date").value;
    var barcode_sticker1 = document.getElementById("barcode_sticker1").value;
    var form_name ="Print Lab Sticker 2";

    $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {
                      
                      form_name : form_name,
                      reg_date : reg_date,
                      sticker1 : barcode_sticker1,
                      UserType : usertype,
                    
                       },
                    success: function(data) {
                        $('#printsticker_result2').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });

  });
  
  
}

function reset_token()
{
  var r = confirm("Are you sure you want to reset all tokens and empty queue?");
  if (r == true) {

     $(document).ready(function() {
      var form_name ="Reset Token";
           $.ajax({
                    url: '././include/functions.php',
                    type: 'POST',
                    data: {

                     form_name : form_name,

                       },
                    success: function(data) {
                        $('#token_status').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //case error                    
                      }
                });

     });
  } 
  else {
    //txt = "You pressed Cancel!";
  }

}

// Noman scripts

function get_user_modules()
  {

      var form_name = "User Rights";
      var user_id = document.getElementById('item_1').value;

      $(document).ready(function() {

           $.ajax({
              url: '././include/functions.php',
              type: 'POST',
              data: {
               
               user_id : user_id, 
               form_name : form_name,
               
                 },
              success: function(data) {
                  $('#item_2').html(data);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                  //case error                    
                }
          });
      });
  }


function get_user_previous_modules(user_id)
  {

      var form_name = "User Actions";
      var module_id = document.getElementById('item_3').value;

      $(document).ready(function() {

           $.ajax({
              url: '././include/functions.php',
              type: 'POST',
              data: {
               
               module_id : module_id,
               user_id : user_id, 
               form_name : form_name,
               
                 },
              success: function(data) {
                  $('#item_4').html(data);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                  //case error                    
                }
          });
      });
  }


// function lab_result()
// {
//   $(document).ready(function() {

//         var form_name="Lab Result";
//         var lab_status = "FIT";
//         var barcode = document.getElementById("barcode").value;
//         var hcv = document.getElementById("hcv").value;
//         var hbs_ag = document.getElementById("hbs_ag").value;
//         var hiv = document.getElementById("hiv").value;
//         var vdrl = document.getElementById("vdrl").value;
//         var tpha = document.getElementById("tpha").value;
//         var rbs = document.getElementById("rbs").value;
//         var bil = document.getElementById("bil").value;
//         var alt = document.getElementById("alt").value;
//         var ast = document.getElementById("ast").value;
//         var alk = document.getElementById("alk").value;
//         var creatinine = document.getElementById("creatinine").value;
//         var blood_group = document.getElementById("blood_group").value;
//         var haemoglobin = document.getElementById("haemoglobin").value;
//         var malaria = document.getElementById("malaria").value;
//         var micro_filariae = document.getElementById("micro_filariae").value;
//         var sugar = document.getElementById("sugar").value;
//         var albumin = document.getElementById("albumin").value;
//         var helminthes = document.getElementById("helminthes").value;
//         var ova = document.getElementById("ova").value;
//         var cyst = document.getElementById("cyst").value;
//         //alert(haemoglobin);
//         var tb_test = document.getElementById("tb_test").value;
//         var pragnancy_test = document.getElementById("pragnancy_test").value;
//         var polio = document.getElementById("polio").value;
//         var poliodate = document.getElementById("poliodate").value;
//         var mmr1 = document.getElementById("mmr1").value;
//         var mmr1date = document.getElementById("mmr1date").value;
//         var mmr2 = document.getElementById("mmr2").value;
//         var mmr2date = document.getElementById("mmr2date").value;
//         var meningococcal = document.getElementById("meningococcal").value;
//         var meningococcaldate = document.getElementById("meningococcaldate").value;
//         if(document.getElementById("reg_id")) {
//           var regid = document.getElementById("reg_id").value;
//         } else {
//           var regid = '';
//         }

//         if(hcv == 'positive' || hbs_ag == 'positive' || hiv == 'positive' || vdrl == 'positive' || tpha == 'positive'){
//           lab_status = "UNFIT";
//         }

//         if(bil > 1.20)
//           alert("BIL Normal Range is 0.05-1.20");
//         if(alt > 40)
//           alert("ALT Normal Range is 10-40");
//         if(ast > 40)
//           alert("AST Normal Range is 10-40");
//         if(alk > 200)
//           alert("ALK Normal Range is 100-200");
//         if(creatinine > 1.20)
//           alert("Creatinine Normal Range is 0.05-1.20");
//         if(haemoglobin > 17)
//           alert("Haemoglobin Normal Range is 12-17");
          
//           var form_array = [barcode,hcv,hbs_ag,hiv,vdrl,tpha,rbs,bil,alt,ast,alk,creatinine,blood_group,haemoglobin,malaria,micro_filariae,sugar,albumin,helminthes,ova,cyst,tb_test,pragnancy_test,polio,poliodate,mmr1,mmr1date,mmr2,mmr2date,meningococcal,meningococcaldate,lab_status,regid];

//           $.ajax({
//                 url: '././include/functions.php',
//                 type: 'POST',
//                 data: {
                 
//                  form_values : form_array, 
//                  form_name : form_name,

//                    },
//                 success: function(data) {
//                     $('#respond_lab_result').html(data);
//                 },
//                 error: function(XMLHttpRequest, textStatus, errorThrown) {
//                     //case error                    
//                   }
//             });

//     });

// }

function lab_result()
{
  // console.log('hi');
  $(document).ready(function() {

        var form_name="Lab Result";
        var lab_status = "FIT";
        var barcode = document.getElementById("barcode").value;
        var hcv = document.getElementById("hcv").value;
        var hbs_ag = document.getElementById("hbs_ag").value;
        var hiv = document.getElementById("hiv").value;
        var vdrl = document.getElementById("vdrl").value;
        var tpha = document.getElementById("tpha").value;
        var rbs = document.getElementById("rbs").value;
        var bil = document.getElementById("bil").value;
        var alt = document.getElementById("alt").value;
        var ast = document.getElementById("ast").value;
        var alk = document.getElementById("alk").value;
        var creatinine = document.getElementById("creatinine").value;
        var blood_group = document.getElementById("blood_group").value;
        var haemoglobin = document.getElementById("haemoglobin").value;
        var malaria = document.getElementById("malaria").value;
        var micro_filariae = document.getElementById("micro_filariae").value;
        var sugar = document.getElementById("sugar").value;
        var albumin = document.getElementById("albumin").value;
        var helminthes = document.getElementById("helminthes").value;
        var ova = document.getElementById("ova").value;
        var cyst = document.getElementById("cyst").value;
        //alert(haemoglobin);
        var tb_test = document.getElementById("tb_test").value;
        var pragnancy_test = document.getElementById("pragnancy_test").value;
        var polio = document.getElementById("polio").value;
        var poliodate = document.getElementById("poliodate").value;
        var mmr1 = document.getElementById("mmr1").value;
        var mmr1date = document.getElementById("mmr1date").value;
        var mmr2 = document.getElementById("mmr2").value;
        var mmr2date = document.getElementById("mmr2date").value;
        var meningococcal = document.getElementById("meningococcal").value;
        var meningococcaldate = document.getElementById("meningococcaldate").value;
        // console.log(meningococcaldate);
        if(document.getElementById("reg_id")) {
          var regid = document.getElementById("reg_id").value;
          // console.log(regid);
          // console.log('hi');
        } else {
          var regid = '';
          // console.log('bye');
        }
        
        // console.log(regid);

        if(hcv == 'positive' || hbs_ag == 'positive' || hiv == 'positive' || vdrl == 'positive' || tpha == 'positive'){
          lab_status = "UNFIT";
        }

        if(bil > 1.20)
          alert("BIL Normal Range is 0.05-1.20");
        if(alt > 40)
          alert("ALT Normal Range is 10-40");
        if(ast > 40)
          alert("AST Normal Range is 10-40");
        if(alk > 200)
          alert("ALK Normal Range is 100-200");
        if(creatinine > 1.20)
          alert("Creatinine Normal Range is 0.05-1.20");
        if(haemoglobin > 17)
          alert("Haemoglobin Normal Range is 12-17");
          
          var form_array = [barcode,hcv,hbs_ag,hiv,vdrl,tpha,rbs,bil,alt,ast,alk,creatinine,blood_group,haemoglobin,malaria,micro_filariae,sugar,albumin,helminthes,ova,cyst,tb_test,pragnancy_test,polio,poliodate,mmr1,mmr1date,mmr2,mmr2date,meningococcal,meningococcaldate,lab_status,regid];

          $.ajax({
                url: '././include/functions.php',
                type: 'POST',
                data: {
                 
                 form_values : form_array, 
                 form_name : form_name,

                   },
                success: function(data) {
                    $('#respond_lab_result').html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //case error                    
                  }
            });

    });

}

function candidate_record_check(e)
{
  //alert(2222);
 
  e.which = e.which || e.keyCode;
  if(e.which == 13)
  {
    //alert("hi");
    var form_name = "Feed Back";
    var barcode = document.getElementById("barcode").value;
    //console.dir(barcode);
    //alert(barcode);
    // var cnic = document.getElementById("cnic").value;
      $(document).ready(function() {

             $.ajax({
                url: '././include/functions.php',
                type: 'POST',
                data: {

                 form_name : form_name,
                 barcode : barcode,
                 
                   },
                success: function(data) {
                  $('#serial_name').html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //case error                    
                  }
            });
      });
  }

}

function cand_feedback(e)
{
  var form_name = "Send Feed Back";
  
    var barcode_num = document.getElementById('barcode').value;
    var feedback;
    
    var feed = document.getElementById('feedback_value').value;
    if(feed==2) {
      feedback = "Need for improvement";
    }
    else if(feed==5) {
      feedback = "Satisfactory";
    }
    else {
      feedback = "Good";
    }
    
    var suggestion = document.getElementById('suggestion').value;

         $.ajax({
            url: '././include/functions.php',
            type: 'POST',
            data: {
             
             barcode_num : barcode_num, 
             feedback : feedback,
             suggestion : suggestion, 
             form_name : form_name,
             
               },
            success: function(data) {
                $('#cand_feed_result').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error                    
              }
        });
  
}

function cand_for_electronic_number()
{
 
  $(document).ready(function() {
      
    var form_name = "Electronic Number";
    var pp_no = document.getElementById("pp_no").value;

         $.ajax({
            url: '././include/functions.php',
            type: 'POST',
            data: {

             form_name : form_name,
             pp_no : pp_no,
             
               },
            success: function(data) {
              $('#cand_info2').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error                    
              }
        });
      
  });

}

function save_cand_eno()
{
  $(document).ready(function() {
      
    var form_name = "Save Eno";
    var pp_no2 = document.getElementById("pp_no2").value;
    var eno = document.getElementById("eno").value;
    var enoDate = document.getElementById("enoDate").value;

         $.ajax({
            url: '././include/functions.php',
            type: 'POST',
            data: {

             form_name : form_name,
             pp_no2 : pp_no2,
             eno : eno,
             enoDate : enoDate,
             
               },
            success: function(data) {
              $('#cand_info').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error                    
              }
        });
      
  });

}


function upload_screenshot()
{
 
  $(document).ready(function() {
      
    var form_name = "ENO Screenshot";
    var pp_no = document.getElementById("pp_no").value;
    // var screenshot = document.getElementById("screenshot").value;
    var file = document.getElementById('screenshot').files[0];
    var formData = new FormData();
    formData.append('file', file); // append file to your form


    var file_name = file.name;
    var file_size = file.size;
    var file_type = file.type;
    var dataString = 'feed='+post_text+'&img_name='+file_name+'&img_size='+file_size+'&img_type='+file_type;
    
    document.getElementById('screenshot').addEventListener('change', handleFileSelect, false);
    //var screenshot = document.getElementById('screenshot').files;
    
    // alert(pp_no);
    // alert(upload);

         $.ajax({
            url: '././include/functions.php',
            type: 'POST',
            data: {

             form_name : form_name,
             pp_no : pp_no,
             screenshot : screenshot,
             
               },
            success: function(data) {
              $('#cand_info').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error                    
              }
        });
      
  });

}

function mouseoverPass(obj) {
var obj = document.getElementById('myPassword');
obj.type = "text";
}

function mouseoutPass(obj) {
var obj = document.getElementById('myPassword');
obj.type = "password";
}

function onGoing_display_tokens()
{

    var form_name = "Display Token";
    var token_num = document.getElementById('token_num').value;

    $(document).ready(function() {

         $.ajax({
            url: '././include/functions.php',
            type: 'POST',
            data: {
             
             token_num : token_num, 
             form_name : form_name,
             
               },
            success: function(data) {
                $('#token_num').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //case error                    
              }
        });
    });
}
