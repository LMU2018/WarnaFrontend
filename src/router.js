import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home.vue";

Vue.use(Router);

export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
  {
    path: "/",
    name: "home",
    component: Home
  },
  {
    path: "/report_tele",
    name: "report_tele",
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/About.vue")
    },
    {
      path: "/report_kpi",
      name: "report_kpi",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Report_KPI.vue")
    },
    {
      path: "/assigment",
      name: "assigment",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Assigment.vue")
    },
    {
      path: "/login",
      name: "login",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Login.vue")
    },
    {
      path: "/logout",
      name: "logout",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Logout.vue")
    },
     {
      path: "/import_target",
      name: "import_target",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Import_target.vue")
    },
    {
      path: "/export_target",
      name: "export_target",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Export_target.vue")
    },
    {
      path: "/setting",
      name: "setting",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Setting.vue")
    },
    {
      path: "/setting",
      name: "setting",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Setting.vue")
    },
    {
      path: "/leads",
      name: "leads",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Leads.vue")
    },
    {
      path: "/deals",
      name: "deals",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Deals.vue")
    },
    {
      path: "/devreport",
      name: "devreport",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/devReport.vue")
    },
     {
      path: "/changelog",
      name: "changelog",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Changelog.vue")
    },
     {
      path: "/order",
      name: "order",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Order.vue")
    },
    //  {
    //   path: "/eula",
    //   name: "eula",
    //   component: () =>
    //   import(/* webpackChunkName: "about" */ "./views/Eula.vue")
    // },
    {
      path: "/users",
      name: "users",
      component: () =>
      import(/* webpackChunkName: "about" */ "./views/Users.vue")
    },
    {
      path: "/visum",
      name: "visum",
      component: () =>
        import( /* webpackChunkName: "about" */ "./views/Visum.vue")
    },
   

    ]
  });
