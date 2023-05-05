<template>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="row" v-if="role == 1">
              <div class="col-md-12">
                <div class="">
                  <div class="x_content">
                    <div class="row">
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-building" syule="color:#589ca3"></i>
                          </div>
                          <div class="count">{{count.countcompany}}</div>
                          <h3>Les sociétés</h3>
                          <router-link to="/companies" class="btn btn-round btn-secondary btn-sm linkdash">Plus d'infos</router-link>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-group" style="color:#64a172"></i>
                          </div>
                          <div class="count">{{count.countemploye}}</div>
                          <h3>Les employées</h3>
                          <router-link to="/employees" class="btn btn-round btn-secondary btn-sm linkdash">Plus d'infos</router-link>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-user" style="color:#fb808b" ></i>
                          </div>
                          <div class="count">{{count.countadmins}}</div>
                          <h3>Les admins</h3>
                          <router-link to="/admins" class="btn btn-round btn-secondary btn-sm linkdash">Plus d'infos</router-link>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-file" style="color:#0963c3" ></i>
                          </div>
                          <div class="count">{{count.countlogs}}</div>
                          <h3>L'historique</h3>
                          <router-link to="/logs" class="btn btn-round btn-secondary btn-sm linkdash">Plus d'infos</router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Détails</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <!-- blockquote -->
                  <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                      posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                  </blockquote>

                  <blockquote class="blockquote-reverse">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                      posuere erat a ante Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</template>
<script>
export default {
     data(){
         return {
             role : localStorage.getItem('role'),
             count: {},
             errors: {}
         }
     },
     mounted: function() {
       this.getcount();
     },
     methods: {
        async getcount(){
          axios.get(`/api/count`).then(response=>{
              this.count = response.data;
              this.errorList="";
          }).catch(error=>{
              console.log(error);
          })
        },
     } 
 }
</script>
