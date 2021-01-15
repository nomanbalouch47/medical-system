<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="#">
          <img src="assets/img/comp_logo/reliance_logo.png" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">

            <?php
              if(auth_user_sideBar($loginuser,4)==1){
            ?>            
            <li class="nav-item">
              <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
                <!-- <i class="ni ni-home text-primary"></i> -->
                <i class="far fa-hospital text-primary"></i>
                <span class="nav-link-text">Administration</span>
              </a>
              <div class="collapse" id="navbar-dashboards">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a href="user_creation" class="nav-link">User Creation</a>
                  </li>
                  <li class="nav-item">
                    <a href="user_role" class="nav-link">User Role</a>
                  </li>
                  <li class="nav-item">
                    <a href="add_country" class="nav-link">Country Setup</a>
                  </li>
                  <li class="nav-item">
                    <a href="add_profession" class="nav-link">Profession Setup</a>
                  </li>
                  <li class="nav-item">
                    <a href="add_agency" class="nav-link">Agency Setup</a>
                  </li>
                  <li class="nav-item">
                    <a href="add_nationality" class="nav-link">Nationality Setup</a>
                  </li>
                  <li class="nav-item">
                    <a href="add_place_of_issue" class="nav-link">Place of Issue</a>
                  </li>
                  <li class="nav-item">
                    <a href="print_duplicate_lab_sticker" class="nav-link">Duplicate Lab Sticker</a>
                  </li>

                </ul>
              </div>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,1)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-user-plus text-orange"></i>
                <!-- <i class="ni ni-ungroup text-orange"></i> -->
                <span class="nav-link-text">Registration</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="registration" class="nav-link">Register</a>
                  </li>
                  <li class="nav-item">
                    <a href="registration_history" class="nav-link">History</a>
                  </li>
                </ul>
              </div>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,17)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="passport_verification">
                <i class="fa fa-fingerprint text-green"></i>
                <!-- <i class="ni ni-archive-2 text-green"></i> -->
                <span class="nav-link-text">Passport Indentification</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,7)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="sample_collection">
                <i class="fa fa-vials text-danger"></i>
                <!-- <i class="ni ni-chart-pie-35 text-info"></i> -->
                <span class="nav-link-text">Sample Collection</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,2)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="medicalOfficer">
                <i class="fa fa-plus-square text-danger"></i>
                <!-- <i class="ni ni-chart-pie-35 text-info"></i> -->
                <span class="nav-link-text">Medical Officer</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,3)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples12" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-x-ray text-info"></i>
                <!-- <i class="ni ni-ungroup text-orange"></i> -->
                <span class="nav-link-text">X-Ray</span>
              </a>
              <div class="collapse" id="navbar-examples12">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="xray" class="nav-link">Verification</a>
                  </li>
                  <?php
                    if(auth_user_sideBar($loginuser,18)==1){
                  ?>
                  <li class="nav-item">
                    <a href="xray_result" class="nav-link">Xray Result</a>
                  </li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,28)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples123" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-x-ray text-primary"></i>
                <!-- <i class="ni ni-ungroup text-orange"></i> -->
                <span class="nav-link-text">LAB </span>
              </a>
              <div class="collapse" id="navbar-examples123">
                <ul class="nav nav-sm flex-column">
                  <?php
                    if(auth_user_sideBar($loginuser,20)==1){
                  ?>
                  <li class="nav-item">
                    <a href="print_lab_sticker" class="nav-link">Print Sticker</a>
                  </li>
                  <?php
                    }
                  ?>
                  <?php
                    if(auth_user_sideBar($loginuser,19)==1){
                  ?>
                  <li class="nav-item">
                    <a href="lab_result" class="nav-link">Lab Result</a>
                  </li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,21)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="print_report">
                <i class="fa fa-clipboard-list text-danger"></i>
               <!--  <i class="ni ni-chart-pie-35 text-info"></i> -->
                <span class="nav-link-text">Print Report</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,22)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="token_generation">
                <i class="ni ni-zoom-split-in text-primary"></i>
               <!--  <i class="ni ni-chart-pie-35 text-info"></i> -->
                <span class="nav-link-text">Token Generation</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,29)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples1235" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-tablet-button text-primary"></i>
                <!-- <i class="ni ni-ungroup text-orange"></i> -->
                <span class="nav-link-text">ENO </span>
              </a>
              <div class="collapse" id="navbar-examples1235">
                <ul class="nav nav-sm flex-column">
                  <?php
                    if(auth_user_sideBar($loginuser,23)==1){
                  ?>
                  <li class="nav-item">
                    <a href="electronic_number" class="nav-link">Electronic Number</a>
                  </li>
                  <?php
                    }
                  ?>
                  <?php
                    if(auth_user_sideBar($loginuser,30)==1){
                  ?>
                  <li class="nav-item">
                    <a href="eno_screenshots" class="nav-link">ENO Screenshots</a>
                  </li>
                  <?php
                    }
                  ?>
                </ul>
              </div>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,24)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="token_status">
                <i class="fa fa-clipboard-check text-primary"></i>
                <!-- <i class="ni ni-chart-pie-35 text-info"></i> -->
                <span class="nav-link-text">Token Status</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,31)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="candidate_token_process_details">
                <i class="fa fa-clipboard-check text-primary"></i>
                <!-- <i class="ni ni-chart-pie-35 text-info"></i> -->
                <span class="nav-link-text">Candidate Token Process</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,25)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="candidate_medical_process">
                <i class="ni ni-sound-wave text-danger"></i>
                <!-- <i class="ni ni-archive-2 text-green"></i> -->
                <span class="nav-link-text">Candidate Medical Status</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,6)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="report_issuance">
                <i class="ni ni-paper-diploma text-green"></i>
                <!-- <i class="ni ni-archive-2 text-green"></i> -->
                <span class="nav-link-text">Report Issuance</span>
              </a>
            </li>
            <?php
              }
            ?>

            <?php
              if(auth_user_sideBar($loginuser,5)==1){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples1" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples1">
                <i class="fa fa-file text-orange"></i>
                <!-- <i class="ni ni-ungroup text-orange"></i> -->
                <span class="nav-link-text">Reports</span>
              </a>
              <div class="collapse" id="navbar-examples1">
                <ul class="nav nav-sm flex-column">
                  <?php
                    if(auth_user_sideBar($loginuser,32)==1){
                  ?>
                  <li class="nav-item">
                    <a href="daily_registration" target="_blank" class="nav-link">Daily Registration Register</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,16)==1){
                  ?>
                  <li class="nav-item">
                    <a href="registration_history" target="_blank" class="nav-link">Registration History</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,33)==1){
                  ?>
                  <li class="nav-item">
                    <a href="daily_status_report" target="_blank" class="nav-link">Daily Status Report</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,34)==1){
                  ?>
                  <li class="nav-item">
                    <a href="yearly_monthly_report" target="_blank" class="nav-link">Monthly/Yearly Report</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,35)==1){
                  ?>
                  <li class="nav-item">
                    <a href="daily_eno_report" target="_blank" class="nav-link">Daily ENO Report</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,36)==1){
                  ?>
                  <li class="nav-item">
                    <a href="reports/daily_cash_statement" target="_blank" class="nav-link">Daily Cash Statement</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,37)==1){
                  ?>
                  <li class="nav-item">
                    <a href="lab_register_report" target="_blank" class="nav-link">Lab Register Report</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,38)==1){
                  ?>
                  <li class="nav-item">
                    <a href="reports/summary_report" target="_blank" class="nav-link">Yearly Summary Report</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,39)==1){
                  ?>
                  <li class="nav-item">
                    <a href="reports/daily_summary_report" target="_blank" class="nav-link">Daily Summary Report</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,40)==1){
                  ?>
                  <li class="nav-item">
                    <a href="medical_slip_expiry_report" target="_blank" class="nav-link">Reference Slip Expiry Report</a>
                  </li>
                  <?php
                    }
                  ?>

                  <?php
                    if(auth_user_sideBar($loginuser,41)==1){
                  ?>
                  <li class="nav-item">
                    <a href="code_list" target="_blank" class="nav-link">Code List</a>
                  </li>
                  <?php
                    }
                  ?>
                  
                  
                </ul>
              </div>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>