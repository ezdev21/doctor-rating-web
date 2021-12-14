<template>
<div>
 <button @click="popup=true" class="text-white bg-tiruhakim text-xl rounded-xl px-4 py-2">add speciality</button>
 <div v-if="popup" class="absolute top-1/4 left-1/3 bg-white z-20 rounded-xl py-5 px-10">
  <form @submit.prevent="addAssociate"> 
   <p class="text-2xl text-center m-2">add new associate here</p>
   <input type="text" v-model="name" required placeholder="new speciality" :class="[error? 'border-red-500':'border-gray-200']" class="border-2 rounded-xl w-72 p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   <input type="text" v-model="email" required placeholder="new speciality" :class="[error? 'border-red-500':'border-gray-200']" class="border-2 rounded-xl w-72 p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   <input type="text" v-model="password" required placeholder="new speciality" :class="[error? 'border-red-500':'border-gray-200']" class="border-2 rounded-xl w-72 p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   <input type="submit" value="submit" class="bg-tiruhakim text-white text-xl py-2" />  
  </form>
 </div>
 <div v-if="popup" @click="popup=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
</div>    
</template>
<script>
export default{
  props:['doctorId'],  
  data(){
   return {  
    name:'',
    email:'',
    password:'',
    error:false,
    popup:false
   }  
  },
  methods:{
   validate(){
     if(this.name.length<2){
       return false;  
     }
     if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)){
       return false;
     }
     if(this.password.length<8){
        return false; 
     }
     return true;
   },   
   addSpeciality(){
     if(this.validate){
       axios.post('/associate/add',{name:this.name,email:this.email,password:this.password})
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