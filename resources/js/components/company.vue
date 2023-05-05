<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Les infos de la société</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Voir les détails</h2>  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form class="form-horizontal form-label-left">
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Nom de société</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h5>{{ user.namecompany }}</h5>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Raison Social</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h5>{{ user.raison_social }}</h5>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h5>{{ user.emailcompany }}</h5>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Adresse</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h5>{{ user.adresscompany }}</h5>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Téléphone</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h5>{{ user.telcompany }}</h5>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Date de création</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h5>{{ user.date_creation }}</h5>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Description</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h6>{{ user.description }}</h6>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</template>
<script>
    export default {
        data(){
            return {
                user_id: document.querySelector("meta[name='user-id']").getAttribute('content'),
                errorList : '',
                admin: {},
                user: {},
                errors: {}
            }
        },
        mounted: function() {
          this.getuser();
        },
        methods: {
          async getuser(){
            axios.get(`/api/employee/${this.user_id}`).then(response=>{
                this.user = response.data;
                this.errorList="";
            }).catch(error=>{
                if(error.response.status == 404)
                {
                  alert(error.response.data.message)
                }     
            })
          }, 
        }
    }
</script>
