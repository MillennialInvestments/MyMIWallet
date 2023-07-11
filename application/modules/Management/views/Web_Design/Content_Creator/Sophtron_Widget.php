<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/Sophtron_Widget/server.js'); ?>" ></script>
    <script type="text/javascript" src="https://cdn.sophtron.com/sophtron-widget-loader-0.0.0.5.min.js" ></script>
    <script type="text/javascript" >
      var currentAction = 'Add';
      function onEvent(e){
        console.log(e)
      }
      function onError(e){
        if(e.error === 401){
          init();
        }
      }
      function init(action){
        currentAction = action || currentAction;
        axios.post('/Content-Creator').then(res => {
          sophtron.init(currentAction , { 
            env: 'prod',
            partner: 'default',
            integration_key: res.data.integration_key,
            request_id: res.data.request_id,
            institution_id: res.data.institution_id,
            userInstitution_id: res.data.userInstitution_id,
            onShow: onEvent,
            onInit: onEvent,
            onClose: onEvent,
            onSelectBank: onEvent,
            onLogin: onEvent,
            onLoginSuccess: onEvent,
            onMfa: onEvent,
            onFinish: onEvent,
            onError: onError,
          }, true );
        })
      }
      init();
    </script>
    <div class="container body-content">
      <div style="padding:50px;">
        <div style=" margin:auto; padding: 50px; min-height:700px">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <br />
                  <br />
                  <h2>sophtron-widget-loader example</h2>
                  <br />
                  <br /> 
                  <br />
                  <br />
                  <br />
                  <br />
                  <b>Choose action</b>
                </div>
              </div>
                <div class="row">
                    <div class="col-md-2">
                      <select class="form-select" aria-label="Default select example" onchange="init(this.value)">
                        <option value="Add">Add</option>
                        <option value="Refresh">Refresh</option>
                        <option value="BankAuth">BankAuth</option>
                        <option value="Verify">Verify</option>
                        <option value="Utils">Utils</option>
                      </select>
                      <br />
                      <button id="start_btn" type="button" class="btn btn-success w-100" onclick="sophtron.show()">Show</button>
                    </div>
                    <div class="col-md-10">
                            
                    </div>
                </div>
            </div>
        </div>
    </div>