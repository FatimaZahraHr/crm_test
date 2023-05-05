<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Ajouter <small>Un admin</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" ref="adminform" data-parsley-validate class="form-horizontal form-label-left" @submit.prevent="add">

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" >Nom d'admin <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text"   v-model="formData.name"  class="form-control ">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Email <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="email" v-model="formData.email" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align" >Mode de passe</label>
              <div class="col-md-6 col-sm-6 ">
                <input  class="form-control" type="password" v-model="formData.password">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="item form-group" >
              <div class="col-md-6 col-sm-6 offset-md-3" >
                <span v-if="formData.message=='success'" >L'ajout est fait avec succès!</span>
                <button type="submit" class="btn btn-success" v-else>Enregistrer</button>
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
                formData: {
                    name:'',
                    email: '',
                    password: '',
                    message:''

                },
                errors: {}
            }
        },
        methods: {
            add(){
                axios.post('/api/admin', this.formData).then((response) => {
                  this.formData.message=response.data.status;
                  Swal.fire({
                    icon: 'success',
                    title: 'L\'ajout est fait avec succès!',
                    showConfirmButton: false,
                    timer: 1600
                  });
                  this.$router.push('/admins');
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                })
            }
        }
    }
</script>
