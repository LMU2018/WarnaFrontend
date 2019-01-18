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
    <div
      class="modal fade"
      id="exampleModalLong"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="#" v-on:submit.prevent="edit">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th class="text-left">
                            <label for="firstname">Firstname</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="firstname"
                              v-model="firstname"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label for="lastname">Lastname</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="lastname"
                              v-model="lastname"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label for="firstname">Users</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="firstname"
                              v-model="userss"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label for="lastname">Sources</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="lastname"
                              v-model="sources"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label for="firstname">Tanggal</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="tanggal"
                              v-model="tanggal"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label for="lastname">Status</label>
                          </th>
                          <th>
                            <select v-model="status" class="form-control form-control-sm">
                              <option
                                v-for="stst in order_mst_status"
                                v-bind:value="stst.id"
                              >{{ stst.status }}</option>
                            </select>
                          </th>
                        </tr>
                        <tr v-if="status == 3">
                          <th>
                            <label for="lastname">Reason</label>
                          </th>
                          <th>
                            <select
                              v-model="reason"
                              class="form-control form-control-sm"
                              required
                              oninvalid="this.setCustomValidity('Nama Files Wajib Di isi')"
                              oninput="setCustomValidity('')"
                              autofocus
                            >
                              <option
                                v-for="r in mst_reason_cancel"
                                v-bind:value="r.id"
                              >{{ r.reason }}</option>
                            </select>
                          </th>
                        </tr>
                        <tr v-if="status == 4">
                          <th>
                            <label for="lastname">Alasan</label>
                          </th>
                          <th>
                            <select
                              v-model="reason"
                              class="form-control form-control-sm"
                              required
                              oninvalid="this.setCustomValidity('Alasan Wajib Di isi')"
                              oninput="setCustomValidity('')"
                              autofocus
                            >
                              <option
                                v-for="r in mst_reason_reject"
                                v-bind:value="r.id"
                              >{{ r.reason }}</option>
                            </select>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class style="background:#2E3A50;color:#fff;height:25px;font-size:15px">
                <b>Product UFI</b>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Nopol</label>
                          </th>
                          <th>
                            <input
                              readonly
                              type="text"
                              class="form-control form-control-sm"
                              id="nopol"
                              v-model="nopol"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>OTR</label>
                          </th>
                          <th>
                            <input
                              readonly
                              type="text"
                              class="form-control form-control-sm"
                              id="otr"
                              v-model="otr"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Tahun</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="tahun"
                              v-model="tahun"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Plafon</label>
                          </th>
                          <th>
                            <input
                              type="number"
                              class="form-control form-control-sm"
                              id="tahun"
                              v-model="plafon"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Type Unit</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="nopol"
                              v-model="unit"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>DP</label>
                          </th>
                          <th>
                            <input
                              type="number"
                              class="form-control form-control-sm"
                              id="nopol"
                              v-model="autodp"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Model</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="tahun"
                              v-model="model"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Angsuran</label>
                          </th>
                          <th>
                            <input
                              type="number"
                              class="form-control form-control-sm"
                              id="tahun"
                              v-model="angsuran"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Merk</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="nopol"
                              v-model="merk"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Tenor</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              class="form-control form-control-sm"
                              id="nopol"
                              v-model="tenor"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Pajak</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="tahun"
                              v-model="pajak"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Penjamin</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="nopol"
                              v-model="penjamin"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Nama BPKB</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="nopol"
                              v-model="bpkb"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive-sm">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th>
                            <label>Keperluan</label>
                          </th>
                          <th>
                            <input
                              type="text"
                              readonly
                              class="form-control form-control-sm"
                              id="tahun"
                              v-model="keperluan"
                            >
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button v-show="orr" class="btn btn-sm btn-info">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <nav>
      <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
        <a
          class="nav-item nav-link active"
          id="nav-prosfecting-tab"
          data-toggle="tab"
          href="#nav-prosfecting"
          role="tab"
          aria-controls="nav-prosfecting"
          aria-selected="true"
        >PROSPECTING</a>
        <a
          class="nav-item nav-link"
          id="nav-qualifed-tab"
          data-toggle="tab"
          href="#nav-qualifed"
          role="tab"
          aria-controls="nav-qualifed"
          aria-selected="false"
        >QUALIFED</a>
        <a
          class="nav-item nav-link"
          id="nav-won-tab"
          data-toggle="tab"
          href="#nav-won"
          role="tab"
          aria-controls="nav-won"
          aria-selected="false"
        >WON</a>
        <a
          class="nav-item nav-link"
          id="nav-unqualifed-tab"
          data-toggle="tab"
          href="#nav-unqualifed"
          role="tab"
          aria-controls="nav-unqualifed"
          aria-selected="false"
        >UNQUALIFIED</a>
        <a
          class="nav-item nav-link"
          id="nav-lost-tab"
          data-toggle="tab"
          href="#nav-lost"
          role="tab"
          aria-controls="nav-lost"
          aria-selected="false"
        >LOST</a>
      </div>
    </nav>
     <!-- <form class="form-inline" role="form">
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
    </form> -->
    <div class="tab-content" id="nav-tabContent">
      <div
        class="tab-pane fade show active"
        id="nav-prosfecting"
        role="tabpanel"
        aria-labelledby="nav-prosfecting-tab"
      >
        <div class="table-responsive table-hover" style="overflow: auto;
