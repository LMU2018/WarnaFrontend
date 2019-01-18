<template>
	<div class="home">

		<br>
		<!-- <img alt="Vue logo" src="../assets/coming.gif" height="250px"> -->

   <loading 
   :active.sync="isLoading" 
   :color="color"
   :loader="loader" 
   :height="height"
   :width="width"
   :is-full-page="fullPage"></loading>



   <div class="card  text-white bg-success">

    <div class="card-body">
      <h4><b> Welcome to Data Importer Tool</b></h4>
      <p align="left">Sebelum melakukan Upload file, lebih baik membaca petunjuk di bawah ini :</p>
      <ul class="list-group">
        <li align="left" style="font-size:14px">Format file harus: xls atau xlsx</li>
        <li align="left" style="font-size:14px">Jika Anda memiliki data file yang besar, kami tidak dapat menjamin success. Jadi,tolong pisahkan file-file itu ke dalam beberapa bagian file (maximal 10.000 baris).</li>
        <li align="left" style="font-size:14px">Alat ini menghasilkan data secara otomatis, berhati-hatilah dengan struktur tabel xls Anda. Harap pastikan dengan benar struktur tabel..</li>
        <li align="left" style="font-size:14px">Struktur tabel: Baris 1 adalah kolom judul, dan selanjutnya adalah data. Untuk lebih lengkap Silahkan Download Template & Details </li>
      </ul>
    </div>
  </div>

  <br>

  <button type="button" class="btn btn-outline-secondary" v-on:click="downloadTemplate()" >Download Template</button>
  <button type="button" class="btn btn-outline-secondary" align="left">Download Details</button>
  <br>
  <br>
  <form action="#" v-on:submit.prevent="submitFile">
    <div class="form-group ">
      <div class="form-group centered ">
        <div class="col-md-6  ">
          <input type="text" id="name" class="form-control col-xs-4" placeholder="Name Files" v-model="name"  required  oninvalid="this.setCustomValidity('Nama Files Wajib Di isi')"
          oninput="setCustomValidity('')" autofocus>
        </div>
      </div>
      <div class="form-group centered ">
        <div class="col-md-6">
          <center><input type="text" id="description" class="form-control" placeholder="description" v-model="description"  required></center>
        </div>
      </div>

      <div class="form-group centered ">
        <div class="col-md-4">
          <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" required />

        </div>
      </div>

      <div class="form-group centered ">
        <div class="col-md-4">
          <button class="btn btn-md btn-info btn-block"  type="submit">Upload</button>
        </div>
      </div>

    </div>
  </form>



</div>

</template>

<script>
import axios from "axios";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Vue from 'vue'
export default {

	name: "home",
 components: {

  Loading, 
},
data () {
  return {
    isLoading: false,
    color: '#007bff',
    height: 128,
    width: 128,
    loader: 'dots',
    fullPage: true,
    ayam: [],
    name: '',
    description: '',
    file: '',
    kambing: [],
    bebek: [],
    post_file: [],

  }
},
methods: {
  downloadTemplate(){
    axios({
      url: 'http://116.197.129.148/warnaprodfrontend/public/uploads/0/2018-11/aa39cbdeaaad3307d33def99dc744b77.xlsx',
      method: 'GET',
  responseType: 'blob', // important
}).then((response) => {
  const url = window.URL.createObjectURL(new Blob([response.data]));
  const link = document.createElement('a');
  link.href = url;
  link.setAttribute('download', 'template.xlsx');
  document.body.appendChild(link);
  link.click();
});
},
handleFileUpload(){
  this.file = this.$refs.file.files[0];
},
async  submitFile(){
  this.isLoading = true;

  let formData = new FormData();
  let file = this.file;
  let id_cms_users = sessionStorage.getItem("id");
  formData.append('name', this.name)
  formData.append('url', file)
  formData.append('description', this.description)
  formData.append('id_cms_users', id_cms_users)

  try {
    var post_file  = await this.$http.post('upload_file',
     formData,
     {
      headers: {
       'Content-Type': 'multipart/form-data'
     }
   });
    console.log("sukses");
  } catch (error) {
    console.log(error)
  }


  this.post_file = post_file.data;
  console.log(this.post_file.id)

  console.log("hahaha");


  var baca_upload = await this.$http.get('upload_file_detail',{
    params:{
      id: this.post_file.id 
    }
  });

  this.ayam = baca_upload.data;

  try {
    var set_file  = await this.$http.post('import_set_files',{
      id: 2,
      name: this.ayam.id,
      url: this.ayam.url,
      description: this.ayam.description,
      id_cms_users: this.ayam.id_cms_users

    });
  } catch (error) {
    console.log(error)
  }
  this.bebek = set_file.data;
  console.log(this.bebek)


  window.location.replace("http://116.197.129.148:66/middleware/proses_import.php");
  // window.location.replace("http://192.168.139.59/middleware/proses_import.php");
  // location.replace("http://192.168.139.61/middleware/proses_import.php");
this.isLoading = false

},

},
mounted(){

 var privilages = sessionStorage.getItem("name_privileges");
 var login = sessionStorage.getItem("login");
 var index = window.location.pathname;
 var url = index == " " || index == "/" || index =="/assigment" || index =="/report_tele" ||  index == "/report_kpi" ||  index == "/export_target" || index == "/import_target" ;
 if (login == 1) {
  if (url) {
   console.log(index);
   console.log(login);

 }else{
   console.log(index);
   window.location = "/"; 
 }


}
else {
  if (url) {
   console.log(index);
   window.location = "/login";
 }else{
   console.log('done');

 }
}

if ( privilages == "CFA") {
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




},
computed:{
 uniqueAyam: function () {
  var existingIds = {};
  return this.ayam.filter(function (user) {
   if (existingIds[user.id_cms_users]) return false;
   return existingIds[user.id_cms_users] = true;
 })
}

}


};
</script>
<style>
.form-wrapper {
  display: flex;
  align-items: center;
}
.input-group {
  border:1px yellow solid;
  text-align:center;
}
.centered {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
