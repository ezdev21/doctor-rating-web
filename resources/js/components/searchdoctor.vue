<template>
<div>
  <div class="bg-tiruhakim py-5 px-10">
    <h1 class="text-4xl text-white capitalize">{{speciality.name}} doctors</h1>
    <p class="text-3xl text-gray-200 m-1">{{doctors.length}} results</p>
  </div>
  <div class="flex w-3/4 m-auto">
  <div v-if="doctors.length" class="w-3/4">
    <div v-for="doctor in filteredDoctors" :key="doctor.id" class="flex shadow-xl m-3 rounded-xl p-1">
    <img src="/storage/icons/hospital_logo.jpg" 
    class="w-32 h-32 rounded-2xl m-1">
    <div class="mx-3 my-auto">
      <p class="text-xl font-bold capitalize">Dr. {{doctor.name}}</p>
      <p class="text-gray-500 text-xl">{{doctor.speciality}}</p>
      <div>
        <stars-component :doctorId="doctor.id" />
      </div>
    </div>
    <div class="mx-3">
      <ol class="">
        <li v-for="hospital in doctor.hospitals" :key="hospital.id">{{hospital.name}}</li>
      </ol>
    </div>
    <div class="mx-3 my-auto">
      <a :href="'/doctor/profile/'+doctor.id" class="bg-tiruhakim text-xl py-2 px-3 text-white rounded-xl">view profile</a>
    </div>
   </div>
  </div>
  <div v-else>
    <p class="text-5xl text-red-600 my-5 mx-10">ooops no {{speciality.name}} doctor found in this website</p> 
  </div>
  <div v-if="doctors.length" class="w-1/3 text-xl mx-5">
   <div class="my-3 border-2 border-gray-400 rounded-xl py-3 px-10">
    <h2 class="text-2xl font-bold text-center">Sort</h2>
    <p><input @change="sort" type="radio" v-model="sortingMethod" value="rating" name="sort" class="m-1 form-radio text-tiruhakim border-2 border-tiruhakim w-8 h-8">Highest rating</p>
    <p><input @change="sort" type="radio" v-model="sortingMethod" value="experience" name="sort" class="m-1 form-radio text-tiruhakim border-2 border-tiruhakim h-8 w-8">Experience</p>
   </div>
   <div class="my-3 border-2 border-gray-400 rounded-xl py-3 px-16">
    <h2 class="text-2xl font-bold text-center">Gender</h2>
    <p><input @change="filterdoctors" v-model="gender" value="male" type="radio" name="gender" class="m-1 form-radio text-tiruhakim border-2 border-tiruhakim h-8 w-8">male</p>
    <p><input @change="filterdoctors" type="radio" v-model="gender" value="female" name="gender" class="m-1 form-radio text-tiruhakim border-2 border-tiruhakim h-8 w-8">female</p>
   </div>
   <div class="my-3 border-2 border-gray-400 rounded-xl py-3 px-16">
    <h2 class="text-2xl font-bold text-center">Age</h2>
    <p><input @change="filterdoctors" type="radio" v-model="age" value="under40" name="age" class="form-radio text-tiruhakim border-2 border-tiruhakim h-8 w-8">under 40</p>
    <p><input @change="filterdoctors" type="radio" v-model="age" value="between40and50" name="age" class="m-1 form-radio text-tiruhakim border-2 border-tiruhakim h-8 w-8">41-50</p>
    <p><input @change="filterdoctors" type="radio" v-model="age" value="between50and60" name="age" class="m-1 form-radio text-tiruhakim border-2 border-tiruhakim h-8 w-8">51-60</p>
   </div>
  </div>
  </div>
</div>
</template>
<script>
export default {
  props:['specialityId'],
  data(){
    return {
      speciality:{},
      doctors:[],
      sortingMethod:'rating',
      age:null,
      gender:null,
      filteredDoctors:[]
    }
  },
  mounted(){
   axios.get('/speciality/search',{params:{specialityId:this.specialityId}})
   .then(res=>{
      this.speciality=res.data.speciality;
      this.doctors=res.data.doctors;
      this.doctors.forEach(doctor=>{
        axios.get('/doctor/averagerate',{params:{doctorId:doctor.id}})
        .then(res=>{
          doctor.rate=res.data.rate;
        });
      });
      this.filteredDoctors=this.doctors;
      this.filteredDoctors.sort(function(a,b){
        if(a.rate>b.rate){
          return 1;
        }
       else if(a.rate<b.rate){
         return -1;
       }
       else{
         return 0;
       }
      });
   });
  },
  methods:{
    sort(){
      if(this.sortingMethod=="rating"){
       this.filteredDoctors.sort(function(a,b){
        if(a.rate>b.rate){
          return 1;
        }
       else if(a.rate<b.rate){
         return -1;
       }
       else{
         return 0;
       }
       }
      );
      }
      if(this.sortingMethod=="experience"){
       this.filteredDoctors.sort(function(a,b){
        if(a.experience>b.experience){
          return 1;
        }
        else if(a.experience<b.experience){
         return -1;
        }
        else{
         return 0;
        }
       }
      );
      }
    },
    filterdoctors(){
     this.filteredDoctors=[];
     if(this.age==null){
       this.doctors.forEach(doctor=>{
        if(doctor.gender==this.gender){
          this.filteredDoctors.push(doctor);
        }
       });
     }
     if(this.age=='under40'){
       this.doctors.forEach(doctor=>{
         if((doctor.age<=40)){
           if(this.gender==null){
             this.filteredDoctors.push(doctor);
           }
           else{
             if(doctor.gender==this.gender){
               this.filteredDoctors.push(doctor);
             }
           }
         }
       });
     }
     if(this.age=='between40and50'){
       this.doctors.forEach(doctor=>{
        if((doctor.age>40&&doctor.age<=50)){
           if(this.gender==null){
             this.filteredDoctors.push(doctor);
           }
           else{
             if(doctor.gender==this.gender){
               this.filteredDoctors.push(doctor);
             }
           }
         }
       });
     }
     if(this.age=='between50and60'){
       this.doctors.forEach(doctor=>{
         if((doctor.age>50&&doctor.age<=60)){
           if(this.gender==null){
             this.filteredDoctors.push(doctor);
           }
           else{
             if(doctor.gender==this.gender){
               this.filteredDoctors.push(doctor);
             }
           }
         }
       });
     }
    }
  }
}
</script>