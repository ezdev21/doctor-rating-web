<template>
 <div>
  <div v-for="user in users" :key="user.id" class="text-xl">
    <p>{{user.name}}</p>
    <p>{{user.email}}</p>  
  </div> 
  <div v-show="!users.length">
    <p class="text-2xl mx-3">no users found</p>
  </div>   
 </div>   
</template>
<script>
export default {
  data(){
    return{
      users:[]  
    }  
  },
  mounted(){
    axios.get('/allusers')
    .then(res=>{
      this.users=res.data.users;  
    })  
  }  
}
</script>