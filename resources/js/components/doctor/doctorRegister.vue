<template>
<div class="w-full lg:w-2/3 xl:w-2/3 2xl:w-2/3 mx-3 my-3 mx-auto rounded-3xl p-3 bg-white">
 <h2 class="capitalize text-center text-tiruhakim text-3xl border-b-2 border-gray-300 p-2">submit the form below to get profile</h2>
 <form @submit.prevent="claimProfile" enctype="multipart/form-data">
  <label for="name" class="text-2xl text-tiruhakim capitalize m-1">full name</label>
  <input type="text" v-model="name" placeholder="full name" required class="text-tiruhakim m-1 border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2"/>    
  <label for="email" class="text-2xl text-tiruhakim capitalize m-1">email</label>
  <input type="email" v-model="email" @input="checkEmail" placeholder="email" required class="text-tiruhakim m-1 border-2 border-gray-200 rounded-xl w-full py-1.5 px-2 text-xl outline-none focus:border-b-2"/>
  <p v-if="emailError" class="text-xl text-red-600">Email already taken! a Doctor with this email is already registered</p>
  <label for="speciality" class="capitalize m-1 text-2xl text-tiruhakim m-1">speciality</label>
  <div class="flex">
    <!-- <multiselect v-model="value" :options="options"></multiselect> -->
    <select v-model="selectedSpeciality" @change="selectSpeciality" class="border-2 border-tiruhakim text-tiruhakim text-xl rounded-md px-3 py-1 ml-1 mr-3 my-1">
      <option value="">select</option>
      <option v-for="speciality in allSpecialities" :key="speciality.id" :value="speciality.id" class="text-tiruhakim">{{speciality.name}}</option>
    </select>
      <div>
       <button @click="popup=true" class="text-white bg-tiruhakim text-xl rounded-xl px-4 py-2">add speciality</button>
       <div v-if="popup" class="absolute top-1/4 left-1/3 bg-white z-20 rounded-xl py-5 px-10">
        <p class="capitalize text-2xl text-center m-2">add new speciality here</p>
        <input @keyup.enter="addSpeciality" type="text" v-model="specialityName" required placeholder="new speciality" class="m-1 border-2 rounded-xl w-72 p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
        <button @click="addSpeciality" class="flex bg-tiruhakim text-white text-xl py-2 px-4 rounded-2xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>add new</span>
        </button>  
       </div>
      <div v-if="popup" @click="popup=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
      </div> 
   </div>
  <div class="my-3">
    <label for="avatar" class="m-1 capitalize text-2xl text-tiruhakim m-1">profile photo</label>
    <input type="file" @change="onChange" required accept="image/*" class="rounded-lg m-1 text-xl text-tiruhakim border-2 border-tiruhakim"/>
  </div>
    <p class="text-2xl m-1 capitalize text-tiruhakim m-1">
      <span>hospital you work</span>
      <button v-if="!showHospitalField" @click="showHospitalField=true" class="bg-tiruhakim text-white text-xl py-2 px-4 rounded-xl">add</button>
    </p>
    <div v-for="hospital in addedHospitals" :key="hospital.id" class="bg-blue-100 border-b-2 border-gray-300 rounded-lg">
      <div class="flex no-underline hover:no-underline">
        <img :src="'/storage/hospitals/'+hospital.picture" class="m-1 rounded-full w-16 h-16"/>
        <div class="mx-1 my-auto">
          <p class="text-xl capitalize">{{hospital.name}}</p>
          <hospitalstars-component :hospitalId="hospital.id" />
        </div>
        <div class="mx-1 my-auto">
          <p class="text-xl capitalize">{{hospital.city}}</p>
          <p class="text-xl capitalize">{{hospital.location}}</p>
        </div>
        <div class="my-auto">
          <button @click="removeFromHospitals(id)" class="bg-tiruhakim text-white text-xl py-2 px-4 rounded-xl">cancel</button>
        </div>
      </div>
      </div>
    <input type="text" v-if="showHospitalField" v-model="hospital" @input="filterHospitals" placeholder="hospital name" class="text-tiruhakim m-1 border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
    <div v-if="filteredHospitals&&hospital">
       <div v-for="hospital in filteredHospitals" :key="hospital.id" class="bg-white hover:bg-gray-100 border-b-2 border-gray-300 rounded-lg">
        <div class="flex no-underline hover:no-underline">
        <img :src="'/storage/hospitals/'+hospital.picture" class="m-1 rounded-full w-16 h-16"/>
        <div class="mx-1 my-auto">
          <p class="text-xl capitalize mx-1">{{hospital.name}}</p>
          <hospitalstars-component :hospitalId="hospital.id" />
        </div>
        <div class="text-xl mx-5 my-auto">
          <p>{{hospital.city}}</p>
          <p>{{hospital.location}}</p>
        </div>
        <div class="my-auto">
          <button @click="addHospital(hospital.id)" class="bg-tiruhakim text-xl text-white py-2 px-4 rounded-xl">add</button>
        </div>
       </div>
      </div>
  </div>
  <label class="capitalize text-2xl text-tiruhakim m-1 my-2">experience(in years)</label>
   <select name="experience" v-model="experience" required class="border-2 border-tiruhakim text-tiruhakim text-xl py-1 rounded-md px-3">
     <option value="">select</option>
     <option v-for="experience in 30" :key="experience" :value="experience" class="text-tiruhakim text-xl">{{experience}}</option>
   </select>
   <label class="capitalize m-1 text-2xl text-tiruhakim tiruhakim block">phone number</label>
   <input type="number" v-model="phoneNumber" placeholder="phone number" required class="text-tiruhakim m-1 border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim"/>
   <p class="my-1">
    <label for="sex" class="capitalize m-1 text-tiruhakim text-2xl mr-2">sex</label>
    <span class="text-2xl text-tiruhakim mx-2"><input type="radio" v-model="gender" value="male" required="required" class="form-radio text-tiruhakim h-6 w-6 border-2 border-tiruhakim mx-1">male</span>
    <span class="text-2xl text-tiruhakim mx-2"><input type="radio" v-model="gender" value="female" required="required" class="form-radio text-tiruhakim h-6 w-6 border-2 border-tiruhakim mx-1">female</span>
   </p> 
    <label for="age" class="m-1 capitalize text-tiruhakim text-2xl">age</label>
   <input type="number" v-model="age" max="60" min="25" placeholder="age" class="text-tiruhakim m-1 text-xl p-2 w-32 rounded-xl w-20 border-2 border-gray-200">
   <div class="flex">
     <label for="languages" class="mr-3 text-2xl text-tiruhakim capitalize my-auto">languages</label>
     <div v-for="language in allLanguages" :key="language.id" class="flex">
       <div class="m-1">
         <input type="checkbox" v-model="languages" :value="language.id" class="w-6 h-6 border-2 form-checkbox text-tiruhakim border-tiruhakim">
         <span class="m-1 text-xl text-tiruhakim">{{language.name}}</span>
       </div>
     </div>
  </div>
   <button v-if="processing" class="my-3 mx-6 py-2 px-3 rounded-3xl text-xl bg-tiruhakim text-white p-1">processing</button>
   <input v-else type="submit" :disabled="emailError" value="Register" :class="[processing? 'cursor-wait':'',emailError? 'cursor-not-allowed':'']" class="my-3 py-2 px-5 rounded-3xl text-xl bg-tiruhakim text-white p-1">
 </form>
 <div v-if="registerPopup" class="inset-center bg-white z-20 rounded-xl py-5 px-10">
   <button @click="backToSite" class="absolute text-tiruhakim top-2 right-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-tiruhakim h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
   </button>
   <h1 class="capitalize text-3xl text-center m-2">thank you</h1>
   <p class="text-gray-600 text-2xl">your submission has been recieved.<br>we will be in touch and contact you soon!</p>
   <button @click="backToSite" class="text-xl text-white bg-tiruhakim py-2 px-4 rounded-lg block mx-auto my-2">back to site</button> 
  </div>
  <div v-if="registerPopup" @click="backToSite" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
