<template>
  <div class="ayam">
  <form class="form-inline form-group" role="form">
    <select v-model="default_branch" class="form-control form-control-sm">
        <option disabled value>Pilih Branch</option>
        <option
          v-for="branch in branch"
          v-bind:value="branch.id"
        >{{ branch.branch_name }}</option>
      </select>
  </form>
  </div>
</template>

<script>
export default {
  name: "Branch_Selected",
  data() {
    return {
      branch: [],
      default_branch: "",
      ayam: 'ayam'
    };
  },
  mounted() {
    this.$http
      .get("frontend_branch_name")
      .then(response => (this.branch = response.data.data));
  }
};
</script>


