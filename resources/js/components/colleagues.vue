<template>
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Liste  <small>des employés</small></h2>   
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <th class="column-title">Société </th>
                    <th class="column-title">Nom </th>
                    <th class="column-title">Email </th>
                    <th class="column-title">Adresse </th>
                    <th class="column-title">Téléphone </th>
                    <th class="column-title">Date de naissance </th>
                    <th class="column-title no-link last">
                      <span class="nobr">Action</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="even pointer"  v-for="(employee, key) in employees.data"  :key="key" >
                    <td>{{employee.namecompany}}</td>
                    <td>{{employee.name}}</td>
                    <td>{{employee.email}}</td>
                    <td>{{employee.adress}} </td>
                    <td>{{employee.tel}}</td>
                    <td>{{employee.birthday}}</td>
                    <td class=" last">
                        <router-link :to="{path : '/employee/'+employee.id+'/show'}"  class="btn btn-primary btns">Afficher</router-link>
                    </td>
                  </tr>
                </tbody>
              </table>
              <Bootstrap4Pagination :data="employees" @pagination-change-page="getData" />            
            </div>
          </div>
        </div>
    </div>
</template>
<script>
import { Bootstrap4Pagination } from 'laravel-vue-pagination'

export default {
  components: {
    Bootstrap4Pagination
  },
  data () {
    return {
      user_id: document.querySelector("meta[name='user-id']").getAttribute('content'),
      employees: [] 
    }
  },
  mounted: function() {
            this.getData();
  },
  methods: {
    getData (page) {
      axios.get(`/api/colleagues/${this.user_id}?page=${page}`).then(response=>{
                this.employees = response.data;
                console.log(this.employees);
            }).catch(error=>{
                console.log(error)
            })
    },
 
  }
}
</script>
