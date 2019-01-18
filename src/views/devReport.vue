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
    <div class="table-responsive">
      <table class="table shadow">
        <tbody>
          <tr>
            <th>
              <div class="media">
                <i class="fas fa-database fa-3x"></i>
                <div class="media-body">
                  <h4>{{leadTotalCabang}}</h4>
                  <p style="font-size:12px">Lead</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-file fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpileadNew}}</h4>
                  <p style="font-size:12px">New</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fab fa-hotjar fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpileadHot}}</h4>
                  <p style="font-size:12px">Hot</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-briefcase fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpileadWorking}}</h4>
                  <p style="font-size:12px">Working</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
               <i class="far fa-times-circle fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpileadUnqualified}}</h4>
                  <p style="font-size:12px">Unqualified</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-sync fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpileadConverted}}</h4>
                  <p style="font-size:12px">Converted</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-trash fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpileadDelete}}</h4>
                  <p style="font-size:12px">Delete</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-users fa-3x"></i>
                <div class="media-body">
                  <h4>{{userslisting}}</h4>
                  <p style="font-size:12px">Users</p>
                </div>
              </div>
            </th>
          </tr>
        </tbody>
      </table>
    </div>


<div class="modal fade" id="periode">
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
             

              
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <downloadexcel
       class="btn btn-outline-dark btn-sm"
      :fetch="fetchData"
      :fields="json_fields"
      type="csv"
     name="Export Leads.xls"
    >
      <b>
        <a data-toggle="tooltip" title="Download Semua Data Deals">Download Leads</a>
      </b>
    </downloadexcel>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Detail Lead</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="table-responsive table-hover" style="overflow: auto;
