import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "axios";
import VueGoodTablePlugin from 'vue-good-table';


// import the styles 
import 'vue-good-table/dist/vue-good-table.css'
import Datatable from 'vue2-datatable-component'
import VueProgressBar from 'vue-progressbar'
import downloadexcel from "vue-json-excel";
import uploader from 'vue-simple-uploader'
import VueGoogleCharts from 'vue-google-charts'
import store from './store'

Vue.use(VueGoogleCharts)



Vue.use(Datatable) // done!
Vue.use(uploader)
Vue.use(VueGoodTablePlugin);
Vue.use(VueProgressBar, options)



Vue.config.productionTip = false;
const options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'left',
  inverse: false
}
let key = "c5e607d81cccaea2a75d506c6286fd40";
let time = new Date();
time = time.getTime();
let token = sessionStorage.getItem("token");
console.log("token", token);
console.log("time", time)

const base = axios.create({
    // baseURL: 'http://116.197.129.148:57/warnadevfrontend/public/api',
    //  baseURL: 'http://116.197.129.148:66/warnatrialfrontend/public/api',
  // baseURL: 'http://116.197.129.148:57/warnaprodfrontend/public/api',
  baseURL: 'http://192.168.139.59/warnadevfrontend/public/api',
  headers: {
    "x-authorization-token": token,
    "X-Authorization-Time": time,

  },
 
})
let id_privileges = sessionStorage.getItem("id_privileges");



Vue.prototype.$http = base

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
