<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.transactionitemtransfer')}}</h1>
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
                            <div class = "col-6 text-right">
                                <a class = "link-action" href="{{ baseUrl("titemtransfer/copy/$model->Id")}}"><i class = "fa fa-clone"></i> {{ lang('Form.copy')}}</a>
                              <a class = "link-action" href="{{ baseUrl("titemtransferdetail/$model->Id")}}"><i class = "fa fa-plus"></i> {{ lang('Form.detail')}}</a>
                          </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                              {!! formOpen(baseUrl('titemtransfer/editsave'))!!}
                              {!! formInput(
                                array(
                                  "id" => "Id",
                                  "type" => "text",
                                  "value" => $model->Id,
                                  "name" => "Id",
                                  "hidden" => ""
                                )
                              ) !!}
                                <div class="form-group">
                                  <div class="required">
                                    <label>{{ lang('Form.number') }}</label>
                                    {!! formInput(
                                      array(
                                        "id" => "TransNo",
                                        "type" => "text",
                                        "placeholder" =>"[Auto Generated]",
                                        "class" => "form-control",
                                        "name" => "TransNo",
                                        "value" => $model->TransNo,
                                        "disabled" => ""
                                      )
                                    ) !!}
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="required">
                                    <label>{{ lang('Form.date') }}</label>
                                    {!! formInput(
                                      array(
                                        "id" => "TransDate",
                                        "type" => "text",
                                        "placeholder" => lang('Form.date'),
                                        "class" => "form-control date",
                                        "name" => "TransDate",
                                        "value" => get_formated_date($model->TransDate, "d-m-Y")
                                      )
                                    ) !!}
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="required">
                                    <label><?= lang('Form.shopto') ?></label>
                                    <div class="input-group has-success">
                                      <?= formInput(
                                        array(
                                          "id" => "M_Shop_Id_To",
                                          "name" => "M_Shop_Id_To",
                                          "value" => $model->M_Shop_Id_To,
                                          "hidden" => ""
                                        )
                                      ) ?>
                                      <?= formInput(
                                      array(
                                        "id" => "shopnameto",
                                        "type" => "text",
                                        "placeholder" => lang('Form.shopto'),
                                        "class" => "form-control custom-readonly clearable",
                                        "name" => "shopnameto",
                                        "value" => $model->get_M_Shop('To')->Name,
                                        "readonly" => ""
                                      )
                                    )
                                    ?>
                                      <!-- <span class="form-control-feedback text-primary">
                                          <i class="material-icons">search</i>
                                      </span> -->
                                      <div class="input-group-append">
                                        <button id="btnShopToModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalShop"><i class="fa fa-search"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="required">
                                    <?= formLabel(lang('Form.type')) ?>
                                    <?= formSelect(
                                      $model->getEnumStatus(),
                                      "Value",
                                      "EnumName",
                                      array(
                                        "id" => "Status",
                                        "class" => "selectpicker form-control",
                                        "name" => "Status",
                                        'value' => $model->Status
                                      )
                                    ) ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                                  <a href="{{ baseUrl('titemtransfer') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
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
            