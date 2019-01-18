<template>
	
</template>

<script>
export default {
	data() {
		return {
			
		}
	},
	mounted(){
        console.log("logout");
        sessionStorage.removeItem("token");
		sessionStorage.removeItem("login");
        sessionStorage.removeItem("id");
        sessionStorage.removeItem("name");
        sessionStorage.removeItem("id_privileges");
        sessionStorage.removeItem("name_privileges");
        sessionStorage.removeItem("id_mst_outlet");
         sessionStorage.removeItem("id_mst_outlet");
        sessionStorage.removeItem("mst_outlet_outlet_name");
        sessionStorage.removeItem("id_mst_branch"); 
        sessionStorage.removeItem("photo");
        window.location = "/";
	}
	
}
</script>

