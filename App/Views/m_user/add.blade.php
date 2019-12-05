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
            {{-- <div class = "col-6 text-right">
              <a class = "" href="{{ baseUrl('muser/add')}}"><i class = "fa fa-plus"></i></a>
            </div> --}}
          </div>
        </div>
          <div class="card-body">
              {!! formOpen(baseUrl('muser/addsave'))!!}
              <?= formInput(
                array(
                  "id" => "M_Groupuser_Id",
                  "name" => "M_Groupuser_Id",
                  "value" => $model->M_Groupuser_Id,
                  "hidden" => ""
                )
              ) ?>
              <div class="form-group bmd-form-group">
                <div class="required">
                  <label class=""><?= lang('Form.name') ?></label>
                  <?= formInput(
                    array(
                      "id" => "Username",
                      "type" => "text",
                      "placeholder" => lang('Form.name'),
                      "class" => "form-control",
                      "name" => "Username",
                      "value" => $model->Username,
                      "required" => ""
                    )
                  ) ?>
                </div>
              </div>
              <div class="form-group">
                <div class="required">
                  <label><?= lang('Form.group_user') ?></label>
                  <div class="input-group has-success">

                    <?= formInput(
                    array(
                      "id" => "groupname",
                      "type" => "text",
                      "placeholder" => lang('Form.group_user'),
                      "class" => "form-control custom-readonly clearable",
                      "name" => "groupname",
                      "value" => $model->get_M_Groupuser()->GroupName,
                      "readonly" => ""
                    )
                  )
                  ?>
                    <!-- <span class="form-control-feedback text-primary">
                        <i class="material-icons">search</i>
                    </span> -->
                    <div class="input-group-append">
                      <button id="btnGroupModal" data-toggle="modal" type="button" class="btn btn-primary" data-target="#modalGroupUser"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="required">
                  <label><?= lang('Form.password') ?></label>
                  <?= formInput(
                    array(
                      "id" => "Password",
                      "type" => "text",
                      "placeholder" => lang('Form.password'),
                      "class" => "form-control",
                      "name" => "Password",
                      "value" => $model->Password,
                      "required" => ""
                    )
                  ) ?>

                </div>
              </div>
              <div class="form-group">
                <input type="submit" value="<?= lang('Form.save') ?>" class="btn btn-primary">
                <a href="<?= baseUrl('muser') ?>" value="<?= lang('Form.cancel') ?>" class="btn btn-primary"><?= lang('Form.cancel') ?></a>
              </div>
              {!! formClose() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php  Core\View::presentBlade('m_groupuser.modal'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    init();
  });

  function init() {

  }
</script>