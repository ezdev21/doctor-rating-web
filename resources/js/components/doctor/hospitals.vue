<template>
<div class="m-2 p-2">
 <div v-for="hospital in hospitals" :key="hospital.id">
   <a :href="`/hospital/profile/${hospital.picture}`">
    <div class="p-2 m-2 flex">
     <img :src="`/storage/hospitals/${hospital.picture}`" class="w-32">
     <p class="mx-2 text-xl">{{hospital.name}}</p> 
    </div>
   </a>
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
     this.hospitals=res.data.hospitals;
   });
 }
} 
</script>