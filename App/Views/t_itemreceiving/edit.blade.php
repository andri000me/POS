<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.transactionitemreceiving')}}</h1>
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
                                <a class = "link-action" href='{{ baseUrl("titemreceiving/copy/$model->Id")}}'><i class = "fa fa-clone"></i> {{ lang('Form.copy')}}</a>
                              <!-- <a class = "link-action" href="{{ baseUrl("titemreceivingdetail/$model->Id")}}"><i class = "fa fa-plus"></i> {{ lang('Form.detail')}}</a> -->
                          </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                              {!! formOpen(baseUrl('titemreceiving/editsave'))!!}
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
                                    {!! formLabel(lang('Form.type')) !!}
                                    {!!  formSelect(
                                      $model->getEnumStatus(),
                                      "Value",
                                      "EnumName",
                                      array(
                                        "id" => "Status",
                                        "class" => "selectpicker form-control",
                                        "name" => "Status",
                                        "value" => $model->Status
                                      )
                                    ) !!}
                                  </div>
                                </div>
                                <div class="form-group">
                                  <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                                  <a href="{{ baseUrl('titemreceiving') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
                                </div>
                              {!! formClose() !!}
                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                  <div class="card-header">
                      <div class = "row">
                          <div class = "col-6">
                              <h3 class="card-title">{{lang('Form.detail')}}</h3>
                          </div>
                          <div class = "col-6 text-right">

                            <!-- <a id = "btnSaveDetail" href="#" data-toggle="modal" class = "btn-just-icon link-action"><i class = "fa fa-save"></i></a> -->
                            <a href="#" data-toggle="modal" data-target="#modalItemtransfer" class = "btn-just-icon link-action"><i class = "fa fa-plus"></i></a>
                        </div>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                          <table id = "tableitemreceiving" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed " role="grid">
                          <thead class=" text-default">
                              <tr role = "row">
                              <th># </th>
                              <th>{{  lang('Form.number')}}</th>
                              <th>{{  lang('Form.date')}}</th>
                              <th>{{  lang('Form.shopfrom')}}</th>
                              <th class="disabled-sorting text-right">{{  lang('Form.actions')}}</th>
                              </tr>
                          </thead>
                          <tfoot class=" text-default">
                              <tr role = "row">
                              <th># </th>
                              <th>{{  lang('Form.number')}}</th>
                              <th>{{  lang('Form.date')}}</th>
                              <th>{{  lang('Form.shopfrom')}}</th>
                              <th class="disabled-sorting text-right">{{  lang('Form.actions')}}</th>
                              </tr>
                          </tfoot>
                          <tbody>
                          
                          </tbody>
                          </table>
                      </div>
                  <!-- /.card-body -->
                  </div>
              </div>
          </div>
      </section>
    </div>
    <?php  Core\View::presentBlade('t_itemtransfer.modal'); ?>
      <script>
        var tablereceivingdetail;
        var detailsadd = [];
        $(document).ready(function() {   
          dataTable();
          loadModalSelectItemtransfer(function(modalId, modaltable){
            modalId.on('hide.bs.modal', function () {
                var selected = modaltable.rows({ selected: true }).data();
                if(selected.length > 0){
                  for (var i=0; i < selected.length ;i++){
                    detailsadd.push(selected[i][0]);
                  }
                  addDetail();
                }
            });

            modalId.on('show.bs.modal', function () {
                modaltable.ajax.url('{{ baseUrl("titemtransfer/getDataModalItemTransfer/$model->Id") }}').load();
            });
          });
        });

    

        function addDetail(){
          $.ajax({
            url : "{{baseUrl('titemreceivingdetail/addDetailJson')}}",
            type : "POST",
            data : {id: "{{$model->Id}}", detail : detailsadd},
            success : function (result){
              if(result == "true"){
                tablereceivingdetail.ajax.reload(null, true);
              }
            }
          })
        }

        function dataTable(){
          var columns = [
              { responsivePriority: 3},
              { responsivePriority: 1},
              { responsivePriority: 2},
              { responsivePriority: 4},
              { responsivePriority: 5},
          ];

          loadIndexDataTable("tableitemreceiving", 
            '{{ baseUrl("titemreceivingdetail/getAllData/$model->Id")}}', 
            "{{ lang('Form.search')}}", 
            '{{ baseUrl("titemreceivingdetail/delete/")}}',
            columns,
            function(indextable){
              tablereceivingdetail = indextable;
            }
          );
        }
      </script>
            