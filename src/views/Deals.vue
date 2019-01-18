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
                  <h4>{{dealsTotalCabang}}</h4>
                  <p style="font-size:12px">Deals</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="far fa-clock fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpiDealsProcces}}</h4>
                  <p style="font-size:12px">Proses</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-check fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpiDealsApprove}}</h4>
                  <p style="font-size:12px">Approve</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-handshake fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpiDealsPaid}}</h4>
                  <p style="font-size:12px">Paid</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="far fa-times-circle fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpiDealsReject}}</h4>
                  <p style="font-size:12px">Reject</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-times-circle fa-3x"></i>
                <div class="media-body">
                  <h4>{{kpiDealsCancel}}</h4>
                  <p style="font-size:12px">Cancel</p>
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
      name="Export Deals.xls"
    >
      <b>
        <a data-toggle="tooltip" title="Download Semua Data Deals">Download Deals</a>
      </b>
    </downloadexcel>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade " id="myModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Detail Deals</h4>
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
                    <th scope="col">Reason</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Type</th>
                    <th scope="col">Year</th>
                    <th scope="col">Plafon</th>
                    <th scope="col">Installment</th>
                    <th scope="col">Tenor</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="table shadow"
                    style="font-size:12px"
                    v-for="(deals, index) in dealsDetailcomp"
                    :key="index"
                  >
                    <td>{{index + 1}}</td>
                    <td>{{deals.created_at}}</td>
                    <td>{{deals.order_mst_status_status}}</td>
                    <td>{{deals.contact_first_name}}</td>
                    <td>{{deals.contact_last_name}}</td>
                    <td>{{deals.order_mst_reason_reason}}</td>
                    <td>{{deals.merk}}</td>
                    <td>{{deals.type}}</td>
                    <td>{{deals.year}}</td>
                    <td>{{deals.plafon}}</td>
                    <td>{{deals.installment}}</td>
                    <td>{{deals.tenor}}</td>
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
      <div >
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="search"
          placeholder="Search"
        >
        <a style="position: absolute;
  right: 0;
"
          class="btn  btn-outline-primary btn-sm"
          data-toggle="modal"
          title="Download Deals"
          data-target="#periode"
        ><i class="fas fa-download"></i></a>
      </div>
      <div v-show="ho" class="input-group">
        <select v-model="default_branch" class="form-control form-control-sm">
          <option disabled value>Pilih Branch</option>
          <option v-for="branch in sortBranch" v-bind:value="branch.id">{{ branch.branch_name }}</option>
        </select>
        <div class="input-group-append">
          <button
            type="button"
            class="btn btn-outline-info btn-sm"
            v-on:click="cariBranch"
          >Cari</button>
        </div>
      </div>
    </form>

    <div class="table-responsive table-hover table-sm">
      <table class="table" style="width:100%">
        <thead style="overflow: auto;
