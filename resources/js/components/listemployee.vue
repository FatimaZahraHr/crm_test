<template>
   <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Liste  <small>des employés</small></h2>   
                    <div class="clearfix"></div>
                  </div>
                  <div class="row divsearch">
                    <label for="">Chercher par nom :</label>  
                    <div class="col-md-3 col-sm-3">
                       <input type="text" class="form-control" @keyup="searchuser" v-model="q" placeholder="Rechercher par nom ..">
                    </div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Société </th>
                            <th class="column-title" @click="sortByName()">Nom <i class="fa fa-sort" style="font-size: 16px;"></i></th>
                            <th class="column-title">Email </th>
                            <th class="column-title">Adresse </th>
                            <th class="column-title">Téléphone </th>
                            <th class="column-title">Date de naissance </th>
                            <th class="column-title">Statut </th>
                            <th class="column-title no-link last">
                              <span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="even pointer"  v-for="(employee, key) in sortedEmployees"  :key="key" >
                            <td>{{employee.namecompany}}</td>
                            <td>{{employee.name}}</td>
                            <td>{{employee.email}}</td>
                            <td>{{employee.adress}} </td>
                            <td>{{employee.tel}}</td>
                            <td>{{employee.birthday}}</td>
                            <td>
                            <span v-if="employee.status == 1" class="badge badge-primary">Validé</span>
                            <span v-if="employee.status == 2" class="badge badge-success">Confirmé</span>
                            <span v-if="employee.status == 3" class="badge badge-danger">Annulé</span>
                            <span v-if="employee.status == null" class="badge badge-secondary">Non confirmé</span>
                            </td>
                            <td class=" last">
                                  <button v-if="employee.status == null || employee.status == 1" @click="cancel(employee.id)"  class="btn btn-danger btns">Annuler</button>
                                  <router-link :to="{path : '/employee/'+employee.id+'/show'}"  class="btn btn-primary btns">Afficher</router-link>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <Bootstrap4Pagination :data="listemployees" @pagination-change-page="getData" />                      
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
      employees: [],
      listemployees:[],
      sortDirection: 1,
      sortField: 'nom',
      q:''
    }
  },
  mounted: function() {
        this.getData();
  },
  computed: {
    sortedEmployees() {
      return this.employees.sort((a, b) => {
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
    getData(page) {
      axios.get(`/api/employee?page=${page}`).then(response=>{
                this.employees = response.data.data;
                this.listemployees = response.data ;
            }).catch(error=>{
                console.log(error)
            })
    },
    sortByName() {
      if (this.sortField === 'name') {
        this.sortDirection *= -1;
      }
      else {
        this.sortDirection = 1;
        this.sortField = 'name';
      }
    },
    searchuser(){
      if(this.q.length > 1){
          axios.get(`/api/searchemployee/` + this.q).then(response=>{
                this.employees = response.data.data;
            }).catch(error=>{console.log(error) })
      }else{
        this.getData();      
      }
    },
    cancel(userid)
    {
        Swal.fire({
          title: 'Vous êtes sûre?',
          text: "Vous voulez annuler cette invitation!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Oui'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.put(`/api/employee/${userid}/cancel`).then(response=>{
            Swal.fire(
              'annulation!',
              'L\'invitation est annulée avec succès',
              'success'
            )
            this.getData();
            }).catch(error=>{
                console.log(error)
            })
          }
        })
    }
  }
}
</script>
