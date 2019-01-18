<template>
  <div class="home">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <h5>
            <b>USERS MANAGEMENT</b>
          </h5>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link">
          <button
            type="button"
            class="btn btn-info btn-sm"
            data-toggle="modal"
            data-target="#create_account"
          >Add Users</button>
        </a>
      </li>
    </ul>
    <br>

    <div class="table-responsive table-hover table-sm">
      <table class="table" style="width:100%">
        <thead style="overflow: auto;
white-space: nowrap;">
          <tr style="font-size:12px" class="table shadow">
            <!-- <th scope="col">#</th> -->
            <th scope="col" @click="sort('name')">Outlet</th>
            <th scope="col" @click="sort('cms_privileges_name')">Total</th>
            <th scope="col" @click="sort('mst_outlet_outlet_name')">Active</th>
            <th scope="col" @click="sort('npm')">Non Active</th>
            <th scope="col" @click="sort('status')">New</th>
            <!-- <th scope="col" @click="sort('status')">Resign</th> -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in arrayKPIUsers" class="table shadow" style="font-size:12px">
            <td class="text-left" v-on:click="filterOutlet(user.id)">{{user.outlet}}</td>
            <td class="text-center">{{user.total}}</td>
            <td class="text-center">{{user.active}}</td>
            <td class="text-center">{{user.noactive}}</td>
            <td class="text-center">{{user.news}}</td>
            <!-- <td class="text-center">{{user.resign}}</td> -->
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="edit"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="#" v-on:submit.prevent="editUsers">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">EDIT USERS</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="form-group">
                <div class="form-group row">
                  <label
                    for="inputEmail3"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>NAME</b>
                  </label>
                  <div class="col-sm-9">
                    <input
                      v-model="DetailUsersName"
                      type="text"
                      class="form-control form-control-sm"
                      placeholder="Name"
                    >
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="npm"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>NPM</b>
                  </label>
                  <div class="col-sm-9">
                    <input
                      minlength="5"
                      v-model="DetailUsersNPM"
                      type="text"
                      class="form-control form-control-sm"
                      placeholder="npm"
                    >
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="npm"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>EMAIL</b>
                  </label>
                  <div class="col-sm-9">
                    <input
                      v-model="DetailUsersEmail"
                      type="email"
                      class="form-control form-control-sm"
                      placeholder="email"
                    >
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="npm"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>RESET PASSWORD</b>
                  </label>
                  <div class="col-sm-9">
                    <input
                      v-model="newPassword"
                      type="password"
                      class="form-control form-control-sm"
                      placeholder="Masukan Password Baru"
                    >
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="npm"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>OUTLET</b>
                  </label>
                  <div class="col-sm-9">
                    <select v-model="DetailUsersOutlet" class="form-control form-control-sm">
                      <option disabled value>Pilih Outlet</option>
                      <option
                        v-for="outlet in outlet"
                        v-bind:value="outlet.id"
                      >{{ outlet.outlet_name }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="npm"
                    style="font-size:12px"
                    class="text text-left col-sm-3 col-form-label"
                  >
                    <b>PRIVILEGES</b>
                  </label>
                  <div class="col-sm-9">
                    <select v-model="DetailUsersPrivileges" class="form-control form-control-sm">
                      <option disabled value>Pilih Privilages</option>
                      <option
                        v-show="cb"
                        v-for="p in selectPrivilagesCB"
                        v-bind:value="p.id"
                      >{{ p.name }}</option>
                      <option
                        v-show="ho"
                        v-for="p in selectPrivilagesHO"
                        v-bind:value="p.id"
                      >{{ p.name }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label style="font-size:12px" class="text text-left col-sm-3 col-form-label">
                    <b>STATUS</b>
                  </label>
                  <div class="col-sm-9">
                    <select
                      v-show="cb"
                      v-model="DetailUsersStatus"
                      class="form-control form-control-sm"
                    >
                      <option disabled value>Pilih Status</option>
                      <option v-for="s in arrayStatus" v-bind:value="s.id">{{ s.name }}</option>
                    </select>
                    <select
                      v-show="ho"
                      v-model="DetailUsersStatus"
                      class="form-control form-control-sm"
                    >
                      <option disabled value>Pilih Status</option>
                      <option v-for="s in arrayStatusHO" v-bind:value="s.id">{{ s.name }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button class="btn btn-sm btn-info" type="submit">Edit</button>
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="create_account">
      <div class="modal-dialog">
        <div class="modal-content">
          <form v-on:submit.prevent="add_users">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">ADD USERS</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="form-group row">
                <label for="npm" style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>NPM</b>
                </label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control form-control-sm"
                    placeholder="Example M1234"
                    v-model="npm"
                  >
                </div>
              </div>
              <div class="form-group row">
                <label for="npm" style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>NAME</b>
                </label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control form-control-sm"
                    v-model="name"
                    placeholder="example"
                  >
                </div>
              </div>
              <div class="form-group row">
                <label for="npm" style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>EMAIL</b>
                </label>
                <div class="col-sm-10">
                  <input
                    type="email"
                    class="form-control form-control-sm"
                    v-model="email"
                    placeholder="mail@example.com"
                    id="email"
                  >
                </div>
              </div>
              <div class="form-group row">
                <label for="npm" style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>PASSWORD</b>
                </label>
                <div class="col-sm-10">
                  <input
                    type="password"
                    class="form-control form-control-sm"
                    v-model="password"
                    placeholder="Password"
                  >
                </div>
              </div>
              <div class="form-group row">
                <label for="npm" style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>PHOTO</b>
                </label>
                <div class="col-sm-10">
                  <input
                    type="file"
                    class="form-control-file form-control-sm"
                    id="files"
                    ref="file"
                    v-on:change="handleFileUpload()"
                  >
                </div>
              </div>
              <div v-show="ho" class="form-group row">
                <label for="npm" style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>CABANG</b>
                </label>
                <div class="col-sm-10">
                  <div>
                    <select v-model="default_cabang_create" class="form-control form-control-sm">
                      <option disabled value>Pilih Cabang</option>
                      <option
                        v-for="branch in sortBranch"
                        v-bind:value="branch.id"
                      >{{ branch.branch_name }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div v-show="ho" class="form-group row">
                <label style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>OUTLET</b>
                </label>
                <div class="col-sm-10">
                  <select v-model="outlet_id" class="form-control form-control-sm">
                    <option disabled value>Pilih Outlet</option>
                    <option
                      v-for="outlet in SelectOutletHO"
                      v-bind:value="outlet.id"
                    >{{ outlet.outlet_name }}</option>
                  </select>
                </div>
              </div>

              <div v-show="cb" class="form-group row">
                <label style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>OUTLET</b>
                </label>
                <div class="col-sm-10">
                  <select v-model="outlet_id" class="form-control form-control-sm">
                    <option disabled value>Pilih Outlet</option>
                    <option
                      v-for="outlet in outlet"
                      v-bind:value="outlet.id"
                    >{{ outlet.outlet_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>PRIVILEGES</b>
                </label>
                <div class="col-sm-10">
                  <select v-model="default_privilages" class="form-control form-control-sm">
                    <option disabled value>Pilih Privilegs</option>
                    <option
                      v-show="cb"
                      v-for="p in selectPrivilagesCB"
                      v-bind:value="p.id"
                    >{{ p.name }}</option>
                    <option
                      v-show="ho"
                      v-for="p in selectPrivilagesHO"
                      v-bind:value="p.id"
                    >{{ p.name }}</option>
                  </select>
                </div>
              </div>

              <div v-show="ho" class="form-group row">
                <label style="font-size:13px" class="text-left col-sm-2 col-form-label">
                  <b>STATUS</b>
                </label>
                <div class="col-sm-10">
                  <select v-model="default_status" class="form-control form-control-sm">
                    <option disabled value>Pilih Outlet</option>
                    <option v-for="s in arrayStatusHO" v-bind:value="s.id">{{ s.name }}</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button class="btn btn-sm btn-info" type="submit">Create</button>
              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <form class="form-inline" role="form">
      <div class="input-group">
        <div class="form-group">
          <input
            type="text"
            class="form-control form-control-sm"
            v-model="search"
            placeholder="Search"
          >
        </div>
      </div>
      <div v-show="ho">
        <select v-model="default_branch" class="form-control form-control-sm">
          <option disabled value>Pilih Branch</option>
          <option v-for="branch in sortBranch" v-bind:value="branch.id">{{ branch.branch_name }}</option>
        </select>
        <button type="button" class="btn btn-info btn-sm" v-on:click="cabangg(default_branch)">Cari</button>
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
            <th scope="col" @click="sort('cms_privileges_name')">
              PRIVILEGES
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('mst_outlet_outlet_name')">
              OUTLET
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('npm')">
              NPM
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('created_at')">
              Tanggal
              <i class="fas fa-sort"></i>
            </th>
            <th scope="col" @click="sort('status')">
              STATUS
              <i class="fas fa-sort"></i>
            </th>

            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="table shadow"
            style="font-size:12px"
            v-for="(user, index) in (  sortedActivity,filteredList   )"
            :key="index"
          >
            <!-- <td>{{index + 1}}</td> -->
            <td class="text-left">{{user.name}}</td>
            <td class="text-left">{{user.cms_privileges_name}}</td>
            <td class="text-left">{{user.mst_outlet_outlet_name}}</td>
            <td class="text-center">{{user.npm}}</td>
            <td class="text-center">{{user.created_at}}</td>
            <td class="text-center">{{user.status}}</td>
            <td>
              <button
                type="button"
                class="btn btn-info btn-sm"
                v-on:click="getUsersDetail(user.id)"
                data-toggle="modal"
                data-target="#edit"
              >Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "home",
  data() {
    return {
      npm: "",

      idusers: "",
      name: "",
      password: "",
      email: "",
      file: "",
      branch: [],
      privilages: [],
      default_privilages: 3,
      default_branch: "",
      default_status: "Not Active",
      default_cabang_create: "",
      outlet: [],
      outlet_id: "",
      idOutlet: "",
      outlet_head: "",
      arrayKPIUsers: [],
      ho: true,
      cb: false,
      outlet_head_default: "",
      ayam: [],
      outlet_yg_dipilih: "",
      users_create: [],
      post_data: [],
      currentSort: "created_at",
      currentSortDir: "desc",
      currentPage: 1,
      search: "",
      searchSelection: "",
      pageSize: 1000,
      DetailUsers: [],
      newPassword: "",
      id_privileges: "",
      id_mst_branch: "",
      arrayStatus: [
        { id: "n", name: "Not Active" }
        // { id: "Resign", name: "Resign" }
      ],
      arrayStatusHO: [
        { id: "y", name: "Active" },
        { id: "n", name: "Not Active" }
        // { id: "Resign", name: "Resign" }
      ]
    };
  },
  methods: {
    async cabangg(id) {
      if (this.default_branch == "") {
        alert("Silahkan Pilih Cabang ");
      } else {
        this.ayam = [];
        this.arrayKPIUsers = [];
        const aaa = await this.$http.get("frontend_account_read", {
          params: {
            branch: id
          }
        });
        this.ayam = aaa.data.data;
        this.kpi();
      }
    },
    sort: function(s) {
      if (s === this.currentSort) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      }
      this.currentSort = s;
    },
    nextPage: function() {
      if (this.currentPage * this.pageSize < this.ayam.length)
        this.currentPage++;
    },
    prevPage: function() {
      if (this.currentPage > 1) this.currentPage--;
    },
    handleFileUpload() {
      this.file = this.$refs.file.files[0];
    },
    async filterOutlet(id) {
      const get = await this.$http.get("frontend_account_read", {
        params: {
          id_mst_outlet: id
        }
      });
    },
    async add_users() {
      if (this.id_privileges !== 5) {
        this.ho = false;
        this.default_status = "Not Active";
      }
      let formData = new FormData();
      let file = this.file;
      formData.append("photo", file);
      formData.append("npm", this.npm);
      formData.append("name", this.name);
      formData.append("password", this.password);
      formData.append("email", this.email);
      formData.append("status", this.default_status);
      formData.append("id_cms_privileges", this.default_privilages);
      formData.append("id_mst_outlet", this.outlet_id);
      formData.append("created_by", this.idusers);

      try {
        const getceknpm = await this.$http.get("frontend_account_read", {
          params: {
            npm: this.npm
          }
        });
        this.ceknpm = getceknpm.data.data.length;
        if (this.ceknpm == 1) {
          alert("NPM Sudah Ada");
        } else {
          
          this.arrayKPIUsers = [];
          var post_data = await this.$http.post(
            "frontend_account_create",
            formData,
            {
              headers: {
                "Content-Type": "multipart/form-data"
              }
            }
          );

          this.post_data = post_data.data;
          if (this.post_data.api_status == 1) {
            this.ayam = [];
            if (this.id_privileges == 5) {
              const getdetailusers = await this.$http.get(
                "frontend_account_read",
                {
                  params: {
                    branch: this.default_branch
                  }
                }
              );
              this.ayam = getdetailusers.data.data;
            } else {
              const getdetailusers = await this.$http.get(
                "frontend_account_read",
                {
                  params: {
                    branch: this.id_mst_branch
                  }
                }
              );
              this.ayam = getdetailusers.data.data;
            }
            if (this.id_privileges == 5) {
              console.log("ho ga reload kpi");
            } else {
              this.kpi();
            }
            this.name = "";
            this.npm = "";
            this.email = "";
            this.password = "";
            this.default_status = "Not Active";
            this.default_privilages = 3;
            this.file = "";
            this.outlet_id = "";
            $("#create_account").modal("hide");
          } else {
            alert(this.post_data.api_message);
          }
        }
      } catch (error) {
        console.log(error);
      }
    },
    async getUsersDetail(id) {
      this.DetailUsers = [];
      this.newPassword = "";
      const getdetailusers = await this.$http.get("frontend_account_details", {
        params: {
          id: id
        }
      });
      this.DetailUsers = getdetailusers.data;
    },
    kpi() {
      for (let i = 0; i < this.uniqueOutlet.length; i++) {
        this.idOutlet = this.uniqueOutlet[i].id_mst_outlet;
        let id = this.idOutlet;
        let outlet = this.uniqueOutlet[i].mst_outlet_outlet_name;
        let total = this.TotalUsersOutlet;
        let active = this.TotalUsersActive;
        let noactive = this.TotalUsersNotActive;
        let news = this.TotalUsersNew;
        let resign = this.TotalUsersResign;

        this.arrayKPIUsers.push({
          id,
          outlet,
          total,
          active,
          noactive,
          news,
          resign
        });
      }
    },
    async editUsers() {
      $("#edit").modal("hide");
      this.ayam = [];
      this.arrayKPIUsers = [];
      try {
        const postusers = await this.$http.post("frontend_account_edit", {
          id: this.DetailUsersId,
          name: this.DetailUsersName,
          password: this.newPassword,
          email: this.DetailUsersEmail,
          id_cms_privileges: this.DetailUsersPrivileges,
          id_mst_outlet: this.DetailUsersOutlet,
          status: this.DetailUsersStatus
        });

        if (this.id_privileges == 5) {
          const getdetailusers = await this.$http.get("frontend_account_read", {
            params: {
              branch: this.default_branch
            }
          });
          this.ayam = getdetailusers.data.data;
        } else {
          const getdetailusers = await this.$http.get("frontend_account_read", {
            params: {
              branch: this.id_mst_branch
            }
          });
          this.ayam = getdetailusers.data.data;
        }

        this.kpi();
      } catch (error) {
        alert(error);
      }
    }
  },
  async mounted() {
    var privilages = sessionStorage.getItem("name_privileges");
    this.id_privileges = sessionStorage.getItem("id_privileges");
    this.id_mst_branch = sessionStorage.getItem("id_mst_branch");
    this.idusers = sessionStorage.getItem("id");
    var login = sessionStorage.getItem("login");
    var index = window.location.pathname;
    var url =
      index == " " ||
      index == "/" ||
      index == "/setting" ||
      index == "/report_tele" ||
      index == "/report_kpi" ||
      index == "/export_target" ||
      index == "/users";
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

    if (this.id_privileges == 5) {
      const aaa = await this.$http.get("frontend_account_read", {
        params: {
          branch: ""
        }
      });
      this.ayam = aaa.data.data;
      const bran = await this.$http.get("frontend_branch_name");
      this.branch = bran.data.data;
      this.$http
        .get("frontend_mst_outlet", {
          params: {
            id_mst_branch: ""
          }
        })
        .then(response => (this.outlet = response.data.data));
    } else {
      this.ho = false;
      this.cb = true;
      const aaa = await this.$http.get("frontend_account_read", {
        params: {
          branch: this.id_mst_branch
        }
      });
      this.ayam = aaa.data.data;
      this.$http
        .get("frontend_mst_outlet", {
          params: {
            id_mst_branch: this.id_mst_branch
          }
        })
        .then(response => (this.outlet = response.data.data));
      this.kpi();
    }

    this.$http
      .get("frontend_privileges")
      .then(response => (this.privilages = response.data.data));
  },
  computed: {
    TotalUsersOutlet() {
      let x = this.idOutlet;
      return this.ayam.filter(function(a) {
        return a.id_mst_outlet == x;
      }).length;
    },
    TotalUsersActive() {
      let x = this.idOutlet;
      let active = "Active";
      return this.ayam.filter(function(a) {
        return (
          a.id_mst_outlet == x &&
          (a.status || "").toLowerCase().includes(active.toLowerCase())
        );
      }).length;
    },
    TotalUsersNotActive() {
      let x = this.idOutlet;
      let notActive = "Not Active";
      return this.ayam.filter(function(a) {
        return (
          a.id_mst_outlet == x &&
          (a.status || "").toLowerCase().includes(notActive.toLowerCase())
        );
      }).length;
    },
    TotalUsersResign() {
      let x = this.idOutlet;
      let resign = "Resign";
      return this.ayam.filter(function(a) {
        return (
          a.id_mst_outlet == x &&
          (a.status || "").toLowerCase().includes(resign.toLowerCase())
        );
      }).length;
    },
    TotalUsersNew() {
      let x = this.idOutlet;
      let news = this.be;
      return this.ayam.filter(function(a) {
        return (
          a.id_mst_outlet == x &&
          (a.created_at || "").toLowerCase().includes(news.toLowerCase())
        );
      }).length;
    },
    getValue() {
      // udah ye
      if (this.outlet_yg_dipilih !== "") {
        console.log(`Coba ${this.outlet_yg_dipilih}`);
        let x = this.outlet_yg_dipilih;
        return this.ayam.filter(function(list) {
          return list.id_mst_outlet == x;
        });
      } else {
        console.log("select pertama belum di pilih");
        return this.users;
      }
    },
    uniqueOutlet: function() {
      var existingIds = {};
      return this.ayam.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    },
    sortedActivity: function() {
      return this.ayam
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
      return this.ayam
        .filter(data => {
          return (
            (data.name || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            (data.cms_privileges_name || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            (data.mst_outlet_outlet_name || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            (data.status || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            (data.created_at || "")
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            (data.npm || "").toLowerCase().includes(this.search.toLowerCase())
          );
        })
        .filter((row, index) => {
          let start = (this.currentPage - 1) * this.pageSize;
          let end = this.currentPage * this.pageSize;
          if (index >= start && index < end) return true;
        });
    },
    DetailUsersId: {
      get: function() {
        return this.DetailUsers.id;
      },
      set: function(a) {
        this.DetailUsers.id = a;
      }
    },
    DetailUsersName: {
      get: function() {
        return this.DetailUsers.name;
      },
      set: function(a) {
        this.DetailUsers.name = a;
      }
    },
    DetailUsersNPM: {
      get: function() {
        return this.DetailUsers.npm;
      },
      set: function(a) {
        this.DetailUsers.npm = a;
      }
    },
    DetailUsersEmail: {
      get: function() {
        return this.DetailUsers.email;
      },
      set: function(a) {
        this.DetailUsers.email = a;
      }
    },
    DetailUsersOutlet: {
      get: function() {
        return this.DetailUsers.id_mst_outlet;
      },
      set: function(a) {
        this.DetailUsers.id_mst_outlet = a;
      }
    },
    DetailUsersPrivileges: {
      get: function() {
        return this.DetailUsers.id_cms_privileges;
      },
      set: function(a) {
        this.DetailUsers.id_cms_privileges = a;
      }
    },
    DetailUsersStatus: {
      get: function() {
        return this.DetailUsers.status;
      },
      set: function(a) {
        this.DetailUsers.status = a;
      }
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
    sortBranch: function() {
      function compare(a, b) {
        if (a.branch_name < b.branch_name) return -1;
        if (a.branch_name > b.branch_name) return 1;
        return 0;
      }

      return this.branch.sort(compare);
    },
    selectPrivilagesCB() {
      return this.privilages.filter(data => {
        return data.id == 3 || data.id == 6;
      });
    },
    selectPrivilagesHO() {
      return this.privilages.filter(data => {
        return data.id !== 1;
      });
    },
    SelectOutletHO() {
      return this.outlet.filter(data => {
        return data.id_mst_branch == this.default_cabang_create;
      });
    }
  }
};
</script>
