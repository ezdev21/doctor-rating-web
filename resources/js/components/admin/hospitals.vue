<template>
 <div>
   <div class="flex">
    <button @click="component='pendingHospitals'" class="flex flex-col -space-y-10 text-xl py-2 px-4 rounded-xl capitalize font-bold" :class="[component=='pendingHospitals'? 'bg-tiruhakim text-white':'text-tiruhakim']">
     pending hospitals
    </button>
    <button @click="component='approvedHospitals'" class="flex flex-col -space-y-10 text-xl py-2 px-4 rounded-xl capitalize font-bold" :class="[component=='approvedHospitals'? 'bg-tiruhakim text-white':'text-tiruhakim']">
      registered hospitals
    </button>
   </div>
    <div>
      <component :is="component" />  
    </div>
 </div>   
</template>
<script>
 import approvedHospitals from './approvedHospitals.vue';
 import pendingHospitals from './pendingHospitals.vue';
 export default {
   components:{
     "approvedHospitals":approvedHospitals,
     "pendingHospitals":pendingHospitals
   },
   data(){
     return{
       component:'pendingHospitals'  
     }  
   },
}
</script>