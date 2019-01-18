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
      <b>REPORT KPI</b>
      {{ test }}
    </h4>
    <a href="#" data-toggle="tooltip" data-placement="top" title="Download Excel">
      <downloadexcel
     
        class="btn"
        :fetch="fetchData"
        :fields="json_fields"
        type="csv"
        title="Report KPI"
        name="Report KPI.xls"
      >Download Excel</downloadexcel>
    </a>


    

    <form v-show="cabang" class="form-inline" role="form">
      <div class="form-group">
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="search"
          placeholder="Search"
        >
      </div>

      <select v-model="outlet_yg_dipilih" class="form-control form-control-sm">
        <option disabled value>Pilih Outlet</option>
        <option
          v-for="outlet in uniqueOutlet"
          v-bind:value="outlet.id_mst_outlet"
        >{{ outlet.mst_outlet_outlet_name }}</option>
      </select>
      
      <button
        type="button"
        class="btn btn-outline-primary btn-sm"
        data-toggle="modal"
        data-target="#myModal"
      >Bulan</button>
    </form>
    <form v-show="ho" class="form-inline" role="form">
      <div class="form-group">
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="search"
          placeholder="Search"
        >
      </div>

      <select v-model="default_branch" class="form-control form-control-sm">
        <option disabled value>Pilih Branch</option>
        <option v-for="branch in sortBranch" v-bind:value="branch.id">{{ branch.branch_name }}</option>
      </select>
      
      <select
        v-show="pilih_outlet"
        v-model="outlet_yg_dipilih"
        class="form-control form-control-sm"
      >
        <option disabled value>Pilih Outlet</option>
        <option v-for="outlet in getOutlet" v-bind:value="outlet.id">{{ outlet.outlet_name }}</option>
      </select>
      
      <button
        type="button"
        class="btn btn-outline-primary btn-sm"
        data-toggle="modal"
        data-target="#myModal"
      >Filter</button>
    </form>

    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Pilih Bulan</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="center" align="center">
              <form class="form-inline" role="form">
                <select v-model="tahunnya" class="form-control">
                  <option v-for="d in tahun" v-bind:value="d.data">{{ d.data }}</option>
                </select>
              </form>
              <br>
              <form class="form-inline form-group" role="form">
                <select v-model="bulanny" class="form-control col-md-4">
                  <option v-for="d in bulan" v-bind:value="d.data">{{ d.nama }}</option>
                </select>
              </form>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" v-on:click="coba" class="btn btn-info btn-sm" data-dismiss="modal">Cari</button>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive table-hover" style="overflow: auto;
