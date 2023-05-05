<template>
  <router-link to="/addcompany"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Ajouter une société</button></router-link>
  <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Liste  <small>des sociétés</small></h2>   
                    <div class="clearfix"></div>
                  </div>
                  <div class="row divsearch">
                    <label for="">Chercher par nom :</label>  
                    <div class="col-md-3 col-sm-3">
                       <input type="text" class="form-control" @keyup="searchcompany" v-model="q" placeholder="Rechercher par nom ..">
                    </div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title" @click="sortByName()">Nom <i class="fa fa-sort" style="font-size: 16px;"></i> </th>
                            <th class="column-title">Raison social </th>
                            <th class="column-title">Téléphone </th>
                            <th class="column-title">Email </th>
                            <th class="column-title">Adresse </th>
                            <th class="column-title">Nombre d'employées </th>
                            <th class="column-title">Date de création </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="even pointer" v-for="(company, index) in companies"  :key="key" >
                            <td>{{company.nom}}</td>
                            <td>{{company.raison_social}} </td>
                            <td>{{company.tel}}</td>
                            <td>{{company.email}}</td>
                            <td>{{company.adresse}}</td>
                            <td>{{company.employes.length}}</td>
                            <td>{{company.date_creation}}</td>
                            <td class="last">
                                <router-link :to="{path : '/company/'+company.id+'/show'}" class="btn btn-primary btns"><i class="fa fa-folder"></i> Afficher</router-link>
                                <router-link :to="{path : '/company/'+company.id+'/edit'}" class="btn btn-success btns"><i class="fa fa-pencil"></i> Modifier</router-link>
                                <button v-if="company.employes.length == 0" @click="deletecompany(company.id)" class="btn btn-danger btns"><i class="fa fa-trash-o"></i> Supprimer</button>
                            </td>
                          </tr>
                        </tbody>

                      </table>
                      <Bootstrap4Pagination :data="listcompanies" @pagination-change-page="getData" />                      

                    </div>
                  </div>
                </div>
              </div>
</template>
<script>
import { Bootstrap4Pagination } from 'laravel-vue-pagination'
import Swal from 'sweetalert2';

export default {
  components: {
    Bootstrap4Pagination
  },
  data () {
    return {
      companies: [] ,
      listcompanies:[],
      sortDirection: 1,
      sortField: 'nom',
      q:''
    }
  },
  mounted: function() {
        this.getData();
  },
  computed: {
    sortedCompanies() {
      return this.companies.sort((a, b) => {
        if (a[this.sortField] < b[this.sortField]) {
          return -1 * this.sortDirection;
        } else if (a[this.sortField] > b[this.sortField]) {
          return 1 * this.sortDirection;
        } else {
          return 0;
        }
      });
    },
  },
  methods: {
    getData(page = 1) {
        axios.get(`/api/company?page=${page}`).then(response=>{
                this.companies = response.data.data;
                this.listcompanies = response.data;
            }).catch(error=>{
                console.log(error)
                this.companies = []
            })
    },
    sortByName() {
      if (this.sortField === 'nom') {
        this.sortDirection *= -1;
      }
      else {
        this.sortDirection = 1;
        this.sortField = 'nom';
      }
    },
    searchcompany(){
      if(this.q.length > 1){
          axios.get(`/api/searchcompany/` + this.q).then(response=>{
                this.companies = response.data.data;
            }).catch(error=>{console.log(error) })
      }else{
        this.getData();      
      }
    },
    deletecompany(companyid)
    {
      console.log(companyid);
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
            axios.delete(`/api/company/${companyid}`).then(response=>{
            Swal.fire(
              'Supprimé!',
              'L\'enregistrement est supprimé avec succès',
              'success'
            )
            this.getData();
            }).catch(error=>{
                console.log(error)
                this.companies = []
            })
          }
        })
    }
  }
}
</script>