white-space: nowrap;">
              <table class="table table-sm">
                <thead>
                  <tr class="table shadow" style="font-size:12px">
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName</th>
                    <th scope="col">DataSource</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Provinsi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="table shadow"
                    style="font-size:12px"
                    v-for="(lead, index) in leadDetailcomp"
                    :key="index"
                  >
                    <td>{{index + 1}}</td>
                    <td>{{lead.created_at}}</td>
                    <td>{{lead.lead_mst_status_status}}</td>
                    <td>{{lead.first_name}}</td>
                    <td>{{lead.last_name}}</td>
                    <td>{{lead.mst_data_source_datasource}}</td>
                    <td>{{lead.address}}</td>
                    <td>{{lead.Kelurahan}}</td>
                    <td>{{lead.Kecamatan}}</td>
                    <td>{{lead.kabupaten}}</td>
                    <td>{{lead.provinsi}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <form  class="form-inline" role="form">
      <div class="form-group">
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="search"
          placeholder="Search"
        >
      </div>
      <div v-show="ho" class="input-group">
        <select v-model="default_branch" class="form-control form-control-sm">
          <option disabled value>Pilih Branch</option>
          <option v-for="branch in sortBranch" v-bind:value="branch.id">{{ branch.branch_name }}</option>
        </select>
        <div class="input-group-append">
          <button class="btn btn-outline-info btn-sm" @click="cariCabang" type="button">Cari</button>
        </div>
      </div>
        <a style="position: absolute;
  right: 0;
"
          class="btn  btn-outline-primary btn-sm"
          data-toggle="modal"
          title="Download Deals"
          data-target="#periode"
        ><i class="fas fa-download"></i></a>
    </form>

    <div class="table-responsive table-hover table-sm">
      <table class="table" style="width:100%">
        <thead style="overflow: auto;
white-space: nowrap;">
          <tr style="font-size:12px"  class="table shadow">
            <!-- <th scope="col">#</th> -->
            <th scope="col" @click="sort('name')">
              NAME
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('privilages')">
              PRIVILEGES
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('outlet')">
              OUTLET
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('leadtotal')">
              TOTAL
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('leadnew')">
              NEW
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('leadhot')">
              HOT
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('leadworking')">
              WORKING
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('leadunqualified')">
              UNQUALIFIED
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('leadconverted')">
              CONVERTED
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('leaddelete')">
              DELETE
              <i class="fas fa-sort"></i>
            </th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="table shadow"
            style="font-size:12px"
            v-for="(lead, index) in (  sortedActivity,filteredList   )"
            :key="index"
          >
            <!-- <td>{{index + 1}}</td> -->
            <td class="text-left">{{lead.name}}</td>
            <td class="text-left">{{lead.privilages}}</td>
            <td class="text-left">{{lead.outlet}}</td>
            <td class="text-center">{{lead.leadtotal}}</td>
            <td class="text-center">{{lead.leadnew}}</td>
            <td class="text-center">{{lead.leadhot}}</td>
            <td class="text-center">{{lead.leadworking}}</td>
            <td class="text-center">{{lead.leadunqualified}}</td>
            <td class="text-center">{{lead.leadconverted}}</td>
            <td class="text-center">{{lead.leaddelete}}</td>
            <td>
              <button
                type="button"
                class="btn btn-info btn-sm"
                v-on:click="getleadDetail(lead.a)"
                data-toggle="modal"
                data-target="#myModal"
              >Detail</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- <button @click="prevPage" class="float-left btn btn-outline-info btn-sm"><i class="fas fa-arrow-left"></i> Previous</button> 
    <button @click="nextPage" class="float-right btn btn-outline-info btn-sm">Next <i class="fas fa-arrow-right"></i></button>-->
  </div>
</template>

<script>
import axios from "axios";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import downloadexcel from "vue-json-excel";
export default {
  name: "home",
  components: {
    downloadexcel,
    Loading
  },
  data() {
    return {
      isLoading: false,
      color: "#007bff",
      height: 128,
      width: 128,
      loader: "dots",
      fullPage: true,
      isLoading: false,
      outletet: [],
      users_outlet: "",
      ayam: [],
      outlet_yg_dipilih: "",
      currentSort: "name",
      currentSortDir: "asc",
      search: "",
      searchSelection: "",
      pageSize: 1000,
      dataper: [
        { data: 10 },
        { data: 25 },
        { data: 50 },
        { data: 100 },
        { data: 150 }
      ],
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
       tahun: [{ data: 2018 }, { data: 2019 }],
      tahunnya: "",
      currentPage: 1,
      default_branch: "",
      branch: [],
      currentSortBranch: "branch_name",
      pilih_outlet: false,
      ho: false,
      cabang: false,
      mst_outlet: [],
      leadCoba: [],
      leadPage: [],
      leadDetail: [],
      leadUser: "",
      userslisting: [],
      arrayLead: [],
      json_fields: {
        created: "created_at",
        outlet_name: "mst_outlet_outlet_name",
        "datasource": "mst_data_source_datasource",
        first_name: "first_name",
        last_name: "last_name",
        job: "mst_job_job",
        "lead status": "lead_mst_status_status",
        cms_users_name: "cms_users_name",
        privilages: "cms_privileges_name",
        address: "address",
        kelurahan: "kelurahan",
        kecamatan: "kecamatan",
        kabupaten: "kabupaten",
        provinsi: "provinsi",
        kodepos: "kodepos",
        duration: "duration",
        description: "description"
      }
    };
  },
  methods: {
    async getleadDetail(id) {
      this.leadDetail = [];
      const getleaddetail = await this.$http.get("frontend_lead_listing", {
        params: {
          id_cms_users: id,
          created_at: this.be
        }
      });
      this.leadDetail = getleaddetail.data.data;
    },
    async cariCabang() {
      var filter_branch = sessionStorage.getItem("id_mst_branch");
      var id_privileges = sessionStorage.getItem("id_privileges");

      this.isLoading = true;
      this.arrayLead = []

       const getleadCoba = await this.$http.get("frontend_lead_coba", {
        params: {
          branch: this.default_branch,
          created_at: this.be
        }
      });
      this.leadCoba = getleadCoba.data.data;

      const getusers = await this.$http.get("frontend_users_listing", {
        params: {
          branch: this.default_branch
        }
      });
      let users = getusers.data.data;
      this.userslisting = users.length;

      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privilages = users[i].cms_privileges_name;
        let outlet = users[i].mst_outlet_outlet_name;
        this.leadUser = id;
        let a = this.id_cms_users;
        let leadtotal = this.leadTotal.length;
        let leadnew = this.leadNew.length;
        let leadhot = this.leadHot.length;
        let leadworking = this.leadWorking.length;
        let leadunqualified = this.leadUnqualified.length;
        let leadconverted = this.leadConverted.length;
        let leaddelete = this.leadDelete.length;
        this.arrayLead.push({
          a,
          name,
          privilages,
          outlet,
          leadtotal,
          leadnew,
          leadhot,
          leadworking,
          leadunqualified,
          leadconverted,
          leaddelete
        });
      }
      this.isLoading = false

     
    },
    sort: function(s) {
      if (s === this.currentSort) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      }
      this.currentSort = s;
    },
    nextPage: function() {
      if (this.currentPage * this.pageSize < this.leadCoba.length)
        this.currentPage++;
    },
    prevPage: function() {
      if (this.currentPage > 1) this.currentPage--;
    },

    async fetchData() {
      this.isLoading = true;
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
      var id_mst_branch = sessionStorage.getItem("id_mst_branch");
      var id_privileges = sessionStorage.getItem("id_privileges");

      if (id_privileges == 5) {
        const response = await this.$http.get("frontend_lead_listing", {
          params: {
            branch: this.default_branch,
            created_at: be
          }
        });
        this.isLoading = false;
        return response.data.data;
      } else {
        const response = await this.$http.get("frontend_lead_listing", {
          params: {
            branch: id_mst_branch,
            created_at: be
          }
        });
        console.log(response);
        this.isLoading = false;
        return response.data.data;
      }
    }
  },
  async mounted() {
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
    var id_privileges = sessionStorage.getItem("id_privileges");
    var privilages = sessionStorage.getItem("name_privileges");
    var login = sessionStorage.getItem("login");
    var filter_branch = sessionStorage.getItem("id_mst_branch");
    var id_mst_branch = sessionStorage.getItem("id_mst_branch");

    var index = window.location.pathname;
    var url =
      index == "/" ||
      index == "/assigment" ||
      index == "/devreport" ||
      index == "/report_kpi" ||
      index == "/leads" ||
      index == "/setting";
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

    var dat = new Date();
    let y = dat.getFullYear();
    var dat = dat.getMonth();
    var dat = dat + 1;
    this.tahunnya = y;
    this.bulanny = dat;

    if (id_privileges == 5) {
      this.ho = true;
      this.$http
        .get("frontend_branch_name")
        .then(response => (this.branch = response.data.data));

         const getleadCoba = await this.$http.get("frontend_lead_coba", {
        params: {
          branch: this.default_branch,
          created_at: be
        }
      });
      this.leadCoba = getleadCoba.data.data;

      const getusers = await this.$http.get("frontend_users_listing", {
        params: {
          branch: this.default_branch
        }
      });
      let users = getusers.data.data;
      this.userslisting = users.length;

      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privilages = users[i].cms_privileges_name;
        let outlet = users[i].mst_outlet_outlet_name;
        this.leadUser = id;
        let a = this.id_cms_users;
        let leadtotal = this.leadTotal.length;
        let leadnew = this.leadNew.length;
        let leadhot = this.leadHot.length;
        let leadworking = this.leadWorking.length;
        let leadunqualified = this.leadUnqualified.length;
        let leadconverted = this.leadConverted.length;
        let leaddelete = this.leadDelete.length;
        this.arrayLead.push({
          a,
          name,
          privilages,
          outlet,
          leadtotal,
          leadnew,
          leadhot,
          leadworking,
          leadunqualified,
          leadconverted,
          leaddelete
        });
      }
    } else {
      this.cabang = true;

      const getleadCoba = await this.$http.get("frontend_lead_coba", {
        params: {
          branch: id_mst_branch,
          created_at: be
        }
      });
      this.leadCoba = getleadCoba.data.data;

      const getusers = await this.$http.get("frontend_users_listing", {
        params: {
          branch: id_mst_branch
        }
      });
      let users = getusers.data.data;
      this.userslisting = users.length;

      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privilages = users[i].cms_privileges_name;
        let outlet = users[i].mst_outlet_outlet_name;
        this.leadUser = id;
        let a = this.id_cms_users;
        let leadtotal = this.leadTotal.length;
        let leadnew = this.leadNew.length;
        let leadhot = this.leadHot.length;
        let leadworking = this.leadWorking.length;
        let leadunqualified = this.leadUnqualified.length;
        let leadconverted = this.leadConverted.length;
        let leaddelete = this.leadDelete.length;
        this.arrayLead.push({
          a,
          name,
          privilages,
          outlet,
          leadtotal,
          leadnew,
          leadhot,
          leadworking,
          leadunqualified,
          leadconverted,
          leaddelete
        });
      }
    }
  },
  computed: {
    leadTotalCabang() {
      return this.leadCoba.length;
    },
    leadDetailcomp() {
      return this.leadDetail;
    },
    sortedActivity: function() {
      return this.arrayLead
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
    filteredList() {
      return this.arrayLead
        .filter(data => {
          return (
            (data.name || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            (data.privilages || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            (data.outlet || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
              data.leadtotal == this.search ||
            data.leadnew == this.search ||
            data.leadhot == this.search ||
            data.leadworking == this.search ||
            data.leadunqualified == this.search ||
            data.leaddelete == this.search
          );
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
        return this.leadPage.filter(function(list) {
          return list.id_mst_outlet == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.leadPage;
      }
    },
    id_cms_users() {
      return this.leadUser;
    },

    uniqueOutlet: function() {
      var existingIds = {};
      return this.leadPage.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    },
    uniqueUsers: function() {
      var existingIds = {};
      return this.leadCoba.filter(function(user) {
        if (existingIds[user.id_cms_users]) return false;
        return (existingIds[user.id_cms_users] = true);
      });
    },
    leadTotal() {
      return this.leadCoba.filter(data => {
        return data.id_cms_users == this.id_cms_users;
      });
    },
    leadNew() {
      return this.leadCoba.filter(data => {
        return (
          data.id_lead_mst_status == 1 && data.id_cms_users == this.id_cms_users
        );
      });
    },
    leadHot() {
      return this.leadCoba.filter(data => {
        return (
          data.id_lead_mst_status == 2 && data.id_cms_users == this.id_cms_users
        );
      });
    },
    leadWorking() {
      return this.leadCoba.filter(data => {
        return (
          data.id_lead_mst_status == 3 && data.id_cms_users == this.id_cms_users
        );
      });
    },
    leadUnqualified() {
      return this.leadCoba.filter(data => {
        return (
          data.id_lead_mst_status == 4 && data.id_cms_users == this.id_cms_users
        );
      });
    },
    leadConverted() {
      return this.leadCoba.filter(data => {
        return (
          data.id_lead_mst_status == 5 && data.id_cms_users == this.id_cms_users
        );
      });
    },
    leadDelete() {
      return this.leadCoba.filter(data => {
        return (
          data.id_lead_mst_status == 6 && data.id_cms_users == this.id_cms_users
        );
      });
    },
    kpileadDelete() {
      return this.leadCoba.filter(data => {
        return data.id_lead_mst_status == 6;
      }).length;
    },
    kpileadConverted() {
      return this.leadCoba.filter(data => {
        return data.id_lead_mst_status == 5;
      }).length;
    },
    kpileadUnqualified() {
      return this.leadCoba.filter(data => {
        return data.id_lead_mst_status == 4;
      }).length;
    },
    kpileadWorking() {
      return this.leadCoba.filter(data => {
        return data.id_lead_mst_status == 3;
      }).length;
    },
    kpileadHot() {
      return this.leadCoba.filter(data => {
        return data.id_lead_mst_status == 2;
      }).length;
    },
    kpileadNew() {
      return this.leadCoba.filter(data => {
        return data.id_lead_mst_status == 1;
      }).length;
    },
    sortBranch: function() {
      return this.branch.sort((a, b) => {
        if (a[this.currentSortBranch] < b[this.currentSortBranch])
          return 1 * -1;
        return 0;
      });
    },
    be(){
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
    return be
    }
  }
};
</script>
