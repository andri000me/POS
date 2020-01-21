<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>{{lang('Form.mastermenu')}}</h1>
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
                            <h3 class="card-title">{{lang('Form.edit')}}</h3>
                        </div>
                    </div>
                <!-- /.card-header -->
                </div>
                <div class="card-body">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="menu-tab" data-toggle="pill" href="#menu" role="tab" aria-controls="menu" aria-selected="true">{{ lang('Form.menu')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="option-tab" data-toggle="pill" href="#option" role="tab" aria-controls="option" aria-selected="false">{{ lang('Form.option')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Settings</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                      
                      <div class="card-body">      
                          {!! formOpenMultipart(baseUrl('mmenu/addsave'))!!}
                          {!! formInput(
                            array(
                              "id" => "Id",
                              "type" => "text",
                              "value" => $model->Id,
                              "name" => "Id",
                              "hidden" => ""
                            )
                          ) !!}
                              <div class="row">
                                <div class="col-12 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="required">
                                      <label>{{ lang('Form.name') }}</label>
                                      {!! formInput(
                                        array(
                                          "id" => "Name",
                                          "type" => "text",
                                          "placeholder" => lang('Form.menu'),
                                          "class" => "form-control",
                                          "name" => "Name",
                                          "value" => $model->Name,
                                          "required" => ""
                                        )
                                      ) !!}
                                    </div>
                                  </div>
                                </div> 
                                <div class="col-12 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="required">
                                      <label>{{ lang('Form.price') }}</label>
                                      {!! formInput(
                                        array(
                                          "id" => "Price",
                                          "type" => "text",
                                          "placeholder" => lang('Form.price'),
                                          "class" => "form-control money2",
                                          "name" => "Price",
                                          "value" => $model->Price,
                                          "required" => ""
                                        )
                                      ) !!}
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="required">
                                      <label>{{ lang('Form.menucategory') }}</label>
                                      <div class="input-group has-success">
                                        {!! formInput(
                                          array(
                                            "id" => "M_Menucategory_Id",
                                            "name" => "M_Menucategory_Id",
                                            "value" => $model->M_Menucategory_Id,
                                            "hidden" => ""
                                          )
                                        ) !!}
                                        {!! formInput(
                                        array(
                                          "id" => "menucategoryname",
                                          "type" => "text",
                                          "placeholder" => lang('Form.menucategory'),
                                          "class" => "form-control custom-readonly clearable",
                                          "name" => "menucategoryname",
                                          "value" => $model->get_M_Menucategory()->Name,
                                          "readonly" => ""
                                        )
                                      )
                                      !!}
                                        <div class="input-group-append">
                                          <button id="btnMenuCategory" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalMenucategory"><i class="fa fa-search"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="required">
                                      <label>{{ lang('Form.mealtime') }}</label>
                                      <div class="input-group has-success">
                                      {!! formInput(
                                          array(
                                            "id" => "M_Mealtime_Id",
                                            "name" => "M_Mealtime_Id",
                                            "value" => $model->M_Mealtime_Id,
                                            "hidden" => ""
                                          )
                                        ) !!}
                                        {!! formInput(
                                        array(
                                          "id" => "mealtimename",
                                          "type" => "text",
                                          "placeholder" => lang('Form.mealtime'),
                                          "class" => "form-control custom-readonly clearable",
                                          "name" => "mealtimename",
                                          "value" => $model->get_M_Mealtime()->Name,
                                          "readonly" => ""
                                        )
                                      )
                                      !!}
                                        <div class="input-group-append">
                                          <button id="btnMealtime" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalMealtime"><i class="fa fa-search"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="required">
                                      {!! formLabel(lang('Form.orderrestriction')) !!}
                                      {!! formSelect(
                                        $model->getEnumOrder(),
                                        "Value",
                                        "EnumName",
                                        array(
                                          "id" => "OrderRestriction",
                                          "class" => "selectpicker form-control",
                                          "name" => "OrderRestriction",
                                          "value" => $model->OrderRestriction
                                        )
                                      ) !!}
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <div class="required">
                                      <label>{{ lang('Form.shop') }}</label>
                                      <div class="input-group has-success">
                                      {!! formInput(
                                          array(
                                            "id" => "M_Shop_Id",
                                            "name" => "M_Shop_Id",
                                            "value" => $model->M_Shop_Id,
                                            "hidden" => ""
                                          )
                                        ) !!}
                                        {!! formInput(
                                        array(
                                          "id" => "shopname",
                                          "type" => "text",
                                          "placeholder" => lang('Form.shop'),
                                          "class" => "form-control custom-readonly clearable",
                                          "name" => "shopname",
                                          "value" => $model->get_M_Shop()->Name,
                                          "readonly" => ""
                                        )
                                      )
                                      !!}
                                        <div class="input-group-append">
                                          <button id="btnShop" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalShop"><i class="fa fa-search"></i></button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="photo">{{ lang('Form.picture') }}</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    {!! formInput(
                                    array(
                                      "id" => "photo",
                                      "type" => "file",
                                      "class" => "custom-file-input",
                                      "name" => "photo",
                                      "required" => ""
                                    )
                                  ) !!}
                                    <label class="custom-file-label" for="photo">{{lang('Form.choosefile')}}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group clearfix">
                                <div class="icheck-primary icheck-default d-inline">
                                  {!! formInput(
                                    array(
                                      "id" => "Status",
                                      "class" => "checkbox",
                                      "type" => "checkbox",
                                      "value" => $model->Status
                                    ) 
                                  ) !!}
                                <label for="Status"> {{lang('Form.isactive')}}
                                </label>
                                  
                                </div>
                              </div>
                              <div class="form-group">
                                <label>{{ lang('Form.description') }}</label>
                                {!! formTextArea($model->Description,
                                    array(
                                      "id" => "Description",
                                      "type" => "text",
                                      "placeholder" => lang('Form.menu'),
                                      "class" => "form-control",
                                      "name" => "Description"
                                    )
                                  ) !!}
                              </div>
                              <div class="form-group">
                                <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
                                <a href="{{ baseUrl('mmenu') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
                              </div>
                            {!! formClose() !!}
                      </div>
                    </div>
                    <div class="tab-pane fade" id="option" role="tabpanel" aria-labelledby="option-tab">
                      
                      <div class="card-body">   
                              <div class="row">
                                <div class="col-12 col-md-12 col-sm-12">
                                  <div class="form-group">
                                    <div class="required">
                                      <label>{{ lang('Form.menuoption') }}</label>
                                      <div class="input-group has-success">
                                      <?php $option = App\Models\M_menuoptions::getAll()?>
                                      <select id = "MenuOption" class = "selectpicker form-control">
                                      </select>
                                     
                                        <div class="input-group-append">
                                          <button id="btnMenuCategory" data-toggle="modal" type="button" class="btn btn-secondary" data-target="#modalMenucategory"><i class="fa fa-arrow-down"></i> {{lang('Form.add')}}</button>
                                        </div>

                                        <div class="input-group-append">
                                          <button id="btnMenuCategoryAdd" data-toggle="modal" type="button" class="btn btn-info" data-target="#modalMenuoptionAdd"><i class="fa fa-plus"></i> {{lang('Form.option')}}</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          {!! formOpenMultipart(baseUrl('mmenu/addsave'))!!}
                          
                          {!! formClose() !!}
                        </div>
                      </div>
                    </div>
                    
                  </div>  
                </div> 
              </div> 
            </div>
          </div>
        </section>
      
    </div>
    <?php Core\View::presentBlade("m_menucategory.modal") ?>
    <?php Core\View::presentBlade("m_mealtime.modal") ?>
    <?php Core\View::presentBlade("m_shop.modal") ?>
    <?php Core\View::presentBlade("m_menuoption.add") ?>
      <script>
      
        $(document).ready(function() {   
          
          loadOption();
        });

        function loadOption(){
          $.ajax({
            url : "<?= baseUrl('mmenuoption/getDataJson')?>",
            type : "GET",
            dataType: "json",
            success : function(result){
              if(result.Status.Code == 1000){
                if(result.Result.length == 0){
                  $('#MenuOption').selectpicker('val', ['Mustard','Relish']);
$('#MenuOption').selectpicker('refresh');
                  // var meneuoptionselect = $('#MenuOption');
                  // console.log(meneuoptionselect);
                  // meneuoptionselect.find("option").remove();
                  // meneuoptionselect.append('<option value="whatever">text</option>')
                  // .val('whatever')
                } else {

                }
              }
            }
          });
        }
      
       
      
        function init(){
          
        }
      </script>
            