<template>
<div class="m-3 p-3">
  <div class="flex">
    <button @click="component='addDoctor'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='addDoctor'? 'text-tiruhakim':'']">
      <span class="">add doctor</span>
      <span v-if="component=='addDoctor'" class="text-6xl text-tiruhakim w-full text-center rounded-full">.</span>
    </button>
    <button @click="component='addHospital'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='addHospital'? 'text-tiruhakim':'']">
      <span class="">add hospital</span>
      <span v-if="component=='addHospital'" class="text-6xl text-tiruhakim w-full text-center rounded-full">.</span>
    </button>
    <button @click="component='doctors'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='doctors'? 'text-tiruhakim':'']">
      <span class="">doctors</span>
      <span v-if="component=='doctors'" class="text-6xl text-tiruhakim w-full text-center rounded-full">.</span>
    </button>
    <button @click="component='hospitals'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='hospitals'? 'text-tiruhakim':'']">
      <span class="">hospitals</span>
      <span v-if="component=='hospitals'" class="text-6xl text-tiruhakim w-full text-center rounded-full">.</span>
    </button>
    <button @click="component='associates'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='associates'? 'text-tiruhakim':'']">
      <span class="">associates</span>
      <span v-if="component=='associates'" class="text-6xl text-tiruhakim w-full text-center rounded-full">.</span>
    </button>
    <button @click="component='users'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='users'? 'text-tiruhakim':'']">
      <span class="">users</span>
      <span v-if="component=='users'" class="text-6xl text-tiruhakim w-full text-center rounded-full">.</span>
    </button>
  </div>
  <component :doctorId="doctorId" :userId="userId" :is="component"/>
</div>  
</template>
<script>
import associates from './admin/associates.vue';
import users from './admin/users.vue';
import doctors from './admin/doctors.vue';
import hospitals from './admin/hospitals.vue';
import addAssociate from './addAssociate.vue';
import addDoctor from './associate/addDoctor.vue';
import addHospital from './associate/addHospital.vue';
 export default{
   props:['doctorId','userId'],
   components:{
    "associates":associates,
    "users":users,
    "doctors":doctors,
    "hospitals":hospitals,
    "addAssociate":addAssociate,   
    "addDoctor":addDoctor,
    "addHospital":addHospital,
   },
   data(){
     return{
      component:'addDoctor' 
     }  
   },
   mounted(){

   },
   methods:{
       
   }  
 }
</script>