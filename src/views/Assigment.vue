<template>
  <div class="assigment">
    <div class="container">
      <h4>
        <b>ASSIGNMENT</b>
      </h4>

      <loading
        :active.sync="isLoading"
        :color="color"
        :loader="loader"
        :height="height"
        :width="width"
        :is-full-page="fullPage"
      ></loading>

      <!-- start modal -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Menu Filter</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" v-model="category" placeholder="Category">
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="no_contract"
                  placeholder="No Contract"
                >
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="provider_1"
                  placeholder="Provider 1 "
                >
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="provider_2"
                  placeholder="Provider 2"
                >
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="kabupaten"
                  placeholder="Kabupaten "
                >
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="kecamatan"
                  placeholder="Kecamatan "
                >
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="kelurahan"
                  placeholder="Kelurahan "
                >
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="cms_users_name"
                  placeholder="Users Name"
                >
              </div>
              <div class="form-group">
                <select v-model="pilih_target_mst_status" class="form-control">
                  <option disabled value>Status</option>
                  <option
                    v-for="stts in target_mst_status"
                    v-bind:value="stts.id"
                  >{{ stts.status }}</option>
                </select>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button
                type="button"
                @click.prevent="getData"
                class="btn btn-info btn-sm"
                data-dismiss="modal"
              >Cari Data</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Confrim -->
      <div class="modal fade" id="myModall">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Confirm</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="form-group">
                <!-- <label for="email">Users Assigmnet:</label> -->
              </div>
              <div class="form-group">
                <label for="disabledInput">Jumlah Target:</label>
                <input
                  type="number"
                  id="disabledInput"
                  class="form-control disabled"
                  v-model="panjang"
                  disabled
                >
              </div>

              <div class="form-group disabled">
                <label for="disabledInput">Target Assigment</label>
                <select
                  v-model="yg_dipilih"
                  id="disabledInput"
                  class="form-control disabled"
                  disabled
                >
                  <option v-for="option in getValue" v-bind:value="option.id">{{ option.name }}</option>
                </select>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button
                type="button"
                v-on:click="kirim"
                class="btn btn-info btn-sm float-left"
                data-dismiss="modal"
              >Submit</button>
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end modal confrim -->
      <br>
      <form class="form-inline" role="form">
        <select v-model="perPage" class="form-control form-control-sm" style="width:110px">
          <option v-for="d in dataper" v-bind:value="d.data">{{ d.data }}</option>
        </select>
        
        <button
          type="button"
          class="btn btn-info btn-sm"
          data-toggle="modal"
          data-target="#myModal"
        >Filter Data</button>
      </form>
      <br>

      <div
        class="table-responsive table-sm table-hover"
        style="overflow: auto;
white-space: nowrap;"
      >
        <table class="table">
          <thead>
            <tr style="font-size:12px" class="text-left">
              <th>
                <input type="checkbox" v-model="selectAll">
                {{panjang}}
              </th>
              <th>CATEGORY</th>
              <th>NO CONTRACT</th>
              <th>FIRST NAME</th>
              <th>PROVIDER 1</th>
              <th>PROVIDER 2</th>
              <th>KABUPATEN</th>
              <th>KECAMATAN</th>
              <th>KELURAHAN</th>
              <th>USERS</th>
              <th>STATUS</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tl in posts" style="font-size:12px" class="text-left">
              <td>
                <input type="checkbox" v-model="selected" :value="tl.id" number>
              </td>
              <td>{{ tl.category }}</td>
              <td>{{ tl.no_contract }}</td>
              <td>{{ tl.first_name }}</td>
              <td>{{ tl.provider_1 }}</td>
              <td>{{ tl.provider_2 }}</td>
              <td>{{ tl.kabupaten }}</td>
              <td>{{ tl.kecamatan }}</td>
              <td>{{ tl.kelurahan }}</td>
              <td>{{ tl.cms_users_name }}</td>
              <td>{{ tl.status }}</td>
            </tr>
          </tbody>
        </table>
        <center>
          <div align="center">{{info}}</div>
        </center>
      </div>

      <div>
        <div class="form-group form-inline">
          <select v-model="outlet_yg_dipilih" class="form-control form-control-sm" style="width:300px">
            <option disabled value>Pilih Outlet</option>
            <option
              v-for="outlet in uniqueOutlet"
              v-bind:value="outlet.id_mst_outlet"
            >{{ outlet.mst_outlet_outlet_name }}</option>
          </select>
        </div>
        <div class="form-group">
          <select v-model="yg_dipilih" class="form-control form-control-sm" style="width:300px">
            <option disabled value>Pilih User</option>
            <option v-for="option in getValue" v-bind:value="option.id">{{ option.name }}</option>
          </select>
          <h5 align="left" class="text-success">Jumlah User Assigmnet : {{panjang}}</h5>

          <button
            type="button"
            class="btn btn-info btn-sm float-left"
            data-toggle="modal"
            data-target="#myModall"
          >Submit</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import uniq from "lodash/uniq";
import Vue from "vue";
import VuejsDialog from "vuejs-dialog";
import "vuejs-dialog/dist/vuejs-dialog.min.css";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

