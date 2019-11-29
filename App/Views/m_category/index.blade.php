<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{lang('Form.mastercategory')}}</h1>
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
                            <h3 class="card-title">{{lang('Form.data')}}</h3>
                        </div>
                        <div class = "col-6 text-right">
                            <a class = "" href="{{ baseUrl('mcategory/add')}}"><i class = "fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <table id = "tablecategory" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed " role="grid">
                        <thead class=" text-default">
                            <tr role = "row">
                            <th># </th>
                            <th>{{  lang('Form.name')}}</th>
                            <th>{{  lang('Form.description')}}</th>
                            <th>{{  lang('Form.createat')}}</th>
                            <th class="disabled-sorting text-right">{{  lang('Form.actions')}}</th>
                            </tr>
                        </thead>
                        <tfoot class=" text-default">
                            <tr role = "row">
                            <th># </th>
                            <th>{{  lang('Form.name')}}</th>
                            <th>{{  lang('Form.description')}}</th>
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
      var table = $('#tablecategory').DataTable({
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
          { responsivePriority: 5, data:"Id" },
          { responsivePriority: 1, data:"GroupName" },
          { responsivePriority: 2, data:"Description" },
          { responsivePriority: 4, data:"Created" },
          { responsivePriority: 2, data:"Action" }
        ],
        "processing": true,
        "serverSide": true,
        ajax:{
          url : "{{ baseUrl('mcategory/getAllData')}}",
          dataSrc : 'data'
        },
        stateSave: true
      }); 
  
       // Delete a record
       table.on( 'click', '.delete', function (e) {
          $tr = $(this).closest('tr');
          var data = table.row($tr).data();
          var id = data['Id'] + "~a";
          var name = document.getElementById(id).innerHTML;
          deleteData(name, function(result){
            if (result==true)
            {
              $.ajax({
                type : "POST",
                url : "{{ baseUrl('mcategory/delete/')}}",
                data : {id : data['Id']},
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
          window.location = "{{ baseUrl('mcategory/editrole/')}}" + id;
      });
  
      table.on( 'click', '.reportrole', function () {
          $tr = $(this).closest('tr');
          var data = table.row($tr).data();;
          var id = data['Id'];
          window.location = "{{ baseUrl('mcategory/editreportrole/')}}" + id;
      });
    }
  
    function init(){
      
    }
  </script>
        