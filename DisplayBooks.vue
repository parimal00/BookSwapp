<template>
  <div>
    <section class="wrapper">
      <div class="container-fostrap">
        <div class="content">
          <div class="container">
            <div class="row my-4" v-for="(e, row) in 3" :key="row">
              <div
                v-for="(e, column) in 3"
                :key="column"
                class="col-xs-12 col-sm-4"
              >
                <div class="card">
                  <a
                    class="img-card"
                    href="http://www.fostrap.com/2016/03/bootstrap-3-carousel-fade-effect.html"
                  >
                    <img :src="'/uploads/' + books[row][column].book_image" />
                  </a>
                  <div class="card-content">
                    <h4 class="card-title">
                      <a href=""> {{ books[row][column].book_name }} </a>
                    </h4>
                    <p class="">Author:{{ books[row][column].author_name }}</p>
                    <p class="">Posted By:{{ books[row][column].name }}</p>
                  </div>
                  <div class="card-read-more">
                    <a
                      href="http://www.fostrap.com/2016/03/bootstrap-3-carousel-fade-effect.html"
                      class="btn btn-link btn-block"
                    >
                      Read More
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- <div class="thisPage">
      <div v-for="book in books" :key="book.id">
        {{ book.image_path }}
        <img
          :src="'/uploads/' + book.book_image"
          width="100px"
          height="100px"
        />
        email = {{ book.email }} id = {{ book.id }} author =
        {{ book.author_name }} description = {{ book.description }}
        <button
          @click="
            showSwapBookForm(
              book.id,
              book.author_name,
              book.description,
              book.email
            )
          "
        >
          Swap Book
        </button>
      </div>
      <div v-if="show">
        <SwapBookForm :id="id" :userIdToSend="userIdToSend" :email="email" />
      </div>
    </div> -->
  </div>
</template>

<script>
import SwapBookForm from "./SwapBookForm.vue";

export default {
  components: { SwapBookForm },
  props: ["email"],
  data() {
    return {
      row: 0,
      column: 0,
      no_of_row: 0,
      show: false,
      books: null,
      id: null,
      author: null,
      description: null,
      userIdToSend: null,
    };
  },
  methods: {
    showSwapBookForm(id, author, description, user_id) {
      this.show = true;
      this.id = id;
      this.author = author;
      this.description = description;
      this.userIdToSend = user_id;
      console.log(this.books.email);
    },
  },
  mounted() {
    axios.get("/api/viewBooks").then((response) => {
      //console.log(response.data.email);
      this.books = response.data;
      this.no_of_row = parseInt(response.data.length / 3) + 1;

      //console.log(this.no_of_row);
      const arr = response.data;

      const newArr = [];
      while (arr.length) newArr.push(arr.splice(0, 3));

      this.books = newArr;
      let i;
      let j;
      for (i = 0; i < 3; i++) {
        for (j = 0; j < 3; j++) {
          console.log(this.books[i][j].id);
        }
      }
    });
  },
};
</script>

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

html,
body {
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  height: 100%;
  width: 100%;
  background: #fff;
  font-family: "Roboto", sans-serif;
  font-weight: 400;
}

.wrapper {
  display: table;
  height: 100%;
  width: 100%;
}

.container-fostrap {
  display: table-cell;
  padding: 1em;
  text-align: center;
  vertical-align: middle;
}
.fostrap-logo {
  width: 100px;
  margin-bottom: 15px;
}
h1.heading {
  color: #fff;
  font-size: 1.15em;
  font-weight: 900;
  margin: 0 0 0.5em;
  color: #505050;
}
@media (min-width: 450px) {
  h1.heading {
    font-size: 3.55em;
  }
}
@media (min-width: 760px) {
  h1.heading {
    font-size: 3.05em;
  }
}
@media (min-width: 900px) {
  h1.heading {
    font-size: 3.25em;
    margin: 0 0 0.3em;
  }
}
.card {
  display: block;
  margin-bottom: 20px;
  line-height: 1.42857143;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  transition: box-shadow 0.25s;
}
.card:hover {
  box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.img-card {
  width: 100%;
  height: 200px;
  border-top-left-radius: 2px;
  border-top-right-radius: 2px;
  display: block;
  overflow: hidden;
}
.img-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  transition: all 0.25s ease;
}
.card-content {
  padding: 15px;
  text-align: left;
}
.card-title {
  margin-top: 0px;
  font-weight: 700;
  font-size: 1.65em;
}
.card-title a {
  color: #000;
  text-decoration: none !important;
}
.card-read-more {
  border-top: 1px solid #d4d4d4;
}
.card-read-more a {
  text-decoration: none !important;
  padding: 10px;
  font-weight: 600;
  text-transform: uppercase;
}
.thisPage {
  width: 100%;
  height: 100vh;
  background-color: red;
}
</style>