white-space: nowrap;">
          <tr style="font-size:12px" class="table shadow">
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
            <th scope="col" @click="sort('dealsTotal')">
              TOTAL
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('dealsProspecting')">
              PROSFECTING
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('dealsQualifed')">
              QUALIFIED
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('dealsWon')">
              WON
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('dealsUnqualified')">
              UNQUALIFIED
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('delasLost')">
              LOST
              <i class="fas fa-sort"></i>
            </th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="table shadow"
            style="font-size:12px"
            v-for="(deals, index) in (  sortedActivity,filteredList   )"
            :key="index"
          >
            <!-- <td>{{index + 1}}</td> -->
            <td class="text-left">{{deals.name}}</td>
            <td class="text-left">{{deals.privilages}}</td>
            <td class="text-left">{{deals.outlet}}</td>
            <td class="text-center">{{deals.dealsTotal}}</td>
            <td class="text-center">{{deals.dealsProspecting}}</td>
            <td class="text-center">{{deals.dealsQualifed}}</td>
            <td class="text-center">{{deals.dealsWon}}</td>
            <td class="text-center">{{deals.dealsUnqualified}}</td>
            <td class="text-center">{{deals.delasLost}}</td>
            <td>
              <button
                type="button"
                class="btn btn-info btn-sm"
                v-on:click="getDealsDetail(deals.a)"
                data-toggle="modal"
                data-target="#myModal"
              >Detail</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
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
      users: [],
      report_deals: [],
      outletet: [],
      users_outlet: "",
      fullPage: true,
      outlet_yg_dipilih: "",
      currentSort: "name",
      currentSortDir: "asc",
      search: "",
      searchSelection: "",
      pageSize: 1000,
      dataper: [{ data: 25 }, { data: 50 }, { data: 100 }, { data: 150 }],
      currentPage: 1,
      default_branch: "",
      branch: [],
      currentSortBranch: "branch_name",
      pilih_outlet: false,
      mst_outlet: [],
      ho: false,
      cabang: false,
      tahun: [{ data: 2018 }, { data: 2019 }],
      tahunnya: "",
      dealsUser: "",
      arrayDeals: [],
      userslisting: [],
      dealsCoba: [],
      dealsDetail: [],
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
      json_fields: {
        created_at: "created_at",
        outlet_name: "mst_outlet_outlet_name",
        id_contact: "id_contact",
        contact_nik: "contact_nik",
        contact_first_name: "contact_first_name",
        contact_last_name: "contact_last_name",
        number: "number",
        contact_birth_place: "contact_birth_place",
        contact_birth_date: "contact_birth_date",
        contact_gender: "contact_gender",
        contact_updated_by: "contact_updated_by",
        mst_product_nama: "mst_product_nama",
        mst_product_status: "mst_product_status",
        no_order: "id",
        order_status: "order_mst_status_status",
        alasan: "order_mst_reason_reason",
        cms_users_npm: "cms_users_npm",
        cms_users_name: "cms_users_name",
        privileges: "cms_privileges_name",
        plafon: "plafon",
        down_payment: "down_payment",
        installment: "installment",
        tenor: "tenor",
        need: "need",
        order_surety_name: "order_surety_name",
        order_surety_birth_place: "order_surety_birth_place",
        year: "year",
        kode_unit: "kode_unit",
        merk: "merk",
        type: "type",
        otr: "otr",
        nopol: "nopol",
        tax_status: "tax_status",
        owner: "owner"
      }
    };
  },
  methods: {
    async cariBranch() {
      this.arrayDeals = [];
      var id_mst_branch = sessionStorage.getItem("id_mst_branch");
      var id_privileges = sessionStorage.getItem("id_privileges");
      this.isLoading = true;

      const getdeals = await this.$http.get("report_cfa_deals", {
        params: {
          branch: this.default_branch,
          created_at: this.be
        }
      });
      this.dealsCoba = getdeals.data.data;

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
        this.dealsUser = id;
        let a = this.id_cms_users;
        let dealsTotal = this.DealsTotal.length;
        let dealsProspecting = this.DealsProcces.length;
        let dealsQualifed = this.DealsApprove.length;
        let dealsWon = this.DealsPaid.length;
        let dealsUnqualified = this.DealsReject.length;
        let delasLost = this.DealsCancel.length;

        this.arrayDeals.push({
          a,
          name,
          privilages,
          outlet,
          dealsTotal,
          dealsProspecting,
          dealsQualifed,
          dealsWon,
          dealsUnqualified,
          delasLost
        });
      }
      this.isLoading = false;
    },
  
  async getDealsDetail(id) {
    this.dealsDetail = [];
    const getdealsdetail = await this.$http.get("report_cfa_deals", {
      params: {
        id_cms_users: id,
        created_at: this.be
      }
    });
    let deal = getdealsdetail.data.data;
    for (let i = 0; i < deal.length; i++) {
      let created_at = deal[i].created_at
      let order_mst_status_status = deal[i].order_mst_status_status
      let contact_first_name = deal[i].contact_first_name
      let contact_last_name = deal[i].contact_last_name
      let order_mst_reason_reason = deal[i].order_mst_reason_reason
      let merk = deal[i].merk
      let type = deal[i].type
      let year = deal[i].year
      let tenor = deal[i].tenor

      let getplafon = deal[i].plafon
      let getinstallment = deal[i].installment
      let plafon = this.plafon(getplafon)
      let installment = this.installment(getinstallment)
      this.dealsDetail.push({created_at,order_mst_status_status,contact_first_name,contact_last_name,order_mst_reason_reason,merk,type,year,tenor,plafon,installment})
      


      
    }


  },
  sort: function(s) {
    if (s === this.currentSort) {
      this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
    }
    this.currentSort = s;
  },
  nextPage: function() {
    if (this.currentPage * this.pageSize < this.report_deals.length)
      this.currentPage++;
  },
  prevPage: function() {
    if (this.currentPage > 1) this.currentPage--;
  },
  plafon(a) {
    return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  },
  installment(a) {
    return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
      const response = await this.$http.get("report_cfa_deals", {
        params: {
          branch: this.default_branch,
          created_at: be
        }
      });
      this.isLoading = false;
      return response.data.data;
          
    } else {
      const response = await this.$http.get("report_cfa_deals", {
        params: {
          branch: id_mst_branch,
          created_at: be
        }
      });
      this.isLoading = false;
      return response.data.data;
          
    }

  },
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
    var privilages = sessionStorage.getItem("name_privileges");
    var id_privileges = sessionStorage.getItem("id_privileges");
    var login = sessionStorage.getItem("login");
    var id_mst_branch = sessionStorage.getItem("id_mst_branch");
    var filter_branch = sessionStorage.getItem("id_mst_branch");

    var index = window.location.pathname;
    var url =
      index == "/" ||
      index == "/deals" ||
      index == "/setting" ||
      index == "/report_kpi" ||
      index == "/report_outlet" ||
      index == "/devreport";
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

    var dat = new Date();
    let y = dat.getFullYear();
    var dat = dat.getMonth();
    var dat = dat + 1;
    this.tahunnya = y;
    this.bulanny = dat;

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

    if (id_privileges == 5) {
      this.ho = true;
      this.$http
        .get("frontend_branch_name")
        .then(response => (this.branch = response.data.data));

      const getdeals = await this.$http.get("report_cfa_deals", {
        params: {
          created_at: this.be
        }
      });
      this.dealsCoba = getdeals.data.data;

      const getusers = await this.$http.get("frontend_users_listing", {
        params: {}
      });
      let users = getusers.data.data;
      this.userslisting = users.length;

      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privilages = users[i].cms_privileges_name;
        let outlet = users[i].mst_outlet_outlet_name;
        this.dealsUser = id;
        let a = this.id_cms_users;
        let dealsTotal = this.DealsTotal.length;
        let dealsProspecting = this.DealsProcces.length;
        let dealsQualifed = this.DealsApprove.length;
        let dealsWon = this.DealsPaid.length;
        let dealsUnqualified = this.DealsReject.length;
        let delasLost = this.DealsCancel.length;

        this.arrayDeals.push({
          a,
          name,
          privilages,
          outlet,
          dealsTotal,
          dealsProspecting,
          dealsQualifed,
          dealsWon,
          dealsUnqualified,
          delasLost
        });
      }
    } else {
      this.cabang = true;

      const getdeals = await this.$http.get("report_cfa_deals", {
        params: {
          branch: id_mst_branch,
          created_at: this.be
        }
      });
      this.dealsCoba = getdeals.data.data;

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
        this.dealsUser = id;
        let a = this.id_cms_users;
        let dealsTotal = this.DealsTotal.length;
        let dealsProspecting = this.DealsProcces.length;
        let dealsQualifed = this.DealsApprove.length;
        let dealsWon = this.DealsPaid.length;
        let dealsUnqualified = this.DealsReject.length;
        let delasLost = this.DealsCancel.length;

        this.arrayDeals.push({
          a,
          name,
          privilages,
          outlet,
          dealsTotal,
          dealsProspecting,
          dealsQualifed,
          dealsWon,
          dealsUnqualified,
          delasLost
        });
      }
    }
  },
  computed: {
    dealsDetailcomp() {
      return this.dealsDetail;
    },
    id_cms_users() {
      return this.dealsUser;
    },
    DealsTotal() {
      return this.dealsCoba.filter(data => {
        return data.id_cms_users == this.id_cms_users;
      });
    },
    DealsApprove() {
      return this.dealsCoba.filter(data => {
        return (
          data.id_order_mst_status == 1 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    DealsProcces() {
      return this.dealsCoba.filter(data => {
        return (
          data.id_order_mst_status == 2 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    DealsCancel() {
      return this.dealsCoba.filter(data => {
        return (
          data.id_order_mst_status == 3 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    DealsReject() {
      return this.dealsCoba.filter(data => {
        return (
          data.id_order_mst_status == 4 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    DealsPaid() {
      return this.dealsCoba.filter(data => {
        return (
          data.id_order_mst_status == 5 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    dealsTotalCabang() {
      return this.dealsCoba.length;
    },
    kpiDealsPaid() {
      return this.dealsCoba.filter(data => {
        return data.id_order_mst_status == 5;
      }).length;
    },
    kpiDealsApprove() {
      return this.dealsCoba.filter(data => {
        return data.id_order_mst_status == 1;
      }).length;
    },
    kpiDealsProcces() {
      return this.dealsCoba.filter(data => {
        return data.id_order_mst_status == 2;
      }).length;
    },
    kpiDealsCancel() {
      return this.dealsCoba.filter(data => {
        return data.id_order_mst_status == 3;
      }).length;
    },
    kpiDealsReject() {
      return this.dealsCoba.filter(data => {
        return data.id_order_mst_status == 4;
      }).length;
    },
    kpiDealsPaid() {
      return this.dealsCoba.filter(data => {
        return data.id_order_mst_status == 5;
      }).length;
    },
    sortedActivity: function() {
      return this.arrayDeals
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
      return this.arrayDeals
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
            data.dealsTotal == this.search ||
            data.dealsProspecting == this.search ||
            data.dealsQualifed == this.search ||
            data.dealsWon == this.search ||
            data.dealsUnqualified == this.search ||
            data.delasLost == this.search
          );
        })
        .filter((row, index) => {
          let start = (this.currentPage - 1) * this.pageSize;
          let end = this.currentPage * this.pageSize;
          if (index >= start && index < end) return true;
        });
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
      return this.outletet.filter(function(user) {
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
    },
    
  }
};
</script>
