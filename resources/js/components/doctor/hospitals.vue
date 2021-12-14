<template>
<div class="m-2 p-2">
 <div v-for="hospital in hospitals" :key="hospital.id">
   <p class="">{{hospital.name}}</p>
   <p class="">{{day}}</p> 
 </div>
</div>
</template>
<script>
export default{
 props:['doctorId'],
 data(){
  return{
   hospitals:[]
  }  
 },
 mounted(){
   axios.get('/doctor/hospitals',{params:{doctorId:this.doctorId}})
   .then(res=>{
     this.hospitals=res.data.hspitals;
   });
 }
} 
</script>