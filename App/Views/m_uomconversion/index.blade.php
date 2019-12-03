<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{lang('Form.masteritem')}}</h1>
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
                            <h3 class="card-title">{{lang('Form.data')}} <a href="{{ baseUrl("mitem/edit/$model->Id") }}">{{ "$model->Code ~ $model->Name"}}</a></h3>
                        </div>
                        <div class = "col-6 text-right">
                            <a class = " link-action" href="{{ baseUrl("mitem")}}"><i class = "fa fa-table"></i></a>
                            <a class = " link-action" href="{{ baseUrl("muomconversion/add/$model->Id")}}"><i class = "fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableOwner" style="width: 100%;" class="table table-striped table-no-bordered table-hover dataTable dtr-inline collapsed " role="grid">
                                <thead class=" text-default">
                                    <tr role="row">
                                        <th># </th>
                                        <th><?= lang('Form.unitfrom') ?></th>
                                        <th><?= lang('Form.unitto') ?></th>
                                        <th><?= lang('Form.qty') ?></th>
                                        <th class="disabled-sorting text-right"><?= lang('Form.actions') ?></th>
                                    </tr>
                                </thead>
                                <tfoot class=" text-default">
                                    <tr role="row">
                                        <th># </th>
                                        <th><?= lang('Form.unitfrom') ?></th>
                                        <th><?= lang('Form.unitto') ?></th>
                                        <th><?= lang('Form.qty') ?></th>
                                        <th class="disabled-sorting text-right"><?= lang('Form.actions') ?></th>
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
<script>
    $(document).ready(function() {

        dataTable();
    });

    function dataTable() {
        var table = $('#tableOwner').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],
            "order": [
                [2, "desc"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                "search": "<?= lang('Form.search') ?>" + " : "
            },
            "columnDefs": [{
                    targets: 'disabled-sorting',
                    orderable: false
                },
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {
                    "className": "td-actions text-right",
                    "targets": [4]
                }
            ],
            columns: [{
                    responsivePriority: 1
                },
                {
                    responsivePriority: 3
                },
                {
                    responsivePriority: 4
                },
                {
                    responsivePriority: 5
                },
                {
                    responsivePriority: 2
                }
            ],
            "processing": true,
            "serverSide": true,
            ajax: {
                url: '{{ baseUrl("muomconversion/getAllData/$model->Id") }}',
                dataSrc: 'data'
            },
            stateSave: true
        });

        // Delete a record
        table.on('click', '.delete', function(e) {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            var id = data[0] + "~a";
            var name = document.getElementById(id).innerHTML;
            deleteData(name, function(result) {
                if (result == true) {

                    $.ajax({
                        type: "POST",
                        url: "<?= baseUrl('muomconversion/delete/'); ?>",
                        data: {
                            id: data[0]
                        },
                        success: function(data) {
                            console.log(data);
                            var status = $.parseJSON(data);
                            if (status['isforbidden']) {
                                window.location = "<?= baseUrl('Forbidden'); ?>";
                            } else {
                                if (!status['status']) {
                                    for (var i = 0; i < status['msg'].length; i++) {
                                        var message = status['msg'][i];
                                        setNotification(message, 3, "bottom", "right");
                                    }
                                } else {
                                    for (var i = 0; i < status['msg'].length; i++) {
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

    }
</script>