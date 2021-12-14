<template>
 <div>
  <div class="w-full lg:w-3/4 lg:mx-auto xl:w-3/4 xl:mx-auto 2xl:mx-auto 2xl:w-3/4 shadow-xl rounded-4xl">
    <form @submit.prevent="search" class="flex">
    <input type="text" @input="filter" v-model="searchQuery" required class="capitalize w-full p-3 text-lg lg:text-xl xl:text-xl 2xl:text-xl outline-none focus:border-b-2 border-tiruhakim rounded-l-4xl lg:rounded-l-4xl xl:rounded-l-4xl 2xl:rounded-l-4xl" placeholder="search doctors and facilities">
    <input type="submit" class="capitalize text-white bg-tiruhakim rounded-r-4xl lg:rounded-r-4xl xl:rounded-r-4xl 2xl:rounded-r-4xl text-xl lg:text-2xl xl:text-2xl 2xl:text-2xl py-3 lg:py-3 xl:py-3 2xl:py-3 px-5 my-auto" value="search"/>   
    </form>
  </div>
  <div class="block lg:flex xl:flex 2xl:flex mx-auto w-full lg:w-3/4 xl:w-3/4 2xl:w-3/4">
    <div v-if="filteredDoctors&&searchQuery" class="m-px rounded-xl w-1/2">
       <div v-for="doctor in filteredDoctors" :key="doctor.id" class="bg-white hover:bg-gray-200 border-b-2 border-gray-300 rounded-lg">
        <a :href="'/doctor/profile/'+doctor.id" class="flex no-underline hover:no-underline">
        <img :src="'/storage/doctors/'+doctor.avatar" class="h-16 w-16 rounded-full m-1"/>
        <div class="my-auto">
          <p class="text-xl capitalize">Dr. {{doctor.name}}</p>
          <stars-component :doctorId="doctor.id" /> 
        </div>
        <div class="mx-1">
         <p v-for="speciality in doctor.specialities" :key="speciality.id" class="text-xl">{{doctor.speciality}}</p>
         <p class="text-xl">{{doctor.hospital}}</p>
        </div>
        </a>
       </div>
    </div>
    <div v-if="filteredHospitals&&searchQuery" class="m-px rounded-xl w-1/2">
       <div v-for="hospital in filteredHospitals" :key="hospital.id" class="bg-white hover:bg-gray-200 border-b-2 border-gray-300 rounded-lg">
        <a :href="'/hospital/profile/'+hospital.id" class="flex no-underline hover:no-underline">
        <img :src="'/storage/hospitals/'+hospital.picture" class="h-16 w-16 rounded-full m-1"/>
        <div class="my-auto mx-1">
          <p class="text-xl capitalize">{{hospital.name}} hospital</p>
          <hospitalstars-component :hospitalId="hospital.id" />
        </div>
        <div class="mx-1 my-auto">
          <p class="text-xl capitalize">{{hospital.location}}</p>
        </div>
        </a>
       </div>
      </div>
  </div>    
 </div>
</template>
<script>
export default{
  data(){
   return {   
    searchQuery:'',
    allDoctors:[],
    allHospitals:[],   
    filteredDoctors:[],
    filteredHospitals:[]
   }
  },
  mounted(){
   axios.get('/alldoctors')
   .then(res=>{
    this.allDoctors=res.data.doctors;
   });
   axios.get('/allhospitals')
   .then(res=>{
    this.allHospitals=res.data.hospitals;
   });
  },
  methods:{
    filter(){
      this.filteredDoctors=[];
      this.filteredHospitals=[];
      this.allDoctors.forEach(doctor=>{
        if(doctor.name.toLowerCase().match(this.searchQuery.toLowerCase())){
          this.filteredDoctors.push(doctor);
        }
      });
      this.allHospitals.forEach(hospital=>{
        if(hospital.name.toLowerCase().match(this.searchQuery.toLowerCase())){
          this.filteredHospitals.push(hospital);
        }
      });
    },
    search(){
     if(this.searchQuery){
      document.getElementById('searchQuery').value=this.searchQuery;
      document.getElementById('search-form').submit();
		 } 
    }  
  }
}
</script>