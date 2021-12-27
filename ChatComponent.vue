<template>
  <div class="chat-container">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
             @click="closethisModal"
            
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body scroll">
          <div class="list-group">

            <ul>
              
              <div   class="list-group-item list-group-item-action" @click="showMessage(user)" v-for="user in users" :key="user" >
                {{ user }}
               
              </div>
              
            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <button @click="closethisModal" type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
    <!-- <ul>
      <li @click="showMessage(user)" v-for="user in users" :key="user">
        {{ user }}
      </li>
    </ul>
    <p>chat Component</p>-->
    <div  v-if="showMessageModal">
    <ChatMessages @closeModal ="showMessage" :sendMsgTo="sendMsgTo" :email="email"/> 
 </div>
  </div>
</template>

<script>
import ChatMessages from "./ChatMessages.vue";

export default {
  components: { ChatMessages },
  methods: {
       closethisModal(){
      this.$emit('closeModal')

    },
    showMessage(user) {
      console.log("waaaa " + user);
      this.showMessageModal = !this.showMessageModal;
      this.sendMsgTo = user;
    },
  },

  props: ["email"],
  data() {
    return {
      users: [],
      showMessageModal: false,
      sendMsgTo: null,
    };
  },

  mounted() {
    console.log(this.email);
    axios.get("/api/list_users").then((response) => {
      console.log(response.data);
      response.data.forEach((element) => {
        console.log(element.email);
        this.users.push(element.email);
      });
    });
  },
};
</script>

<style scoped>
.scroll {
  margin: 4px, 4px;
  padding: 4px;

  width: 100%;

  height: 70vh;
  overflow-x: hidden;
  overflow-y: auto;
  text-align: justify;
}
.modal-dialog{
  width: 80%;
}
.chat-container {
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
</style>