// Tell Vue to install the plugin.
Vue.use(VuejsDialog);
export default {
  components: {
    Loading
  },
  name: "assigmnet",
  data() {
    return {
      info: '',
      isLoading: false,
      color: "#007bff",
      height: 128,
      width: 128,
      loader: "dots",
      fullPage: true,
      posts: [],
      perPage: 150,
      dataper: [
        { data: 5 },
        { data: 10 },
        { data: 25 },
        { data: 50 },
        { data: 100 },
        { data: 150 },
      ],
      pages: [],
      selected: [],
      yg_dipilih: "",
      users: [],
      outlet_yg_dipilih: "",
      outlet: "",
      users_outlet: [],
      ayam: [],
      category: "",
      no_contract: "",
      provider_1: "",
      provider_2: "",
      kabupaten: "",
      kecamatan: "",
      kelurahan: "",
      cms_users_name: "Super Admin",
      status: "",
      showModal: false,
      provinsi: [],
      pilih_provinsi: [],
      target_mst_status: [],
      pilih_target_mst_status: 1,
      currentSortBranch: "name"
    };
  },
  methods: {
    onCancel() {
      console.log("User cancelled the loader.");
    },
    kirim: async function(event) {
      this.isLoading = true;
      var cek_login = sessionStorage.getItem("id");
      var ayam;
      for (ayam = 0; ayam < this.selected.length; ayam++) {
        try {
          var response = await this.$http.post("target_assigment", {
            id: this.selected[ayam],
            id_cms_users: this.yg_dipilih,
            updated_by: cek_login,
            id_target_mst_status: 1
            
          });
        } catch (error) {
          console.log(error);
        }
      }


      this.isLoading = false;

      if (event) {
        alert("Assignment Sukses");
        window.location.reload(true);
      }
    },
    async getData() {
      // simulate AJAX

      var filter_branch = sessionStorage.getItem("id_mst_branch");
      var perPage = this.perPage;
     

      if (filter_branch == "null") {
        var filter_branch_ho = " ";
      } else {
        var filter_branch_ho = filter_branch;
      }

      this.isLoading = true;
    

      const response = await this.$http.get("frontend_target_assigment", {
        params: {
          id_mst_branch: filter_branch_ho,
          limit: perPage,
          category: this.category,
          no_contract: this.no_contract,
          provider_1: this.provider_1,
          provider_2: this.provider_2,
          kabupaten: this.kabupaten,
          kecamatan: this.kecamatan,
          kelurahan: this.kelurahan,
          cms_users_name: this.cms_users_name,
          id_target_mst_status: this.pilih_target_mst_status
        }
      });
      
      this.posts = response.data.data

      if (this.posts.length == 0) {
        this.info = "Data Tidak Ditemukan";
      } else {
        this.info = "";
      }
      this.isLoading = false;
    },

    getPosts() {
      var filter_branch = sessionStorage.getItem("id_mst_branch");

      console.log(this.outlet_yg_dipilih);

      if (filter_branch == "null") {
        var filter_branch_ho = " ";
      } else {
        var filter_branch_ho = filter_branch;
      }

      this.$http
        .get("frontend_users_listing", {
          params: {
            branch: filter_branch_ho
          }
        })
        .then(response => (this.users = response.data.data));
    }
  },
  computed: {
    panjang() {
      return this.selected.length;
    },

    selectAll: {
      get: function() {
        return this.posts ? this.selected.length == this.posts.length : false;
      },
      set: function(value) {
        var selected = [];
        if (value) {
          this.posts.forEach(function(tl) {
            selected.push(tl.id);
          });
        }
        this.selected = selected;
      }
    },
    getValue() {
      // udah ye
      if (this.outlet_yg_dipilih !== "") {
        console.log(`Coba ${this.outlet_yg_dipilih}`);
        let x = this.outlet_yg_dipilih;
        return this.sortUsers.filter(function(list) {
          return list.id_mst_outlet == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.users;
      }
    },
    uniqueOutlet: function() {
      var existingIds = {};
      return this.sortUsers.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    },
    sortUsers: function() {
    function compare(a, b) {
      if (a.name < b.name)
        return -1;
      if (a.name > b.name)
        return 1;
      return 0;
    }

    return this.users.sort(compare);
  }
  },
  mounted() {
    var privilages = sessionStorage.getItem("name_privileges");
    var login = sessionStorage.getItem("login");
    var filter_branch = sessionStorage.getItem("id_mst_branch");
    let id_privileges = sessionStorage.getItem("id_privileges");

    var index = window.location.pathname;
    var url =
      index == "/" ||
      index == "/assigment" ||
      index == "/setting" ||
      index == "/report_kpi" ||
      index == "/report_outlet";
    if (login == 1) {
      if (url) {
        console.log(index);
      } else {
        window.location = "/";
      }
    } else {
      if (url) {
        window.location = "/login";
      } else {
        console.log("index");
      }
    }

    if (id_privileges == 3 && id_privileges == 5) {
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
    this.$http
      .get("frontend_target_mst_status")
      .then(response => (this.target_mst_status = response.data.data));
  },

  created() {
    this.getPosts();
  }
};
</script>
<style>
</style>

