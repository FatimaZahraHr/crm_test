<template>
    <div>
     <div class="login_wrapper">
       <div class="animate form login_form">
         <section class="login_content">
           <form @submit.prevent="login">
             <h1>Login Form</h1>
             <div>
               <input type="text" class="form-control" placeholder="Username" required=""  v-model="formData.email" />
             </div>
             <div>
               <input type="password" class="form-control" placeholder="Password" required="" v-model="formData.password" />
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
                 <router-link :to="{name:'dashboard'}">test</router-link>
               </p>

               <div class="clearfix"></div>
               <br />

           
             </div>
           </form>
         </section>
       </div>

    
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
                errors: {}
            }
        },
        methods: {
            login(){
                axios.post('/api/login', this.formData).then((response) => {
                    console.log('hello');
                   // this.$router.push('/')
                //    window.location.href = 'http://127.0.0.1:8000/';

                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                })
            }
        }
    }
</script>
