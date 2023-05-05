<template>
   <div class="login_wrapper" >
        <div class="animate form login_form">
          <section class="login_content">
            <div class="">
                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                  <li class="mb-0 ms-3" v-for="(error,index) in this.errorList" :key="index">
                      {{ error[0] }}
                  </li>
                </ul>
              </div>
             Bonjour {{ name }}
            <form @submit.prevent="update">
              <h1>Compléter votre profile</h1>
              <p>Veuillez saisir toutes les informations</p>
              <label class="labelpro">Nom:</label>
              <div>
                <input type="text" class="form-control" placeholder="Nom" v-model="name"  :readonly="true"/>
              </div>
              <label class="labelpro">Email:</label>
              <div>
                <input type="text" class="form-control" placeholder="Email" v-model="email" :readonly="true" />
              </div>
              <label class="labelpro">Adresse:</label>
              <div>
                <input type="text" class="form-control" placeholder="Adresse" v-model="formData.adress"  />
              </div>
              <label class="labelpro">Téléphone:</label>
              <div>
                <input type="text" class="form-control" placeholder="Téléphone" v-model="formData.tel"  />
              </div>
              <label class="labelpro">Date de naissance:</label>
              <div>
                <input type="date" class="form-control" placeholder="Date de naissance" v-model="formData.birthday"  />
              </div> <br />
              <label class="labelpro">Mot de passe:</label>
              <div>
                <input type="password" class="form-control" placeholder="Mot de passe" v-model="formData.password"  />
              </div>
              <div>
                <button  class="btn btn-dark submit" >Valider</button>
              </div>
              <a class="reset_pass" href="/login">Se connecter</a>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-check-circle"></i> CRM</h1>
                  <p>©Tous les droits sont réservés</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
  </template>
<script>
import Swal from 'sweetalert2';

export default {
  
     data(){
         return {
          email: this.$route.query.email,
             formData: {
                 email: '',
                 password: '',
                 name: '',
                 birthday:'',
                 tel: '',
                 adress:'',
             },
             id:'',
             errors: {},
             errorList : '',
         }
     },
     mounted: function() {
        let uri = window.location.search.substring(1); 
        let params = new URLSearchParams(uri);
        this.email = params.get("email");
        this.name = params.get("name");
        this.getProfil(this.email);
      },
      methods: {
         async getProfil(email){
            axios.get(`/api/profil/${this.email}`).then(response=>{
                 this.formData.name = response.data.name;
                 this.formData.email = response.data.email;
                 this.id = response.data.id;
            }).catch(error=>{
                if(error.response.status == 404)
                {
                  alert(error.response.data.message)
                }             
            })
        },
        update(){
            axios.put(`/api/valideprofil/${this.id}`, this.formData).then((response) => {
              this.formData.message=response.data.status;
              this.errorList="";
              Swal.fire({
                    icon: 'success',
                    title: 'Votre compte est activé! Vous pouvez se connecter',
                    showConfirmButton: false,
                    timer: 1000
                  });
              window.location.replace('/login');
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