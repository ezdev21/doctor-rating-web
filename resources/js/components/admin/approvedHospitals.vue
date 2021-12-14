<template>
 <div class="my-5 mx-3">
  <div v-for="hospital in approvedHospitals" :key="hospital.id" class="m-2">
   <div class="flex">
    <img :src="'/storage/hospitals/'+hospital.picture" class="w-12 h-12 rounded-full m-2">
    <div>
     <p class="text-xl mx-1">{{hospital.name}}</p>
     <hospitalstars-component :hospitalId="hospital.id"/>
    </div>
    <div>
     <p class="text-xl">{{hospital.location}}</p>  
    </div>
    <div>
      <button class="text-white bg-tiruhakim text-xl py-1 px-4 rounded-xl"><a :href="'/hospital/edit/'+hospital.id">edit</a></button>  
      <button @click="deleteHospital(id)" class="text-white bg-tiruhakim text-xl py-1 px-4 rounded-xl">delete</button>  
    </div>
   </div>
  </div>  
  <div v-show="!approvedHospitals.length">
     <p class="text-2xl mx-3">no new approved hospitals found</p>
  </div>  
 </div>  
</template>
<script>
export default {
  data(){
   return {
    approvedHospitals:[]
   }   
  },
  mounted(){
   axios.get('/hospital/approvedhospitals')
   .then(res=>{
     this.approvedHospitals=res.data.hospitals;
   });
  },
  methods:{
    deleteHospital(id){
     axios.post('/hospital/delete',{id:id})
     .then(res=>{
       this.$toaster.success('hospital removed successfully',{timeout:8000});
       let hospital=this.approvedHospitals.find(hospital=>{
        return hospital.id==id;
       });
       this.approvedHospitals.pop(hospital);
     });   
    }
  }  
}
</script>