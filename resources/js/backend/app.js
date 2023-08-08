import Vue from 'vue'
require('../bootstrap');


import { BButton, BImg, BModal,VBModal  } from 'bootstrap-vue'
Vue.component('b-modal', BModal)
Vue.component('b-button', BButton)
Vue.component('b-img', BImg)


import Editor from '@tinymce/tinymce-vue'
Vue.component('vue-editor', Editor);

import Swal from 'sweetalert2'
window.Swal = Swal;

import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from './routes';

import store from '../store'

import tablecom from '../table.vue'
Vue.component('TableComponent', tablecom);


import Prodibedondakhil from './components/sonod/prodibedon_dakhil.vue'
Vue.component('Prodibedondakhil', Prodibedondakhil);


import Prodibedondakhilimarot from './components/sonod/Prodibedon_dakhili_marot.vue'
Vue.component('Prodibedondakhilimarot', Prodibedondakhilimarot);




Vue.prototype.$localStorage = localStorage;


import Multiselect from 'vue-multiselect'


// register globally
Vue.component('multiselect', Multiselect)

window.Reload = new Vue();
const router = new VueRouter({
  routes,
  mode: 'history'
})
const app = new Vue({
    el: '#app',
    router,
    store
});


