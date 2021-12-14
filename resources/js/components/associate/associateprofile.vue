<template>
<div class="m-3 p-3">
  <div class="flex">
    <button @click="component='doctorProfile'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='doctorProfile'? 'text-tiruhakim':'']">
      <span class="">my profile</span>
      <span v-if="component=='doctorProfile'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
    <button @click="component='addDoctor'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='addDoctor'? 'text-tiruhakim':'']">
      <span class="">add doctor</span>
      <span v-if="component=='addDoctor'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
    <button @click="component='addHospital'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='addHospital'? 'text-tiruhakim':'']">
      <span class="">add hospital</span>
      <span v-if="component=='addHospital'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
  </div>
  <component :doctorId="doctorId" :userId="userId" :is="component"/>
</div>  
</template>
<script>
import addDoctor from './addDoctor.vue';
import addHospital from './addHospital.vue';
import doctorProfile from './doctorProfile.vue';
 export default{
   props:['doctorId','userId'],
   components:{
    "addDoctor":addDoctor,
    "addHospital":addHospital,
    "doctorProfile":doctorProfile,
   },
   data(){
     return{
      component:'doctorProfile' 
     }  
   },
   mounted(){

   },
   methods:{
       
   }  
 }
</script>