<template>
<div>
 <button @click="popup=true" class="text-white bg-tiruhakim text-xl rounded-xl px-4 py-2">add speciality</button>
 <div v-if="popup" class="absolute top-1/4 left-1/3 bg-white z-20 rounded-xl py-5 px-10">
   <p class="text-2xl text-center m-2">add new speciality here</p>
   <input @keyup.enter="addSpeciality" type="text" v-model="speciality" required placeholder="new speciality" :class="[error? 'border-red-500':'border-gray-200']" class="border-2 rounded-xl w-72 p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   <button @click="addSpeciality" class="bg-tiruhakim text-white text-xl py-2 px-4 rounded-2xl"><span class="bg-white text-tiruhakim w-8 h-8 text-center rounded-full m-1">+</span>add new</button>  
 </div>
 <div v-if="popup" @click="popup=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
</div>    
</template>
<script>
export default{
  props:['doctorId'],  
  data(){
   return {  
    speciality:'',
    error:false,
    popup:false
   }  
  },
  methods:{
   addSpeciality(){
     if(this.speciality){
       axios.post('/speciality/add',{doctorId:this.doctorId,speciality:this.speciality,status:'approved'})
       .then(res=>{
         this.popup=false;
       });  
     }
     else{
     this.error=true;
   }   
   }   
  }  
}
</script>