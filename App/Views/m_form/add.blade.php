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
                                <h3 class="card-title">{{lang('Form.setting')}}</h3>
                            </div>
                            {{-- <div class = "col-6 text-right">
                                <a class = "" href="{{ baseUrl('mitem/add')}}"><i class = "fa fa-plus"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                      <div id="accordion" role="tablist">
                        
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" href="#transitemstock" aria-expanded="false" aria-controls="transitemstock" class="collapsed">
                                <?= lang('Form.transaction') . " / " . lang('Form.itemstock') ?>
                              </a>
                            </h5>
                          </div>
                          <div id="transitemstock" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                                
                              {!! formOpen(baseUrl('setting/saveitemstock'))!!}
                                <div class="row">
                                  <label class="col-sm-2 col-form-label"><?= lang('Form.numberformat') ?></label>
                                  <div class="col-md-10">
                                    <div class="form-group bmd-form-group">
                                      <input id="itemstockformatnumber" type="text" class="form-control transnumberformat" name="itemstockformatnumber" value="<?= $itemstockmodel->StringValue ?>">
                                      <span class="bmd-help text-default"><?= lang('Info.membernumberformat') ?></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <input type="submit" value="<?= lang('Form.save') ?>" class="btn btn-primary">
                                </div>
                              {!! formClose() !!}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" href="#transitemtransfer" aria-expanded="false" aria-controls="transitemtransfer" class="collapsed">
                                <?= lang('Form.transaction') . " / " . lang('Form.itemtransfer') ?>
                              </a>
                            </h5>
                          </div>
                          <div id="transitemtransfer" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                                
                              {!! formOpen(baseUrl('setting/saveitemtransfer'))!!}
                                <div class="row">
                                  <label class="col-sm-2 col-form-label"><?= lang('Form.numberformat') ?></label>
                                  <div class="col-md-10">
                                    <div class="form-group bmd-form-group">
                                      <input id="itemtransferformatnumber" type="text" class="form-control transnumberformat" name="itemtransferformatnumber" value="<?= $itemtransfermodel->StringValue ?>">
                                      <span class="bmd-help text-default"><?= lang('Info.membernumberformat') ?></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <input type="submit" value="<?= lang('Form.save') ?>" class="btn btn-primary">
                                </div>
                              {!! formClose() !!}
                            </div>
                          </div>
                        </div>
                        <div class="card-collapse">
                          <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" href="#transitemreceive" aria-expanded="false" aria-controls="transitemreceive" class="collapsed">
                                <?= lang('Form.transaction') . " / " . lang('Form.itemreceiving') ?>
                              </a>
                            </h5>
                          </div>
                          <div id="transitemreceive" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body">
                                
                              {!! formOpen(baseUrl('setting/saveitemreceive'))!!}
                                <div class="row">
                                  <label class="col-sm-2 col-form-label"><?= lang('Form.numberformat') ?></label>
                                  <div class="col-md-10">
                                    <div class="form-group bmd-form-group">
                                      <input id="itemreceiveformatnumber" type="text" class="form-control transnumberformat" name="itemreceiveformatnumber" value="<?= $itemreceivemodel->StringValue ?>">
                                      <span class="bmd-help text-default"><?= lang('Info.membernumberformat') ?></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <input type="submit" value="<?= lang('Form.save') ?>" class="btn btn-primary">
                                </div>
                              {!! formClose() !!}
                            </div>
                          </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
  
</div>
<script>
  $(document).ready(function() {
    initsetting();
    // loadModalChartOfAccount();
  });

  function initsetting() {
    <?php
    if ($userlocationmodel->BooleanValue == 1) {
      ?>
      $('#TrackUser').prop('checked', true);
    <?php
    }
    ?>
  }


  function loadModalChartOfAccount() {
    var table = $('#tablemodalChartOfAccounts').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [5, 10, 15, 20, -1],
        [5, 10, 15, 20, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      }
    });

    // Edit record
    table.on('click', '.rowdetail', function() {
      $tr = $(this).closest('tr');

      var data = table.row($tr).data();
      var id = $tr.attr('id');

      $("#paymentcoaid").val(id);
      $("#paymentcoaname").val(data[0] + " " + data[1]);
      $('#modalChartOfAccounts').modal('hide');
    });
  }
</script>