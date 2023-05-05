<template>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Inviter un employée</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" @submit.prevent="invite">
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Société</label>
                <div class="col-md-6 col-sm-6 ">
                <div id="gender" class="btn-group" data-toggle="buttons">
                <select class="form-control"  v-model="formData.company">
                  <option>Choisissez une société</option>
                  <option v-for="(company, index) in companies.data" :key="index" :value="company.id">
                    {{ company.nom }}
                </option>
                </select>
                </div>
                </div>
            </div>
            <div class="item form-group">
                <label  class="col-form-label col-md-3 col-sm-3 label-align">Nom</label>
                <div class="col-md-6 col-sm-6 ">
                  <input placeholder="Nom" class="form-control" type="text"  v-model="formData.name">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                <div class="col-md-6 col-sm-6 ">
                  <input placeholder="Email" class="form-control" type="text"  v-model="formData.email">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
              </div>
              <div class="">
                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                  <li class="mb-0 ms-3" v-for="(error,index) in this.errorList" :key="index">
                      {{ error[0] }}
                  </li>
                </ul>
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
            companies: [],
             formData: {
                 company:'',
                 name: '',
                 email: ''
             },
             errorList : '',
         }
     },
      mounted: function() {
            this.getCompanies();
      },
     methods: {
        async getCompanies(){
            axios.get('/api/company').then(response=>{
                this.companies = response.data;
                console.log(this.companies);
            }).catch(error=>{
                console.log(error)
                this.companies = []
            })
        },
         invite(){
             axios.post('/api/employee', this.formData).then((response) => {
               this.formData.message=response.data.status;
               this.errorList="";
               Swal.fire({
                    icon: 'success',
                    title: 'L\'invitation est envoyée avec succès!',
                    showConfirmButton: false,
                    timer: 1500
                  });
                this.$router.push('/employees');
              // this.$router.push('/companies');
             }).catch((error) => {
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