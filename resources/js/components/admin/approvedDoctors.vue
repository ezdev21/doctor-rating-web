<template>
<div class="my-5 mx-3">
  <div v-for="doctor in approvedDoctors" :key="doctor.id" class="">
    <div class="flex">
    <img :src="'/storage/doctors/'+doctor.avatar" class="w-12 h-12 rounded-full m-2">
    <div>
     <p class="text-xl mx-1">{{doctor.name}}</p>
     <stars-component :doctorId="doctor.id"/>
    </div>  
    <div>
      <button class="text-white bg-tiruhakim text-xl py-2 px-4 rounded-2xl"><a :href="'/doctor/edit/'+doctor.id">edit</a></button>  
      <button @click="deleteDoctor(id)" class="text-white bg-tiruhakim text-xl py-2 px-4 rounded-2xl">delete</button>  
    </div>
   </div>
  </div>
  <div v-show="!approvedDoctors.length">
     <p class="text-2xl mx-3">no new approved doctors found</p>
  </div>
</div>  
</template>
<script>
export default {
  data(){
   return{
    approvedDoctors:[],   
   }
  },  
  mounted(){
    axios.get('/doctor/approveddoctors')
    .then(res=>{
      this.approvedDoctors=res.data.doctors;  
    });  
  },
  methods:{
    deleteDoctor(id){
      axios.post('/doctor/delete',{id:id})
      .then(res=>{
        this.$toaster.success('doctor removed sucessfully',{timeout:8000});
        let doctor=this.approvedDoctors.find(doctor=>{
         return doctor.id==id;
        });
        this.approvedDoctors.pop(doctor);
      });  
    }  
  }  
}
</script>