<template>
	<div class="home container">
		<br>
		<br>
		<br>

		<h2  align="left"><b><strong>Dev Channel Changelog</strong></b></h2>
		<h4  align="left"><b>Build 1.4 beta</b></h4>
		<p align="left"><i>12 November 2018</i></p>
		<div align="left">
			<ul>
				<p><b>#LOGIN</b></p>
				<li>Perubahan Tampilan Login</li>
				<li>Penambahan Logo Warung Dana</li>
				<li>Penambahan Users Aggrement</li>
				<br>
				<p><b>#ASSIGNMENT</b></p>
				<li>Perubahan Tampilan Judul Assigment</li>
				<li>menghapus maximal baris 2250 Table</li>
				<li>Optimize Table </li>
				<li>Perubahan Warna Button</li>
				<br>
				<p><b>#IMPORT TARGET</b></p>
				<li>memperbaiki Tampilan Di mobile Phone</li>
				<br>
				<p><b>#EXPORT TARGET</b></p>
				<li>Optimize Table </li>
				<li>Perubahan Tampilan Judul Export Target</li>
				<br>
				<p><b>#LEADS</b></p>
				<li>Menghilangkan Outlet Name Pada Table</li>
				<li>Optimize Table </li>
				<li>Fix Pilih Outlet</li>
				<li>Rename Head Table</li>
				<br>
				<p><b>#DEALS</b></p>
				<li>Optimize Table </li>
				<li>Fix Pilih Outlet</li>
				<li>Rename Head Table</li>
				<br>
				<p><b>#REPORT KPI</b></p>
				<li>Perubahan Tampilan Judul Report KPI</li>
				<li>Optimize Table </li>
				<li>Pencarian Parameter Tanggal</li>
			</ul>
		</div>
		<h4  align="left"><b>Build 1.3</b></h4>
		<p align="left"><i>6 November 2018</i></p>
		<div align="left">
			<ul>
				<li>Menambah Date Calls Pada target Export</li>

			</ul>
		</div>
		<h4  align="left"><b>Build 1.2</b></h4>
		<p align="left"><i>31 October 2018</i></p>
		<div align="left">
			<ul>
				<li>New Icon Per Menu</li>
				<li>Add Loading View</li>
				<li>Fixed Other Bugs </li>
				
			</ul>
		</div>
		<h4  align="left"><b>Build 1.1</b></h4>
		<p align="left"><i>30 October 2018</i></p>
		<div align="left">
			<ul>
				<li>Fixed Assigment Search All Data</li>
				<li>Fixed Assigment Filter Data</li>
				<li>Add Confirm Submit</li>
				<li>Export Target Details </li>
				<li>Filter Per Outlet Report Telemarketing, Report KPI, </li>
				<li>Leads Export detail</li>
				<li>Deals Export detail</li>
			</ul>
		</div>
		
		
	</div>
</div>
</template>

<script>

export default {

	name: "home",
	data () {
		return {
			ayam: [],
		}
	},
	methods: {
		
	},
	mounted(){

		var privilages = sessionStogetItemrage.getItem("name_privileges");
		var login = sessionStorage.getItems("login");
		var index = window.location.pathname;
		var url = index == " " || index == "/" || index =="/assigment" || index =="/report_tele" ||  index == "/report_kpi" ||  index == "/export_target" || index == "/import_target" || index == "/leads" || index == "/changelog" ;
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
		

	}


};
</script>
