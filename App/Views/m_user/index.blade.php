<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{lang('Form.master_user')}}</h1>
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
                <a class = "" href="{{ baseUrl('muser/add')}}"><i class = "fa fa-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="material-datatables">
              <div class="table-responsive">
                <table data-page-length="5" id = "tableUser" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                  <thead class=" text-default">
                      <th># </th>
                      <th><?=  lang('Form.user')?></th>
                      <th><?=  lang('Form.group_user')?></th>
                      <th><?=  lang('Form.shop')?></th>
                      <th><?=  lang('Form.isactive')?></th>
                      <th class="disabled-sorting text-right"><?=  lang('Form.actions')?></th>
                  </thead>
                  <tfoot class=" text-default">
                    <tr role = "row">
                      <th># </th>
                      <th><?=  lang('Form.user')?></th>
                      <th><?=  lang('Form.group_user')?></th>
                      <th><?=  lang('Form.shop')?></th>
                      <th><?=  lang('Form.isactive')?></th>
                      <th class="disabled-sorting text-right"><?=  lang('Form.actions')?></th>
                    </tr>
                  </tfoot>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </section>
</div>
<script type = "text/javascript">
var tableuser;
  $(document).ready(function() {    
    init();
    dataTable();
  });

  function dataTable(){
    var tableuser = $('#tableUser').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "<?= lang('Form.search')?>"+" : "
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
           "targets": [ 5 ] 
        }
      ],
      
      columns: [
        { responsivePriority: 5 },
        { responsivePriority: 1 },
        { responsivePriority: 3 },
        { responsivePriority: 4 },
        { responsivePriority: 6 },
        { responsivePriority: 2 }
      ],
      "processing": true,
      "serverSide": true,
      ajax:{
        url : "<?= baseUrl('muser/getAllData')?>",
        dataSrc : 'data'
      },
      stateSave: true
    }); 

     // Edit record
     tableuser.on( 'click', '.edit', function () {
        $tr = $(this).closest('tr');
        var data = tableuser.row($tr).data();
        var id = data[0] + "~a";
        window.location = "<?= baseUrl('muser/edit/');?>" + data[0];
     } );

     // Delete a record
     tableuser.on( 'click', '.activate', function (e) {
        $tr = $(this).closest('tr');
        var data = tableuser.row($tr).data();
        var id = data[0] + "~a";
        window.location = "<?= baseUrl('muser/activate/');?>" + data[0];
     });
  }

  function init(){
    
  }

  function delete_user(id, name){
    deleteData(name, function(result){
      if (result==true)
        window.location = "<?= baseUrl('muser/delete/');?>" + id;
    });
  } 
  function activate_user(id){
    window.location = "<?= baseUrl('muser/activate/');?>" + id;
  }
</script>
      