<template>
<div>
  <div v-for="doctor in pendingDoctors" :key="doctor.id" class="my-5 mx-3">
    <div class="flex">
    <img :src="'/storage/doctors/'+doctor.avatar" class="w-32 h-32 m-2">
    <div class="text-xl mx-1">
     <p>name: {{doctor.name}}</p>
     <p>email: {{doctor.emai}}</p>
     <p>city: {{doctor.city}}</p>
     <p>age: {{doctor.age}}</p>
     <p>phone: {{doctor.phone_number}}</p>
     <p>sex: {{doctor.sex}}</p>
     <p>age: {{doctor.age}}</p>
     <p>experience: {{doctor.experience}}</p>
     <p v-if="doctor.hospital">{{doctor.hospital}}(not registered)</p>
     <div v-if="doctor.specialities">
       <p>speciality</p>
       <p class="flex" v-for="speciality in doctor.specialities" :key="speciality.id">{{speciality.name}}</p>
     </div>
     <div v-if="doctor.hospitals">
       <p>hospitals</p>
       <p class="flex" v-for="hospital in doctor.hospitals" :key="hospital.id">{{hospital.name}}</p>
     </div>
     <div v-if="doctor.languages">
       <p>languages</p>
       <p class="flex" v-for="language in doctor.languages" :key="language.id">{{language.name}}</p>
     </div>
     <p></p>
    </div>  
    <div>
      <button @click="approveDoctor(id)" class="m-1 text-white bg-tiruhakim text-xl py-2 px-4 rounded-2xl">approve</button>  
    </div>
   </div>
  </div>
  <div v-show="!pendingDoctors.length">
     <p class="text-2xl mx-3">no new registered doctors found</p>
  </div>
</div>  
</template>
<script>
export default {
  data(){
   return{
    pendingDoctors:[]  
   }
  },  
  mounted(){
    axios.get('/doctor/pendingdoctors')
    .then(res=>{
      this.pendingDoctors=res.data.doctors; 
    });  
  },
  methods:{
    approveDoctor(id){
      axios.post('/doctor/approve',{id:id})
      .then(res=>{
        this.$toaster.success('doctor approved successfully',{timeout:8000});
        let doctor=this.pendingDoctors.find(doctor=>{
        return doctor.id==id;
        });
        this.pendingDoctors.pop(doctor);
      });
    } 
  }  
}
</script>