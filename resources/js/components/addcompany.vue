<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Ajouter <small>Une société</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" @submit.prevent="add">

            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align">Nom de la société <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" v-model="formData.name"  class="form-control ">
              </div>
            </div>
            <div class="item form-group">
              <label class="col-form-label col-md-3 col-sm-3 label-align" >Raison sociale <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 ">
                <input type="text" v-model="formData.raison" class="form-control">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align" >Email</label>
              <div class="col-md-6 col-sm-6 ">
                <input class="form-control" type="email" v-model="formData.email">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Adresse</label>
              <div class="col-md-6 col-sm-6 ">
                <input  class="form-control" type="text" v-model="formData.adresse">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Téléphone</label>
              <div class="col-md-6 col-sm-6 ">
                <input  class="form-control" type="text" v-model="formData.tel">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Date de création</label>
              <div class="col-md-6 col-sm-6 ">
                <input class="form-control" type="date" v-model="formData.date">
              </div>
            </div>
            <div class="item form-group">
              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
              <div class="col-md-6 col-sm-6 ">
                <textarea  class="form-control" cols="30" rows="10" v-model="formData.description"></textarea>
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
                    raison: '',
                    email: '',
                    adresse :'',
                    tel:'',
                    date:'',
                    description:'',
                    message:''

                },
                errors: {}
            }
        },
        methods: {
            add(){
                axios.post('/api/company', this.formData).then((response) => {
                  this.formData.message=response.data.status;
                  Swal.fire({
                    icon: 'success',
                    title: 'L\'ajout est fait avec succès!',
                    showConfirmButton: false,
                    timer: 1600
                  });
                  this.$router.push('/companies');
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                })
            }
        }
    }
</script>
