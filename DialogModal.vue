<template>
 <div class="uploadbook-container"> 
   {{bookTitle}}

   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" @click="closeModal" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to upload the book?</p>
        {{bookTitle}} {{bookAuthor}} {{bookImage}}
      </div>
      <div class="modal-footer">
        <button type="button" @click="uploadBook" class="btn btn-primary">Yes</button>
        <button type="button" @click="closeModal" class="btn btn-secondary" >No</button>
      </div>
    </div>
  </div>
 </div>
</template>

<script>
export default {
  props:['bookTitle','bookAuthor','bookImage','description','email'],
    methods:{
        closeModal(){
            console.log("closed")
            this.$emit('closeDialogModal')
        },
        uploadBook(){
            let fd= new FormData()
             fd.append('bookImage', this.bookImage)
             fd.append('bookTitle',this.bookTitle)
             fd.append('bookAuthor',this.bookAuthor)
             fd.append('description',this.description)
             fd.append('email',this.email)
             

             
            
          
            axios.post('/api/postBook',fd)
            .then((response)=>{
                console.log(response)
                this.closeModal()

            })
        }
    },
    mounted(){
      console.log(this.bookImage)
      console.log(this.email)
      console.log(this.description)
      
    }

}
</script>

<style scoped>
.uploadbook-container{
position: fixed;
    top: 5px;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
}
form{
  max-width: 420px;
  margin: 30px auto;
  background: white;
  text-align: left;
  padding: 40px;
  border-radius: 10px
}

label{
  color: #aaa;
  margin: 30px auto;
  display: inline-block;
  margin: 25px 0 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
.scroll {
                margin:4px, 4px;
                padding:4px;
               background: brown;
                width: 100%;
                height: 70vh;
                overflow-x: hidden;
                overflow-y: auto;
                text-align:justify;
            }
input{
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}


</style>