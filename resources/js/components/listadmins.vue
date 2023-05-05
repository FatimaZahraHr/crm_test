<template>
    <router-link to="/addadmin"><button class="btn btn-primary" type="button">Ajouter un Admin</button></router-link>
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Liste  <small>des admins</small></h2>   
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Nom </th>
                    <th class="column-title">Email </th>
                    <th class="column-title no-link last"><span class="nobr">Action</span>
                    </th>
                    <th class="bulk-actions" colspan="7">
                      <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="even pointer"  v-for="(admin, key) in admins"  :key="key" >
                    <td>{{admin.name}}</td>
                    <td>{{admin.email}} </td>
                      <td class="last">
                        <router-link :to="{path : '/admin/'+admin.id+'/show'}" class="btn btn-primary btns"><i class="fa fa-folder"></i> Afficher</router-link>
                        <router-link :to="{path : '/admin/'+admin.id+'/edit'}" class="btn btn-success btns"><i class="fa fa-pencil"></i> Modifier</router-link>
                        <button @click="deleteuser(admin.id)" class="btn btn-danger btns"><i class="fa fa-trash-o"></i> Supprimer</button>
                    </td>          
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
import Swal from 'sweetalert2';
  export default {
    data: function() {
            return {            
              admins: []
            }
        },
        mounted: function() {
            this.getData();
        },  
        methods: {  
          async getData(){
            axios.get('/api/admin').then(response=>{
                this.admins = response.data;
                console.log(this.admins);
            }).catch(error=>{
                console.log(error)
                this.admins = []
            })
          },
          deleteuser(adminId)
          {
              Swal.fire({
                title: 'Vous êtes sûre?',
                text: "Vous voulez supprimer cet enregistrement!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui , je le supprime!'
              }).then((result) => {
                if (result.isConfirmed) {
                  axios.delete(`/api/admin/${adminId}`).then(response=>{
                  Swal.fire(
                    'Supprimé!',
                    'L\'enregistrement est supprimé avec succès',
                    'success'
                  )
                  this.getData();
                  }).catch(error=>{
                      console.log(error)
                      this.admins = []
                  })
                }
              })
          }
        }
    }
</script>