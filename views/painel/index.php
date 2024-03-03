<?php

/** @var yii\web\View $this */

$this->title = 'Meus Painéis';
?>
<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-md-5 align-self-center">
              <h3 class="page-title">Alarmes:</h3>
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
                href="/painel"
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
                  data-feather="grid"
                  class="feather-sm fill-white me-0 me-md-1"
                ></i
                ><span class="d-none d-md-block font-weight-medium "
                  >Meus</span
                ></a
              >
            </li>
            <li class="nav-item">
              <a
                href="/painel/integrado"
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
                  data-feather="layout"
                  class="feather-sm fill-white me-0 me-md-1"
                ></i
                ><span class="d-none d-md-block font-weight-medium"
                  >Painéis Integrados</span
                ></a
              >
            </li>
          
        
          </ul>
          
          <div class="tab-content">

            <!-- modals alarms-->

            <div
                      id="primary-header-modal"
                      class="modal fade"
                      tabindex="-1"
                      aria-labelledby="primary-header-modalLabel"
                      aria-hidden="true"
                    >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div
                            class="
                              modal-header modal-colored-header
                              bg-primary
                              text-white
                            "
                          >
                            <h4
                              class="modal-title"
                              id="primary-header-modalLabel"
                            >
                              Detalhes sobre o alarme
                            </h4>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <div class="modal-body">
                            <!--<h5 class="mt-0">Primary Background</h5>-->
                            <p>
                              Aqui teremos informações gerais sobre o referido alarme.
                            </p>
                           
                          </div>
                          <div class="modal-footer">
                            <button
                              type="button"
                              class="btn btn-light"
                              data-bs-dismiss="modal"
                            >
                              Fechar
                            </button>
                            <button
                              type="button"
                              class="
                                btn btn-light-primary
                                text-primary
                                font-weight-medium
                              "
                            >
                              Salvar
                            </button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

            <!-- end modals alarms-->

            <div id="note-full-container" class="note-has-grid row"> 
              <div class="col-md-12 single-note-item all-category note-social">
                <div class="card card-body">
                  <!-- DADOS FATURAS AQUI-->
                  CODE HERE 2
                  
                </div>
              </div>
              <div class="col-md-12 single-note-item all-category note-business">
                <div class="card card-body">                 
                  <div class="row gx-3">
                    <div class="col-md-6 col-lg-3 col-6">
                      <div class="card text-black bg-light-inverse">
                        <div class="card-body">
                          <span>
                            <i data-feather="grid" class="feather-lg fill-white"></i>
                          </span>
                          <h3 class="card-title mt-3 mb-0 text-black">Hospital Águas Claras</h3>
                          <p class="card-text text-black-50 fs-3 fw-normal">
                            Valdir de Luca
                          </p>
                          <p class="card-text text-success fs-3 fw-normal" style="text-align: right;">
                            <i data-feather="share-2"></i>
                            <i data-feather="trash-2"></i>
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-6">
                      <div class="card text-black bg-light-inverse">
                        <div class="card-body">
                          <span>
                            <i data-feather="grid" class="feather-lg fill-white"></i>
                          </span>
                          <h3 class="card-title mt-3 mb-0 text-black">Hospital Águas Claras</h3>
                          <p class="card-text text-black-50 fs-3 fw-normal">
                            Valdir de Luca
                          </p>
                          <p class="card-text text-success fs-3 fw-normal" style="text-align: right;">
                            <i data-feather="share-2"></i>
                            <i data-feather="trash-2"></i>
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-6">
                      <div class="card text-black bg-light-inverse">
                        <div class="card-body">
                          <span>
                            <i data-feather="grid" class="feather-lg fill-white"></i>
                          </span>
                          <h3 class="card-title mt-3 mb-0 text-black">Assaí Atacadista</h3>
                          <p class="card-text text-black-50 fs-3 fw-normal">
                            Valdir de Luca
                          </p>
                          <p class="card-text text-success fs-3 fw-normal" style="text-align: right;">
                            <i data-feather="share-2"></i>
                            <i data-feather="trash-2"></i>
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-6">
                      <div class="card text-black bg-light-inverse">
                        <div class="card-body">
                          <span>
                            <i data-feather="grid" class="feather-lg fill-white"></i>
                          </span>
                          <h3 class="card-title mt-3 mb-0 text-black">Grupo Pão de Açucar</h3>
                          <p class="card-text text-black-50 fs-3 fw-normal">
                            Valdir de Luca
                          </p>
                          <p class="card-text text-success fs-3 fw-normal" style="text-align: right;">
                            <i data-feather="share-2"></i>
                            <i data-feather="trash-2"></i>
                          </p>
                        </div>
                      </div>
                    </div>

                    <!--<div class="col-md-6 col-lg-3 col-6">
                      <div class="card text-white bg-warning rounded ">
                        <div class="card-body">
                          <span>
                            <i data-feather="grid" class="feather-lg fill-white"></i>
                          </span>
                          <h3 class="card-title mt-3 mb-0 text-white">Santander</h3>
                          <p class="card-text text-white-50 fs-3 fw-normal">
                            Wagner Carvalho
                          </p>
                          <p class="card-text text-white-50 fs-3 fw-normal" style="text-align: right;">
                            <i data-feather="share-2"></i>
                            <i data-feather="trash-2"></i>
                          </p>
                        </div>
                      </div>
                    </div> -->                         
                  </div>
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