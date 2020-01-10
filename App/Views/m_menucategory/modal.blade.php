<!-- modal -->
<div id="modalMenucategory" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupUserModalLabel" class="modal-title">{{lang('Form.menucategory')}}</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="card-body">
        <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar
                                  -->
        </div>
        <div class="material-datatables">
          <div id = "datatables_wrapper" class = "dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table data-page-length="5" id = "tableModalMenucategory" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-default">
                        
                        <th># </th>
                        <th>{{   lang('Form.name')}}</th>
                    </thead>
                    <tfoot class=" text-default">
                      <tr role = "row">
                        <th># </th>
                        <th>{{   lang('Form.name')}}</th>
                      </tr>
                    </tfoot>
                    <tbody>
                   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type = "text/javascript">
  var tableMenucategory ;
  $(document).ready(function() {  
    loadModalMenucategory();
  });

  function loadModalMenucategory(){
    tableMenucategory  = $("#tableModalMenucategory").DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "{{  lang('Form.search')}}"+" : ",
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
          }
        ],
        "processing": true,
        "serverSide": true,
        ajax:{
            url : "{{  baseUrl('mmenucategory/getDataModal') }}",
            dataSrc : 'data'
        },
        stateSave: true
    });
     // Edit record
     tableMenucategory.on( 'click', '.rowdetail', function () {
        $tr = $(this).closest('tr');

        var data = tableMenucategory.row($tr).data();
        var id = $tr.attr('id');

        $("#M_Menucategory_Id").val(data[0]);
        $("#menucategoryname").val(data[1]);
        $('#modalMenucategory').modal('hide');
     } );
  }

  $('#tableModalMenucategory').on('show.bs.modal', function (e) {
      tableMenucategory.ajax.reload(null, true);
    })
</script>