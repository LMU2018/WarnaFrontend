<template>
  <div class="ayam">
    <br>

    <div>
      <form v-on:submit.prevent="login">
        <img alt="Vue logo" src="../assets/logo.png">
        <br>
        <br>
        <div class="form-group">
          <div class="form-group centered">
            <div class="col-md-4">
              <input
                type="text"
                id="inputEmail"
                class="form-control col-xs-4"
                placeholder="NPM"
                v-model="npm"
                required
                autofocus
              >
            </div>
          </div>
          <div class="form-group centered">
            <div class="col-md-4">
              <center>
                <input
                  type="password"
                  id="inputPassword"
                  class="form-control"
                  placeholder="Password"
                  v-model="password"
                  required
                >
              </center>
            </div>
          </div>
          <br>
          <div class="form-group centered">
            <div class="col-md-4">
              <p>
                <b>
                  <strong>WARUNG DANA EULA</strong>
                </b>
              </p>
              <label>
                <input type="checkbox" checked="checked" v-model="checked" name="remember"> Saya Setuju Dengan Syarat & Ketentuan
                <br>
                <a style="color:blue" href="https://lmu2018.github.io/WarungDana/">WARUNG DANA EULA</a>
              </label>
            </div>
          </div>

          <div class="form-group centered">
            <div class="col-md-4">
              <button class="btn btn-md btn-info btn-block" type="submit">Sign in</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
import Router from "vue-router";
import bModal from "bootstrap-vue/es/components/modal/modal";
import bModalDirective from "bootstrap-vue/es/directives/modal/modal";
Vue.use(Router);
export default {
  data() {
    return {
      npm: "",
      password: "",
      loginError: false,
      checked: false
    };
  },
  methods: {
    async login() {
      if (this.checked == true) {
       
        let formData = new FormData();
        formData.append("npm", this.npm);
        formData.append("password", this.password);

        console.log("boleh login");
        axios
          .post("http://192.168.139.59/middleware/login.php",  formData)
          
          // .post("http://116.197.129.148:57/middleware/login.php",  formData)
          //  .post("http://116.197.129.148:66/middleware/login.php",  formData)
       
          .then(response => (this.masuk = response.data))
          .catch(function(error) {
            if (error.response) {
              console.log(error.response.status);
              console.log(error.response.api_message);
            }
          })
          .then(function(response) {
            if (response) {
              console.log(response.api_status);
              console.log(response.api_message);
              console.log(response.id);
              console.log(response.status);
              console.log(response.api_http);

              if (response.api_status == 1) {
              console.log("berhasil login");
                sessionStorage.setItem("login", 1);
                sessionStorage.setItem("token", response.token);
                sessionStorage.setItem("id", response.id);
                sessionStorage.setItem("name", response.name);
                sessionStorage.setItem(
                  "id_privileges",
                  response.id_cms_privileges
                );
                sessionStorage.setItem(
                  "name_privileges",
                  response.cms_privileges_name
                );
                sessionStorage.setItem("id_mst_outlet", response.id_mst_outlet);
                sessionStorage.setItem(
                  "mst_outlet_outlet_name",
                  response.mst_outlet_outlet_name
                );
                sessionStorage.setItem("id_mst_branch", response.id_mst_branch);
                sessionStorage.setItem("mst_branch_name", response.mst_branch_name);
                sessionStorage.setItem("photo", response.photo);

                window.location = "/";
              } else {
                alert("User NPM / Password Salah");
              }
            }
          });
      } else {
        alert("Belum Memenuhi Syarat Dan Ketentuan");
        console.log("eula");
      }
    }
  }
};
</script>

<style>
.form-wrapper {
  display: flex;
  align-items: center;
}
.input-group {
  border: 1px yellow solid;
  text-align: center;
}
.centered {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>

