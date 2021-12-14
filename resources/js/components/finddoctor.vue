<template>
<div class="m-2">
  <div class="flex flex-wrap m-2 items-center">
    <div class="my-auto p-3 md:w-1/2 lg:w-1/2 xl:w-1/2 2xl:w-1/2 text-tiruhakim text-4xl md:text-5xl lg:text-6xl xl:text-6xl 2xl:text-6xl m-auto order-2 md:order-1 lg:order-1 xl:order-1 2xl:order-1">
      <h2 class="capitalize text-4xl font-bold my-3 text-tiruhakim">Looking for a doctor?</h2>
      <p class="text-3xl lg:text-4xl xl:text-4xl 2xl:text-4xl text-gray-500 mb-5 leading-tight">Tiru Hakim is an online database of patient reviews for doctors and facilities in Ethiopia. we give you the tools you need to find the best provider for you!</p>
      <div class="mx-auto w-full shadow-xl rounded-4xl">
      <form @submit.prevent="search" class="flex">
       <input type="text" v-model="searchQuery" required @input="filterDoctors" class="capitalize w-full p-3 text-xl outline-none focus:border-b-2 focus:bg-tiruhakim rounded-l-4xl" placeholder="search doctors">
       <input type="submit" class="capitalize text-white bg-tiruhakim rounded-r-4xl text-2xl py-3 px-10 my-auto" value="search"/>   
      </form>
    </div>
      <div v-if="filteredDoctors&&searchQuery" class="rounded-lg">
       <div v-for="doctor in filteredDoctors" :key="doctor.id" class="bg-white hover:bg-gray-100 border-b-2 border-gray-300 rounded-lg">
        <a :href="'/doctor/profile/'+doctor.id" class="flex no-underline hover:no-underline">
        <img :src="'/storage/doctors/'+doctor.avatar" class="my-auto h-16 w-16 rounded-full my-1 mx-2"/>
        <div class="my-auto">
          <p class="text-xl capitalize">Dr. {{doctor.name}}</p>
          <stars-component :doctorId="doctor.id" />
        </div>
        <div class="my-auto">
         <p v-for="speciality in doctor.specialities" :key="speciality.id" class="flex text-xl"><span>{{doctor.speciality}}</span></p>
         <p class="text-xl">{{doctor.hospital}}</p>
        </div>
        </a>
       </div>
      </div>
      <div v-else>
        <p v-if="searchQuery" class="text-xl capitalize">sorry! no doctor found like {{searchQuery}}</p>
      </div>
     </div>
    <img class="md:w-1/2 lg:w-1/2 xl:w-1/2 2xl:w-1/2 order-1 md:order-2 lg:order-2 xl:order-2 2xl:order-2" src="/storage/icons/undraw_doctor_kw5l.svg">
  </div>
  <div class="m-5">
    <h2 class="text-3xl text-center capitalize">Browse doctors by top specialities</h2>
    <div class="flex my-5 mx-20 flex-wrap">
     <button v-for="speciality in specialities" :key="speciality.id" class="text-white shadow-xl bg-tiruhakim m-2 px-3 py-2 rounded-xl">
      <a :key="speciality.id" :href="'/speciality/'+speciality.id"
      class="p-3 text-2xl capitalize rounded-lg text-white">
      {{speciality.name}}
      </a>
     </button>
    </div>
  </div>
 </div>
</template>
<script>
import stars from './stars.vue';
export default {
  components:{
   "stars-component":stars
  },
  data(){
   return{
    searchQuery:'',
    specialities:[],
    allDoctors:[],
    filteredDoctors:[]
   }
  },
  mounted(){
    axios.get('/allspecialities')
    .then(res=>{
      this.specialities=res.data.specialities; 
    });
    axios.get('/alldoctors')
    .then(res=>{
    this.allDoctors=res.data.doctors;
    });
   },
  methods:{
    filterDoctors(){
      this.filteredDoctors=[];
      this.allDoctors.forEach(doctor=>{
        if(doctor.name.toLowerCase().match(this.searchQuery.toLowerCase())){
          this.filteredDoctors.push(doctor);
        }
      });
    },
    search(){
     if(this.searchQuery){
      document.getElementById('searchQuery').value=this.searchQuery;
      document.getElementById('search-form').submit();
		 }    
    },
  }
}
</script>