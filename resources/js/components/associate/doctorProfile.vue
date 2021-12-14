<template>
<div>
 <div v-if="doctorId" class="p-5">
  <div class="flex">
    <img :src="'/storage/doctors/'+doctor.avatar" class="w-48 h-48 rounded-full m-2">
    <div class="text-gray-600 m-2 my-auto">
      <h2 class="text-2xl font-bold capitalize">Dr {{doctor.name}}</h2>
      <p class="text-2xl">
       <span class="capitalize">{{doctor.gender}}</span>
       <span>age {{doctor.age}}</span>
      </p>
      <p class="text-tiruhakim text-xl">speciality</p>
      <a v-for="speciality in doctor.specialities" :href="'doctor/profile/'+doctor.id" :key="speciality.id">-{{speciality.name}}</a>
      <div class="cursor-pointer text-4xl">
        <stars-component :doctorId="doctorId"/>
      </div>
    </div>
    <div>
    </div>
  </div>
  <p class="m-2 text-xl text-gray-600">{{doctor.description}}</p>
  <div class="m-2">
   <div class="flex">
    <button @click="component='rating'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='rating'? 'text-tiruhakim':'']">
      <span class="">rating</span>
      <span v-if="component=='rating'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
    <button @click="component='aboutMe'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='aboutMe'? 'text-tiruhakim':'']">
      <span class="">about me</span>
      <span v-if="component=='aboutMe'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
    <button @click="component='hospitals'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='hospitals'? 'text-tiruhakim':'']">
      <span class="">hospitals</span>
      <span v-if="component=='hospitals'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
   </div>
   <component :is="component" :doctorId="doctorId" />
  </div>
 </div>
 <div v-else>
  <p class="text-3xl text-bold">sorry! only registered doctors can see this page!</p>
 </div>
</div> 
</template>
<script>
import rating from '../doctor/rating.vue';
import aboutMe from '../doctor/aboutMe.vue';
import hospitals from '../doctor/hospitals.vue';
import stars from '../stars.vue';
export default {
  components:{
    "rating":rating,
    "aboutMe":aboutMe,
    "hospitals":hospitals,
    "stars-component":stars
  },
  props:['doctorId','userId'],
  data(){
    return {
     doctor:{}, 
     component:'rating',
    }
  },
  mounted(){
    axios.get('/doctor/data',{params:{doctorId:this.doctorId}})
    .then(res=>{
      this.doctor=res.data.doctor;
    });
  },
  methods:{
       
  }
}
</script>