</div>    
</template>
<script>
import hospitalStars from '../hospitalstars.vue';
export default {
  components:{
    "hospitalStars":hospitalStars
  },
  data(){
   return { 
    allSpecialities:[],
    allLanguages:[],
    allHospitals:[], 
    specialities:[],
    selectedSpeciality:'',
    languages:[],
    allHospitals:[],
    filteredHospitals:[],
    specialityName:'',
    name:'',
    email:'',
    experience:'',
    phoneNumber:'',
    hospital:'',
    hospitalId:[],
    addedHospitals:[],
    age:'',
    gender:'',
    file:'',
    processing:false,
    popup:false,
    registerPopup:false,
    showHospitalField:true,
    emails:[],
    emailError:false
   }
  },
  mounted(){ 
   axios.get('/allspecialities')
   .then(res=>{
     this.allSpecialities=res.data.specialities;
     console.log(this.allSpecialities);
   });
   axios.get('/allhospitals')
   .then(res=>{
    this.allHospitals=res.data.hospitals;
   });
   axios.get('/languages')
   .then(res=>{
     this.allLanguages=res.data.languages;
   });
   axios.get('/doctor/emails')
   .then(res=>{
     this.emails=res.data.emails;
   });
  },
  methods:{
    checkEmail(){
      this.emailError=false;
      this.emails.forEach(email=>{
        if(this.email==email){
          this.emailError=true;
        }
      });
    },
    selectSpeciality(){
      this.specialities.push(this.selectedSpeciality);
    },
    addSpeciality(){
      axios.post('/doctor/addSpeciality',{specialityName:this.specialityName})
      .then(res=>{
        let speciality=res.data.speciality;
        this.allSpecialities.push(speciality);
        this.specialities.push(speciality.id);
        this.popup=false;
        this.specialityName="";
      });
    },
    removeFromHospitals(id){
      let hospital=this.addedHospitals.find(hospital=>{
        return hospital.id==id;
       });
      this.addedHospitals.pop(hospital);
    },
    filterHospitals(){
      let added=false;
      this.filteredHospitals=[];
      this.allHospitals.forEach(hospital=>{
        if(hospital.name.toLowerCase().match(this.hospital.toLowerCase())){
          this.addedHospitals.forEach(addedHospital=>{
            if(addedHospital.id==hospital.id){
              added=true;
            }
          });
          if(!added){
           this.filteredHospitals.push(hospital); 
          }
        }
      });
    },
    onChange(e){
     this.file = e.target.files[0];
    },
    addHospital(id){
      this.hospitalId.push(id);
      this.allHospitals.forEach(hospital=>{
       if(hospital.id==id){
         this.addedHospitals.push(hospital);
       }
      });
      this.hospital='';
      this.showHospitalField=false;
    },
    claimProfile(){
      this.processing=true;
      let currentObj = this;
      const config = {
          headers: { 'content-type': 'multipart/form-data' }
      }
      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('languages', this.languages);
      formData.append('specialities', this.specialities);
      formData.append('name', this.name);
      formData.append('email', this.email);
      formData.append('experience', this.experience);
      formData.append('phoneNumber', this.phoneNumber);
      formData.append('age', this.age);
      formData.append('hospital', this.hospital);
      formData.append('hospitalId', this.hospitalId);
      formData.append('gender', this.gender);
      axios.post('/doctor/register',formData,config)
      .then(res=>{
        this.registerPopup=true;
      });
    },  
    backToSite(){
      window.location.href="/";
    }
  }  
}
</script>