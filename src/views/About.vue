<template>
  <div class="home">
    <loading
      :active.sync="isLoading"
      :color="color"
      :loader="loader"
      :height="height"
      :width="width"
      :is-full-page="fullPage"
    ></loading>

    <h4>
      <b>REPORT TELEMARKETING</b>
    </h4>

    <br>

    <form class="form-inline" role="form">
      <!-- <select
        v-model="pageSize"
        class="form-control form-control-sm border-secondary"
        style="width:90px"
      >
        <option v-for="d in dataper" v-bind:value="d.data">{{ d.data }}</option>
      </select>-->
      <div class="form-group">
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="search"
          placeholder="Search"
        >
        <a
          class="btn btn btn-outline-primary btn-sm text-dark"
          data-toggle="modal"
          title="Silahkan Pilih Periode"
          data-target="#myModal"
        >Filter</a>
      </div>
    </form>

    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Pilih Periode</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
              <div class="form-group row">
                <label
                  for="npm"
                  style="font-size:12px"
                  class="text text-left col-sm-3 col-form-label"
                >
                  <b>Tahun</b>
                </label>
                <div class="col-sm-9">
                  <select v-model="tahunnya" class="form-control form-control-sm">
                    <option v-for="d in tahun" v-bind:value="d.data">{{ d.data }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="npm"
                  style="font-size:12px"
                  class="text text-left col-sm-3 col-form-label"
                >
                  <b>Bulan</b>
                </label>
                <div class="col-sm-9">
                  <select v-model="bulanny" class="form-control form-control-sm">
                    <option v-for="d in bulan" v-bind:value="d.data">{{ d.nama }}</option>
                  </select>
                </div>
              </div>
              <div v-show="cabang" class="form-group row">
                <label
                  for="npm"
                  style="font-size:12px"
                  class="text text-left col-sm-3 col-form-label"
                >
                  <b>Outlet</b>
                </label>
                <div class="col-sm-9">
                  <select v-model="outlet_yg_dipilih" class="form-control form-control-sm">
                    <option disabled value>Pilih Outlet</option>
                    <option
                      v-for="outlet in uniqueOutlet"
                      v-bind:value="outlet.id_mst_outlet"
                    >{{ outlet.outlet }}</option>
                  </select>
                </div>
              </div>

              <div v-show="ho">
                <div class="form-group row">
                  <label
                    for="npm"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>Cabang</b>
                  </label>
                  <div class="col-sm-9">
                    <select v-model="default_branch" class="form-control form-control-sm">
                      <option disabled value>Pilih Branch</option>
                      <option
                        v-for="branch in sortBranch"
                        v-bind:value="branch.id"
                      >{{ branch.branch_name }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row" v-show="pilih_outlet">
                  <label
                    for="npm"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>Outlet</b>
                  </label>
                  <div class="col-sm-9">
                    <select v-model="outlet_yg_dipilih" class="form-control form-control-sm">
                      <option disabled value>Pilih Outlet</option>
                      <option
                        v-for="outlet in getOutlet"
                        v-bind:value="outlet.id"
                      >{{ outlet.outlet_name }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              type="button"
              v-on:click="coba"
              class="btn btn-outline-success btn-sm"
              data-dismiss="modal"
            >Cari</button>
            <downloadexcel
              v-show="download"
              class="btn btn-outline-dark btn-sm"
              :fetch="fetchData"
              :fields="json_fields"
              type="csv"
              title="Telemarketing Log"
              name="Report TELEMARKETING.xls"
            >Download Log</downloadexcel>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive table-hover table-sm">
      <table class="table">
        <thead>
          <tr class="table shadow" style="font-size:12px">
            <th scope="col">#</th>
            <th class="text-left" scope="col" @click="sort('name')">NAME</th>
            <th class="text-center" scope="col" @click="sort('Berminat')">BERMINAT</th>
            <th class="text-center" scope="col" @click="sort('ButuhWaktu')">BUTUH WAKTU</th>
            <th class="text-center" scope="col" @click="sort('TanyaPasangan')">TANYA PASANGAN</th>
            <th class="text-center" scope="col" @click="sort('PikirPikir')">PIKIR-PIKIR</th>
            <th class="text-center" scope="col" @click="sort('TidakBerminat')">TIDAK BERMINAT</th>
            <th class="text-center" scope="col" @click="sort('Cancel')">CANCEL</th>
            <th class="text-center" scope="col" @click="sort('TidakDiangkat')">TIDAK DIANGKAT</th>
            <th class="text-center" scope="col" @click="sort('SalahSambung')">SALAH SAMBUNG</th>
            <th class="text-center" scope="col" @click="sort('Reject')">REJECT</th>

            <th class="text-center" scope="col" @click="sort('TidakAktif')">TIDAK AKTIF</th>
            <th class="text-center" scope="col" @click="sort('TidakTerdaftar')">TIDAK TERDAFTAR</th>

            <th class="text-center" scope="col" @click="sort('Total')">TOTAL</th>
          </tr>
        </thead>

        <tbody>
          <tr
            class="table shadow"
            style="font-size:12px"
            v-for="(r, index) in (sortedActivity, filteredList)"
            :key="index"
          >
            <td>{{index + 1}}</td>
            <td class="text-left">{{ r.name}}</td>
            <td class="text-center">{{ r.Berminat }}</td>
            <td class="text-center">{{ r.ButuhWaktu }}</td>
            <td class="text-center">{{ r.TanyaPasangan }}</td>
            <td class="text-center">{{ r.PikirPikir }}</td>
            <td class="text-center">{{ r.TidakBerminat }}</td>
            <td class="text-center">{{ r.Cancel }}</td>
            <td class="text-center">{{ r.TidakDiangkat }}</td>
            <td class="text-center">{{ r.SalahSambung }}</td>
            <td class="text-center">{{ r.Reject }}</td>
            <td class="text-center">{{ r.TidakAktif }}</td>
            <td class="text-center">{{ r.TidakTerdaftar }}</td>
            <td class="text-center">{{ r.Total}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card text-center" v-if="arrayTele == 0">
      <div class="card-body">
        <img alt="Vue logo" src="../assets/pilihfilter.png" style="max-height:300px">
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import downloadexcel from "vue-json-excel";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import Vue from "vue";
export default {
  name: "home",
  components: {
    downloadexcel,
    Loading
  },
  data() {
    return {
      perPage: 150,
      dataper: [{ data: 25 }, { data: 50 }, { data: 100 }, { data: 150 }],
      users: [],
      currentSort: "name",
      currentSortDir: "asc",
      branch: [],
      mst_outlet: [],
      search: "",
      searchSelection: "",
      pageSize: 1000,
      currentPage: 1,
      ho: false,
      cabang: false,
      currentSortBranch: "branch_name",
      default_branch: "",
      pilih_outlet: false,
      arraybaru: [],
      outlet_yg_dipilih: "",

      download: true,

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
      reportTele: [],
      teleusers: "",
      arrayTele: [],
      id_mst_branch: "",

      json_fields: {
        id_target: "id_target",
        created_at: "created_at",
        business_code: "target_business_code",
        category: "target_category",
        priority: "target_priority",
        no_contract: "target_no_contract",
        nopol: "target_nopol",
        first_name: "target_first_name",
        last_name: "target_last_name",
        provider_1: "target_provider_1",
        provider_2: "target_provider_2",
        job: "target_job",
        address: "target_address",
        duration: "duration",
        description: "mst_log_desc_description",
        status: "status",
        recall: "recall",
        users_name: "cms_users_name",
        privileges: "cms_privileges_name",
        outlet: "mst_outlet_outlet_name",
        branch: "mst_branch_branch_name"
      },

      isLoading: false,
      color: "#007bff",
      height: 128,
      width: 128,
      loader: "dots",
      fullPage: true
    };
  },
  methods: {
    sort: function(s) {
      if (s === this.currentSort) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      }
      this.currentSort = s;
    },
    nextPage: function() {
      if (this.currentPage * this.pageSize < this.status_array_baru.length)
        this.currentPage++;
    },
    prevPage: function() {
      if (this.currentPage > 1) this.currentPage--;
    },
    showDate(date) {
      this.date = date;
    },
    async fetchData() {
      $("#myModal").modal("hide");
      this.isLoading = true;
      let id_mst_branch = sessionStorage.getItem("id_mst_branch");
      let id_privileges = sessionStorage.getItem("id_privileges");
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
      if (id_privileges == 5) {
        const target_log = await this.$http.get(
          "frontend_target_download_log",
          {
            params: {
              created_at: be,
              branch: this.default_branch
            }
          }
        );
        this.target_log = target_log.data.data;
      } else {
        const target_log = await this.$http.get(
          "frontend_target_download_log",
          {
            params: {
              created_at: be,
              branch: id_mst_branch
            }
          }
        );
        this.target_log = target_log.data.data;
      }

      if (this.target_log.length == 0) {
        this.isLoading = false;
      }

      this.isLoading = false;
      return this.target_log;
    },

    async coba() {
      $("#myModal").modal("hide");
      this.arrayTele = [];
      this.reportTele = [];

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
      this.isLoading = true;

      if (this.id_privileges == 5) {
        const getusers = await this.$http.get("frontend_users_listing", {
          params: {
            branch: this.default_branch,
            id_cms_privileges: 6
          }
        });
        let users = getusers.data.data;

        const gettele = await this.$http.get("frontend_report_telemarketing", {
          params: {
            branch: this.default_branch,
            created_at: be
          }
        });
        this.reportTele = gettele.data.data;

        for (let i = 0; i < users.length; i++) {
          let id = users[i].id;
          let name = users[i].name;
          let privilages = users[i].cms_privileges_name;
          let id_mst_outlet = users[i].id_mst_outlet;
          let outlet = users[i].mst_outlet_outlet_name;
          this.teleusers = id;
          let Berminat = this.Berminat.length;
          let SalahSambung = this.SalahSambung.length;
          let TidakBerminat = this.TidakBerminat.length;
          let PikirPikir = this.PikirPikir.length;
          let TanyaPasangan = this.TanyaPasangan.length;
          let ButuhWaktu = this.ButuhWaktu.length;
          let Reject = this.Reject.length;
          let TidakDiangkat = this.TidakDiangkat.length;
          let TidakTerdaftar = this.TidakTerdaftar.length;
          let TidakAktif = this.TidakAktif.length;
          let Cancel = this.Cancel.length;
          let Total = this.Total.length;

          this.arrayTele.push({
            id,
            name,
            privilages,
            id_mst_outlet,
            outlet,
            Berminat,
            TidakBerminat,
            PikirPikir,
            TanyaPasangan,
            ButuhWaktu,
            Reject,
            TidakDiangkat,
            TidakTerdaftar,
            TidakAktif,
            Cancel,
            SalahSambung,
            Total
          });
        }
        this.isLoading = false;
      } else {
        const getusers = await this.$http.get("frontend_users_listing", {
          params: {
            branch: this.id_mst_branch,
            id_cms_privileges: 6
          }
        });
        let users = getusers.data.data;

        const gettele = await this.$http.get("frontend_report_telemarketing", {
          params: {
            branch: this.id_mst_branch,
            created_at: be
          }
        });
        this.reportTele = gettele.data.data;

        for (let i = 0; i < users.length; i++) {
          let id = users[i].id;
          let name = users[i].name;
          let privilages = users[i].cms_privileges_name;
          let id_mst_outlet = users[i].id_mst_outlet;
          let outlet = users[i].mst_outlet_outlet_name;
          this.teleusers = id;
          let Berminat = this.Berminat.length;
          let SalahSambung = this.SalahSambung.length;
          let TidakBerminat = this.TidakBerminat.length;
          let PikirPikir = this.PikirPikir.length;
          let TanyaPasangan = this.TanyaPasangan.length;
          let ButuhWaktu = this.ButuhWaktu.length;
          let Reject = this.Reject.length;
          let TidakDiangkat = this.TidakDiangkat.length;
          let TidakTerdaftar = this.TidakTerdaftar.length;
          let TidakAktif = this.TidakAktif.length;
          let Cancel = this.Cancel.length;
          let Total = this.Total.length;

          this.arrayTele.push({
            id,
            name,
            privilages,
            id_mst_outlet,
            outlet,
            Berminat,
            TidakBerminat,
            PikirPikir,
            TanyaPasangan,
            ButuhWaktu,
            Reject,
            TidakDiangkat,
            TidakTerdaftar,
            TidakAktif,
            Cancel,
            SalahSambung,
            Total
          });
        }
        this.isLoading = false;
      }
    }
  },
  async mounted() {
    var privilages = sessionStorage.getItem("name_privileges");
    this.id_privileges = sessionStorage.getItem("id_privileges");
    var login = sessionStorage.getItem("login");
    this.id_mst_branch = sessionStorage.getItem("id_mst_branch");

    var index = window.location.pathname;
    var url =
      index == "/" ||
      index == "/devreport" ||
      index == "/setting" ||
      index == "/report_kpi" ||
      index == "/report_outlet" ||
      index == "/report_tele";
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

    if (this.id_privileges == 7) {
      this.download = false;
    }

    var d = new Date();
    let y = d.getFullYear();
    var d = d.getMonth();
    var d = d + 1;
    this.tahunnya = y;
    this.bulanny = d;

    if (this.id_privileges == 5) {
      this.ho = true;
      this.$http
        .get("frontend_branch_name")
        .then(response => (this.branch = response.data.data));

      this.$http
        .get("frontend_mst_outlet")
        .then(response => (this.mst_outlet = response.data.data));
    } else {
      this.cabang = true;
      const getusers = await this.$http.get("frontend_users_listing", {
        params: {
          branch: this.id_mst_branch,
          id_cms_privileges: 6
        }
      });
      let users = getusers.data.data;

      const gettele = await this.$http.get("frontend_report_telemarketing", {
        params: {
          branch: this.id_mst_branch,
          created_at: this.be
        }
      });
      this.reportTele = gettele.data.data;

      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privilages = users[i].cms_privileges_name;
        let id_mst_outlet = users[i].id_mst_outlet;
        let outlet = users[i].mst_outlet_outlet_name;
        this.teleusers = id;
        let Berminat = this.Berminat.length;
        let SalahSambung = this.SalahSambung.length;
        let TidakBerminat = this.TidakBerminat.length;
        let PikirPikir = this.PikirPikir.length;
        let TanyaPasangan = this.TanyaPasangan.length;
        let ButuhWaktu = this.ButuhWaktu.length;
        let Reject = this.Reject.length;
        let TidakDiangkat = this.TidakDiangkat.length;
        let TidakTerdaftar = this.TidakTerdaftar.length;
        let TidakAktif = this.TidakAktif.length;
        let Cancel = this.Cancel.length;
        let Total = this.Total.length;

        this.arrayTele.push({
          id,
          name,
          privilages,
          id_mst_outlet,
          outlet,
          Berminat,
          TidakBerminat,
          PikirPikir,
          TanyaPasangan,
          ButuhWaktu,
          Reject,
          TidakDiangkat,
          TidakTerdaftar,
          TidakAktif,
          Cancel,
          SalahSambung,
          Total
        });
      }
    }
  },
  computed: {
    Total() {
      return this.reportTele.filter(data => {
        return data.id_cms_users == this.teleusers;
      });
    },
    Berminat() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 1 && data.id_cms_users == this.teleusers
        );
      });
    },
    TidakBerminat() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 2 && data.id_cms_users == this.teleusers
        );
      });
    },
    PikirPikir() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 3 && data.id_cms_users == this.teleusers
        );
      });
    },
    TanyaPasangan() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 4 && data.id_cms_users == this.teleusers
        );
      });
    },
    ButuhWaktu() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 5 && data.id_cms_users == this.teleusers
        );
      });
    },
    Reject() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 6 && data.id_cms_users == this.teleusers
        );
      });
    },
    TidakDiangkat() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 7 && data.id_cms_users == this.teleusers
        );
      });
    },
    TidakTerdaftar() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 8 && data.id_cms_users == this.teleusers
        );
      });
    },
    TidakAktif() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 9 && data.id_cms_users == this.teleusers
        );
      });
    },
    Cancel() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 10 && data.id_cms_users == this.teleusers
        );
      });
    },
    SalahSambung() {
      return this.reportTele.filter(data => {
        return (
          data.id_mst_log_status == 11 && data.id_cms_users == this.teleusers
        );
      });
    },
    filteredList() {
      return this.getValue
        .filter(tl => {
          return (
            (tl.name || "").toLowerCase().includes(this.search.toLowerCase()) ||
            (tl.outlet || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            tl.Berminat == this.search ||
            tl.TidakBerminat == this.search ||
            tl.PikirPikir == this.search ||
            tl.TanyaPasangan == this.search ||
            tl.ButuhWaktu == this.search ||
            tl.Reject == this.search ||
            tl.TidakDiangkat == this.search ||
            tl.TidakTerdaftar == this.search ||
            tl.TidakAktif == this.search ||
            tl.Cancel == this.search ||
            tl.SalahSambung == this.search ||
            tl.Total == this.search
          );
        })
        .filter((row, index) => {
          let start = (this.currentPage - 1) * this.pageSize;
          let end = this.currentPage * this.pageSize;
          if (index >= start && index < end) return true;
        });
    },

    sortedActivity: function() {
      return this.getValue
        .sort((a, b) => {
          let modifier = 1;
          if (this.currentSortDir === "desc") modifier = -1;
          if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
          if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
          return 0;
        })
        .filter((row, index) => {
          let start = (this.currentPage - 1) * this.pageSize;
          let end = this.currentPage * this.pageSize;
          if (index >= start && index < end) return true;
        });
    },

    getValue() {
      // udah ye
      if (this.outlet_yg_dipilih !== "") {
        console.log(`Coba ${this.outlet_yg_dipilih}`);
        let x = this.outlet_yg_dipilih;
        return this.arrayTele.filter(function(list) {
          return list.id_mst_outlet == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.arrayTele;
      }
    },
    getOutlet() {
      // udah ye
      if (this.default_branch !== "") {
        this.pilih_outlet = true;
        let x = this.default_branch;
        return this.mst_outlet.filter(function(list) {
          return list.id_mst_branch == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.mst_outlet;
      }
    },

    uniqueOutlet: function() {
      var existingIds = {};
      return this.arrayTele.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    },
    sortBranch: function() {
      function compare(a, b) {
        if (a.branch_name < b.branch_name) return -1;
        if (a.branch_name > b.branch_name) return 1;
        return 0;
      }

      return this.branch.sort(compare);
    },
    be() {
      let d = new Date();
      let year = d.getFullYear();
      let month = d.getMonth() + 1;

      year = String(year);
      let ayam = String(month).length;
      if (ayam == 1) {
        let a = month;
        var ha = "0" + a;
        console.log("satu digit");
        console.log(ha);
      } else {
        let a = String(month);
        var ha = a;
        console.log("lebih dari 1");
        console.log(ha);
      }
      let be = year + "-" + ha;
      return be;
    }
  }
};
</script>
