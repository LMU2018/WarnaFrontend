<template>
  <div class="export_target">
    <h4>
      <b>TARGET</b>
    </h4>
    <loading
      :active.sync="isLoading"
      :color="color"
      :loader="loader"
      :height="height"
      :width="width"
      :is-full-page="fullPage"
    ></loading>

    <br>
    {{hitung}}
    <form v-show="cabang" class="form-inline" role="form">
      <select v-model="default_branch" class="form-control form-control-sm">
        <option disabled value>Pilih Branch</option>
        <option v-for="branch in sortBranch" v-bind:value="branch.id">{{ branch.branch_name }}</option>
      </select>
      <button type="button" v-on:click="cari" class="btn btn-default btn-sm">Cari</button>
    </form>

    <div class="table-responsive">
      <table class="table shadow">
        <tbody>
          <tr>
            <th>
              <div class="media">
                <i class="fas fa-database fa-3x"></i>
                <div class="media-body">
                  <h4>{{com_data_target}}</h4>
                  <p style="font-size:12px">Data Target</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-headset fa-3x"></i>

                <div class="media-body">
                  <h4>{{com_target_sudah_follow}}</h4>
                  <p style="font-size:12px">Sudah Dihubungin</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-copy fa-3x"></i>
                <div class="media-body">
                  <h4>{{com_target_belum_follow}}</h4>
                  <p style="font-size:12px">Belum Dihubungi</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-users fa-3x"></i>
                <div class="media-body">
                  <h4>{{com_users_target}}</h4>
                  <p style="font-size:12px">Users</p>
                </div>
              </div>
            </th>
          </tr>
        </tbody>
      </table>
    </div>

    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-inline" role="form">
              <select v-model="modeny" class="form-control">
                <option disabled value>Pilih Periode</option>
                <option v-for="d in mode" v-bind:value="d.data">{{ d.text }}</option>
              </select>
            </form>
            <br>
            <div v-if="modeny == 2" class="center" align="center">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Tahun</label>
                </div>
                <select v-model="tahunnya" class="form-control">
                  <option v-for="d in tahun" v-bind:value="d.data">{{ d.data }}</option>
                </select>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Bulan</label>
                </div>
                <select v-model="bulanny" class="form-control">
                  <option v-for="d in bulan" v-bind:value="d.data">{{ d.nama }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          
              <downloadexcel
               class="btn btn-info btn-sm"
               v-if="modeny == 1"
                :fetch="fetchData1"
                :fields="json_fields"
                type="csv"
                name="Export Target.xls"
              >Download All</downloadexcel>
          
           
              <downloadexcel
              v-if="modeny == 2"
              class="btn btn-info btn-sm"
                :fetch="fetchData2"
                :fields="json_fields"
                type="csv"
                name="Export Target.xls"
              >Download</downloadexcel>
            
          </div>
        </div>
      </div>
    </div>

    <div class="card-group shadow">
      <div
        v-on:click="modee(1)"
        class="btn btn-sm btn-outline-danger card border-danger"
        data-toggle="modal"
        data-target="#exampleModal"
      >
        <a>
          <b>ALL</b>
        </a>
      </div>
      <div
        v-on:click="modee(2)"
        class="card border-info btn btn-sm btn-outline-info"
        data-toggle="modal"
        data-target="#exampleModal"
      >
        <p>
          <b>Sudah Dihubungi</b>
        </p>
      </div>
      <div
        v-on:click="modee(3)"
        class="card border-warning btn btn-sm btn-outline-warning"
        data-toggle="modal"
        data-target="#exampleModal"
      >
        <p>
          <b>Belum Dihubungi</b>
        </p>
      </div>
    </div>
    <br>

    <form class="form-inline" role="form">
      <select v-model="outlet_yg_dipilih" class="form-control form-control-sm" style="width:300px">
        <option disabled value>Pilih Outlet</option>
        <option
          v-for="outlet in uniqueOutlet"
          v-bind:value="outlet.id_mst_outlet"
        >{{ outlet.mst_outlet_outlet_name }}</option>
      </select>
    </form>
    <div class="table-responsive table-hover" style="overflow: auto;
	white-space: nowrap;">
      <table class="table">
        <thead>
          <tr style="font-size:12px">
            <th>Name</th>
            <th>Privileges</th>
            <th>Sudah Difollow</th>
            <th>Belum Difollow</th>
             <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr style="font-size:12px" v-for="tl in getValue">
            <td class="text-left">{{ tl.name }}</td>
            <td>{{ tl.cms_privileges_name}}</td>
            <td>{{ tl.follow }}</td>
            <td>{{ tl.notfollow }}</td>
            <td>{{ tl.users_data }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

import axios from "axios";
import downloadexcel from "vue-json-excel";

import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  name: "app",
  components: {
    downloadexcel,
    Loading
  },
  data() {
    return {
      isLoading: false,
      hitung: "",
      color: "#007bff",
      report_telemarketing_detail: "",
      outlet_yg_dipilih: "",
      selisih: "",
      users: [],
      ajg: null,
      mod: "",
      array_baru: [],
      height: 128,
      width: 128,
      loader: "dots",
      fullPage: true,
      total: "",
      totall: "",
      branch: [],
      currentSortBranch: "branch_name",
      default_branch: "",
      cabang: false,
      target_sudah_follow: [],
      target_belum_follow: [],
      users_target: [],
      target_data: [],
      array_users: [],
      down: "",
      title: "",
      tahun: [{ data: 2018 }, { data: 2019 }],
      tahunnya: "",
      bulan: [
        { data: 1, nama: "January" },
        { data: 2, nama: "Febuary" },
        { data: 3, nama: "Maret" },
        { data: 4, nama: "April" },
        { data: 5, nama: "Mei" },
        { data: 6, nama: "Juni" },
        { data: 7, nama: "Juli" },
        { data: 8, nama: "Agustus" },
        { data: 9, nama: "September" },
        { data: 10, nama: "Oktober" },
        { data: 11, nama: "November" },
        { data: 12, nama: "Desember" }
      ],
      bulanny: "",
      modeny: "",
      mode: [
        { data: 1, text: "Download Semua Data" },
        { data: 2, text: "Download Berdasarkan Periode" }
      ],
      g: [],
      h: [],

      json_fields: {
        id: 'id',
        "Tanggal Upload": "created_at",
        "updated_at": "updated_at",
        // "Last Call": "created_at_target_log",
        "Branch name": "mst_branch_branch_name",
        Datasource: "mst_data_source_datasource",
        target_status: "target_mst_status_status",
        business_code: "business_code",
        category: "category",
        priority: "priority",
        "No contract": "no_contract",
        nopol: "nopol",
        Firstname: "first_name",
        Lastname: "last_name",
        provider_1: "provider_1",
        provider_2: "provider_2",
        job: "job",
        address: "address",
        kelurahan: "kelurahan",
        kecamatan: "kecamatan",
        kabupaten: "kabupaten",
        provinsi: "provinsi",
        npm: "cms_users_npm",
        "Users name": "cms_users_name",
        privilages: "cms_privileges_name",
        "Outlet name": "mst_outlet_outlet_name",
        "duration Terakhir": "duration",
        "recall": "recall",
        "description Terakhir": "description",
        "status Terakhir": "status",
        revisit: "revisit",
        visit_status: "visit_status"
      }
    };
  },

  async mounted() {
    let year = new Date();
    this.tahunnya = year.getFullYear();

    let month = new Date();
    this.bulanny = month.getMonth() + 1;

      let yearr = String(this.tahunnya);
      let mounth = this.bulanny;
      let ayam = String(mounth).length;
      var tahunnya = this.tahunnya;
      let bulanny = this.bulanny;

      if (ayam == 1) {
        let a = this.bulanny;
        var ha = "0" + a;
        console.log("satu digit");
        console.log(ha);
      } else {
        let a = String(this.bulanny);
        var ha = a;
        console.log("lebih dari 1");
        console.log(ha);
      }
      let be = yearr + "-" + ha;

    var privilages = sessionStorage.getItem("name_privileges");
    var id_mst_branch = sessionStorage.getItem("id_mst_branch");
    var id_privileges = sessionStorage.getItem("id_privileges");
    var login = sessionStorage.getItem("login");
    var index = window.location.pathname;
    var url =
      index == " " ||
      index == "/" ||
      index == "/export_target" ||
      index == "/report_tele" ||
      index == "/report_kpi" ||
      index == "/setting" ||
      index == "/import_target";
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

    if (privilages == "CFA") {
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
      this.cabang = true;
      this.$http
        .get("frontend_branch_name")
        .then(response => (this.branch = response.data.data));
    } else {
      this.$http
        .get("frontend_target_data", {
          params: {
            id_mst_branch: id_mst_branch
          }
        })
        .then(response => (this.target_data = response.data.data));
      this.$http
        .get("frontend_target_belum_follow", {
          params: {
            updated_at: be,
            id_mst_branch: id_mst_branch,
            id_target_mst_status: 1
          }
        })
        .then(response => (this.target_belum_follow = response.data.data));
      this.$http
        .get("frontend_target_sudah_follow", {
          params: {
            updated_at: be,
            id_mst_branch: id_mst_branch
          }
        })
        .then(response => (this.target_sudah_follow = response.data.data));

      const users = await this.$http.get("frontend_users_listing", {
        params: {
          branch: id_mst_branch
        }
      });
      this.users_target = users.data.data;

      for (let i = 0; i < this.users_target.length; i++) {
        console.log(i);
        let id = this.users_target[i].id;
        let name = this.users_target[i].name;
        let id_mst_outlet = this.users_target[i].id_mst_outlet;
        let mst_outlet_outlet_name = this.users_target[i]
          .mst_outlet_outlet_name;
        let cms_privileges_name = this.users_target[i].cms_privileges_name;
        let follow = [];
        let notfollow = [];
        let users_data = [];

        const a = await this.$http.get("frontend_target_belum_follow", {
          params: {
            id_mst_branch: id_mst_branch,
            id_target_mst_status: 1,
            id_cms_users: id
          }
        });
        notfollow = a.data.data.length;

        const b = await this.$http.get("frontend_target_sudah_follow", {
          params: {
            id_mst_branch: id_mst_branch,
            id_cms_users: id
          }
        });
        follow = b.data.data.length;

        const c = await this.$http.get("frontend_target_total_data_users", {
          params: {
            id_mst_branch: id_mst_branch,
            id_cms_users: id
          }
        });
        users_data = c.data.data.length;

        this.array_users.push({
          id,
          name,
          follow,
          notfollow,
          users_data,
          id_mst_outlet,
          mst_outlet_outlet_name,
          cms_privileges_name
        });
      }
    }
  },
  methods: {
    modee(id) {
      this.modeny = "";
      switch (id) {
        case 1:
        this.array_baru = []
          this.down = "";
          this.title = "Download All Data";
          break;
        case 2:
        this.array_baru = []
          this.down = 2;
          this.title = "Download Data Follow UP";
          break;
        case 3:
        this.array_baru = []
          this.down = 1;
          this.title = "Download  Data Not Followed";
      }

      console.log(this.down);
     
    },
    async fetchData1() {
      console.log("test")
       $("#exampleModal").modal("hide");
      var id_mst_branch = sessionStorage.getItem("id_mst_branch");
      var id_privileges = sessionStorage.getItem("id_privileges");
      this.isLoading = true;
      this.hitung = "";

      if (id_privileges == 5) {
        if (this.down == 2) {
             const a = await this.$http.get(
              "frontend_target_total_followup",
              {
                params: {
                 id_mst_branch: this.default_branch
                }
              }
            );
            this.total = a.data.data;
        } else {
          const a = await this.$http.get(
              "frontend_target_total",
              {
                params: {
                 id_target_mst_status: this.down,
                id_mst_branch: this.default_branch
                }
              }
            );
            this.total = a.data.data;
        }

        for (let i = 0; i < this.Loops; i++) {
          console.log("get data 100");
          let a = 100;
          let n = [i];
          let b = 100;
          let hitung = a + (n - 1) * b;

          console.log(hitung, "    ", [i]);
          this.hitung = hitung;

          if (this.down == 2) {
            const users = await this.$http.get(
              "frontend_target_listing_followup",
              {
                params: {
                  id_mst_branch: this.default_branch,
                  limit: 100,
                  offset: hitung
                }
              }
            );
            this.g = users.data.data;
          } else {
            const users = await this.$http.get("frontend_target_listing", {
              params: {
                id_target_mst_status: this.down,
                id_mst_branch: this.default_branch,
                limit: 100,
                offset: hitung
              }
            });
            this.g = users.data.data;
          }

          for (let j = 0; j < this.g.length; j++) {
            let created_at = this.g[j].created_at;
            let updated_at = this.g[j].updated_at;
            let mst_branch_branch_name = this.g[j].mst_branch_branch_name;
            let mst_data_source_datasource = this.g[j]
              .mst_data_source_datasource;
            let target_mst_status_status = this.g[j].target_mst_status_status;
            let business_code = this.g[j].business_code;
            let category = this.g[j].category;
            let priority = this.g[j].priority;
            let no_contract = this.g[j].no_contract;
            let nopol = this.g[j].nopol;
            let first_name = this.g[j].first_name;
            let last_name = this.g[j].last_name;
            let provider_1 = this.g[j].provider_1;
            let provider_2 = this.g[j].provider_2;
            let job = this.g[j].job;
            let address = this.g[j].address;
            let kelurahan = this.g[j].kelurahan;
            let kecamatan = this.g[j].kecamatan;
            let kabupaten = this.g[j].kabupaten;
            let provinsi = this.g[j].provinsi;
            let cms_users_npm = this.g[j].cms_users_npm;
            let cms_users_name = this.g[j].cms_users_name;
            let cms_privileges_name = this.g[j].cms_privileges_name;
            let mst_outlet_outlet_name = this.g[j].mst_outlet_outlet_name;
            let created_at_target_log = this.g[j].created_at_target_log;
            let duration = this.g[j].duration;
            let recall = this.g[j].recall;
            let description = this.g[j].description;
            let status = this.g[j].status;
            let revisit = this.g[j].revisit;
            let visit_status = this.g[j].visit_status;

            this.array_baru.push({
              created_at,
              updated_at,
              mst_branch_branch_name,
              mst_data_source_datasource,
              target_mst_status_status,
              business_code,
              category,
              priority,
              no_contract,
              nopol,
              first_name,
              last_name,
              provider_1,
              provider_2,
              job,
              address,
              kelurahan,
              kecamatan,
              kabupaten,
              provinsi,
              cms_users_npm,
              cms_users_name,
              cms_privileges_name,
              mst_outlet_outlet_name,
              created_at_target_log,
              duration,
              recall,
              description,
              status,
              revisit,
              visit_status
            });
          }
        }
        if (this.down == 2) {
          const users2 = await this.$http.get(
            "frontend_target_listing_followup",
            {
              params: {
                id_mst_branch: this.default_branch,
                limit: 100,
                offset: this.Selisih
              }
            }
          );
          this.h = users2.data.data;
        } else {
          const users2 = await this.$http.get("frontend_target_listing", {
            params: {
              id_target_mst_status: this.down,
              id_mst_branch: this.default_branch,
              limit: 100,
              offset: this.Selisih
            }
          });
          this.h = users2.data.data;
        }

        console.log(this.Modulus);
        for (let k = 0; k < this.Modulus; k++) {
          console.log([k]);
          let created_at = this.h[k].created_at;
          let updated_at = this.h[k].updated_at;
          let mst_branch_branch_name = this.h[k].mst_branch_branch_name;
          let mst_data_source_datasource = this.h[k].mst_data_source_datasource;
          let target_mst_status_status = this.h[k].target_mst_status_status;
          let business_code = this.h[k].business_code;
          let category = this.h[k].category;
          let priority = this.h[k].priority;
          let no_contract = this.h[k].no_contract;
          let nopol = this.h[k].nopol;
          let first_name = this.h[k].first_name;
          let last_name = this.h[k].last_name;
          let provider_1 = this.h[k].provider_1;
          let provider_2 = this.h[k].provider_2;
          let job = this.h[k].job;
          let address = this.h[k].address;
          let kelurahan = this.h[k].kelurahan;
          let kecamatan = this.h[k].kecamatan;
          let kabupaten = this.h[k].kabupaten;
          let provinsi = this.h[k].provinsi;
          let cms_users_npm = this.h[k].cms_users_npm;
          let cms_users_name = this.h[k].cms_users_name;
          let cms_privileges_name = this.h[k].cms_privileges_name;
          let mst_outlet_outlet_name = this.h[k].mst_outlet_outlet_name;
          let created_at_target_log = this.h[k].created_at_target_log;
          let duration = this.h[k].duration;
          let recall = this.h[k].recall;
          let description = this.h[k].description;
          let status = this.h[k].status;
          let revisit = this.h[k].revisit;
          let visit_status = this.h[k].visit_status;

          this.array_baru.push({
            created_at,
            updated_at,
            mst_branch_branch_name,
            mst_data_source_datasource,
            target_mst_status_status,
            business_code,
            category,
            priority,
            no_contract,
            nopol,
            first_name,
            last_name,
            provider_1,
            provider_2,
            job,
            address,
            kelurahan,
            kecamatan,
            kabupaten,
            provinsi,
            cms_users_npm,
            cms_users_name,
            cms_privileges_name,
            mst_outlet_outlet_name,
            created_at_target_log,
            duration,
            recall,
            description,
            status,
            revisit,
            visit_status
          });
          console.log(created_at);
        }

        this.isLoading = false;
        return this.array_baru;
        

      } else {
        if (this.down == 2) {
             const a = await this.$http.get(
              "frontend_target_total_followup",
              {
                params: {
                 id_mst_branch: id_mst_branch
                }
              }
            );
            this.total = a.data.data;
        } else {
          const a = await this.$http.get(
              "frontend_target_total",
              {
                params: {
                 id_target_mst_status: this.down,
                id_mst_branch: id_mst_branch
                }
              }
            );
            this.total = a.data.data;
        }

        for (let i = 0; i < this.Loops; i++) {
          console.log("get data 100");
          let a = 100;
          let n = [i];
          let b = 100;
          let hitung = a + (n - 1) * b;

          console.log(hitung, "    ", [i]);
          this.hitung = hitung;

          if (this.down == 2) {
            const users = await this.$http.get(
              "frontend_target_listing_followup",
              {
                params: {
                  id_mst_branch: id_mst_branch,
                  limit: 100,
                  offset: hitung
                }
              }
            );
            this.g = users.data.data;
          } else {
            const users = await this.$http.get("frontend_target_listing", {
              params: {
                id_target_mst_status: this.down,
                id_mst_branch: id_mst_branch,
                limit: 100,
                offset: hitung
              }
            });
            this.g = users.data.data;
          }

          for (let j = 0; j < this.g.length; j++) {
            let created_at = this.g[j].created_at;
            let updated_at = this.g[j].updated_at;
            let mst_branch_branch_name = this.g[j].mst_branch_branch_name;
            let mst_data_source_datasource = this.g[j]
              .mst_data_source_datasource;
            let target_mst_status_status = this.g[j].target_mst_status_status;
            let business_code = this.g[j].business_code;
            let category = this.g[j].category;
            let priority = this.g[j].priority;
            let no_contract = this.g[j].no_contract;
            let nopol = this.g[j].nopol;
            let first_name = this.g[j].first_name;
            let last_name = this.g[j].last_name;
            let provider_1 = this.g[j].provider_1;
            let provider_2 = this.g[j].provider_2;
            let job = this.g[j].job;
            let address = this.g[j].address;
            let kelurahan = this.g[j].kelurahan;
            let kecamatan = this.g[j].kecamatan;
            let kabupaten = this.g[j].kabupaten;
            let provinsi = this.g[j].provinsi;
            let cms_users_npm = this.g[j].cms_users_npm;
            let cms_users_name = this.g[j].cms_users_name;
            let cms_privileges_name = this.g[j].cms_privileges_name;
            let mst_outlet_outlet_name = this.g[j].mst_outlet_outlet_name;
            let created_at_target_log = this.g[j].created_at_target_log;
            let duration = this.g[j].duration;
            let recall = this.g[j].recall;
            let description = this.g[j].description;
            let status = this.g[j].status;
            let revisit = this.g[j].revisit;
            let visit_status = this.g[j].visit_status;

            this.array_baru.push({
              created_at,
              updated_at,
              mst_branch_branch_name,
              mst_data_source_datasource,
              target_mst_status_status,
              business_code,
              category,
              priority,
              no_contract,
              nopol,
              first_name,
              last_name,
              provider_1,
              provider_2,
              job,
              address,
              kelurahan,
              kecamatan,
              kabupaten,
              provinsi,
              cms_users_npm,
              cms_users_name,
              cms_privileges_name,
              mst_outlet_outlet_name,
              created_at_target_log,
              duration,
              recall,
              description,
              status,
              revisit,
              visit_status
            });
          }
        }
        if (this.down == 2) {
          const users2 = await this.$http.get(
            "frontend_target_listing_followup",
            {
              params: {
                id_mst_branch: id_mst_branch,
                limit: 100,
                offset: this.Selisih
              }
            }
          );
          this.h = users2.data.data;
        } else {
          const users2 = await this.$http.get("frontend_target_listing", {
            params: {
              id_target_mst_status: this.down,
              id_mst_branch: id_mst_branch,
              limit: 100,
              offset: this.Selisih
            }
          });
          this.h = users2.data.data;
        }

        console.log(this.Modulus);
        for (let k = 0; k < this.Modulus; k++) {
          console.log([k]);
          let created_at = this.h[k].created_at;
          let updated_at = this.h[k].updated_at;
          let mst_branch_branch_name = this.h[k].mst_branch_branch_name;
          let mst_data_source_datasource = this.h[k].mst_data_source_datasource;
          let target_mst_status_status = this.h[k].target_mst_status_status;
          let business_code = this.h[k].business_code;
          let category = this.h[k].category;
          let priority = this.h[k].priority;
          let no_contract = this.h[k].no_contract;
          let nopol = this.h[k].nopol;
          let first_name = this.h[k].first_name;
          let last_name = this.h[k].last_name;
          let provider_1 = this.h[k].provider_1;
          let provider_2 = this.h[k].provider_2;
          let job = this.h[k].job;
          let address = this.h[k].address;
          let kelurahan = this.h[k].kelurahan;
          let kecamatan = this.h[k].kecamatan;
          let kabupaten = this.h[k].kabupaten;
          let provinsi = this.h[k].provinsi;
          let cms_users_npm = this.h[k].cms_users_npm;
          let cms_users_name = this.h[k].cms_users_name;
          let cms_privileges_name = this.h[k].cms_privileges_name;
          let mst_outlet_outlet_name = this.h[k].mst_outlet_outlet_name;
          let created_at_target_log = this.h[k].created_at_target_log;
          let duration = this.h[k].duration;
          let recall = this.h[k].recall;
          let description = this.h[k].description;
          let status = this.h[k].status;
          let revisit = this.h[k].revisit;
          let visit_status = this.h[k].visit_status;

          this.array_baru.push({
            created_at,
            updated_at,
            mst_branch_branch_name,
            mst_data_source_datasource,
            target_mst_status_status,
            business_code,
            category,
            priority,
            no_contract,
            nopol,
            first_name,
            last_name,
            provider_1,
            provider_2,
            job,
            address,
            kelurahan,
            kecamatan,
            kabupaten,
            provinsi,
            cms_users_npm,
            cms_users_name,
            cms_privileges_name,
            mst_outlet_outlet_name,
            created_at_target_log,
            duration,
            recall,
            description,
            status,
            revisit,
            visit_status
          });
          console.log(created_at);
        }

        this.isLoading = false;
        return this.array_baru;
        
      }
    },
     async fetchData2() {
        console.log("test")
       let year = String(this.tahunnya);
      let mounth = this.bulanny;
      let ayam = String(mounth).length;
      var tahunnya = this.tahunnya;
      let bulanny = this.bulanny;

      if (ayam == 1) {
        let a = this.bulanny;
        var ha = "0" + a;
        console.log("satu digit");
        console.log(ha);
      } else {
        let a = String(this.bulanny);
        var ha = a;
        console.log("lebih dari 1");
        console.log(ha);
      }
      let be = year + "-" + ha;
      console.log(be);
       $("#exampleModal").modal("hide");
      var id_mst_branch = sessionStorage.getItem("id_mst_branch");
      var id_privileges = sessionStorage.getItem("id_privileges");
      this.isLoading = true;
      this.hitung = "";

      if (id_privileges == 5) {
        if (this.down == 2) {
             const a = await this.$http.get(
              "frontend_target_total_followup",
              {
                params: {
                  updated_at: be,
                 id_mst_branch: this.default_branch
                }
              }
            );
            this.total = a.data.data;
        } else {
          const a = await this.$http.get(
              "frontend_target_total",
              {
                params: {
                  updated_at: be,
                 id_target_mst_status: this.down,
                id_mst_branch: this.default_branch
                }
              }
            );
            this.total = a.data.data;
        }

        for (let i = 0; i < this.Loops; i++) {
          console.log("get data 100");
          let a = 100;
          let n = [i];
          let b = 100;
          let hitung = a + (n - 1) * b;

          console.log(hitung, "    ", [i]);
          this.hitung = hitung;

          if (this.down == 2) {
            const users = await this.$http.get(
              "frontend_target_listing_followup",
              {
                params: {
                  updated_at: be,
                  id_mst_branch: this.default_branch,
                  limit: 100,
                  offset: hitung
                }
              }
            );
            this.g = users.data.data;
          } else {
            const users = await this.$http.get("frontend_target_listing", {
              params: {
                updated_at: be,
                id_target_mst_status: this.down,
                id_mst_branch: this.default_branch,
                limit: 100,
                offset: hitung
              }
            });
            this.g = users.data.data;
          }

          for (let j = 0; j < this.g.length; j++) {
            let created_at = this.g[j].created_at;
            let updated_at = this.g[j].updated_at;
            let mst_branch_branch_name = this.g[j].mst_branch_branch_name;
            let mst_data_source_datasource = this.g[j]
              .mst_data_source_datasource;
            let target_mst_status_status = this.g[j].target_mst_status_status;
            let business_code = this.g[j].business_code;
            let category = this.g[j].category;
            let priority = this.g[j].priority;
            let no_contract = this.g[j].no_contract;
            let nopol = this.g[j].nopol;
            let first_name = this.g[j].first_name;
            let last_name = this.g[j].last_name;
            let provider_1 = this.g[j].provider_1;
            let provider_2 = this.g[j].provider_2;
            let job = this.g[j].job;
            let address = this.g[j].address;
            let kelurahan = this.g[j].kelurahan;
            let kecamatan = this.g[j].kecamatan;
            let kabupaten = this.g[j].kabupaten;
            let provinsi = this.g[j].provinsi;
            let cms_users_npm = this.g[j].cms_users_npm;
            let cms_users_name = this.g[j].cms_users_name;
            let cms_privileges_name = this.g[j].cms_privileges_name;
            let mst_outlet_outlet_name = this.g[j].mst_outlet_outlet_name;
            let created_at_target_log = this.g[j].created_at_target_log;
            let duration = this.g[j].duration;
            let recall = this.g[j].recall;
            let description = this.g[j].description;
            let status = this.g[j].status;
            let revisit = this.g[j].revisit;
            let visit_status = this.g[j].visit_status;

            this.array_baru.push({
              created_at,
              updated_at,
              mst_branch_branch_name,
              mst_data_source_datasource,
              target_mst_status_status,
              business_code,
              category,
              priority,
              no_contract,
              nopol,
              first_name,
              last_name,
              provider_1,
              provider_2,
              job,
              address,
              kelurahan,
              kecamatan,
              kabupaten,
              provinsi,
              cms_users_npm,
              cms_users_name,
              cms_privileges_name,
              mst_outlet_outlet_name,
              created_at_target_log,
              duration,
              recall,
              description,
              status,
              revisit,
              visit_status
            });
          }
        }
        if (this.down == 2) {
          const users2 = await this.$http.get(
            "frontend_target_listing_followup",
            {
              params: {
                updated_at: be,
                id_mst_branch: this.default_branch,
                limit: 100,
                offset: this.Selisih
              }
            }
          );
          this.h = users2.data.data;
        } else {
          const users2 = await this.$http.get("frontend_target_listing", {
            params: {
              updated_at: be,
              id_target_mst_status: this.down,
              id_mst_branch: this.default_branch,
              limit: 100,
              offset: this.Selisih
            }
          });
          this.h = users2.data.data;
        }

        console.log(this.Modulus);
        for (let k = 0; k < this.Modulus; k++) {
          console.log([k]);
          let created_at = this.h[k].created_at;
          let updated_at = this.h[k].updated_at;
          let mst_branch_branch_name = this.h[k].mst_branch_branch_name;
          let mst_data_source_datasource = this.h[k].mst_data_source_datasource;
          let target_mst_status_status = this.h[k].target_mst_status_status;
          let business_code = this.h[k].business_code;
          let category = this.h[k].category;
          let priority = this.h[k].priority;
          let no_contract = this.h[k].no_contract;
          let nopol = this.h[k].nopol;
          let first_name = this.h[k].first_name;
          let last_name = this.h[k].last_name;
          let provider_1 = this.h[k].provider_1;
          let provider_2 = this.h[k].provider_2;
          let job = this.h[k].job;
          let address = this.h[k].address;
          let kelurahan = this.h[k].kelurahan;
          let kecamatan = this.h[k].kecamatan;
          let kabupaten = this.h[k].kabupaten;
          let provinsi = this.h[k].provinsi;
          let cms_users_npm = this.h[k].cms_users_npm;
          let cms_users_name = this.h[k].cms_users_name;
          let cms_privileges_name = this.h[k].cms_privileges_name;
          let mst_outlet_outlet_name = this.h[k].mst_outlet_outlet_name;
          let created_at_target_log = this.h[k].created_at_target_log;
          let duration = this.h[k].duration;
          let recall = this.h[k].recall;
          let description = this.h[k].description;
          let status = this.h[k].status;
          let revisit = this.h[k].revisit;
          let visit_status = this.h[k].visit_status;

          this.array_baru.push({
            created_at,
            updated_at,
            mst_branch_branch_name,
            mst_data_source_datasource,
            target_mst_status_status,
            business_code,
            category,
            priority,
            no_contract,
            nopol,
            first_name,
            last_name,
            provider_1,
            provider_2,
            job,
            address,
            kelurahan,
            kecamatan,
            kabupaten,
            provinsi,
            cms_users_npm,
            cms_users_name,
            cms_privileges_name,
            mst_outlet_outlet_name,
            created_at_target_log,
            duration,
            recall,
            description,
            status,
            revisit,
            visit_status
          });
          console.log(created_at);
        }

        this.isLoading = false;
        return this.array_baru;
        

      } else {
        if (this.down == 2) {
             const a = await this.$http.get(
              "frontend_target_total_followup",
              {
                params: {
                  updated_at: be,
                 id_mst_branch: id_mst_branch
                }
              }
            );
            this.total = a.data.data;
        } else {
          const a = await this.$http.get(
              "frontend_target_total",
              {
                params: {
                  updated_at: be,
                 id_target_mst_status: this.down,
                id_mst_branch: id_mst_branch
                }
              }
            );
            this.total = a.data.data;
        }

        for (let i = 0; i < this.Loops; i++) {
          console.log("get data 100");
          let a = 100;
          let n = [i];
          let b = 100;
          let hitung = a + (n - 1) * b;

          console.log(hitung, "    ", [i]);
          this.hitung = hitung;

          if (this.down == 2) {
            const users = await this.$http.get(
              "frontend_target_listing_followup",
              {
                params: {
                  updated_at: be,
                  id_mst_branch: id_mst_branch,
                  limit: 100,
                  offset: hitung
                }
              }
            );
            this.g = users.data.data;
          } else {
            const users = await this.$http.get("frontend_target_listing", {
              params: {
                updated_at: be,
                id_target_mst_status: this.down,
                id_mst_branch: id_mst_branch,
                limit: 100,
                offset: hitung
              }
            });
            this.g = users.data.data;
          }

          for (let j = 0; j < this.g.length; j++) {
            let created_at = this.g[j].created_at;
            let updated_at = this.g[j].updated_at;
            let mst_branch_branch_name = this.g[j].mst_branch_branch_name;
            let mst_data_source_datasource = this.g[j]
              .mst_data_source_datasource;
            let target_mst_status_status = this.g[j].target_mst_status_status;
            let business_code = this.g[j].business_code;
            let category = this.g[j].category;
            let priority = this.g[j].priority;
            let no_contract = this.g[j].no_contract;
            let nopol = this.g[j].nopol;
            let first_name = this.g[j].first_name;
            let last_name = this.g[j].last_name;
            let provider_1 = this.g[j].provider_1;
            let provider_2 = this.g[j].provider_2;
            let job = this.g[j].job;
            let address = this.g[j].address;
            let kelurahan = this.g[j].kelurahan;
            let kecamatan = this.g[j].kecamatan;
            let kabupaten = this.g[j].kabupaten;
            let provinsi = this.g[j].provinsi;
            let cms_users_npm = this.g[j].cms_users_npm;
            let cms_users_name = this.g[j].cms_users_name;
            let cms_privileges_name = this.g[j].cms_privileges_name;
            let mst_outlet_outlet_name = this.g[j].mst_outlet_outlet_name;
            let created_at_target_log = this.g[j].created_at_target_log;
            let duration = this.g[j].duration;
            let recall = this.g[j].recall;
            let description = this.g[j].description;
            let status = this.g[j].status;
            let revisit = this.g[j].revisit;
            let visit_status = this.g[j].visit_status;

            this.array_baru.push({
              created_at,
              updated_at,
              mst_branch_branch_name,
              mst_data_source_datasource,
              target_mst_status_status,
              business_code,
              category,
              priority,
              no_contract,
              nopol,
              first_name,
              last_name,
              provider_1,
              provider_2,
              job,
              address,
              kelurahan,
              kecamatan,
              kabupaten,
              provinsi,
              cms_users_npm,
              cms_users_name,
              cms_privileges_name,
              mst_outlet_outlet_name,
              created_at_target_log,
              duration,
              recall,
              description,
              status,
              revisit,
              visit_status
            });
          }
        }
        if (this.down == 2) {
          const users2 = await this.$http.get(
            "frontend_target_listing_followup",
            {
              params: {
                updated_at: be,
                id_mst_branch: id_mst_branch,
                limit: 100,
                offset: this.Selisih
              }
            }
          );
          this.h = users2.data.data;
        } else {
          const users2 = await this.$http.get("frontend_target_listing", {
            params: {
              updated_at: be,
              id_target_mst_status: this.down,
              id_mst_branch: id_mst_branch,
              limit: 100,
              offset: this.Selisih
            }
          });
          this.h = users2.data.data;
        }

        console.log(this.Modulus);
        for (let k = 0; k < this.Modulus; k++) {
          console.log([k]);
          let created_at = this.h[k].created_at;
          let updated_at = this.h[k].updated_at;
          let mst_branch_branch_name = this.h[k].mst_branch_branch_name;
          let mst_data_source_datasource = this.h[k].mst_data_source_datasource;
          let target_mst_status_status = this.h[k].target_mst_status_status;
          let business_code = this.h[k].business_code;
          let category = this.h[k].category;
          let priority = this.h[k].priority;
          let no_contract = this.h[k].no_contract;
          let nopol = this.h[k].nopol;
          let first_name = this.h[k].first_name;
          let last_name = this.h[k].last_name;
          let provider_1 = this.h[k].provider_1;
          let provider_2 = this.h[k].provider_2;
          let job = this.h[k].job;
          let address = this.h[k].address;
          let kelurahan = this.h[k].kelurahan;
          let kecamatan = this.h[k].kecamatan;
          let kabupaten = this.h[k].kabupaten;
          let provinsi = this.h[k].provinsi;
          let cms_users_npm = this.h[k].cms_users_npm;
          let cms_users_name = this.h[k].cms_users_name;
          let cms_privileges_name = this.h[k].cms_privileges_name;
          let mst_outlet_outlet_name = this.h[k].mst_outlet_outlet_name;
          let created_at_target_log = this.h[k].created_at_target_log;
          let duration = this.h[k].duration;
          let recall = this.h[k].recall;
          let description = this.h[k].description;
          let status = this.h[k].status;
          let revisit = this.h[k].revisit;
          let visit_status = this.h[k].visit_status;

          this.array_baru.push({
            created_at,
            updated_at,
            mst_branch_branch_name,
            mst_data_source_datasource,
            target_mst_status_status,
            business_code,
            category,
            priority,
            no_contract,
            nopol,
            first_name,
            last_name,
            provider_1,
            provider_2,
            job,
            address,
            kelurahan,
            kecamatan,
            kabupaten,
            provinsi,
            cms_users_npm,
            cms_users_name,
            cms_privileges_name,
            mst_outlet_outlet_name,
            created_at_target_log,
            duration,
            recall,
            description,
            status,
            revisit,
            visit_status
          });
          console.log(created_at);
        }

        this.isLoading = false;
        return this.array_baru;
        
      }
    },
    async cari() {
      this.isLoading = true;
      const data_target = await this.$http.get("frontend_target_data", {
        params: {
          id_mst_branch: this.default_branch
        }
      });
      this.target_data = data_target.data.data;

      const target_belum_follow = await this.$http.get(
        "frontend_target_belum_follow",
        {
          params: {
            id_mst_branch: this.default_branch,
            id_target_mst_status: 1
          }
        }
      );
      this.target_belum_follow = target_belum_follow.data.data;

      const target_sudah_follow = await this.$http.get(
        "frontend_target_sudah_follow",
        {
          params: {
            id_mst_branch: this.default_branch
          }
        }
      );
      this.target_sudah_follow = target_sudah_follow.data.data;

      const users_target = await this.$http.get("frontend_users_listing", {
        params: {
          branch: this.default_branch
        }
      });
      this.users_target = users_target.data.data;


      this.isLoading = false;

      for (let i = 0; i < this.users_target.length; i++) {
        console.log(i);
        let id = this.users_target[i].id;
        let name = this.users_target[i].name;
        let id_mst_outlet = this.users_target[i].id_mst_outlet;
        let mst_outlet_outlet_name = this.users_target[i]
          .mst_outlet_outlet_name;
        let cms_privileges_name = this.users_target[i].cms_privileges_name;
        let follow = [];
        let notfollow = [];
        let users_data = [];

        const a = await this.$http.get("frontend_target_belum_follow", {
          params: {
            id_mst_branch: this.default_branch,
            id_target_mst_status: 1,
            id_cms_users: id
          }
        });
        notfollow = a.data.data.length;

        const b = await this.$http.get("frontend_target_sudah_follow", {
          params: {
            id_mst_branch: this.default_branch,
            id_cms_users: id
          }
        });
        follow = b.data.data.length;

        const c = await this.$http.get("frontend_target_total_data_users", {
          params: {
            id_mst_branch: this.default_branch,
            id_cms_users: id
          }
        });
        users_data = c.data.data.length;

        this.array_users.push({
          id,
          name,
          follow,
          notfollow,
          users_data,
          id_mst_outlet,
          mst_outlet_outlet_name,
          cms_privileges_name
        });
      }
    }
  },
  computed: {
    Modulus() {
      let a = this.total.length;
      let b = a % 100;
      this.mod = b;
      return b;
    },
    Selisih() {
      let a = this.total.length - this.Modulus;
      return a;
    },
    Loops() {
      let a = this.Selisih / 100;
      return a;
    },
    sortBranch: function() {
      return this.branch.sort((a, b) => {
        if (a[this.currentSortBranch] < b[this.currentSortBranch])
          return 1 * -1;
        return 0;
      });
    },
    com_data_target() {
      return this.target_data.length;
    },
    com_target_belum_follow() {
      return this.target_belum_follow.length;
    },
    com_target_sudah_follow() {
      return this.target_sudah_follow.length;
    },
    com_users_target() {
      return this.users_target.length;
    },
    com_telemarketing_detail() {
      return this.report_telemarketing_detail;
    },
    getValue() {
      // udah ye
      if (this.outlet_yg_dipilih !== "") {
        console.log(`Coba ${this.outlet_yg_dipilih}`);
        let x = this.outlet_yg_dipilih;
        return this.array_users.filter(function(list) {
          return list.id_mst_outlet == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.array_users;
      }
    },
    uniqueOutlet: function() {
      var existingIds = {};
      return this.array_users.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    }
  }
};
</script>
<style>
</style>
