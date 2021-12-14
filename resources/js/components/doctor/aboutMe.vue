<template>
<div class="w-max m-2 p-2">
 <div class="border-b-2 border-gray-400 m-1">
  <h2 class="text-2xl">work experience</h2>
  <p class="text-xl text-gray-500">{{experience}} years</p>
 </div>
 <div class="border-b-2 border-gray-400 m-1">
  <h2 class="text-2xl">specialities</h2>
  <p v-for="speciality in specialities" :key="speciality.id" class="text-gray-500 text-xl">-{{speciality.name}}</p>
 </div>
 <div class="border-b-2 border-gray-400 m-1">
  <h2 class="text-2xl">languages</h2>
  <p v-for="language in languages" :key="language.id" class="text-xl text-gray-500">-{{language.name}}</p>
 </div>
</div>
</template>
<script>
export default {
  props:['doctorId'],
  data(){
   return{
    experience:0,
    specialities:[],
    languages:[]
   } 
  },
  mounted(){
   axios.get('/doctor/aboutme',{params:{doctorId:this.doctorId}})
   .then(res=>{
     this.experience=res.data.experience;
     this.specialities=res.data.specialities;
     this.languages=res.data.languages;
   })
  }
}
</script>