white-space: nowrap;">
          <table class="table table-sm">
            <thead width="400px">
              <tr class="table shadow" style="font-size:12px">
                <th scope="col">#</th>
                <th scope="col" @click="sort('npm')">Tanggal</th>
                <th scope="col" @click="sort('name')">Firstname</th>
                <th scope="col" @click="sort('cms_privileges_name')">LastName</th>
                <th scope="col" @click="sort('brosur_count')">Merk</th>
                <th scope="col" @click="sort('leads_count')">Type</th>
                <th scope="col" @click="sort('order_count')">Year</th>
                <th scope="col" @click="sort('target_calls_count')">Plafon</th>
                <th scope="col" @click="sort('booking_count')">Installment</th>
                <th scope="col" @click="sort('booking_count')">Tenor</th>
                <th scope="col" @click="sort('booking_count')">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="table shadow"
                style="font-size:12px"
                v-for="(user, index) in (sortDescprospecting)"
                :key="index"
              >
                <td>{{index + 1}}</td>
                <td>{{user.created_at}}</td>
                <td>{{user.contact_first_name}}</td>
                <td>{{user.contact_last_name}}</td>
                <td>{{user.merk}}</td>
                <td>{{user.type}}</td>
                <td>{{user.year}}</td>
                <td>{{user.plafon}}</td>
                <td>{{user.installment}}</td>
                <td>{{user.tenor}}</td>
                <td>{{user.order_mst_status_status}}</td>
                <td>
                  <button
                    type="button"
                    v-on:click="get_order(user.id)"
                    class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#exampleModalLong"
                  >Edit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="nav-qualifed"
        role="tabpanel"
        aria-labelledby="nav-qualifed-tab"
      >
        <div class="table-responsive table-hover" style="overflow: auto;
white-space: nowrap;">
          <table class="table table-sm">
            <thead width="400px">
              <tr class="table shadow" style="font-size:12px">
                <th scope="col">#</th>
                <th scope="col" @click="sort('npm')">Tanggal</th>
                <th scope="col" @click="sort('name')">Firstname</th>
                <th scope="col" @click="sort('cms_privileges_name')">LastName</th>
                <th scope="col" @click="sort('brosur_count')">Merk</th>
                <th scope="col" @click="sort('leads_count')">Type</th>
                <th scope="col" @click="sort('order_count')">Year</th>
                <th scope="col" @click="sort('target_calls_count')">Plafon</th>
                <th scope="col" @click="sort('booking_count')">Installment</th>
                <th scope="col" @click="sort('booking_count')">Tenor</th>
                <th scope="col" @click="sort('booking_count')">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="table shadow"
                style="font-size:12px"
                v-for="(user, index) in (sortDescqualifed)"
                :key="index"
              >
                <td>{{index + 1}}</td>
                <td>{{user.created_at}}</td>
                <td>{{user.contact_first_name}}</td>
                <td>{{user.contact_last_name}}</td>
                <td>{{user.merk}}</td>
                <td>{{user.type}}</td>
                <td>{{user.year}}</td>
                <td>{{user.plafon}}</td>
                <td>{{user.installment}}</td>
                <td>{{user.tenor}}</td>
                <td>{{user.order_mst_status_status}}</td>
                <td>
                  <button
                    type="button"
                    v-on:click="get_order(user.id)"
                    class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#exampleModalLong"
                  >Edit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-won" role="tabpanel" aria-labelledby="nav-won-tab">
        <div class="table-responsive table-hover" style="overflow: auto;
