<template>
<div class="my-5">
  <div class="flex mx-3 mt-2 flex-wrap items-center">
    <div class="md:w-1/2 lg:w-1/2 xl:w-1/2 2xl:w-1/2 text-tiruhakim text-4xl md:text-5xl lg:text-6xl xl:text-6xl 2xl:text-6xl m-auto order-2 md:order-1 lg:order-1 xl:order-1 2xl:order-1">
      <h2 class="text-4xl font-bold my-3 text-tiruhakim">Looking for a Hospital?</h2>
      <p class="text-3xl text-semibold text-gray-500 mb-5 leading-tight">Tiru Hakim is an online database of patient reviews for doctors and facilities in Ethiopia. we give you the tools you need to find the best provider for you!</p>
      <div class="mx-auto w-full shadow-xl rounded-4xl">
      <form @submit.prevent="search" class="flex">
       <input type="text" v-model="searchQuery" @input="filterHospitals" class="capitalize w-full p-3 text-xl outline-none focus:border-b-2 focus:bg-tiruhakim rounded-l-4xl" placeholder="search hospitals">
       <input type="submit" class="capitalize text-white bg-tiruhakim rounded-r-4xl text-2xl py-3 px-10 my-auto" value="search"/>   
      </form>
    </div>
      <div v-if="filteredHospitals&&searchQuery">
       <div v-for="hospital in filteredHospitals" :key="hospital.id" class="bg-white hover:bg-gray-100 border-b-2 border-gray-300 rounded-lg">
        <a :href="'/hospital/profile/'+hospital.id" class="flex no-underline hover:no-underline">
        <img :src="'/storage/hospitals/'+hospital.picture" class="m-1 rounded-full w-16 h-16"/>
        <div class="mx-1 my-auto">
          <p class="text-xl capitalize">{{hospital.name}}</p>
          <hospitalstars-component :hospitalId="hospital.id" />
        </div>
        <div class="mx-1 my-auto">
          <p class="text-xl capitalize">{{hospital.location}}</p>
        </div>
        </a>
       </div>
      </div>
     </div>
    <img class="md:w-1/2 lg:w-1/2 xl:w-5/12 2xl:w-5/12 order-1 md:order-2 lg:order-2 xl:order-2 2xl:order-2" src="/storage/icons/hospital_logo.svg">
  </div>
  <div class="m-5">
    <h2 class="text-3xl text-center capitalize">Browse hospitals by cities</h2>
    <div class="flex my-5 mx-20 flex-wrap">
     <button v-for="city in cities" :key="city.id" class="text-white shadow-xl bg-tiruhakim m-2 px-3 py-2 rounded-xl">
      <a :key="city.id" :href="'/city/'+city.id+'/hospitals'"
      class="p-3 text-2xl capitalize rounded-lg text-white">
      {{city.name}}
      </a>
     </button>
    </div>
  </div>
 </div>
</template>
<script>
import hospitalstars from './hospitalstars.vue';
export default {
  components:{
   "hospitalstars-component":hospitalstars
  },
  data(){
   return {
    searchQuery:'',
    allHospitals:[],
    filteredHospitals:[],
    cities:[]
   }
  },
  mounted(){
    axios.get('/city/all')
    .then(res=>{
      this.cities=res.data.cities; 
    });
    axios.get('/allhospitals')
    .then(res=>{
    this.allHospitals=res.data.hospitals;
    });
   },
  methods:{
    search(){
     if(this.searchQuery){
      document.getElementById('searchQuery').value=this.searchQuery;
      document.getElementById('search-form').submit();
		 }    
    },
    filterHospitals(){
      this.filteredHospitals=[];
      this.allHospitals.forEach(hospital=>{
        if(hospital.name.toLowerCase().match(this.searchQuery.toLowerCase())){
          this.filteredHospitals.push(hospital);
        }
      });
    }
  }
}
</script>