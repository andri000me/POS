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
                                <h3 class="card-title">{{lang('Form.add')}}<a href="{{ baseUrl("mitem/edit/$item->Id") }}">{{ " $item->Code ~ $item->Name"}}</a></h3>
                            </div>
                            {{-- <div class = "col-6 text-right">
                                <a class = "" href="{{ baseUrl('mitem/add')}}"><i class = "fa fa-plus"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <?= formOpen(baseUrl('muomconversion/addsave')) ?>
                        <?= formInput(
                            array(
                                "id" => "M_Item_Id",
                                "name" => "M_Item_Id",
                                "value" => $item->Id,
                                "hidden" => ""
                            )
                        )
                        ?>
                        <div class="form-group">
                            <div class="required">
                              <label><?= lang('Form.unitfrom') ?></label>
                              <div class="input-group has-success">
                                <?= formInput(
                                  array(
                                    "id" => "M_Uom_Id_From",
                                    "name" => "M_Uom_Id_From",
                                    "value" => $model->M_Uom_Id_From,
                                    "hidden" => ""
                                  )
                                ) ?>
                                <?= formInput(
                                array(
                                  "id" => "uomnamefrom",
                                  "type" => "text",
                                  "placeholder" => lang('Form.unitfrom'),
                                  "class" => "form-control custom-readonly clearable",
                                  "name" => "uomnamefrom",
                                  "value" => $model->get_M_Uom('From')->Name,
                                  "readonly" => ""
                                )
                              )
                              ?>
                                <div class="input-group-append">
                                  <button id="btnUomFromModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalUom"><i class="fa fa-search"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="required">
                              <label><?= lang('Form.unitto') ?></label>
                              <div class="input-group has-success">
                                <?= formInput(
                                  array(
                                    "id" => "M_Uom_Id_To",
                                    "name" => "M_Uom_Id_To",
                                    "value" => $model->M_Uom_Id_To,
                                    "hidden" => ""
                                  )
                                ) ?>
                                <?= formInput(
                                array(
                                  "id" => "uomnameto",
                                  "type" => "text",
                                  "placeholder" => lang('Form.unitto'),
                                  "class" => "form-control custom-readonly clearable",
                                  "name" => "uomnamefrom",
                                  "value" => $model->get_M_Uom('To')->Name,
                                  "readonly" => ""
                                )
                              )
                              ?>
                                <div class="input-group-append">
                                  <button id="btnUomToModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalUom"><i class="fa fa-search"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                                <div class="required">
                                    
                                    <label><?= lang('Form.qty') ?></label>
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
                          <div class="form-group">
                            <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                            <a href='{{ baseUrl("muomconversion/$item->Id") }}' value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
  <?php  Core\View::presentBlade('m_uom.modal'); ?>
</div>

    <script>

        $(document).ready(function() {
            // initaddmember();
        });

        $('#btnUomFromModal').on("click", function(){
            uomModalSet("M_Uom_Id_From", "uomnamefrom");
        });

        $('#btnUomToModal').on("click", function(){
            uomModalSet("M_Uom_Id_To", "uomnameto");
        });
        
    </script>