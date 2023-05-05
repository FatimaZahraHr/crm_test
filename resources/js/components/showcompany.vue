<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Les sociétés</h2>
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
                          <h5>{{ company.nom }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Raison Social</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ company.raison_social }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ company.email }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Adresse</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ company.adresse }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Téléphone</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ company.tel }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Date de création</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ company.date_creation }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Description</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h6>{{ company.description }}</h6>
                        </div>
                      </div>
                      <div class="ln_solid"></div>

                      <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                          <router-link to="/companies" class="btn btn-success"><a>
                            	<i class="fa fa-navicon"></i> Retour à la liste des sociétés </a></router-link>
                        </div>
                      </div>
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
                companyId:'',
                errorList : '',
                company: {},
                errors: {}
            }
        },
        mounted: function() {
          this.companyId = this.$route.params.id;
          this.getcompanybyid(this.$route.params.id);
        },

        methods: {
          async getcompanybyid(companyid){
            axios.get(`/api/company/${this.companyId}`).then(response=>{
                this.company = response.data;
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
