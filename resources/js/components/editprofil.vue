<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Modifier <small>mon profil</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nom d'admin <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" id="first-name"  v-model="formData.name"  class="form-control ">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
              <div class="col-md-6 col-sm-6 ">
                <input id="middle-name" class="form-control" type="email" v-model="formData.email">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Adresse</label>
              <div class="col-md-6 col-sm-6 ">
                <input id="middle-name" class="form-control" type="text" v-model="formData.adress">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Téléphone</label>
              <div class="col-md-6 col-sm-6 ">
                <input id="middle-name" class="form-control" type="text" v-model="formData.tel">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Date de naissance</label>
              <div class="col-md-6 col-sm-6 ">
                <input id="middle-name" class="form-control" type="text" v-model="formData.birthday">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Mot de passe</label>
              <div class="col-md-6 col-sm-6 ">
                <input id="middle-name" class="form-control" type="password" v-model="formData.password">
              </div>
            </div>
              <center>Laissez le champ "Mot de passe" si vous ne voulez pas le changer</center>
            <div class="ln_solid"></div>
            <div >
              <div class="">
                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                  <li class="mb-0 ms-3" v-for="(error,index) in this.errorList" :key="index">
                      {{ error[0] }}
                  </li>
                </ul>
              </div>
            </div>
            <div class="item form-group" >
              <div class="col-md-6 col-sm-6 offset-md-3" >
                <button type="button"  @click="update" class="btn btn-success" >Enregistrer</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
</template>

<script>
import Swal from 'sweetalert2';

   export default {
        data(){
            return {
              user_id: document.querySelector("meta[name='user-id']").getAttribute('content'),
              adminId:'',
                errorList : '',
                formData: {
                    nom:'',
                    email: '',  
                    password:''  
                },
                admin: {},
                errors: {}
            }
        },
        mounted: function() {
          this.adminId = this.$route.params.id;
          this.getuser(this.$route.params.id);
        },

        methods: {
          async getuser(){
            axios.get(`/api/user`).then(response=>{
                // this.company = response.data;
                this.formData = response.data;
                this.errorList="";
            }).catch(error=>{
                if(error.response.status == 404)
                {
                  alert(error.response.data.message)
                }
               
            })
        },
        update(){
            axios.put(`/api/employee/${this.user_id}`, this.formData).then((response) => {
              this.formData.message=response.data.status;
              this.errorList="";
              Swal.fire({
                    icon: 'success',
                    title: 'La modification est faite avec succès!',
                    showConfirmButton: false,
                    timer: 1600
                  });
              this.$router.push('/myprofil');
            }).catch((error) => {
      
                if(error.response.status == 404)
                {
                  alert(error.response.data.message)
                }
                if(error.response.status == 422)
                {
                  this.errorList = error.response.data.errors;
                  console.log(this.errorList);
                }
            })
        }
        
        }
        
    }
</script>
