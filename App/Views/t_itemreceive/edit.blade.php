<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.transactionitemreceive')}}</h1>
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
                                <a class = "link-action" href='{{ baseUrl("titemreceive/copy/$model->Id")}}'><i class = "fa fa-clone"></i> {{ lang('Form.copy')}}</a>
                              <!-- <a class = "link-action" href="{{ baseUrl("titemreceivedetail/$model->Id")}}"><i class = "fa fa-plus"></i> {{ lang('Form.detail')}}</a> -->
                          </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                              {!! formOpen(baseUrl('titemreceive/editsave'))!!}
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
                                  <a href="{{ baseUrl('titemreceive') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
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
                            <a data-toggle="modal" data-target="#modalItemtransfer"><i class = "fa fa-plus"></i></a>
                        </div>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                          <table id = "tableitemreceive" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed " role="grid">
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
        var tablereceivedetail;
        $(document).ready(function() {   
          dataTable();
          loadModalSelectItemtransfer();
        });
      
        function dataTable(){
          var tablereceivedetail = $('#tableitemreceive').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            "order" : [[2, "desc"]],
            responsive: true,
            language: {
            search: "_INPUT_",
            "search": "{{ lang('Form.search')}}"+" : "
            },
            "columnDefs": [ 
              {
                targets: 'disabled-sorting', 
                orderable: false
              },
              {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
              },
              {
                  "className": "td-actions text-right", 
                  "targets": [ 4 ] 
              }
            ],
            columns: [
              { responsivePriority: 3},
              { responsivePriority: 1},
              { responsivePriority: 2},
              { responsivePriority: 4},
              { responsivePriority: 5},
            ],
            "processing": true,
            "serverSide": true,
            ajax:{
              url : '{{ baseUrl("titemreceivedetail/getAllData/$model->Id")}}',
              dataSrc : 'data'
            },
            stateSave: true
          }); 

            // Delete a record
            tablereceivedetail.on( 'click', '.delete', function (e) {
              $tr = $(this).closest('tr');
              var data = tablereceivedetail.row($tr).data();
              var id = data['0'] + '~a';
              var name = document.getElementById(id).innerHTML;
              deleteData(name, function(result){
                if (result==true)
                {
                  $.ajax({
                    type : "POST",
                    url : "{{ baseUrl('titemreceivedetail/delete/')}}",
                    data : {id : data['0']},
                    success : function(data){
                      console.log(data);
                      var status = $.parseJSON(data);
                      if(status['isforbidden']){
                        window.location = "{{ baseUrl('Forbidden')}}";
                      } else {
                        if(!status['status']){
                          for(var i=0 ; i< status['msg'].length; i++){
                            var message = status['msg'][i];
                            setNotification(message, 3, "bottom", "right");
                          }
                        } else {
                          for(var i=0 ; i< status['msg'].length; i++){
                            var message = status['msg'][i];
                            setNotification(message, 2, "bottom", "right");
                          }
                          tablereceivedetail.row($tr).remove().draw();
                          e.preventDefault();
                        }
                      }
                    }
                  });
                }
              });
            });
        }
      </script>
            