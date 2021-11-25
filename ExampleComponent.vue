<template>
  <div>
 
<!-- Modal -->

    <div>
    
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item" @click="uploadBookClickHandlar">
                <a class="nav-link" href="#">Post a book?</a>
              </li>
             
              <li class="nav-item" @click="notificationClickHandlar">
                <a class="nav-link"  href="#">Notifications</a>
              </li>
            </ul>
            <form class="d-flex">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <ul>
        <li
          @click="uploadBookClickHandlar"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
        >Post a book?</li>
        <li  data-bs-toggle="modal"
          data-bs-target="#exampleModal" @click="notificationClickHandlar">Notifications</li>
        <li @click="messagesClickHandlar">Messages</li>
      </ul>
    </div>
   
    <div v-if="messageStatus">
      <Messages />
    </div>
   

    <DisplayBooks :email="email"/>
    
     <div v-if="showUploadBookForm">
      <UploadBookForm :email="email" @closeModal="uploadBookClickHandlar" />
    </div>

    <div v-if="notificationStatus">
      <Notifications :email="email" @closeModal="notificationClickHandlar"/>
    </div>
    
  </div>
</template>

<script>
import DisplayBooks from "./DisplayBooks.vue";
import UploadBookForm from "./UploadBookForm.vue";
import Notifications from "./Notifications.vue";
import Messages from "./Messages.vue";
export default {
  components: { DisplayBooks, UploadBookForm, Notifications, Messages},
  data() {
    return {
      showUploadBookForm: false,
      notificationStatus: false,
      messageStatus: false
    };
  },
  methods: {
    uploadBookClickHandlar() {
      this.showUploadBookForm = !this.showUploadBookForm;
      console.log("waaaa");
    },
    notificationClickHandlar() {
      this.notificationStatus = !this.notificationStatus;
      console.log("clicked");
    },
    messagesClickHandlar() {
      this.messageStatus = true;
    }
  },
  mounted() {

    console.log("Component mounted.");
  },
  props: ["email"]
};
</script>
