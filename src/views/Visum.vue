<template>
  <div class="table-responsive">
    <loading
      :active.sync="isLoading"
      :color="color"
      :loader="loader"
      :height="height"
      :width="width"
      :is-full-page="fullPage"
    ></loading>
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
                    <th scope="col">id_target</th>
                    <th scope="col">business_code</th>
                    <th scope="col">category</th>
                    <th scope="col">priority</th>
                    <th scope="col">no_contract</th>
                    <th scope="col">nopol</th>
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">provider_1</th>
                    <th scope="col">provider_2</th>
                    <th scope="col">Job</th>
                    <th scope="col">address</th>
                    <th scope="col">kelurahan</th>
                    <th scope="col">kecamatan</th>
                    <th scope="col">kabupaten</th>
                     <th scope="col">provinsi</th>
                    <th scope="col">visum_status</th>
                    <th scope="col">revisit</th>
                    <th scope="col">cms_users_name</th>
                    <th scope="col">outlet_name</th>
                    <th scope="col">branch_name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="table shadow"
                    style="font-size:12px"
                    v-for="(visum, index) in visumDetail"
                    :key="index"
                  >
                    <td>{{index + 1}}</td>
                    <td>{{visum.created_at}}</td>
                    <td>{{visum.id_target}}</td>
                    <td>{{visum.target_business_code}}</td>
                    <td>{{visum.target_category}}</td>
                    <td>{{visum.target_priority}}</td>
                    <td>{{visum.target_no_contract}}</td>
                    <td>{{visum.target_nopol}}</td>
                    <td>{{visum.target_first_name}}</td>
                    <td>{{visum.target_last_name}}</td>
                    <td>{{visum.target_provider_1}}</td>
                    <td>{{visum.target_provider_2}}</td>
                    <td>{{visum.target_job}}</td>
                    <td>{{visum.target_address}}</td>
                    <td>{{visum.target_kelurahan}}</td>
                    <td>{{visum.target_kecamatan}}</td>
                    <td>{{visum.target_kabupaten}}</td>
                    <td>{{visum.target_provinsi}}</td>
                    <td>{{visum.mst_visum_status_status}}</td>
                    <td>{{visum.revisit}}</td>
                    <td>{{visum.cms_users_name}}</td>
                    <td>{{visum.mst_outlet_outlet_name}}</td>
                    <td>{{visum.mst_branch_branch_name}}</td>

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


    <div class="table-responsive">
      <table class="table shadow">
        <tbody>
          <tr>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-database fa-2x">{{visum.length}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Visum</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-home fa-2x">{{JmlRumahKosong}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Rumah Kosong</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-map-marked-alt fa-2x">{{JmlAlamatTidakSesuai}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Alamat Salah</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-times-circle fa-2x">{{JmlDitolak}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Ditolak/Diusir</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-clock fa-2x">{{JmlButuhWaktu}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Butuh Waktu</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-question-circle fa-2x">{{JmlTanyaPasangan}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Tanya Pasangan</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-meh fa-2x">{{JmlPikirPikir}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Pikir-Pikir</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-grin-alt fa-2x">{{JmlBerminat}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Berminat</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-house-damage fa-2x">{{JmlRumahTidakKetemu}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Rumah Ghoib</p>
            </th>
            <th>
              <div class="text-center">
                <tr class="table-borderless">
                  <i class="fas fa-dizzy fa-2x">{{JmlTidakBerminat}}</i>
                </tr>
              </div>
              <p style="font-size:12px">Tidak Berminat</p>
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
            <div class="input-group-append" v-show="ho">
              <button type="button" class="btn btn-outline-info btn-sm" v-on:click="cariBranch">Cari</button>
            </div>
            <downloadexcel
              class="btn btn-outline-dark btn-sm"
              :fetch="fetchData"
              :fields="json_fields"
              type="csv"
              name="Export Visum.xls"
            >
              <b>
                <a data-toggle="tooltip" title="Download Semua Data Deals">Download Visum</a>
              </b>
            </downloadexcel>
          </div>
        </div>
      </div>
    </div>

    <form class="form-inline" role="form">
      <div>
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="search"
          placeholder="Search"
        >
        <a
          class="btn btn-outline-primary btn-sm"
          data-toggle="modal"
          title="Download Deals"
          data-target="#periode"
        >Filter</a>
      </div>
      <!-- <div v-show="ho" class="input-group">
        <select v-model="default_branch" class="form-control form-control-sm">
          <option disabled value>Pilih Branch</option>
          <option v-for="branch in sortBranch" v-bind:value="branch.id">{{ branch.branch_name }}</option>
        </select>
       
      </div>-->
    </form>
    <div class="table-responsive table-hover table-sm">
      <table class="table">
        <thead>
          <tr style="font-size:12px">
            <th scope="col">#</th>
            <th scope="col" @click="sort('name')">NAME</th>
            <th scope="col" @click="sort('privileges')">PRIVILEGES</th>
            <th scope="col" @click="sort('Total')">Total</th>
            <th scope="col" @click="sort('RumahKosong')">Rumah Kosong</th>
            <th scope="col" @click="sort('AlamatTidakSesuai')">Alamat Salah</th>
            <th scope="col" @click="sort('Ditolak')">Ditolak/Diusir</th>
            <th scope="col" @click="sort('ButuhWaktu')">Butuh Waktu</th>
            <th scope="col" @click="sort('TanyaPasangan')">Tanya Pasangan</th>
            <th scope="col" @click="sort('PikirPikir')">PikirPikir</th>
            <th scope="col" @click="sort('Berminat')">Berminat</th>
            <th scope="col" @click="sort('RumahTidakKetemu')">Rumah Ghoib</th>
            <th scope="col" @click="sort('TidakBerminat')">Tidak Berminat</th>
             <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr
            style="font-size:12px"
            v-for="(user, index) in (sortedActivity, filteredList)"
            :key="index"
          >
            <td>{{index + 1}}</td>
            <td class="text-left">{{user.name}}</td>
            <td>{{user.privileges}}</td>
            <td>{{user.Total}}</td>
            <td>{{user.RumahKosong}}</td>
            <td>{{user.AlamatTidakSesuai}}</td>
            <td>{{user.Ditolak}}</td>
            <td>{{user.ButuhWaktu}}</td>
            <td>{{user.TanyaPasangan}}</td>
            <td>{{user.PikirPikir}}</td>
            <td>{{user.Berminat}}</td>
            <td>{{user.RumahTidakKetemu}}</td>
            <td>{{user.TidakBerminat}}</td>
            <td>
              <button
                type="button"
                class="btn btn-info btn-sm"
                v-on:click="getVisumDetail(user.a)"
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
/*eslint-disable*/
import axios from "axios";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import downloadexcel from "vue-json-excel";
export default {
  components: {
    downloadexcel,
    Loading
  },
  data: () => ({
    isLoading: false,
    users: [],
    currentSort: "name",
    currentSortDir: "asc",
    search: "",
    searchSelection: "",
    isLoading: false,
    color: "#007bff",
    height: 128,
    width: 128,
    loader: "dots",
    fullPage: true,
    pilih_outlet: false,
    default_branch: "",
    outlet_yg_dipilih: "",
visumUsers: '',
    pageSize: 1000,
    currentPage: 1,
    visum: [],
    arrayVisum: [],
    branch: [],
    mst_outlet: [],
    visumDetail: [],
    tahun: [{ data: 2018 }, { data: 2019 }, { data: 2020 }],
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
    ho: false,
    cabang: false,
    json_fields: {
      created_at: "created_at",
      id_target: "id_target",
      business_code: "target_business_code",
      category: "target_category",
      priority: "target_priority",
      no_contract: "target_no_contract",
      nopol: "target_nopol",
      first_name: "target_first_name",
      last_name: "target_last_name",
      hp_1: "target_hp_1",
      hp_2: "target_hp_2",
      provider_1: "target_provider_1",
      provider_2: "target_provider_2",
      job: "target_job",
      address: "target_address",
      kelurahan: "target_kelurahan",
      kecamatan: "target_kecamatan",
      kabupaten: "target_kabupaten",
      provinsi: "target_provinsi",
      visum_status: "mst_visum_status_status",
      visum_status_updated_by: "mst_visum_status_updated_by",
      revisit: "revisit",
      users_name: "cms_users_name",
      mst_outlet_outlet_name: "mst_outlet_outlet_name",
      mst_branch_branch_name: "mst_branch_branch_name"
    }
  }),
  async mounted() {
    var dat = new Date();
    let y = dat.getFullYear();
    var dat = dat.getMonth();
    var dat = dat + 1;
    this.tahunnya = y;
    this.bulanny = dat;

    if (this.id_privileges == 5) {
      this.ho = true;
      this.$http
        .get("frontend_mst_outlet")
        .then(response => (this.mst_outlet = response.data.data));

      const getvisum = await this.$http.get("frontend_visum", {
        params: {
          created_at: this.MounthYear,
          branch: this.default_branch
        }
      });
      this.visum = getvisum.data.data;

      this.$http
        .get("frontend_branch_name")
        .then(response => (this.branch = response.data.data));

      const getusers = await this.$http.get("frontend_users_listing", {
        params: {}
      });
      let users = getusers.data.data;
      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privileges = users[i].cms_privileges_name;
        let id_mst_outlet = users[i].id_mst_outlet;
        let outlet = users[i].mst_outlet_outlet_name;
       this.visumUsers = id;
        let a = this.id_cms_users;
        let RumahKosong = this.RumahKosong.length;
        let AlamatTidakSesuai = this.AlamatTidakSesuai.length;
        let Ditolak = this.Ditolak.length;
        let ButuhWaktu = this.ButuhWaktu.length;
        let TanyaPasangan = this.TanyaPasangan.length;
        let PikirPikir = this.PikirPikir.length;
        let Berminat = this.Berminat.length;
        let RumahTidakKetemu = this.RumahTidakKetemu.length;
        let TidakBerminat = this.TidakBerminat.length;
        let Total = this.Total.length;

        this.arrayVisum.push({
          a,
          name,
          privileges,
          id_mst_outlet,
          outlet,
          RumahKosong,
          AlamatTidakSesuai,
          Ditolak,
          ButuhWaktu,
          TanyaPasangan,
          PikirPikir,
          Berminat,
          RumahTidakKetemu,
          TidakBerminat,
          Total
        });
      }
    } else {
      const getvisum = await this.$http.get("frontend_visum", {
        params: {
          created_at: this.MounthYear,
          branch: this.id_mst_branch
        }
      });
      this.visum = getvisum.data.data;
      const getusers = await this.$http.get("frontend_users_listing", {
        params: { branch: this.id_mst_branch }
      });
      let users = getusers.data.data;
      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privileges = users[i].cms_privileges_name;
        let id_mst_outlet = users[i].id_mst_outlet;
        let outlet = users[i].mst_outlet_outlet_name;
        this.visumUsers = id;
        let a = this.id_cms_users;
        let RumahKosong = this.RumahKosong.length;
        let AlamatTidakSesuai = this.AlamatTidakSesuai.length;
        let Ditolak = this.Ditolak.length;
        let ButuhWaktu = this.ButuhWaktu.length;
        let TanyaPasangan = this.TanyaPasangan.length;
        let PikirPikir = this.PikirPikir.length;
        let Berminat = this.Berminat.length;
        let RumahTidakKetemu = this.RumahTidakKetemu.length;
        let TidakBerminat = this.TidakBerminat.length;
        let Total = this.Total.length;

        this.arrayVisum.push({
          a,
          name,
          privileges,
          id_mst_outlet,
          outlet,
          RumahKosong,
          AlamatTidakSesuai,
          Ditolak,
          ButuhWaktu,
          TanyaPasangan,
          PikirPikir,
          Berminat,
          RumahTidakKetemu,
          TidakBerminat,
          Total
        });
      }
    }
  },
  methods: {
    async getVisumDetail(id){
       this.visumDetail = [];
    const getvisumdetail = await this.$http.get("frontend_visum_listing", {
      params: {
         created_at: this.MounthYear,
        id_cms_users: id,
        
      }
    });
    this.visumDetail = getvisumdetail.data.data;


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
        const response = await this.$http.get("frontend_visum_listing", {
          params: {
            branch: this.default_branch,
            created_at: be
          }
        });
        this.isLoading = false;
        return response.data.data;
      } else {
        const response = await this.$http.get("frontend_visum_listing", {
          params: {
            branch: id_mst_branch,
            created_at: be
          }
        });
        this.isLoading = false;
        return response.data.data;
      }
    },
    sort: function(s) {
      if (s === this.currentSort) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      }
      this.currentSort = s;
    },
    nextPage: function() {
      if (this.currentPage * this.pageSize < this.arrayVisum.length)
        this.currentPage++;
    },
    prevPage: function() {
      if (this.currentPage > 1) this.currentPage--;
    },
    async cariBranch() {
      this.arrayVisum = [];
      this.visum = [];
      const getvisum = await this.$http.get("frontend_visum", {
        params: {
          created_at: this.MounthYear,
          branch: this.default_branch
        }
      });
      this.visum = getvisum.data.data;
      const getusers = await this.$http.get("frontend_users_listing", {
        params: { branch: this.default_branch }
      });
      let users = getusers.data.data;
      for (let i = 0; i < users.length; i++) {
        let id = users[i].id;
        let name = users[i].name;
        let privileges = users[i].cms_privileges_name;
        let id_mst_outlet = users[i].id_mst_outlet;
        let outlet = users[i].mst_outlet_outlet_name;
        this.visumUsers = id;
        let a = this.id_cms_users;
        let RumahKosong = this.RumahKosong.length;
        let AlamatTidakSesuai = this.AlamatTidakSesuai.length;
        let Ditolak = this.Ditolak.length;
        let ButuhWaktu = this.ButuhWaktu.length;
        let TanyaPasangan = this.TanyaPasangan.length;
        let PikirPikir = this.PikirPikir.length;
        let Berminat = this.Berminat.length;
        let RumahTidakKetemu = this.RumahTidakKetemu.length;
        let TidakBerminat = this.TidakBerminat.length;
        let Total = this.Total.length;

        this.arrayVisum.push({
          a,
          name,
          privileges,
          id_mst_outlet,
          outlet,
          RumahKosong,
          AlamatTidakSesuai,
          Ditolak,
          ButuhWaktu,
          TanyaPasangan,
          PikirPikir,
          Berminat,
          RumahTidakKetemu,
          TidakBerminat,
          Total
        });
      }
    }
  },
  computed: {
    JmlRumahKosong() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 1;
      }).length;
    },
    JmlAlamatTidakSesuai() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 2;
      }).length;
    },
    JmlDitolak() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 3;
      }).length;
    },
    JmlButuhWaktu() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 4;
      }).length;
    },
    JmlTanyaPasangan() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 5;
      }).length;
    },
    JmlPikirPikir() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 6;
      }).length;
    },
    JmlBerminat() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 7;
      }).length;
    },
    JmlRumahTidakKetemu() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 8;
      }).length;
    },
    JmlTidakBerminat() {
      return this.visum.filter(data => {
        return data.id_mst_visum_status == 9;
      }).length;
    },
    Total() {
      return this.visum.filter(data => {
        return data.id_cms_users == this.id_cms_users;
      });
    },
    RumahKosong() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 1 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    AlamatTidakSesuai() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 2 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    Ditolak() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 3 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    ButuhWaktu() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 4 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    TanyaPasangan() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 5 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    PikirPikir() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 6 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    Berminat() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 7 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    RumahTidakKetemu() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 8 &&
          data.id_cms_users == this.id_cms_users
        );
      });
    },
    TidakBerminat() {
      return this.visum.filter(data => {
        return (
          data.id_mst_visum_status == 9 &&
          data.id_cms_users == this.id_cms_users
        );
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
    filteredList() {
      return this.getValue
        .filter(data => {
          let name = data.name.toLowerCase().match(this.search.toLowerCase());
          let privileges = data.privileges
            .toLowerCase()
            .match(this.search.toLowerCase());
          let RumahKosong = data.RumahKosong == this.search;
          let AlamatTidakSesuai = data.AlamatTidakSesuai == this.search;
          let Total = data.Total == this.search;
          let Ditolak = data.Ditolak == this.search;
          let ButuhWaktu = data.ButuhWaktu == this.search;
          let TanyaPasangan = data.TanyaPasangan == this.search;
          let PikirPikir = data.PikirPikir == this.search;
          let Berminat = data.Berminat == this.search;
          let RumahTidakKetemu = data.RumahTidakKetemu == this.search;
          let TidakBerminat = data.TidakBerminat == this.search;
          return (
            name ||
            privileges ||
            RumahKosong ||
            AlamatTidakSesuai ||
            Total ||
            Ditolak ||
            ButuhWaktu ||
            TanyaPasangan ||
            PikirPikir ||
            Berminat ||
            RumahTidakKetemu ||
            TidakBerminat
          );
        })
        .filter((row, index) => {
          let start = (this.currentPage - 1) * this.pageSize;
          let end = this.currentPage * this.pageSize;
          if (index >= start && index < end) return true;
        });
    },
    MounthYear() {
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
    id_mst_branch() {
      var id_mst_branch = sessionStorage.getItem("id_mst_branch");
      return id_mst_branch;
    },
    id_privileges() {
      var id_privileges = sessionStorage.getItem("id_privileges");
      return id_privileges;
    },
    sortBranch: function() {
      function compare(a, b) {
        if (a.branch_name < b.branch_name) return -1;
        if (a.branch_name > b.branch_name) return 1;
        return 0;
      }

      return this.branch.sort(compare);
    },

    uniqueOutlet: function() {
      var existingIds = {};
      return this.arrayVisum.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    },
    getValue() {
      // udah ye
      if (this.outlet_yg_dipilih !== "") {
        console.log(`Coba ${this.outlet_yg_dipilih}`);
        let x = this.outlet_yg_dipilih;
        return this.arrayVisum.filter(function(list) {
          return list.id_mst_outlet == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.arrayVisum;
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
    id_cms_users() {
      return this.visumUsers;
    },
  },
  created() {
    axios.get("https://jsonplaceholder.typicode.com/users").then(response => {
      this.users = response.data;
    });
  }
};
</script>

<style>
th {
  cursor: pointer;
  /* width: 500px !important; */
  white-space: nowrap;
}
tr {
  white-space: nowrap;
}
</style>