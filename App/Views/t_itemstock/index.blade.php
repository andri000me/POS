<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{lang('Form.transactionitemstock')}}</h1>
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
                            <h3 class="card-title">{{lang('Form.data')}}</h3>
                        </div>
                        <div class = "col-6 text-right">
                            <a class = "" href="{{ baseUrl('titemstock/add')}}"><i class = "fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                        <table id = "tableitemstock" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed " role="grid">
                        <thead class=" text-default">
                            <tr role = "row">
                            <th># </th>
                            <th>{{  lang('Form.number')}}</th>
                            <th>{{  lang('Form.date')}}</th>
                            <th>{{  lang('Form.status')}}</th>
                            <th>{{  lang('Form.shop')}}</th>
                            <th>{{  lang('Form.createat')}}</th>
                            <th class="disabled-sorting text-right">{{  lang('Form.actions')}}</th>
                            </tr>
                        </thead>
                        <tfoot class=" text-default">
                            <tr role = "row">
                            <th># </th>
                            <th>{{  lang('Form.number')}}</th>
                            <th>{{  lang('Form.date')}}</th>
                            <th>{{  lang('Form.status')}}</th>
                            <th>{{  lang('Form.shop')}}</th>
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
      var columns = [
          { responsivePriority: 7},
          { responsivePriority: 1},
          { responsivePriority: 3},
          { responsivePriority: 4},
          { responsivePriority: 5},
          { responsivePriority: 6},
          { responsivePriority: 2}
      ];
      loadIndexDataTable('tableitemstock', 
      "{{ baseUrl('titemstock/getAllData') }}", 
      "{{ lang('Form.search')}}",
      "{{ baseUrl('titemstock/delete')}}",
      columns);
    });
  
  </script>
        