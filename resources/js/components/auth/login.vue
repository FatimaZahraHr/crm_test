<template>
   <div class="login_wrapper" >
        <div class="animate form login_form">
          <section class="login_content">
            {{ errors }}
            <form @submit.prevent="login">
              <h1>Login CRM</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" v-model="formData.email"  />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Mot de passe" v-model="formData.password"  />
              </div>
              <div>
                <button  class="btn btn-dark submit">Se connecter</button>
              </div>
              <a class="reset_pass" href="#">Mot de passe oublié?</a>
              <div class="clearfix"></div>
              <div >
              <div class="">
                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                  <li class="mb-0 ms-3" v-for="(error,index) in this.errorList" :key="index">
                      {{ error[0] }}
                  </li>
                </ul>
                <ul class="alert alert-danger" v-if="message">
                  <li class="mb-0 ms-3">
                      {{ message }}
                  </li>
                </ul>
              </div>
            </div>
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

export default {
     data(){
         return {
             formData: {
                 email: '',
                 password: '',
             },
             errorList : '',
             message: '',

         }
     }, 
     methods: {
         login(){
             axios.post('/api/login', this.formData).then((response) => {
                 if(response.data.success){
                  localStorage.setItem('token',response.data.data.token);
                  localStorage.setItem('role',response.data.data.role);
                  window.location.replace('/home');
                }else{
                  this.message=response.data.message
                 }
             }).catch((error) => {
              if(error.response.status == 422)
                {
                  this.message = "";
                  this.errorList = error.response.data.errors;
                }else{
                  this.errorList = "";
                }
             })
         }
    }
 }
</script>