white-space: nowrap;">
      <table class="table table-sm">
        <thead width="400px">
          <tr style="font-size:12px">
            <th scope="col">#</th>
            <th scope="col" @click="sort('npm')">NPM</th>
            <th scope="col" @click="sort('name')">NAME</th>
            <th scope="col" @click="sort('cms_privileges_name')">PRIVILAGES</th>
            <th scope="col" @click="sort('brosur_count')">BROCHURE</th>
            <th scope="col" @click="sort('leads_count')">LEADS</th>
            <th scope="col" @click="sort('order_count')">ORDER</th>
            <th scope="col" @click="sort('target_calls_count')">TARGET CALLS</th>
            <th scope="col" @click="sort('booking_count')">BOOKING</th>
          </tr>
        </thead>
        <tbody class="shadow">
          <tr
            style="font-size:12px"
            v-for="(user, index) in (sortedActivity, filteredList)"
            :key="index"
          >
            <td>{{index + 1}}</td>
            <td>{{user.npm}}</td>
            <td>{{user.name}}</td>
            <td>{{user.cms_privileges_name}}</td>
            <td>{{user.brosur_count}}</td>
            <td>{{user.leads_count}}</td>
            <td>{{user.order_count}}</td>
            <td>{{user.target_calls_count}}</td>
            <td>{{user.booking_count}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card text-center" v-if="arraybaru == 0">
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
      currentSortBranch: "branch_name",
      currentSortDir: "asc",
      search: "",
      searchSelection: "",
      pageSize: 1000,
      currentPage: 1,
      branch: [],
      default_branch: "",
      pilih_outlet: false,
      ho: false,
      cabang: false,
      isLoading: false,
      color: "#007bff",
      height: 128,
      width: 128,
      loader: "dots",
      fullPage: true,
      arraybaru: [],
      users: [],
      report_deals: [],
      target_calls: [],
      order: [],
      mst_outlet: [],
      booking: [],
      brosure: [],
      brosure_baru: [],
      user_listing: "",
      outlet_yg_dipilih: "",
      kosong: [],
      haha: [],
      tahun: [{ data: 2018 }, { data: 2019 }],
      tahunnya: '',
      downlaod: true,
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
      test: null,
      json_fields: {
        Tahun: "tahunnya",
        Bulan: "bulanny",
        Name: "name",
        Privilages: "cms_privileges_name",
        "Outlet Name": "mst_outlet_outlet_name",
        Brosure: "brosur_count",
        Leads: "leads_count",
        Order: "order_count",
        "Target Calls": "target_calls_count",
        Booking: "booking_count"
      }
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
      if (this.currentPage * this.pageSize < this.arraybaru.length)
        this.currentPage++;
    },
    prevPage: function() {
      if (this.currentPage > 1) this.currentPage--;
    },
    showDate(date) {
      this.date = date;
    },
    async fetchData() {
      this.isLoading = true;

      const response = await this.arraybaru;
      console.log(response);
      this.isLoading = false;
      return response;
    },
    coba: async function() {
      this.isLoading = true;

      this.arraybaru = [];

      let year = String(this.tahunnya);
      let mounth = this.bulanny;
      let ayam = String(mounth).length;

      // console.log(panjang)
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

      const users = await this.$http.get("user_listing", {
        params: {
          branch: this.default_branch
        }
      });
      this.users = users.data.data;

      if (this.users.length == 0) {
        this.isLoading = false;
      }
      const target_calls = await this.$http.get("frontend_target_calls", {
        params: {
          created_at: be
        }
      });

      const orders = await this.$http.get("frontend_count_order", {
        params: {
          created_at: be
        }
      });

      const leadss = await this.$http.get("frontend_lead_kpi", {
        params: {
          created_at: be
        }
      });

      const bookings = await this.$http.get("frontend_booking", {
        params: {
          created_at: be
        }
      });

      this.$http
        .get("frontend_brosur", {
          params: {
            created_at: be
          }
        })
        .then(response => (this.brosure = response.data.data))
        .then(response => {
          for (let index = 0; index < this.brosure.length; index++) {
            this.brosure[index].brosur = parseInt(this.brosure[index].brosur);
          }
        });

      this.target_calls = target_calls.data.data;
      this.order = orders.data.data;
      this.report_deals = leadss.data.data;
      //this.brosur = brosur.data.data;
      this.booking = bookings.data.data;

      if (this.getValue.length == 0) {
        this.isLoading = false
      }

      for (var i = 0; i < this.getValue.length; i++) {
        var id = this.getValue[i].id;
        var id_mst_outlet = this.getValue[i].id_mst_outlet;
        var mst_outlet_outlet_name = this.getValue[i].mst_outlet_outlet_name;
        var name = this.getValue[i].name;
        var npm = this.getValue[i].npm;
        let cms_privileges_name = this.getValue[i].cms_privileges_name;
        var lead = this.report_deals;
        var order = this.order;
        var brosur = this.brosure;
        let brosurrr = this.brosure_baru;
        var target_call = this.target_calls;
        var booking = this.booking;
        var tahunnya = this.tahunnya;
        let bulanny = this.bulanny;

        let ayam = lead.filter(tl => {
          return tl.id_cms_users === id;
        });

        let bebek = order.filter(tl => {
          return tl.id_cms_users === id;
        });

        let kucing = brosur.filter(tl => {
          return tl.id_cms_users === id;
        });

        let biawak = brosurrr.filter(tl => {
          return tl.a_id_cms_users === id;
        });

        let uler = target_call.filter(tl => {
          return tl.id_cms_users === id;
        });

        let kutilang = booking.filter(tl => {
          return tl.id_cms_users === id;
        });

        // var msgTotal = kucing.reduce(function(prev, cur) {
        //   return prev + cur.brosur;
        // }, 0);

        var brosurTotal = biawak.reduce(function(prev, cur) {
          return prev + cur.a_brosur;
        }, 0);
        // this.kosong.push(biawak)
        // this.haha.push(msgTotal)

        // get sum of msgCount prop across all objects in array

        let leads_count = ayam.length;
        let order_count = bebek.length;
        // let brosur_count = msgTotal
        let brosur_count = brosurTotal;
        let target_calls_count = uler.length;
        let booking_count = kutilang.length;
        // console.log(id,id_mst_outlet,name,leads_count,order_count,brosur_count,target_calls_count,booking_count)
        this.arraybaru.push({
          tahunnya,
          bulanny,
          id,
          npm,
          cms_privileges_name,
          id_mst_outlet,
          mst_outlet_outlet_name,
          name,
          leads_count,
          order_count,
          brosur_count,
          target_calls_count,
          booking_count
        });

        this.isLoading = false;
      }
    }
  },
  mounted() {
    var privilages = sessionStorage.getItem("name_privileges");
    var id_privileges = sessionStorage.getItem("id_privileges");
    var login = sessionStorage.getItem("login");
    var filter_branch = sessionStorage.getItem("id_mst_branch");

    var index = window.location.pathname;
    var url =
      index == "/" ||
      index == "/devreport" ||
      index == "/setting" ||
      index == "/report_kpi" ||
      index == "/report_outlet" ||
      index == "/leads";
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

    if (filter_branch == "null") {
      var filter_branch_ho = " ";
    } else {
      var filter_branch_ho = filter_branch;
    }
    if (id_privileges == 7) {
      this.downlaod = false
    }

    var d = new Date();
    let y = d.getFullYear();
    var d = d.getMonth();
    var d = d + 1;
    this.bulanny = d;
    this.tahunnya = y

    if (id_privileges == 5) {
      this.ho = true;
      this.$http
        .get("frontend_branch_name")
        .then(response => (this.branch = response.data.data));

      this.$http
        .get("frontend_mst_outlet")
        .then(response => (this.mst_outlet = response.data.data));

     
    } else {
      this.cabang = true;
      this.$http
        .get("user_listing", {
          params: {
            branch: filter_branch_ho
          }
        })
        .then(response => (this.users = response.data.data));
    }

    this.$http
      .get("frontend_brosur", {
        params: {
          created_at: this.search
        }
      })
      .then(response => (this.brosure = response.data.data))
      .then(response => {
        for (let index = 0; index < this.brosure.length; index++) {
          let a_id = this.brosure[index].id;
          let a_id_cms_users = this.brosure[index].id_cms_users;
          let a_cms_users_npm = this.brosure[index].cms_users_npm;
          let a_cms_users_name = this.brosure[index].cms_users_name;
          let a_created_at = this.brosure[index].created_at;
          let a_brosur = this.brosure[index].brosur;

          if (a_brosur == null) {
            a_brosur = 0;
          } else {
            a_brosur = parseInt(a_brosur);
          }
          // console.log(this.brosure[index].brosur)
          // a_brosur = parseInt(this.brosure[index].brosur)

          this.brosure_baru.push({
            a_id,
            a_id_cms_users,
            a_cms_users_npm,
            a_cms_users_name,
            a_created_at,
            a_brosur
          });
        }
      });
  },
  computed: {
    filteredList() {
      return this.arraybaru
        .filter(tl => {
          return (
            (tl.npm || "").toLowerCase().includes(this.search.toLowerCase()) ||
            (tl.name || "").toLowerCase().includes(this.search.toLowerCase()) ||
            (tl.cms_privileges_name || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            tl.brosur_count == this.search.toLowerCase() ||
            tl.leads_count === this.search ||
            tl.order_count === this.search ||
            tl.target_calls_count === this.search ||
            tl.booking_count === this.search
          );
        })
        .filter((row, index) => {
          let start = (this.currentPage - 1) * this.pageSize;
          let end = this.currentPage * this.pageSize;
          if (index >= start && index < end) return true;
        });
    },

    sortedActivity: function() {
      return this.arraybaru
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

    panjang_users() {
      return this.user_listing.length;
    },
    getValue() {
      // udah ye
      if (this.outlet_yg_dipilih !== "") {
        console.log(`Coba ${this.outlet_yg_dipilih}`);
        let x = this.outlet_yg_dipilih;
        return this.users.filter(function(list) {
          return list.id_mst_outlet == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.users;
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
      return this.users.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    },
    sortBranch: function() {
      return this.branch.sort((a, b) => {
        if (a[this.currentSortBranch] < b[this.currentSortBranch])
          return 1 * -1;
        return 0;
      });
    }
  }
};
</script>
