<template>
  <div id="app">
    <div class="wrapper">
      <!-- Sidebar  -->
      <nav id="sidebar" v-show="ok">
        <div class="sidebar-header">
          <div class="text-center">
            <img v-bind:src="photo" class="rounded" alt="profil" width="70px">
            <p align="center">{{name}}</p>
          </div>
        </div>

        <ul class="list-unstyled components">
          <li class="active" style="background: #B00020; color: #fff">
            <span style="font-size: 15px; font-family:calibri">
              <b>NAVIGATION</b>
            </span>
          </li>

          <li style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri;">
              <router-link to="/">
                <i class="fas fa-tachometer-alt fa-2x"></i>
                DASHBOARD
              </router-link>
            </span>
          </li>
          <li v-show="ass" class="active" style="background: #2E3A50; color: #fff">
            <span style="font-size: 15px; font-family:calibri">
              <b>TELEMARKETING</b>
            </span>
          </li>
          <li style="padding: 5px;" v-show="ass">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/assigment">
                <img alt="Vue logo" src="./assets/assignment.png" style="max-height:25px">
                <span style="text-color:#2E3A50">ASSIGNMENT</span>
              </router-link>
            </span>
          </li>

          <li style="padding: 5px;" v-show="import_data">
            <span style="font-size: 13px;text-align:left;  font-family:calibri">
              <router-link to="/import_target">
                <img alt="Vue logo" src="./assets/import.png" style="max-height:25px">
                IMPORT TARGET
              </router-link>
            </span>
          </li>
          <li class="active" style="background: #2E3A50; color: #fff">
            <span style="font-size: 15px; font-family:calibri">
              <b>REPORT</b>
            </span>
          </li>

          <li style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/report_tele">
                <img alt="Vue logo" src="./assets/telemarketing report.png" style="max-height:25px">
                REPORT TELEMARKETING
              </router-link>
            </span>
          </li>

          <li style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/report_kpi">
                <img alt="Vue logo" src="./assets/KPI Report.png" style="max-height:25px">
                REPORT KPI
              </router-link>
            </span>
          </li>
       
          <li v-show="target" class="active" style="background: #2E3A50; color: #fff">
            <span style="font-size: 15px; font-family:calibri">
              <b>DOWNLOAD</b>
            </span>
          </li>
          <li v-show="target" style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/export_target">
                <img alt="Vue logo" src="./assets/target.png" style="max-height:25px">
                TARGET
              </router-link>
            </span>
          </li>
          <li v-show="lead" style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/leads">
                <img alt="Vue logo" src="./assets/lead.png" style="max-height:25px">
                LEADS
              </router-link>
            </span>
          </li>
             <li style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/visum">
                <img alt="Vue logo" src="./assets/KPI Report.png" style="max-height:25px">
                VISUM
              </router-link>
            </span>
          </li>
          <li v-show="deal" style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/deals">
                <img alt="Vue logo" src="./assets/deal.png" style="max-height:25px">
                DEALS
              </router-link>
            </span>
          </li>

          <li class="active" style="background: #2E3A50; color: #fff ; font-family:calibri">
            <span style="font-size: 15px">
              <b>USERS MANAGEMENT</b>
            </span>
          </li>

          <li>
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/users">
                <img alt="Vue logo" src="./assets/user.png" style="max-height:25px">
                USERS
              </router-link>
            </span>
          </li>
          <!-- <li>
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/devreport">
                <img alt="Vue logo" src="./assets/dev report.png" style="max-height:25px">
                Dev Report
              </router-link>
            </span>
          </li>
          <li>
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/setting">
                <img alt="Vue logo" src="./assets/setting.png" style="max-height:25px">
                Setting
              </router-link>
            </span>
          </li> -->
          <li v-show="order" class="active" style="background: #2E3A50; color: #fff">
            <span style="font-size: 15px; font-family:calibri">
              <b>ORDER</b>
            </span>
          </li>
          <li v-show="order" style="padding: 5px;">
            <span style="font-size: 13px;text-align:left; font-family:calibri">
              <router-link to="/order">
                <img alt="Vue logo" src="./assets/target.png" style="max-height:25px">
                Order
              </router-link>
            </span>
          </li>

          <li
            class="active"
            style="background: #8A2D30; color: #fff ; font-family:calibri;padding: 0px;"
          >
            <span style="font-size: 13px">
              <b>
                <router-link to="/logout">LOGOUT</router-link>
              </b>
            </span>
          </li>

          <!-- <li>
            <a href="#">
              <router-link to="/logout">logout</router-link>
            </a>
          </li>-->
        </ul>

        <ul class="list-unstyled CTAs"></ul>
      </nav>

      <!-- Page Content  -->
      <div id="content">
        <nav class="navbar navbar-expand-sm" v-show="ok" style="background: #8A2D30">
          <div class>
            <button type="button" id="sidebarCollapse" class="btn" style="background: #8A2D30">
              <i style="color: #fff" class="fas fa-bars"></i>
              <span style="color: #fff"></span>
            </button>
<!-- 
            <button style="color: #fff" class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i style="color: #fff" class="fas fa-align-justify"></i>
            </button> -->
             <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Page</a>
                </li>
              </ul>
            </div> -->
          </div>
        </nav>

        <router-view/>

        <div class="line"></div>
      </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
  </div>
</template>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>


<script>
import axios from "axios";

import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);
export default {
  data() {
    return {
      ok: true,
      photo: null,
      name: null,
      ass: true,
      import_data: true,
      assignment: true,
      target: true,
      lead: true,
      deal: true,
      order: true
    };
  },
  mounted() {
    var privilages = sessionStorage.getItem("name_privileges");
    let id_privileges = sessionStorage.getItem("id_privileges");
    var login = sessionStorage.getItem("login");
    var namee = sessionStorage.getItem("name");
    var photo = sessionStorage.getItem("photo");
    var index = window.location.pathname;
    this.name = namee;
    this.photo = photo;
    var url =
      index == " " ||
      index == "/" ||
      index == "/assigment" ||
      index == "/report_tele" ||
      index == "/report_kpi" ||
      index == "/export_target" ||
      index == "/import_target" ||
      index == "/setting" ||
      index == "/devreport";

    if (index == "/login") {
      this.ok = false;
    }

    if (login == 1) {
      if (url) {
        console.log(index);
        console.log(login);
      } else {
        console.log(index);
        window.location = "/";
      }
    } else {
      if (url) {
        console.log(index);
        window.location = "/login";
      } else {
        console.log("done");
      }
    }

    if (id_privileges == 3) {
      sessionStorage.removeItem("login");
      sessionStorage.removeItem("id");
      sessionStorage.removeItem("name");
      sessionStorage.removeItem("id_privileges");
      sessionStorage.removeItem("name_privileges");
      sessionStorage.removeItem("id_mst_outlet");
      sessionStorage.removeItem("id_mst_outlet");
      sessionStorage.removeItem("mst_outlet_outlet_name");
      sessionStorage.removeItem("id_mst_branch");
      alert("Maaf Anda Tidak Punya Akses");
      window.location = "/login";
    }
    if (id_privileges == 5) {
      this.ass = false;
    }
    if (id_privileges == 8 || id_privileges == 4 || id_privileges == 7) {
      this.import_data = false;
    }
    if (id_privileges == 7) {
       this.ass = false;
      this.import_data = false;
      this.target = false
      this.lead = false
      this.deal = false
      this.order = false
    }
  }
};
</script>

