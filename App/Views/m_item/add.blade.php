<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.masteritem')}}</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">{{lang('Form.master')}}</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <div class = "row">
                            <div class = "col-6">
                                <h3 class="card-title">{{lang('Form.add')}}</h3>
                            </div>
                            {{-- <div class = "col-6 text-right">
                                <a class = "" href="{{ baseUrl('mitem/add')}}"><i class = "fa fa-plus"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <form method="post" action="{{ baseUrl('mitem/addsave')}}">
                              <div class="form-group">
                                <div class="required">
                                  <label>{{ lang('Form.code') }}</label>
                                  {!! formInput(
                                    array(
                                      "id" => "Code",
                                      "type" => "text",
                                      "placeholder" => lang('Form.code'),
                                      "class" => "form-control",
                                      "name" => "Code",
                                      "value" => $model->Code,
                                      "required" => ""
                                    )
                                  ) !!}
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="required">
                                  <label>{{ lang('Form.name') }}</label>
                                  {!! formInput(
                                    array(
                                      "id" => "Name",
                                      "type" => "text",
                                      "placeholder" => lang('Form.item'),
                                      "class" => "form-control",
                                      "name" => "Name",
                                      "value" => $model->Name,
                                      "required" => ""
                                    )
                                  ) !!}
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="required">
                                  <label><?= lang('Form.category') ?></label>
                                  <div class="input-group has-success">
                                    <?= formInput(
                                      array(
                                        "id" => "M_Category_Id",
                                        "name" => "M_Category_Id",
                                        "value" => $model->M_Category_Id,
                                        "hidden" => ""
                                      )
                                    ) ?>
                                    <?= formInput(
                                    array(
                                      "id" => "categoryname",
                                      "type" => "text",
                                      "placeholder" => lang('Form.category'),
                                      "class" => "form-control custom-readonly clearable",
                                      "name" => "categoryname",
                                      "value" => $model->get_M_Category()->Name,
                                      "readonly" => ""
                                    )
                                  )
                                  ?>
                                    <!-- <span class="form-control-feedback text-primary">
                                        <i class="material-icons">search</i>
                                    </span> -->
                                    <div class="input-group-append">
                                      <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalCategory"><i class="fa fa-search"></i></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                                <a href="{{ baseUrl('mitem') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
                              </div>
                            </form>
                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
      
      <?php  Core\View::presentBlade('m_category.modal'); ?>
    </div>
      <script>
      
        $(document).ready(function() {   
          
          
        });
      
       
      
        function init(){
          
        }
      </script>
            