<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.master_groupuser')}}</h1>
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
                                <a class = "" href="{{ baseUrl('mgroupuser/add')}}"><i class = "fa fa-plus"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                              
                              {!! formOpen(baseUrl('mgroupuser/addsave'))!!}
                                <div class="form-group">
                                  <div class="required">
                                    <label>{{ lang('Form.name') }}</label>
                                    {!! formInput(
                                      array(
                                        "id" => "GroupName",
                                        "type" => "text",
                                        "placeholder" => lang('Form.groupuser'),
                                        "class" => "form-control",
                                        "name" => "GroupName",
                                        "value" => $model->GroupName,
                                        "required" => ""
                                      )
                                    ) !!}
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>{{ lang('Form.description') }}</label>
                                  {!! formTextArea($model->Description,
                                      array(
                                        "id" => "Description",
                                        "type" => "text",
                                        "placeholder" => lang('Form.groupuser'),
                                        "class" => "form-control",
                                        "name" => "Description"
                                      )
                                    ) !!}
                                </div>
                                <div class="form-group">
                                  <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                                  <a href="{{ baseUrl('mgroupuser') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
                                </div>
                              {!!formClose() !!}
                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
      
    </div>
      <script>
      
        $(document).ready(function() {   
          
          
        });
      
       
      
        function init(){
          
        }
      </script>
            