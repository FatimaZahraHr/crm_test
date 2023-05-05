<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Les admins</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Nom d'admin</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ admin.name }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ admin.email }}</h5>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                          <router-link to="/admins" class="btn btn-success"><a>
                            	<i class="fa fa-navicon"></i> Retour à la liste des admins </a></router-link>
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
                adminId:'',
                errorList : '',
                admin: {},
                errors: {}
            }
        },
        mounted: function() {
          this.adminId = this.$route.params.id;
          this.getadminbyid(this.$route.params.id);
        },

        methods: {
          async getadminbyid(adminId){
            axios.get(`/api/admin/${this.adminId}`).then(response=>{
                this.admin = response.data;
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
