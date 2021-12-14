
require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';

import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
Vue.use(Toaster, {timeout: 10000});
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('evaluation-component', require('./components/evaluation.vue').default);
Vue.component('finddoctor-component', require('./components/finddoctor.vue').default);
Vue.component('searchdoctor-component', require('./components/searchdoctor.vue').default);
Vue.component('findhospital-component', require('./components/findhospital.vue').default);
Vue.component('navigation-component', require('./components/navigation.vue').default);
Vue.component('notification-component', require('./components/notification.vue').default);
Vue.component('rate-component', require('./components/rate.vue').default);
Vue.component('review-component', require('./components/review.vue').default);
Vue.component('aboutme-component', require('./components/doctor/aboutMe.vue').default);
Vue.component('doctorprofile-component', require('./components/doctor/doctorprofile.vue').default);
Vue.component('hospitals-component', require('./components/doctor/hospitals.vue').default);
Vue.component('rating-component', require('./components/rate.vue').default);
Vue.component('stars-component', require('./components/stars.vue').default);
Vue.component('hospitalprofile-component', require('./components/hospitalprofile.vue').default);
Vue.component('hospitalstars-component', require('./components/hospitalstars.vue').default);
Vue.component('homesearch-component', require('./components/homesearch.vue').default);
Vue.component('hospitalstars-component', require('./components/hospitalstars.vue').default);
Vue.component('adddoctor-component', require('./components/associate/addDoctor.vue').default);
Vue.component('addhospital-component', require('./components/associate/addHospital.vue').default);
Vue.component('associateprofile-component', require('./components/associate/associateprofile.vue').default);
Vue.component('addspeciality-component', require('./components/addSpeciality.vue').default);
Vue.component('addassociate-component', require('./components/addAssociate.vue').default);
Vue.component('claimprofile-component', require('./components/doctor/claimprofile.vue').default);
Vue.component('adminhome-component', require('./components/adminHome.vue').default);
Vue.component('pendingdoctors-component', require('./components/admin/pendingDoctors.vue').default);
Vue.component('pendinghospitals-component', require('./components/admin/pendingHospitals.vue').default);
Vue.component('approveddoctors-component', require('./components/admin/approvedDoctors.vue').default);
Vue.component('approvedhospitals-component', require('./components/admin/approvedHospitals.vue').default);
Vue.component('registerpopup-component', require('./components/registerPopup.vue').default);
Vue.component('doctorregister-component', require('./components/doctor/doctorRegister.vue').default);
Vue.component('hospitalregister-component', require('./components/hospitalRegister.vue').default);

const app = new Vue({
    el: '#app',
});