<template>
 <div class="m-5">
  <div>
    <input type="text" v-model="searchQuery" @input="filter" placeholder="search pending doctors" class="p-2 text-xl rounded-xl border-2 border-gray-400 w-96">
  </div>
  <p class="text-2xl text-tiruhakim mx-4">list of pending doctors</p>
  <div v-for="doctor in pendingDoctors" :key="doctor.id" class="">
   <div class="flex">
     <img :src="'/storage/doctors/'+doctor.avatar" class="w-16 h-16 rounded-full my-auto mx-2">
     <div>
       <p class="text-xl capitalize mx-1">{{doctor.name}}</p>
       <stars-component :doctorId="doctor.id"/>  
     </div>
     <div class="my-auto">
       <button @click="doctor=doctor;popup=true" class="text-white bg-tiruhakim text-xl py-2 px-4 rounded-xl">
         claim profile    
       </button>  
     </div>
   </div>
  </div>
  <div v-if="popup" class="absolute top-1/4 left-1/3 bg-white z-20 rounded-xl py-5 px-10">
   <p class="text-2xl text-center m-2">verify your email to get a profile</p>
   <input type="email" v-model="email" required placeholder="enter your email" :class="[error? 'border-red-500':'border-gray-200']" class=" w-96 border-2 rounded-xl w-72 p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   <button @click="claimProfile" class="bg-tiruhakim text-white text-xl py-2 px-4 rounded-2xl">claim profile</button>  
 </div>
  <div v-if="popup" @click="popup=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
 </div>  
</template>
<script>
export default {
  data(){
   return {   
    searchQuery:'',
    popup:false,
    pendingDoctors:[],
    filteredDoctors:[],
    email:'',
    doctor:{}
   }
  },
  mounted(){
    axios.get('/doctor/pendingdoctors')
    .then(res=>{
      this.pendingDoctors=res.data.doctors;
      this.filteredDoctors=this.pendingDoctors;
    });
  },
  methods:{
    filter(){

    },
    claimProfile(){
      if(this.email==this.doctorEmail){
        axios.post('/doctor/claimprofile',{doctorId:this.doctor.id})
        .then(res=>{
          this.popup=false;
          this.toaster.success('your requestis sent to adminstrators');
        });
      }
      else{
        this.popup=false;
        this.toaster.warn('email does not much',{timeout:8000});
      }  
    }  
  }  
}
</script>