<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.transactionitemtransferdetail')}}</h1>
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
                                <h3 class="card-title">{{lang('Form.add')}}</h3>
                            </div>
                            {{-- <div class = "col-6 text-right">
                                <a class = "" href="{{ baseUrl('titemtransferdetail/add')}}"><i class = "fa fa-plus"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <form method="post" action="{{ baseUrl('titemtransferdetail/addsave')}}">
                              <?= formInput(
                                      array(
                                        "id" => "T_Itemtransfer_Id",
                                        "name" => "T_Itemtransfer_Id",
                                        "value" => $model->T_Itemtransfer_Id,
                                        "hidden" => ""
                                      )
                                  ) ?>
                              <div class="form-group">
                                <div class="required">
                                  <label><?= lang('Form.item') ?></label>
                                  <div class="input-group has-success">
                                    <?= formInput(
                                      array(
                                        "id" => "M_Item_Id",
                                        "name" => "M_Item_Id",
                                        "value" => $model->M_Item_Id,
                                        "hidden" => ""
                                      )
                                    ) ?>
                                    <?= formInput(
                                    array(
                                      "id" => "itemname",
                                      "type" => "text",
                                      "placeholder" => lang('Form.item'),
                                      "class" => "form-control custom-readonly clearable",
                                      "name" => "itemname",
                                      "value" => $model->get_M_Item()->Name,
                                      "readonly" => ""
                                    )
                                  )
                                  ?>
                                    <!-- <span class="form-control-feedback text-primary">
                                        <i class="material-icons">search</i>
                                    </span> -->
                                    <div class="input-group-append">
                                      <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalItem"><i class="fa fa-search"></i></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="required">
                                  <label><?= lang('Form.uom') ?></label>
                                  <div class="input-group has-success">
                                    <?= formInput(
                                      array(
                                        "id" => "M_Uom_Id",
                                        "name" => "M_Uom_Id",
                                        "value" => $model->M_Uom_Id,
                                        "hidden" => ""
                                      )
                                    ) ?>
                                    <?= formInput(
                                    array(
                                      "id" => "uomname",
                                      "type" => "text",
                                      "placeholder" => lang('Form.uom'),
                                      "class" => "form-control custom-readonly clearable",
                                      "name" => "uomname",
                                      "value" => $model->get_M_Uom()->Name,
                                      "readonly" => ""
                                    )
                                  )
                                  ?>
                                    <!-- <span class="form-control-feedback text-primary">
                                        <i class="material-icons">search</i>
                                    </span> -->
                                    <div class="input-group-append">
                                      <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalUom"><i class="fa fa-search"></i></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="required">
                                  <label><?= lang('Form.warehouse') ?></label>
                                  <div class="input-group has-success">
                                    <?= formInput(
                                      array(
                                        "id" => "M_Warehouse_Id",
                                        "name" => "M_Warehouse_Id",
                                        "value" => $model->M_Warehouse_Id,
                                        "hidden" => ""
                                      )
                                    ) ?>
                                    <?= formInput(
                                    array(
                                      "id" => "warehousename",
                                      "type" => "text",
                                      "placeholder" => lang('Form.warehouse'),
                                      "class" => "form-control custom-readonly clearable",
                                      "name" => "uomname",
                                      "value" => $model->get_M_Warehouse()->Name,
                                      "readonly" => ""
                                    )
                                  )
                                  ?>
                                    <!-- <span class="form-control-feedback text-primary">
                                        <i class="material-icons">search</i>
                                    </span> -->
                                    <div class="input-group-append">
                                      <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalWarehouse"><i class="fa fa-search"></i></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="required">
                                  <label><?= lang('Form.qty') ?></label>
                                  <div class="input-group has-success">
                                   
                                    <?= formInput(
                                    array(
                                      "id" => "Qty",
                                      "type" => "number",
                                      "placeholder" => lang('Form.qty'),
                                      "class" => "form-control",
                                      "name" => "Qty",
                                      "value" => $model->Qty
                                    )
                                  )
                                  ?>
                                  </div>
                                </div>
                              </div>
                                <div class="form-group">
                                  <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                                  <a href='{{ baseUrl("titemtransferdetail/$model->T_Itemtransfer_Id") }}' value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
                                </div>
                              </form>
                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
      
    </div>
    
    <?php  Core\View::presentBlade('m_uom.modal'); ?>
    <?php  Core\View::presentBlade('m_warehouse.modal'); ?>
    <?php  Core\View::presentBlade('m_item.modal'); ?>
      <script>
      
        $(document).ready(function() {   
          
          
        });
      
       
      
        function init(){
          
        }
      </script>
            