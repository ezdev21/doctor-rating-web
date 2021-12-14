<template>
<div>
 <button @click="popup=true" class="text-white bg-tiruhakim text-xl rounded-3xl px-4 py-2">Register</button>
 <div v-if="popup" class="absolute top-1/4 left-1/3 bg-white z-20 rounded-xl py-5 px-10">
   <button class="hover:bg-white block bg-tiruhakim text-white text-xl py-2 px-4 rounded-2xl m-1">
    <a class="no-underline hover:no-underline hover:text-tiruhakim" href="/doctor/register">Register as a Doctor</a>
   </button>  
   <button class="hover:bg-white block bg-tiruhakim text-white text-xl py-2 px-4 rounded-2xl m-1">
    <a class="no-underline hover:no-underline hover:text-tiruhakim" href="/register">Register as a User</a>
   </button>  
 </div>
 <div v-if="popup" @click="popup=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
</div>    
</template>
<script>
export default{  
  data(){
   return {  
    popup:false
   }  
  },
  methods:{
    
  }  
}
</script>