<template>
   <div class="col-md-12 col-sm-12  ">
      <div>
        <div class="row">
          <div class="col-sm-12 mail_list_column">
            <h2>L'historique</h2>
            <hr>
            <a v-for="(log, key) in logs.data"  :key="key" >
              <div class="mail_list">
                <div class="left">
                  <i class="fa fa-circle"></i>
                </div>
                <div class="right">         
                  <p> <strong>{{log.date}}</strong> || <strong>{{log.user}}</strong> {{ log.message }}</p>
                </div>
              </div>
            </a>
          </div>
          <Bootstrap4Pagination :data="logs" @pagination-change-page="getData" />                      
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
      logs: [] 
    }
  },
  mounted: function() {
        this.getData();
  },
  methods: {
    getData (page) {
      axios.get(`/api/logs?page=${page}`).then(response=>{
                this.logs = response.data;
                console.log(this.logs);
            }).catch(error=>{
                console.log(error)
                this.logs = []
            })
      },
    }
  }
</script>
