<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.mastershop')}}</h1>
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
                                <h3 class="card-title">{{lang('Form.edit')}}</h3>
                            </div>
                            {{-- <div class = "col-6 text-right">
                                <a class = "" href="{{ baseUrl('mshop/add')}}"><i class = "fa fa-plus"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                              {!! formOpen(baseUrl('mshop/editsave'))!!}
                              {!! formInput(
                                array(
                                  "id" => "Id",
                                  "type" => "text",
                                  "value" => $model->Id,
                                  "name" => "Id",
                                  "hidden" => ""
                                )
                              ) !!}
                                <div class = "row">
                                    <div class = "col-sm-12 col-md-6 col-12">
                                      
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
                                              
                                            )
                                          ) !!}
                                        </div>
                                      </div>
                                    </div>
                                    <div class = "col-sm-12 col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="required">
                                              <label>{{ lang('Form.shop') }}</label>
                                              {!! formInput(
                                                array(
                                                  "id" => "Name",
                                                  "type" => "text",
                                                  "placeholder" => lang('Form.shop'),
                                                  "class" => "form-control",
                                                  "name" => "Name",
                                                  "value" => $model->Name,
                                                  
                                                )
                                              ) !!}
                                            </div>
                                          </div>
                                    </div>
                                  </div>
                                  <div class = "row">
                                      <div class = "col-sm-12 col-md-6 col-12">
                                        
                                        <div class="form-group">
                                            <div class="required">
                                              <label>{{ lang('Form.address') }} 1</label>
                                              {!! formTextArea($model->Address1,
                                                array(
                                                  "id" => "Address1",
                                                  "type" => "text",
                                                  "placeholder" => lang('Form.address'),
                                                  "class" => "form-control",
                                                  "name" => "Address1"
                                                )
                                              ) !!}
                                            </div>
                                        </div>
                                      </div>
                                      <div class = "col-sm-12 col-md-6 col-12">
                                          <div class="form-group">
                                              <div class="required">
                                                  <label>{{ lang('Form.address') }} 2</label>
                                                  {!! formTextArea($model->Address2,
                                                    array(
                                                      "id" => "Address2",
                                                      "type" => "text",
                                                      "placeholder" => lang('Form.address'),
                                                      "class" => "form-control",
                                                      "name" => "Address2"
                                                    )
                                                  ) !!}
                                              </div>
                                            </div>
                                      </div>
                                    </div>
                                    <div class = "row">
                                        <div class = "col-sm-12 col-md-6 col-12">
                                          
                                          <div class="form-group">
                                            <div class="required">
                                              <label>{{ lang('Form.email') }}</label>
                                              {!! formInput(
                                                array(
                                                  "id" => "Email",
                                                  "type" => "email",
                                                  "placeholder" => lang('Form.email'),
                                                  "class" => "form-control",
                                                  "name" => "Email",
                                                  "value" => $model->Email,
                                                  
                                                )
                                              ) !!}
                                            </div>
                                          </div>
                                        </div>
                                        <div class = "col-sm-12 col-md-6 col-12">
                                            <div class="form-group">
                                                <div class="required">
                                                  <label>{{ lang('Form.telephone') }}</label>
                                                  {!! formInput(
                                                    array(
                                                      "id" => "Phone",
                                                      "type" => "text",
                                                      "placeholder" => lang('Form.telephone'),
                                                      "class" => "form-control",
                                                      "name" => "Phone",
                                                      "value" => $model->Phone,
                                                      
                                                    )
                                                  ) !!}
                                                </div>
                                              </div>
                                        </div>
                                      </div>  
                                      <div class = "row">
                                        <div class = "col-sm-12 col-md-6 col-12">
                                          
                                          <div class="form-group">
                                            <div class="required">
                                              <label>{{ lang('Form.city') }}</label>
                                              {!! formInput(
                                                array(
                                                  "id" => "City",
                                                  "type" => "test",
                                                  "placeholder" => lang('Form.city'),
                                                  "class" => "form-control",
                                                  "name" => "City",
                                                  "value" => $model->City,
                                                  
                                                )
                                              ) !!}
                                            </div>
                                          </div>
                                        </div>
                                        <div class = "col-sm-12 col-md-6 col-12">
                                            <div class="form-group">
                                                <div class="required">
                                                  <label>{{ lang('Form.province') }}</label>
                                                  {!! formInput(
                                                    array(
                                                      "id" => "Province",
                                                      "type" => "text",
                                                      "placeholder" => lang('Form.province'),
                                                      "class" => "form-control",
                                                      "name" => "Province",
                                                      "value" => $model->Province,
                                                      
                                                    )
                                                  ) !!}
                                                </div>
                                            </div>
                                          </div>
                                        </div> 
                                        <div class = "row">
                                          <div class = "col-sm-12 col-md-6 col-12">
                                            
                                            <div class="form-group">
                                              <div class="required">
                                                <label>{{ lang('Form.city') }}</label>
                                                {!! formInput(
                                                  array(
                                                    "id" => "City",
                                                    "type" => "test",
                                                    "placeholder" => lang('Form.city'),
                                                    "class" => "form-control",
                                                    "name" => "City",
                                                    "value" => $model->City,
                                                    
                                                  )
                                                ) !!}
                                              </div>
                                            </div>
                                          </div>
                                          <div class = "col-sm-12 col-md-6 col-12">
                                              <div class="form-group">
                                                  <div class="required">
                                                    <label>{{ lang('Form.province') }}</label>
                                                    {!! formInput(
                                                      array(
                                                        "id" => "Province",
                                                        "type" => "text",
                                                        "placeholder" => lang('Form.province'),
                                                        "class" => "form-control",
                                                        "name" => "Province",
                                                        "value" => $model->Province,
                                                        
                                                      )
                                                    ) !!}
                                                  </div>
                                                </div>
                                          </div>
                                        </div> 
                                        <div class = "row">
                                            <div class = "col-sm-12 col-md-6 col-12">
                                              
                                              <div class="form-group">
                                                <div class="required">
                                                  <label>{{ lang('Form.postcode') }}</label>
                                                  {!! formInput(
                                                    array(
                                                      "id" => "PostCode",
                                                      "type" => "test",
                                                      "placeholder" => lang('Form.postcode'),
                                                      "class" => "form-control",
                                                      "name" => "PostCode",
                                                      "value" => $model->PostCode,
                                                      
                                                    )
                                                  ) !!}
                                                </div>
                                              </div>
                                            </div>
                                            <div class = "col-sm-12 col-md-6 col-12">
                                                <div class="form-group">
                                                    <div class="required">
                                                      <label>{{ lang('Form.country') }}</label>
                                                      {!! formInput(
                                                        array(
                                                          "id" => "Country",
                                                          "type" => "text",
                                                          "placeholder" => lang('Form.country'),
                                                          "class" => "form-control",
                                                          "name" => "Country",
                                                          "value" => $model->Country,
                                                          
                                                        )
                                                      ) !!}
                                                    </div>
                                                  </div>
                                            </div>
                                          </div> 
                                <div class="form-group">
                                  <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                                  <a href="{{ baseUrl('mshop') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
                                </div>
                              {!! formClose() !!}
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
            