white-space: nowrap;">
          <table class="table table-sm">
            <thead width="400px">
              <tr class="table shadow" style="font-size:12px">
                <th scope="col">#</th>
                <th scope="col" @click="sort('npm')">Tanggal</th>
                <th scope="col" @click="sort('name')">Firstname</th>
                <th scope="col" @click="sort('cms_privileges_name')">LastName</th>
                <th scope="col" @click="sort('brosur_count')">Merk</th>
                <th scope="col" @click="sort('leads_count')">Type</th>
                <th scope="col" @click="sort('order_count')">Year</th>
                <th scope="col" @click="sort('target_calls_count')">Plafon</th>
                <th scope="col" @click="sort('booking_count')">Installment</th>
                <th scope="col" @click="sort('booking_count')">Tenor</th>
                <th scope="col" @click="sort('booking_count')">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="table shadow"
                style="font-size:12px"
                v-for="(user, index) in (sortDescwon)"
                :key="index"
              >
                <td>{{index + 1}}</td>
                <td>{{user.created_at}}</td>
                <td>{{user.contact_first_name}}</td>
                <td>{{user.contact_last_name}}</td>
                <td>{{user.merk}}</td>
                <td>{{user.type}}</td>
                <td>{{user.year}}</td>
                <td>{{user.plafon}}</td>
                <td>{{user.installment}}</td>
                <td>{{user.tenor}}</td>
                <td>{{user.order_mst_status_status}}</td>
                <td>
                  <button
                    type="button"
                    v-on:click="get_order(user.id)"
                    class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#exampleModalLong"
                  >Edit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="nav-unqualifed"
        role="tabpanel"
        aria-labelledby="nav-unqualifed-tab"
      >
        <div class="table-responsive table-hover" style="overflow: auto;
