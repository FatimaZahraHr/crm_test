<template>

  <div class="row">
    <form  @submit.prevent="login">
             <h1>Login Form</h1>
             {{ formData }}
             <p class="text-danger">{{ errors }}</p>
             <div>
               <input type="text" class="form-control" placeholder="Username"   v-model="formData.email" />
             </div>
             <div>
               <input type="password" class="form-control" placeholder="Password"   v-model="formData.password" />
             </div>
             <div>
                <button  class="btn btn-default ">Se connecter</button>

               <!-- <a @click="login"  class="btn btn-default submit" >Log in</a> -->
               <a class="reset_pass" href="#">Lost your password?</a>
             </div>

             <div class="clearfix"></div>

             <div class="separator">
               <p class="change_link">New to site?
                 <a href="#signup" class="to_register"> Create Account </a>
               </p>

               <div class="clearfix"></div>
               <br />

           
             </div>
           </form>
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
             errors: {}
         }
     },
     
     methods: {
         login(){
             axios.post('/api/login', this.formData).then((response) => {
              console.log(response);
               //  console.log(response.data.success);
              // console.log(response);
                 if(response.data.success){
                  localStorage.setItem('token',response.data.data.token);
                  window.location.replace('/home');
               
                }else{
                  this.errors=response.data.message
                 }
                // this.$router.push('/home')
             //    window.location.href = 'http://127.0.0.1:8000/';

             }).catch((errors) => {
              
                 this.errors = errors
             })
         }
     }
 }
</script>