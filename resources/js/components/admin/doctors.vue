<template>
 <div>
   <div class="flex">
    <button @click="component='pendingDoctors'" class="flex flex-col -space-y-10 text-xl py-2 px-4 rounded-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='pendingDoctors'? 'bg-tiruhakim text-white':'text-tiruhakim']">
      pending doctors
    </button>
    <button @click="component='approvedDoctors'" class="flex flex-col -space-y-10 text-xl py-2 px-4 rounded-xl text-gray-500 capitalize font-bold" :class="[component=='approvedDoctors'? 'bg-tiruhakim text-white':'text-tiruhakim']">
      registered doctors
    </button>
   </div>
    <div>
      <component :is="component" />  
    </div>
 </div>   
</template>
<script>
 import approvedDoctors from './approvedDoctors.vue';
 import pendingDoctors from './pendingDoctors.vue'
 export default {
   components:{
     "approvedDoctors":approvedDoctors,
     "pendingDoctors":pendingDoctors
   },
   data(){
     return{
       component:'pendingDoctors'  
     }  
   },
}
</script>