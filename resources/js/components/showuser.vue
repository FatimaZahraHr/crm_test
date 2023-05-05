<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Les employés</h2>
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
                          <h5>{{ employee.namecompany }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Nom de l'employée</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ employee.name }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ employee.email }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Téléphone</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ employee.tel }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Adresse</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ employee.adress }}</h5>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Date de naissance</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <h5>{{ employee.birthday }}</h5>
                        </div>
                      </div>
                      <div class="form-group row" v-if="role == 1">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Statut</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <span v-if="employee.status == 1" class="badge badge-primary">Validé</span>
                            <span v-if="employee.status == 2" class="badge badge-success">Confirmé</span>
                            <span v-if="employee.status == 3" class="badge badge-danger">Annulé</span>
                            <span v-if="employee.status == null" class="badge badge-default">Non confirmé</span>
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
              role : localStorage.getItem('role'),
              userid:'',
              errorList : '',
              employee: {},
              errors: {}
            }
        },
        mounted: function() {
          this.userid = this.$route.params.id;
          this.getcompanybyid(this.$route.params.id);
        },
        methods: {
          async getcompanybyid(userid){
           if(this.role == 1){
            this.iduser = this.$route.params.id;
           }else{
            this.iduser = this.user_id;
           }
              axios.get(`/api/employee/${this.iduser}`).then(response=>{
                this.employee = response.data;
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
