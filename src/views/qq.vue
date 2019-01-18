<template>
    <div class="container">
        <!-- <div class="text-center form-wrapper">

            <form class="form-signin" v-on:submit.prevent="login">

                <h1 class="h3 mb-3 font-weight-normal">Login</h1>

                <label for="inputEmail" class="sr-only">NPM</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="NPM" required autofocus v-model="npm">

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="password">

                
                <p><b>WARUNG DANA Customer Agreement</b></p>
                <div class="row">
                    <div class="col-sm-1"><input type="checkbox" id="checkbox" v-model="checked"></div>
                    <div class="col-sm-11"><label for="checkbox">Check here to indicate that you have read and agree to the terms of the  </label></div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>

        </div>
 -->



<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
        
        <div class="row">                
            <div class="iconmelon">
              <svg viewBox="0 0 32 32">
                <g filter="">
                  <use xlink:href="#git"></use>
                </g>
              </svg>
            </div>
        </div>
        
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Bootsnipp.com</div>
            </div>     

            <div class="panel-body" >

                <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">
                   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user" type="text" class="form-control" name="user" value="" placeholder="User">                                        
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>                                                                  

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Log in</button>                          
                        </div>
                    </div>

                </form>     

            </div>                     
        </div>  
    </div>

    </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
import Router from "vue-router";
import bModal from 'bootstrap-vue/es/components/modal/modal'
import bModalDirective from 'bootstrap-vue/es/directives/modal/modal'
Vue.use(Router);
export default {
    data() {
        return {
            npm: '',
            password: '',
            loginError: false,
            checked: false
        }
    },
    methods: {
        login () {
            if (this.checked == true) {
                console.log("boleh login")
                this.$http.get('login',{
                    params:{
                        npm: this.npm,
                        password: this.password,

                    }
                })
                .then(response => (this.masuk = response.data))
                .catch(function (error) {
                    if (error.response) {
                        console.log(error.response.status);
                        console.log(error.response.api_message);
                    }

                })
                .then(function(response){
                    if (response) {
                        console.log(response.api_status);
                        console.log(response.api_message);
                        console.log(response.id);
                        console.log(response.status);
                        console.log(response.api_http);

                        if (response.api_status == 1) {
                            console.log('berhasil login');
                            sessionStorage.setItem("login", 1);
                            sessionStorage.setItem("id", response.id);
                            sessionStorage.setItem("name", response.name);
                            sessionStorage.setItem("id_privileges", response.id_cms_privileges);
                            sessionStorage.setItem("name_privileges", response.cms_privileges_name);
                            sessionStorage.setItem("id_mst_outlet", response.id_mst_outlet);
                            sessionStorage.setItem("mst_outlet_outlet_name", response.mst_outlet_outlet_name);
                            sessionStorage.setItem("id_mst_branch", response.id_mst_branch);

                            window.location = "/";
                        }else{
                            alert('User NPM / Password Salah');
                        }
                    }            
                });
            }else {
                alert('Eulla');
                console.log('eula')
            }

            
        }
    }
}
</script>

<style scoped>
.form-wrapper {
    min-height: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
}
.form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
}
.form-signin .form-control:focus {
    z-index: 2;
}
.form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
</style>