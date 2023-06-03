let adminlayout = require('./components/layouts/adminlayout.vue').default;
let blanklayout = require('./components/layouts/blanklayout.vue').default;



// Auth Components

let logout = require('./components/auth/logout.vue').default;

let home = require('./components/home.vue').default;


let profile = require('./components/profile.vue').default;
let report = require('./components/report.vue').default;




let unionlist = require('./components/unionList/list.vue').default;
let unionlistedit = require('./components/unionList/form.vue').default;




let userlist = require('./components/users/list.vue').default;
let userlistedit = require('./components/users/form.vue').default;

let sonodWord = require('./components/sonod/word.vue').default;
let sonod = require('./components/sonod/index.vue').default;


let reportlistWord = require('./components/reports/word.vue').default;
let reportlist = require('./components/reports/index.vue').default;


let sonodedit = require('./components/sonod/form.vue').default;
let Vaccination = require('./components/sonod/Vaccination.vue').default;
let sonodview = require('./components/sonod/view.vue').default;

let qr = require('./components/sonod/qr2.vue').default;


let PageNotFound = require('./components/404.vue').default;


let prefix = '/dashboard'
export const routes = [

  //Auth Routes

  { path: `${prefix}/logout`, component: logout, name:'logout',meta: { layout: blanklayout } },


  { path: `${prefix}/qr`, component: qr, name:'qr',meta: { layout: blanklayout } },

  { path:  `${prefix}`, component: home, name:'Dashboard',meta: { layout: adminlayout } },
  { path:  `${prefix}/profile`, component: profile, name:'profile',meta: { layout: adminlayout } },

  { path:  `${prefix}/report`, component: report, name:'report',meta: { layout: adminlayout } },




  { path:  `${prefix}/user/list`, component: userlist, name:'userlist',meta: { layout: adminlayout } },
  { path:  `${prefix}/user/list/add`, component: userlistedit, name:'userlistadd',meta: { layout: adminlayout } },
  { path:  `${prefix}/user/list/edit/:id`, component: userlistedit, name:'userlistedit',meta: { layout: adminlayout } },




  { path:  `${prefix}/application/list/:type/:name`, component: sonod, name:'applicationlist',meta: { layout: adminlayout } },

//   { path:  `${prefix}/application/list/:word/:type`, component: sonod, name:'applicationlist',meta: { layout: adminlayout } },


{ path:  `${prefix}/union/list`, component: unionlist, name:'unionlist',meta: { layout: adminlayout } },
{ path:  `${prefix}/union/list/add`, component: unionlistedit, name:'unionlistadd',meta: { layout: adminlayout } },
{ path:  `${prefix}/union/list/edit/:id`, component: unionlistedit, name:'unionlistedit',meta: { layout: adminlayout } },



  { path:  `${prefix}/report/list/:type`, component: reportlistWord, name:'reportlistWord',meta: { layout: adminlayout } },
  { path:  `${prefix}/report/list/:word/:type`, component: reportlist, name:'reportlist',meta: { layout: adminlayout } },



  { path:  `${prefix}/sonod/action/Vaccination/:id`, component: Vaccination, name:'Vaccination',meta: { layout: adminlayout } },
  { path:  `${prefix}/sonod/action/edit/:id`, component: sonodedit, name:'sonodedit',meta: { layout: adminlayout } },
  { path:  `${prefix}/sonod/action/view/:id`, component: sonodview, name:'sonodview',meta: { layout: adminlayout } },



  { path: "*", component: PageNotFound }

]
