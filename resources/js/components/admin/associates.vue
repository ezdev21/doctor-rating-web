<template>
<div>
  <h1>add new associate</h1>
 <div>
   <form @submit.prevent="addAssociate">
    <input type="text" v-model="associateName" required class="p-2 w-96 text-xl border-2 border-gray-300 rounded-xl">
    <input type="submit" value="add">
   </form>
 </div>
 <div v-for="associate in associates" :key="associate.id" class="p-1 m-1">
   <p class="text-xl">{{associate.name}}</p>
   <p class="text-xl">{{associate.email}}</p>
 </div>
 <div v-show="!associates.length">
   <p class="text-2xl mx-3">no associates found</p>
 </div>
</div>  
</template>
<script>
export default {
  data(){
   return{
     associates:[],
     associateName:''  
   }   
  },
  mounted(){
    axios.get('/allassociates')
    .then(res=>{
      this.associates=res.data.associates;
    });
  },
  methods:{
    addAssociate(){
      axios.post('admin/addassociate',{associateName:this.associateName})
      .then(res=>{
        let associate=res.data.associate;
        this.associates.push(associate);
      });
    }
  }  
}
</script>