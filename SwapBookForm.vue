<template>
  <div>

    {{user_id}}
    {{id}}

   

    <!-- {{this.user_id=userIdToSend}} -->
       <form @submit.prevent method="GET">

         <input type="hidden" name="book_id" value="id">

        <input type="hidden" name="book_title" ><br>
        <input type="hidden" name ="authors_name" ><br>
        <input type="hidden" name ="description" ><br>
        <input type="hidden" name ="user_id" v-model="userIdToSend"><br>

        <input type="text" v-model="formData.req_book_title" name="req_book_title" placeholder="enter book title of your book you want to swap with"><br>
        <input type="text" v-model="formData.req_book_authors_name" name="req_book_authors_name" placeholder="enter your books' author name"><br>
        <input type="text" v-model="formData.req_book_description" name="req_book_description" placeholder="describe your book (optional)"><br>
        <button @click="sendSwapRequest"> send swap request </button> 
        {{formData.req_book_title}}
        {{formData.req_book_authors_name}}
       </form>

  </div>
</template>

<script>
export default {
    props:['id','userIdToSend','email'],
    data (){
      return{
        user_id:this.userIdToSend,
        book_id:this.id,
      
       
        formData:{
          req_book_title:null,
          req_book_authors_name:null,
          req_book_description:null,
          
          
         
        }


      }
     
    },
     mounted(){
       console.log(this.email)
       console.log(this.userIdToSend)
       console.log(this.id)
       
        
      },
      methods:{
        sendSwapRequest(){
          this.formData['send_to']=this.userIdToSend
          this.formData['book_id']=this.id
          this.formData['send_from']=this.email

          console.log(this.formData)
          console.log(this.formData)
         axios.post('/api/swap_books',this.formData)
         .then((response)=>{
            console.log(response)
         }
         )
       
        }
      }

}
</script>

<style>

</style>