white-space: nowrap;">
          <table class="table table-sm">
            <thead width="400px">
              <tr class="table shadow" style="font-size:12px">
                <th scope="col">#</th>
                <th scope="col" @click="sort('npm')">Tanggal</th>
                <th scope="col" @click="sort('name')">Firstname</th>
                <th scope="col" @click="sort('cms_privileges_name')">LastName</th>
                <th scope="col" @click="sort('brosur_count')">Merk</th>
                <th scope="col" @click="sort('leads_count')">Type</th>
                <th scope="col" @click="sort('order_count')">Year</th>
                <th scope="col" @click="sort('target_calls_count')">Plafon</th>
                <th scope="col" @click="sort('booking_count')">Installment</th>
                <th scope="col" @click="sort('booking_count')">Tenor</th>
                <th scope="col" @click="sort('booking_count')">Status</th>
                <th scope="col" @click="sort('booking_count')">Alasan</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="table shadow"
                style="font-size:12px"
                v-for="(user, index) in (sortDescunqualifed)"
                :key="index"
              >
                <td>{{index + 1}}</td>
                <td>{{user.created_at}}</td>
                <td>{{user.contact_first_name}}</td>
                <td>{{user.contact_last_name}}</td>
                <td>{{user.merk}}</td>
                <td>{{user.type}}</td>
                <td>{{user.year}}</td>
                <td>{{user.plafon}}</td>
                <td>{{user.installment}}</td>
                <td>{{user.tenor}}</td>
                <td>{{user.order_mst_status_status}}</td>
                <td>{{user.order_mst_reason_reason}}</td>
                <td>
                  <button
                    type="button"
                    v-on:click="get_order(user.id)"
                    class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#exampleModalLong"
                  >Edit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-lost" role="tabpanel" aria-labelledby="nav-lost-tab">
        <div class="table-responsive table-hover">
          <table class="table table-sm">
            <thead width="400px">
              <tr class="table shadow" style="font-size:12px">
                <th scope="col">#</th>
                <th scope="col" @click="sort('npm')">Tanggal</th>
                <th scope="col" @click="sort('name')">Firstname</th>
                <th scope="col" @click="sort('cms_privileges_name')">LastName</th>
                <th scope="col" @click="sort('brosur_count')">Merk</th>
                <th scope="col" @click="sort('leads_count')">Type</th>
                <th scope="col" @click="sort('order_count')">Year</th>
                <th scope="col" @click="sort('target_calls_count')">Plafon</th>
                <th scope="col" @click="sort('booking_count')">Installment</th>
                <th scope="col" @click="sort('booking_count')">Tenor</th>
                <th scope="col" @click="sort('booking_count')">Status</th>
                <th scope="col" @click="sort('booking_count')">Alasan</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="table shadow"
                style="font-size:12px"
                v-for="(user, index) in (sortDesclost)"
                :key="index"
              >
                <td>{{index + 1}}</td>
                <td>{{user.created_at}}</td>
                <td>{{user.contact_first_name}}</td>
                <td>{{user.contact_last_name}}</td>
                <td>{{user.merk}}</td>
                <td>{{user.type}}</td>
                <td>{{user.year}}</td>
                <td>{{user.plafon}}</td>
                <td>{{user.installment}}</td>
                <td>{{user.tenor}}</td>
                <td>{{user.order_mst_status_status}}</td>
                <td>{{user.order_mst_reason_reason}}</td>
                <td>
                  <button
                    type="button"
                    v-on:click="get_order(user.id)"
                    class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#exampleModalLong"
                  >Edit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
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
      search: "",
      searchSelection: "",
      pageSize: 10000,
      currentPage: 1,
      isLoading: false,
      color: "#007bff",
      height: 128,
      width: 128,
      loader: "dots",
      fullPage: true,
      order: [],
      order_mst_status: [],
      prosfecting: [],
      qualifed: [],
      won: [],
      unqualifed: [],
      lost: [],
      frontend_order_detail: [],
      frontend_order_detailll: [],
      filter_branch: "",
      orr: true,
      select_reason: true,
      mst_reason_reject: [],
      mst_reason_cancel: []
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
    get_order: async function(id) {
      this.isLoading = true;
      this.$http
        .get("frontend_order_detail", {
          params: {
            id: id
          }
        })
        .then(response => (this.frontend_order_detail = response.data));

      this.isLoading = false;
    },
    edit: async function() {
      $("#exampleModalLong").modal("hide");
      this.isLoading = true;
      try {
        let userid = sessionStorage.getItem("id");
        userid = parseInt(userid);
        let autodp = parseInt(this.autodp);
        let plafon = parseInt(this.plafon);

        const id_loan = await this.$http.get("frontend_order_id_loan", {
          params: {
            id_order: this.id_order
          }
        });
        let idloan = id_loan.data.id;
        if (this.status == 3 || this.status == 4) {
          var response = await this.$http.post("frontend_order_edit_status", {
            id: this.id_order,
            id_order_mst_reason: this.reason,
            id_order_mst_status: this.status,
            updated_by: userid
          });
        } else {
          var response = await this.$http.post("frontend_order_edit_status", {
            id: this.id_order,
            id_order_mst_status: this.status,
            updated_by: userid,
            id_order_mst_reason: '',
          });
        }

        const loan = await this.$http.post("frontend_order_edit_loan", {
          id: idloan,
          plafond: plafon,
          down_payment: this.autodp,
          installment: this.angsuran,
          tenor: this.tenor,
          updated_by: userid
        });

        alert("sukses edit");
      } catch (error) {
        alert("error");
        console.log(error);
      }
      this.prosfecting = [];
      this.qualifed = [];
      this.won = [];
      this.unqualifed = [];
      this.lost = [];

      this.$http
        .get("frontend_order_status_prospecting", {
          params: {
            branch: this.filter_branch_ho
          }
        })
        .then(response => (this.prosfecting = response.data.data));

      this.$http
        .get("frontend_order_status_lost", {
          params: {
            branch: this.filter_branch_ho
          }
        })
        .then(response => (this.lost = response.data.data));

      this.$http
        .get("frontend_order_status_qualifed", {
          params: {
            branch: this.filter_branch_ho
          }
        })
        .then(response => (this.qualifed = response.data.data));

      this.$http
        .get("frontend_order_status_unqualified", {
          params: {
            branch: this.filter_branch_ho
          }
        })
        .then(response => (this.unqualifed = response.data.data));

      this.$http
        .get("frontend_order_status_won", {
          params: {
            branch: this.filter_branch_ho
          }
        })
        .then(response => (this.won = response.data.data));

      this.isLoading = false;
    }
  },
  async mounted() {
    var privilages = sessionStorage.getItem("name_privileges");
    let id_privileges = sessionStorage.getItem("id_privileges");
    var login = sessionStorage.getItem("login");
    var filter_branch = sessionStorage.getItem("id_mst_branch");

    var index = window.location.pathname;
    var url =
      index == "/" ||
      index == "/order" ||
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

    if (id_privileges == 5) {
      this.orr = false;
    }

    this.filter_branch = filter_branch;

    this.$http
      .get("frontend_order_status_prospecting", {
        params: {
          branch: filter_branch_ho
        }
      })
      .then(response => (this.prosfecting = response.data.data));

    this.$http
      .get("frontend_order_mst_reason_reject")
      .then(response => (this.mst_reason_reject = response.data.data));
    this.$http
      .get("frontend_order_mst_reason_cancel")
      .then(response => (this.mst_reason_cancel = response.data.data));

    this.$http
      .get("frontend_order_status_lost", {
        params: {
          branch: filter_branch_ho
        }
      })
      .then(response => (this.lost = response.data.data));

    this.$http
      .get("frontend_order_status_qualifed", {
        params: {
          branch: filter_branch_ho
        }
      })
      .then(response => (this.qualifed = response.data.data));

    this.$http
      .get("frontend_order_status_unqualified", {
        params: {
          branch: filter_branch_ho
        }
      })
      .then(response => (this.unqualifed = response.data.data));

    this.$http
      .get("frontend_order_status_won", {
        params: {
          branch: filter_branch_ho
        }
      })
      .then(response => (this.won = response.data.data));

    this.$http
      .get("frontend_order_mst_status_listing")
      .then(response => (this.order_mst_status = response.data.data));
  },
  computed: {
    id_order() {
      return this.frontend_order_detail.id;
    },
    firstname() {
      return this.frontend_order_detail.contact_first_name;
    },
    lastname() {
      return this.frontend_order_detail.contact_last_name;
    },
    userss() {
      return this.frontend_order_detail.cms_users_name;
    },
    sources() {
      return this.frontend_order_detail.mst_data_source_datasource;
    },
    tanggal() {
      return this.frontend_order_detail.created_at;
    },
    status: {
      get: function() {
        return this.frontend_order_detail.id_order_mst_status;
      },
      set: function(newValue) {
        this.frontend_order_detail.id_order_mst_status = newValue;
      }
    },

    nopol() {
      return this.frontend_order_detail.nopol;
    },
    tahun() {
      return this.frontend_order_detail.year;
    },
    unit() {
      return this.frontend_order_detail.type;
    },
    model() {
      return this.frontend_order_detail.model;
    },
    merk() {
      return this.frontend_order_detail.merk;
    },
    pajak() {
      return this.frontend_order_detail.tax_status;
    },
    bpkb() {
      return this.frontend_order_detail.owner;
    },
    plafon: {
      get: function() {
        return this.frontend_order_detail.plafon;
      },
      set: function(newValue) {
        this.frontend_order_detail.plafon = newValue;
      }
    },
    reason: {
      get: function() {
        return this.frontend_order_detail.id_order_mst_reason;
      },
      set: function(newValue) {
        this.frontend_order_detail.id_order_mst_reason = newValue;
      }
    },
    dp: {
      get: function() {
        return this.frontend_order_detail.down_payment;
      },
      set: function(newValue) {
        this.frontend_order_detail.down_payment = newValue;
      }
    },
    angsuran: {
      get: function() {
        return this.frontend_order_detail.installment;
      },
      set: function(newValue) {
        this.frontend_order_detail.installment = newValue;
      }
    },
    tenor: {
      get: function() {
        return this.frontend_order_detail.tenor;
      },
      set: function(newValue) {
        this.frontend_order_detail.tenor = newValue;
      }
    },
    keperluan() {
      return this.frontend_order_detail.need;
    },

    penjamin() {
      return this.frontend_order_detail.order_surety_name;
    },
    otr() {
      return this.frontend_order_detail.otr;
    },

    autodp() {
      return this.otr - this.plafon;
    },

    sortDesclost: function() {
      function compare(a, b) {
        if (a.updated_at < b.updated_at) return 1;
        if (a.updated_at > b.updated_at) return -1;
        return 0;
      }
      return this.lost.sort(compare);
    },
    sortDescqualifed: function() {
      function compare(a, b) {
        if (a.updated_at < b.updated_at) return 1;
        if (a.updated_at > b.updated_at) return -1;
        return 0;
      }
      return this.qualifed.sort(compare);
    },
    sortDescunqualifed: function() {
      function compare(a, b) {
        if (a.updated_at < b.updated_at) return 1;
        if (a.updated_at > b.updated_at) return -1;
        return 0;
      }
      return this.unqualifed.sort(compare);
    },
     sortDescprospecting: function() {
      function compare(a, b) {
        if (a.updated_at < b.updated_at) return 1;
        if (a.updated_at > b.updated_at) return -1;
        return 0;
      }
      return this.prosfecting.sort(compare);
    },

    sortDescwon: function() {
      function compare(a, b) {
        if (a.updated_at < b.updated_at) return 1;
        if (a.updated_at > b.updated_at) return -1;
        return 0;
      }
      return this.won.sort(compare);
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

    uniqueOutlet: function() {
      var existingIds = {};
      return this.users.filter(function(user) {
        if (existingIds[user.id_mst_outlet]) return false;
        return (existingIds[user.id_mst_outlet] = true);
      });
    }
  }
};
</script>
