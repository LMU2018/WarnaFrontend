<template>
  <div class="home container">
    <br>
    <br>
    <br>

    <!-- 		<h2  align="left"><b><strong>WARUNG DANA Customer Agreement</strong></b></h2> -->
    <h4 align="left">
      <b>WARUNG DANA End User License Agreement</b>
    </h4>
    <p align="left">
      <i>11 November 2018</i>
    </p>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "home",
  data() {
    return {
      ayam: []
    };
  },
  mounted(){
    const instance = axios.create({
  baseURL: 'http://192.168.139.59/warnadev/public/api/user_listing',
  timeout: 1000,
  headers: {
    "x-authorization-token": token,
    "X-Authorization-Time": time,
    "User-Agent": useragent
  },
});
  }

};
</script>
