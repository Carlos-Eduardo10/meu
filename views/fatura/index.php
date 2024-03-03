<?php

/** @var yii\web\View $this */

$this->title = 'Faturas';
?>
<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-md-5 align-self-center">
              <h3 class="page-title">Faturas:</h3>
              <div class="d-flex align-items-center">
                
              </div>
            </div>
            <div
              class="
                col-md-7
                justify-content-end
                align-self-center
                d-none d-md-flex
              "
            >
              <div class="d-flex">
                
                <!--<button class="btn btn-success">
                  <i data-feather="plus" class="fill-white feather-sm"></i>
                  Create
                </button>-->
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid note-has-grid">
          <ul class="nav nav-pills p-3 bg-white mb-3 align-items-center">
            
            <li class="nav-item">
              <a
                href="/fatura"
                class="
                  nav-link
                  rounded-pill
                  note-link
                  d-flex
                  align-items-center
                  justify-content-center
                  px-3 px-md-3
                  me-0 me-md-2
                  active
                "
                id="note-business"
              >
                <i
                  data-feather="bar-chart"
                  class="feather-sm fill-white me-0 me-md-1"
                ></i
                ><span class="d-none d-md-block font-weight-medium"
                  >Gráficos</span
                ></a
              >
            </li>
            <li class="nav-item">
              <a
                href="/fatura/dados"
                class="
                  nav-link
                  rounded-pill
                  note-link
                  d-flex
                  align-items-center
                  justify-content-center
                  px-3 px-md-3
                  me-0 me-md-2
                "
                id="note-social"
              >
                <i
                  data-feather="file-text"
                  class="feather-sm fill-white me-0 me-md-1"
                ></i
                ><span class="d-none d-md-block font-weight-medium"
                  >Dados</span
                ></a
              >
            </li>
          
        
          </ul>
          
          <div class="tab-content">
            <div id="note-full-container" class="note-has-grid row"> 
              <div class="col-md-8 single-note-item all-category note-business">
                <div class="card">                 
                  <div class="card-body">
                    <ul class="list-inline text-end">
                      <li class="list-inline-item">
                        <h5>
                          <i class="fa fa-circle me-1 text-inverse"></i>Consumo ponta
                        </h5>
                      </li>
                      <li class="list-inline-item">
                        <h5><i class="fa fa-circle me-1 text-info"></i>Consumo fora ponta</h5>
                      </li>
                      <li class="list-inline-item">
                        <h5>
                          <i class="fa fa-circle me-1 text-success"></i>Demanda única
                        </h5>
                      </li>
                    </ul>
                    <div id="morris-area-chart"></div>
                  </div>
                </div>
                
              </div>
             
              
              <div class="col-md-4 single-note-item all-category note-business">
                <div class="card">                 
                  <div class="card-body">
                    <h6 class="card-subtitle lh-base">
                      Ponto de medição
                    </h6>
                    <select
                    class="select2 form-control custom-select"
                    style="width: 100%; height: 36px"
                    >
                    <option>Principal</option>
                   </select>
                   <br>
                   <h6 class="card-subtitle lh-base">
                    Modo de visão
                  </h6>
                  <select
                  class="select2 form-control custom-select"
                  style="width: 100%; height: 36px"
                  >
                  <option>Energia</option>
                  <option>Financeiro</option>
                 </select>
                  </div>  

                  <div class="card-body">
                    <h6 class="card-subtitle">
                      Data inicial
                    </h6>
                    <input
                    id="picker_from"
                    class="form-control datepicker"
                    type="date"
                  /><br>
                  <h6 class="card-subtitle">
                    Data final
                  </h6>
                  <input
                        id="picker_to"
                        class="form-control datepicker"
                        type="date"
                      />
                  
                </div>
                
                  <button type="button" class="btn waves-effect waves-light btn-success">Calcular fatura</button>
                

                  
                 
                </div>
              </div>
              
              </div>
              
             
              </div>
          
              
           

        </div>
        
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== 
        -->
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->