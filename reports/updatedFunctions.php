
    <div class="col-md-4">
                  </div>

              <form method="post" action="">
                  <div class="col-md-2">
                    <div class="form-group float-right">
                        
                      <!-- <input type="text" name="from_date" value="<?php echo $from ?>">
                      <input type="text" name="to_date" value="<?php echo $to ?>"> -->
                      <input type="submit" class="btn btn-default" name="pdf_report" value="PDF">
                    </div>
                  </div>
              </from>
                </div>  


<tbody>
                 <?php
                      /*if($_POST['btnSearch'])
                      {
                        if(isset($_POST['to']) && ($_POST['from']))
                        {
                            $to = $_POST['to'];
                            $from = $_POST['from'];
                            history($to, $from);
                        }
                        else
                        {
                            alert_box("Please set dates before searching");
                        }
                      }*/
                      if(isset($_POST['search']))
                      {
                        if(isset($_POST['to']) && ($_POST['from']))
                        {
                            $to = $_POST['to'];
                            $from = $_POST['from'];
                            /*alert_box("$to");
                            alert_box("$from");*/
                            get_dateBWsearch($to, $from);
                            if(isset($_POST['pdf_report']))
                            {
                                get_pdf_data($to, $from);
                            }
                        }
                        else
                        {
                            alert_box("Please select dates first!");
                        }
                      }
                      else
                      {
                          history();  
                      }
                      
                  ?>
  </tbody>

<?php
// functions.php

//  Updated by N
function get_pdf_data($to, $from) 
{    
  global $data;

/*    $to = $_POST['to_date'];
    $from = $_POST['from_date'];*/

    $to_strd=date("d-m-y",strtotime($to));
    $from_strd=date("d-m-y",strtotime($from));
                
     $process_query = $data->query("select reg_date, serial_no, candidate_name, son_of, passport_no, country, agency from tb_registration where (reg_date >= '$to_strd' AND reg_date <= '$from_strd')");
     
     //$rows = mysqli_fetch_array($process_query);
     //alert($process_query);
/*
        while ($rows = mysqli_fetch_array($process_query)) {
          $date = $rows['reg_date'];
          $serial_no = $rows['serial_no'];
          $cand_name = $rows['candidate_name'];
          $son_of = $rows['son_of'];
          $pp_no = $rows['passport_no'];
          $country = $rows['country'];
          $agency = $rows['agency'];
          $status = 'FIT';
        }
*/


        echo "<script>window.open('../reports/reportCollection?data=$to','_blank')</script>";
        //echo "<script>window.open('../reports/reportCollection.php','getPDF_Data($process_query)')</script>";

        //redirect('reports/reportCollection.php', getPDF_Data($process_query));     

    

}



?>