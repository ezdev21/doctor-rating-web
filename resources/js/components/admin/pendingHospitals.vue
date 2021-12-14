<template>
 <div class="my-5 mx-3">
  <div v-for="hospital in pendingHospitals" :key="hospital.id" class="my-5 mx-3">
    <div class="flex">
    <img :src="'/storage/hospitals/'+hospital.picture" class="h-max m-2">
    <div class="text-xl mx-1">
     <p>name: {{hospital.name}}</p>
     <p>email: {{hospital.email}}</p>
     <p>city: {{hospital.city}}</p>
     <p>phone: {{hospital.phone_number}}</p>
     <p>location:{{hospital.location}}</p>
     <p>description: {{hospital.experience}}</p>
     <p v-if="hospital.hospital">{{hospital.hospital}}(not registered)</p>
    </div>  
    <div class="mx-5">
      <button @click="approveHospital(id)" class="m-1 text-white bg-tiruhakim text-xl py-2 px-4 rounded-2xl">approve</button>  
    </div>
   </div>
  </div>
  <div v-show="!pendingHospitals.length">
     <p class="text-2xl mx-3">no new registered hospitals found</p>
  </div>
 </div>  
</template>
<script>
export default {
  data(){
   return {
    pendingHospitals:[],
   }   
  },
  mounted(){
   axios.get('/hospital/pendinghospitals')
   .then(res=>{
     this.pendingHospitals=res.data.hospitals;
   });
  },
  methods:{
   approveHospital(id){
     axios.post('/hospital/approve',{id:id})
     .then(res=>{
      this.$toaster.success('hospital approved successfully',{timeout:8000});
      let hospital=this.pendingHospitals.find(hospital=>{
        return hospital.id==id;
      });
      this.pendingHospitals.pop(hospital);
     });
   }
  }  
}
</script>