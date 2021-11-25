<template>
  <div class="uploadbook-container">
      <div class="abcd" >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
          <button
            type="button"
            @click="closeModal"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body scroll">
          <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action">
     <div v-for="notification in notifications" :key="notification.notification_id"  >
           <div v-if="notification.status===2"> 
            {{notification.name}} wants
    to swap {{notification.book_name}}
    with {{notification.req_book_title}} <br>
    <Button class="btn btn-primary " @click="acceptReqHandlar(notification.req_book_title,notification.email)" > Accept </Button>
    <Button class="btn btn-primary " @click="rejectReqHandlar(notification.req_book_title,notification.email)"> Reject </Button>
    </div>
    <div v-if="notification.status===1"> 
            {{notification.name}} has accepted your request
    
    </div>
     <div v-if="notification.status===0"> 
         <p> {{notification.name}} has rejected your request</p>  
    
    </div>
     </div>
  </a>
  

             
      </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            @click="closeModal"
           
          >
            Close
          </button>
          
        </div>
      </div>
    </div>
    </div>
    </div>
  
  
</template>

<script>
export default {
  data() {
    return {
      notifications: null,
      formData: {
        email: this.email,
      },
    };
  },
 
  props: ["email"],
  methods: {
    closeModal(){
      console.log('clicked')
      this.$emit('closeModal')
     
    },
    
    acceptReqHandlar(req_book_title, email) {
      let fd = new FormData();
      fd.append("req_book_title", req_book_title);
      fd.append("send_from", email);
      fd.append("send_to", this.email);

      axios.post("/api/acceptReq", fd).then((response) => {
        console.log(response);
      });
    },
    rejectReqHandlar(req_book_title, email) {
      console.log("rejected");
      let fd = new FormData();
      fd.append("req_book_title", req_book_title);
      fd.append("send_from", email);
      fd.append("send_to", this.email);

      axios.post("/api/rejectReq", fd).then((response) => {
        console.log(response);
      });
    },
  },
  mounted() {
    axios.post("/api/view_notification", this.formData).then((response) => {
      console.log(response.data);
      this.notifications = response.data;
      console.log(this.notifications);
    });
  },
};
</script>

<style scoped>
.modal-body{
    width:100%;
    
}
.uploadbook-container {
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

label {
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
  margin: 4px, 4px;
  padding: 4px;

  width: 100%;

  height: 70vh;
  overflow-x: hidden;
  overflow-y: auto;
  text-align: justify;
}
input {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}
</style>