<template>
<div class="">
 <div v-for="notification in notifications" class="" :class="">
  <div v-if="type==doctor" class="flex">
  <img :src="'/storage/pendingdoctors/'+doctor.id" class="w-5 h-5 rounded-full">
  <p>DR. {{doctor.name}}</p>
  </div>
  <div v-else class="flex">
  <img :src="'/storage/pendinghospitals/'+hospital.id" class="w-5 h-5 rounded-full">
  <p>{{hospital.name}}</p>
  </div>
 </div>
</div>
</template>
<script>
export default{
 data(){
 return {
  doctors:[],
  hospitals:[]
 }
 },
 mounted(){
 axios.get('/notification')
 .then(res=>{
 
 });
 },
 methods:{
 readNotification(id){
  axios.post('',id)
  .then(res=>{
  
  });
 }
 }
}
</script>
