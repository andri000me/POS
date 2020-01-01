<!-- modal -->
<div id="modalItemtransfer" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupUserModalLabel" class="modal-title">{{lang('Form.itemtransfer')}}</h5>
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
                  <table data-page-length="5" id = "tableModalItemtransfer" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead class=" text-default">

                        <th># </th>
                        <th> </th>
                        <th>{{   lang('Form.name')}}</th>
                        <th>{{   lang('Form.date')}}</th>
                        <th>{{   lang('Form.shopfrom')}}</th>
                    </thead>
                    <tfoot class=" text-default">
                      <tr role = "row">

                      <th># </th>
                        <th> </th>
                        <th>{{   lang('Form.name')}}</th>
                        <th>{{   lang('Form.date')}}</th>
                        <th>{{   lang('Form.shopfrom')}}</th>
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
  var tableItemtransfer ;
  var purpose = 'input';
  $(document).ready(function() {  
    loadModalItemtransfer();
  });

  function setModalItemtransferPurpose(newpurpose){
    purpose = newpurpose;
  }

  function loadModalItemtransfer(){
    tableItemtransfer  = $("#tableModalItemtransfer").DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
      responsive: true,
      language: {
      search: "_INPUT_",
      "search": "{{  lang('Form.search')}}"+" : ",
      },
      "columnDefs": [ 
        {
          className: 'select-checkbox',
          targets: 'disabled-sorting', 
          orderable: false
        },
        {
            "targets": [0],
            "visible": false,
            "searchable": false,
        },
        {
          orderable: false,
          className: 'select-checkbox',
          targets:  1
        }
      ],

      select: {
          style:    'os',
          selector: 'td:first-child'
      },
      "processing": true,
      "serverSide": true,
      ajax:{
          url : "{{  baseUrl('titemtransfer/getDataModal') }}",
          dataSrc : 'data'
      },
      stateSave: true
    });
    // console.log(tableItemtransfer);
     // Edit record
     tableItemtransfer.on( 'click', '.rowdetail', function () {
        $tr = $(this).closest('tr');

        var data = tableItemtransfer.row($tr).data();
        var id = $tr.attr('id');

        if(purpose = 'input'){
          $("#T_Itemtransfer_Id").val(data[0]);
          $("#itemtransfername").val(data[0]);
          $('#modalItemtransfer').modal('hide');
        } else {

        }
     } );
  }

  $('#tableModalItemtransfer').on('show.bs.modal', function (e) {
      tableItemtransfer.ajax.reload(null, true);
    })
</script>