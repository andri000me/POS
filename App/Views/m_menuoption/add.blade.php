<!-- modal -->
<div id="modalMenuoptionAdd" tabindex="-1" role="dialog" aria-labelledby="groupUserModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="groupUserModalLabel" class="modal-title">{{lang('Form.menuoption')}}</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="card-body">
        <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar
                                  -->
        </div>
                              
        {!! formOpenMultipart(baseUrl('mmenu/addsave'))!!}
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
                        "value" => "",
                        "required" => ""
                        )
                    ) !!}
                    </div>
                </div>
            </div> 
        </div>
        <div class="form-group">
            <input type="submit" value="{{ lang('Form.save') }}" class="btn btn-primary">
            <a href="{{ baseUrl('mmenu') }}" value="{{ lang('Form.cancel') }}" class="btn btn-primary">{{ lang('Form.cancel') }}</a>
        </div>
        {!! formClose() !!}
      </div>
    </div>
  </div>
</div>
      <script>
      
        $(document).ready(function() {   
          
          
        });
      
       
      
        function init(){
          
        }
      </script>
            