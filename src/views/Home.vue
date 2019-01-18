<template>
  <div class="home">
    <p class="text-left" style="padding: 0px; margin:0px;color:#B388FF">
      <b>{{tggl}}</b>
    </p>
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
                <i class="fas fa-user fa-3x"></i>
                <div class="media-body">
                  <h4>{{total_users}}</h4>
                  <p style="font-size:12px">USERS</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-copy fa-3x"></i>

                <div class="media-body">
                  <h4>{{total_brochure}}</h4>
                  <p style="font-size:12px">BROCHURE</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-headset fa-3x"></i>
                <div class="media-body">
                  <h4>{{total_tele}}</h4>
                  <p style="font-size:12px">TELEMARKETING</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-users fa-3x"></i>
                <div class="media-body">
                  <h4>{{total_leads}}</h4>
                  <p style="font-size:12px">LEADS</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-handshake fa-3x"></i>
                <div class="media-body">
                  <h4>{{total_deals}}</h4>
                  <p style="font-size:12px">DEALS</p>
                </div>
              </div>
            </th>
            <th>
              <div class="media">
                <i class="fas fa-hand-holding-usd fa-3x"></i>
                <div class="media-body">
                  <h4>{{total_bookings}}</h4>
                  <p style="font-size:12px">BOOKING</p>
                </div>
              </div>
            </th>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="row">
            <div v-show="ho" class="col-md-12">
              <div class="card shadow">
                <div class="card-header" style="font-size:14px;background:#8A2D30;color:#fff">
                  <b>CABANG</b>
                </div>
                <div class="card-body">
                  <div class="table-wrapper-scroll-y">
                    <div class="table-responsive text-nowrap">
                      <table class="table table-sm table-borderless table-hover">
                        <tbody style="font-size:12px">
                          <tr
                            style="font-size:12px"
                            class="text-left"
                            v-for="(ayam, index)   in sortCabang "
                            :key="index"
                          >
                            <td>
                              <a v-on:click="cabangg(ayam.id,ayam.branch_name)">{{ayam.branch_name}}</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div v-show="cabang" class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <p style="font-size:14px">
                    <b>OUTLET</b>
                  </p>
                  <div class="table-wrapper-scroll-y">
                    <div class="table-responsive text-nowrap">
                      <table class="table table-sm table-borderless table-hover">
                        <tbody style="font-size:12px">
                          <tr
                            class="text-left"
                            style="font-size:12px"
                            v-for="(ayam, index)   in outlet_name "
                            :key="index"
                            v-on:click="dioutlet(ayam.id,ayam.outlet_name)"
                          >
                            <td>{{ayam.outlet_name}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <GChart
            style=" height: 400px;"
            :resizeDebounce="500"
            :settings="{packages: ['bar']}"
            :data="chartan"
            :options="chartOptions"
            :createChart="(el, google) => new google.charts.Bar(el)"
            @ready="onChartReady"
          />
        </div>
      </div>
    </div>
    <br>

    <div class="container-fluid" style="margin-bottom:0">
      <div class="row">
        <div class="col-sm-6">
          <div class="card shadow">
            <div class="row card-body">
              <div class="col-md-4 float-none">
                <i class="far fa-thumbs-up fa-5x" style="color:#03DAC6"></i>
                <p style="font-size:12px">
                  <b>GOOD ARHIEVEMENT</b>
                </p>
              </div>
              <div class="col-md-8 float-right table-wrapper-scroll-y">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm table-borderless table-hover">
                    <tbody style="color:#03DAC6;font-size:12px">
                      <tr v-for="(ayam, index)  in sortDesc " :key="index">
                        <th class="text-left" scope="row">{{index + 1}}</th>
                        <td class="text-left">{{ayam.nama_branch}}</td>
                        <td>{{ayam.total_booking}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card shadow">
            <div class="row card-body">
              <div class="col-md-4 float-none">
                <i class="far fa-thumbs-down fa-5x" style="color:#B00020"></i>
                <p style="font-size:12px">
                  <b>WORST ARHIEVEMENT</b>
                </p>
              </div>
              <div class="col-md-8 float-right table-wrapper-scroll-y">
                <div class="table-responsive text-nowrap">
                  <table class="table table-sm table-borderless table-hover">
                    <tbody style="color:#B00020;font-size:12px">
                      <tr v-for="(bebek, indexx)  in sortAsc " :key="indexx">
                        <th class="text-left" scope="row">{{sortAsc.length - indexx}}</th>
                        <td class="text-left">{{bebek.nama_branch}}</td>
                        <td>{{bebek.total_booking}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import VueFilter from "vue-filter";
import Vue from "vue";
import { GChart } from "vue-google-charts";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

// Vue.install(vueFilter); // Vue V1
Vue.use(VueFilter);

export default {
  components: {
    GChart,
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
      array_chart: [],
      chart_outlet: [],
      chartan: [],
      currentSort: "total_booking",
      currentSort2: "total_booking",
      currentSortDir: "desc",
      currentSortDir2: "asc",
      currentSortBranch: "branch_name",
      user_listing: [],
      frontend_dashboard_telemarketing: [],
      frontend_dashboard_leads: [],
      frontend_dashboard_booking: [],
      frontend_dashboard_deals: [],
      frontend_dashboard_brochure: [],
      brosure_baru: [],
      array_brosur: [],
      brosur: [],
      outlet: [],
      totalBrosur: 0,
      order_archivement: [],
      order_archivement2: [],
      result: [],
      tot_booking: [],
      array_branch_name: [],
      outlet_name: [],
      order_outlet: [],
      ayam: [],
      cabang: false,
      ho: false,
      tggl: "",
      selectactive: false,
      masterbooking: [],
      chartsLib: null,
      // Array will be automatically processed with visualization.arrayToDataTable function
      chartan: [
        ["Bulan", "wait"],
        ["January", 0],
        ["Febuary", 0],
        ["Maret", 0],
        ["April", 0],
        ["Mei", 0],
        ["Juni", 0],
        ["Juli", 0],
        ["Agustus", 0],
        ["September", 0],
        ["Oktober", 0],
        ["November", 0],
        ["Desember", 0]
      ],
      chartTitle: ""
    };
  },
  name: "home",
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
    let id_privileges = sessionStorage.getItem("id_privileges");
    var privilages = sessionStorage.getItem("name_privileges");
    var login = sessionStorage.getItem("login");
    var branch = sessionStorage.getItem("id_mst_branch");
    let nama_outlet = sessionStorage.getItem("mst_outlet_outlet_name");

    var index = window.location.pathname;
    var url =
      index == " " ||
      index == "/" ||
      index == "/devreport" ||
      index == "/report_tele" ||
      index == "/report_kpi" ||
      index == "/export_target" ||
      index == "/import_target";
    if (login == 1) {
      if (url) {
        console.log(login);
      } else {
        window.location = "/";
        console.log("ada cfa nih suruh kluar");
      }
    } else {
      if (url) {
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
      this.ho = true;
      this.cabang = true;
      this.isLoading = true;
      const get_branch = await this.$http.get("frontend_branch_name");
      let array_branch = get_branch.data.data;

      this.array_branch_name = array_branch;

      const aaa = await this.$http.get("frontend_mst_outlet");

      let ayam = aaa.data.data;
      // for (let a = 0; a < ayam.length; a++) {
      //   let id_otlet = ayam[a].id;
      //   const bbb = await this.$http.get("frontend_dashboard_brochure", {
      //     params: {
      //       id_mst_outlet: id_otlet,
      //       created_at: this.thn_bln
      //     }
      //   });

      //   let bebek = bbb.data.data;
      //   for (let b = 0; b < bebek.length; b++) {
      //     if (bebek[b].brosur == null) {
      //       let brosur = 0;
      //       this.array_brosur.push({ brosur });
      //     } else {
      //       let brosur = parseInt(bebek[b].brosur);
      //       this.array_brosur.push({ brosur });
      //     }
      //   }
      // }

      // let brosurTotal = this.array_brosur.reduce(function(prev, cur) {
      //   return prev + cur.brosur;
      // }, 0);

      // this.totalBrosur = brosurTotal;

      this.$http
        .get("frontend_dashboard_users")
        .then(response => (this.user_listing = response.data.data));

      this.$http
        .get("frontend_dashboard_telemarketing", {
          params: {
            created_at: this.thn_bln
          }
        })
        .then(
          response =>
            (this.frontend_dashboard_telemarketing = response.data.data)
        );

      this.$http
        .get("frontend_dashboard_leads", {
          params: {
            created_at: this.thn_bln
          }
        })
        .then(response => (this.frontend_dashboard_leads = response.data.data));

      this.$http
        .get("frontend_dashboard_booking", {
          params: {
            created_at: this.thn_bln
          }
        })
        .then(
          response => (this.frontend_dashboard_booking = response.data.data)
        );

      this.$http
        .get("frontend_dashboard_deals", {
          params: {
            created_at: this.thn_bln
          }
        })
        .then(response => (this.frontend_dashboard_deals = response.data.data));

      this.isLoading = false;

      const mas = await this.$http.get("frontend_dashboard_booking");
      this.masterbooking = mas.data.data;

      this.chartTitle = "Nasional";

      this.chartan = [
        ["Bulan", "Booking"],
        ["January", this.january],
        ["Febuary", this.febuary],
        ["Maret", this.maret],
        ["April", this.april],
        ["Mei", this.mei],
        ["Juni", this.juni],
        ["Juli", this.juli],
        ["Agustus", this.agustus],
        ["September", this.september],
        ["Oktober", this.oktober],
        ["November", this.november],
        ["Desember", this.desember]
      ];

      for (let q = 0; q < array_branch.length; q++) {
        let id_branch = array_branch[q].id;
        let nama_branch = array_branch[q].branch_name;

        const tot_booking = await this.$http.get("frontend_order_achievement", {
          params: {
            branch: id_branch,
            created_at: this.thn_bln
          }
        });

        let total_booking = tot_booking.data.data.length;
        console.log(total_booking);
        this.order_archivement.push({ nama_branch, total_booking });
        this.order_archivement2.push({ nama_branch, total_booking });
      }
    } else {
      // this.cabang = true
      this.cabang = true;
      this.isLoading = true;

      this.$http
        .get("frontend_dashboard_users", {
          params: {
            branch: branch
          }
        })
        .then(response => (this.user_listing = response.data.data));

      this.$http
        .get("frontend_dashboard_telemarketing", {
          params: {
            branch: branch,
            created_at: be
          }
        })
        .then(
          response =>
            (this.frontend_dashboard_telemarketing = response.data.data)
        );

      this.$http
        .get("frontend_dashboard_leads", {
          params: {
            branch: branch,
            created_at: be
          }
        })
        .then(response => (this.frontend_dashboard_leads = response.data.data));

      this.$http
        .get("frontend_dashboard_booking", {
          params: {
            branch: branch,
            created_at: be
          }
        })
        .then(
          response => (this.frontend_dashboard_booking = response.data.data)
        );

      this.$http
        .get("frontend_dashboard_deals", {
          params: {
            branch: branch,
            created_at: be
          }
        })
        .then(response => (this.frontend_dashboard_deals = response.data.data));

      this.isLoading = false;

      const aaa = await this.$http.get("frontend_mst_outlet", {
        params: {
          id_mst_branch: branch
        }
      });

      let ayam = aaa.data.data;
      this.outlet_name = ayam;

      const mas = await this.$http.get("frontend_dashboard_booking", {
        params: {
          branch: branch
        }
      });
      this.masterbooking = mas.data.data;
      this.chartTitle = this.nama_branch;

      this.chartan = [
        ["Bulan", "Booking"],
        ["January", this.january],
        ["Febuary", this.febuary],
        ["Maret", this.maret],
        ["April", this.april],
        ["Mei", this.mei],
        ["Juni", this.juni],
        ["Juli", this.juli],
        ["Agustus", this.agustus],
        ["September", this.september],
        ["Oktober", this.oktober],
        ["November", this.november],
        ["Desember", this.desember]
      ];

      for (let a = 0; a < ayam.length; a++) {
        let id_otlet = ayam[a].id;
        const bbb = await this.$http.get("frontend_dashboard_brochure", {
          params: {
            id_mst_outlet: id_otlet,
            created_at: be
          }
        });

        let bebek = bbb.data.data;
        for (let b = 0; b < bebek.length; b++) {
          if (bebek[b].brosur == null) {
            let brosur = 0;
            this.array_brosur.push({ brosur });
          } else {
            let brosur = parseInt(bebek[b].brosur);
            this.array_brosur.push({ brosur });
          }
        }
      }

      let brosurTotal = this.array_brosur.reduce(function(prev, cur) {
        return prev + cur.brosur;
      }, 0);

      this.totalBrosur = brosurTotal;

      const get_branch = await this.$http.get("frontend_branch_name");
      let array_branch = get_branch.data.data;
      this.array_branch_name = array_branch;
      for (let q = 0; q < array_branch.length; q++) {
        let id_branch = array_branch[q].id;
        let nama_branch = array_branch[q].branch_name;

        const tot_booking = await this.$http.get("frontend_order_achievement", {
          params: {
            branch: id_branch,
            created_at: this.thn_bln
          }
        });

        let total_booking = tot_booking.data.data.length;
        console.log(total_booking);
        this.order_archivement.push({ nama_branch, total_booking });
        this.order_archivement2.push({ nama_branch, total_booking });
      }
    }
  },
  methods: {
    onChartReady(chart, google) {
      this.chartsLib = google;
    },
    cabangg: async function(id, branch_name) {
      this.isLoading = true;
      this.selectactive = false;
      this.selectactive = true;
      let year = new Date();
      let tahun = year.getFullYear();

      const aaa = await this.$http.get("frontend_mst_outlet", {
        params: {
          id_mst_branch: id
        }
      });

      let ayam = aaa.data.data;
      this.outlet_name = ayam;
      // for (let a = 0; a < ayam.length; a++) {
      //   let id_otlet = ayam[a].id;
      //   const bbb = await this.$http.get("frontend_dashboard_brochure", {
      //     params: {
      //       id_mst_outlet: id_otlet,
      //       created_at: this.thn_bln
      //     }
      //   });

      //   let bebek = bbb.data.data;
      //   for (let b = 0; b < bebek.length; b++) {
      //     if (bebek[b].brosur == null) {
      //       let brosur = 0;
      //       this.array_brosur.push({ brosur });
      //     } else {
      //       let brosur = parseInt(bebek[b].brosur);
      //       this.array_brosur.push({ brosur });
      //     }
      //   }
      // }

      // let brosurTotal = this.array_brosur.reduce(function(prev, cur) {
      //   return prev + cur.brosur;
      // }, 0);

      // this.totalBrosur = brosurTotal;

      this.$http
        .get("frontend_dashboard_users", {
          params: {
            branch: id
          }
        })
        .then(response => (this.user_listing = response.data.data));

      this.$http
        .get("frontend_dashboard_telemarketing", {
          params: {
            branch: id,
            created_at: this.thn_bln
          }
        })
        .then(
          response =>
            (this.frontend_dashboard_telemarketing = response.data.data)
        );

      this.$http
        .get("frontend_dashboard_leads", {
          params: {
            branch: id,
            created_at: this.thn_bln
          }
        })
        .then(response => (this.frontend_dashboard_leads = response.data.data));

      this.$http
        .get("frontend_dashboard_booking", {
          params: {
            branch: id,
            created_at: this.thn_bln
          }
        })
        .then(
          response => (this.frontend_dashboard_booking = response.data.data)
        );

      this.$http
        .get("frontend_dashboard_deals", {
          params: {
            branch: id,
            created_at: this.thn_bln
          }
        })
        .then(response => (this.frontend_dashboard_deals = response.data.data));

      this.isLoading = false;

      const mas = await this.$http.get("frontend_dashboard_booking", {
        params: {
          branch: id
        }
      });
      this.masterbooking = mas.data.data;
      this.chartTitle = branch_name;

      this.chartan = [
        ["Bulan", "Booking"],
        ["January", this.january],
        ["Febuary", this.febuary],
        ["Maret", this.maret],
        ["April", this.april],
        ["Mei", this.mei],
        ["Juni", this.juni],
        ["Juli", this.juli],
        ["Agustus", this.agustus],
        ["September", this.september],
        ["Oktober", this.oktober],
        ["November", this.november],
        ["Desember", this.desember]
      ];
    },
    dioutlet: async function(id, outlet_name) {
      this.isLoading = true;
      const mas = await this.$http.get("frontend_dashboard_booking", {
        params: {
          id_mst_outlet: id
        }
      });
      this.masterbooking = mas.data.data;
      this.chartTitle = outlet_name;

      this.chartan = [
        ["Bulan", "Booking"],
        ["January", this.january],
        ["Febuary", this.febuary],
        ["Maret", this.maret],
        ["April", this.april],
        ["Mei", this.mei],
        ["Juni", this.juni],
        ["Juli", this.juli],
        ["Agustus", this.agustus],
        ["September", this.september],
        ["Oktober", this.oktober],
        ["November", this.november],
        ["Desember", this.desember]
      ];
      this.isLoading = false;
    }
  },
  computed: {
    year() {
      let d = new Date();
      let year = d.getFullYear();
      return year;
    },
    january() {
      let date = this.year + "-01";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    febuary() {
      let date = this.year + "-02";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    maret() {
      let date = this.year + "-03";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    april() {
      let date = this.year + "-04";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    mei() {
      let date = this.year + "-05";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    juni() {
      let date = this.year + "-06";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    juli() {
      let date = this.year + "-07";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    agustus() {
      let date = this.year + "-08";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    september() {
      let date = this.year + "-09";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    oktober() {
      let date = this.year + "-10";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    november() {
      let date = this.year + "-11";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    desember() {
      let date = this.year + "-12";
      return this.masterbooking.filter(function(a) {
        return (a.created_at || "").toLowerCase().includes(date.toLowerCase());
      }).length;
    },
    total_users() {
      return this.user_listing.length;
    },
    total_tele() {
      return this.frontend_dashboard_telemarketing.length;
    },
    total_leads() {
      return this.frontend_dashboard_leads.length;
    },
    total_bookings() {
      return this.frontend_dashboard_booking.length;
    },
    total_deals() {
      return this.frontend_dashboard_deals.length;
    },
    total_brochure() {
      return this.totalBrosur;
    },
    sortDesc: function() {
      function compare(a, b) {
        if (a.total_booking < b.total_booking) return 1;
        if (a.total_booking > b.total_booking) return -1;
        return 0;
      }

      return this.order_archivement.sort(compare);
    },
    sortAsc: function() {
      function compare(a, b) {
        if (a.total_booking < b.total_booking) return -1;
        if (a.total_booking > b.total_booking) return 1;
        return 0;
      }

      return this.order_archivement2.sort(compare);
    },
    thn_bln() {
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
    tahun(){
       let d = new Date();
      let year = d.getFullYear();
      return year
    },

    sortCabang: function() {
      function compare(a, b) {
        if (a.branch_name < b.branch_name) return -1;
        if (a.branch_name > b.branch_name) return 1;
        return 0;
      }

      return this.array_branch_name.sort(compare);
    },
    chartOptions() {
      if (!this.chartsLib) return null;
      return this.chartsLib.charts.Bar.convertOptions({
        chart: {
          title: "Booking Performance " + this.chartTitle,
          subtitle: 'Tahun '+ this.tahun
        },
        bars: "vertical", // Required for Material Bar Charts.
        hAxis: { format: "decimal" },
        colors: ["#1b9e77", "#d95f02", "#7570b3"]
      });
    },
    nama_branch() {
      let nama_branch = sessionStorage.getItem("mst_branch_name");
      return nama_branch;
    }
  }
};
</script>
<style>
</style>
