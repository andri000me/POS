<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{lang('Form.transactionitemstockdetail')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{lang('Form.transaction')}}</li>
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
                            <h3 class="card-title">{{lang('Form.data')}}<a href="{{ baseUrl("titemstock/edit/$model->Id") }}">{{ " ( $model->TransNo ) "}}</a></h3>
                        </div>
                        <div class = "col-6 text-right">
                            <a class = "" href='{{ baseUrl("titemstockdetail/add/$model->Id")}}''><i class = "fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <table id = "tableitemstockdetail" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed " role="grid">
                        <thead class=" text-default">
                            <tr role = "row">
                            <th># </th>
                            <th>{{  lang('Form.item')}}</th>
                            <th>{{  lang('Form.uom')}}</th>
                            <th>{{  lang('Form.warehouse')}}</th>
                            <th>{{  lang('Form.qty')}}</th>
                            <th>{{  lang('Form.createat')}}</th>
                            <th class="disabled-sorting text-right">{{  lang('Form.actions')}}</th>
                            </tr>
                        </thead>
                        <tfoot class=" text-default">
                            <tr role = "row">
                            <th># </th>
                            <th>{{  lang('Form.item')}}</th>
                            <th>{{  lang('Form.uom')}}</th>
                            <th>{{  lang('Form.warehouse')}}</th>
                            <th>{{  lang('Form.qty')}}</th>
                            <th>{{  lang('Form.createat')}}</th>
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
  <script>
  
    $(document).ready(function() {   
      
      init();
      dataTable();
    });
  
    function dataTable(){
      var table = $('#tableitemstockdetail').DataTable({
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
             "targets": [ 6 ] 
          }
        ],
        columns: [
          { responsivePriority: 6},
          { responsivePriority: 1},
          { responsivePriority: 2},
          { responsivePriority: 4},
          { responsivePriority: 5},
          { responsivePriority: 7},
          { responsivePriority: 2}
        ],
        "processing": true,
        "serverSide": true,
        ajax:{
          url : '{{ baseUrl("titemstockdetail/getAllData/$model->Id")}}',
          dataSrc : 'data'
        },
        stateSave: true
      }); 
  
       // Delete a record
       table.on( 'click', '.delete', function (e) {
          $tr = $(this).closest('tr');
          var data = table.row($tr).data();
          var id = data['0'] + '~a';
          var name = document.getElementById(id).innerHTML;
          deleteData(name, function(result){
            if (result==true)
            {
              $.ajax({
                type : "POST",
                url : "{{ baseUrl('titemstockdetail/delete/')}}",
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
                      table.row($tr).remove().draw();
                      e.preventDefault();
                    }
                  }
                }
              });
            }
          });
       });
  
      //Like record
      table.on( 'click', '.role', function () {
          $tr = $(this).closest('tr');
          var data = table.row($tr).data();;
          var id = data['Id'];
          window.location = "{{ baseUrl('titemstockdetail/editrole/')}}" + id;
      });
  
      table.on( 'click', '.reportrole', function () {
          $tr = $(this).closest('tr');
          var data = table.row($tr).data();;
          var id = data['Id'];
          window.location = "{{ baseUrl('titemstockdetail/editreportrole/')}}" + id;
      });
    }
  
    function init(){
      
    }
  </script>
        