<template>
  <section>
    <div class="card mb-5" v-if="post">
      <div class="card-header">
        <h1>Titolo: {{ post.title }}</h1>
      </div>
      <div class="card-body">
        <small class="mr-3">Data ultima modifica: {{ formatDate }}</small>
        <!-- <div v-if="post.published == 1">
            <p class="badge-success d-inline-block p-1 rounded">Pubblicato</p>
          </div>
          <div v-if="post.published != 1">
            <p class="badge-danger d-inline-block p-1 rounded">
              Non ancora pubblicato
            </p>
          </div> -->
        <h2>Descrizione:</h2>
        <!-- metodo per formattare l'html su vue -->
        <p v-html="post.content"></p>
        <div v-if="post.tags.length > 0">
          <h4>Tags:</h4>
          <p v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</p>
        </div>
        <div v-if="post.image">
          <img
            :src="`/storage/${post.image}`"
            :alt="`immagine ` + post.title"
          />
        </div>
        <div class="card mt-5 p-3">
          <h3>Inserisci un commento</h3>
          <form @submit.prevent="addComment()">
            <div class="d-flex align-items-center">
              <label for="username">Nome</label>
              <input class="mx-2" v-model="formData.username" type="text" />
              <label class="mx-2" for="content">Testo</label>
              <textarea
                v-model="formData.content"
                type="text"
                rows="6"
                cols="50"
              >
              </textarea>
              <button class="mx-3 btn btn-primary" type="submit">Invia</button>
            </div>
          </form>
        </div>
        <div class="card">
          <ul v-if="post.comments.length > 0">
            <div class="card-header">
              <h4>Commenti:</h4>
            </div>
            <li v-for="comment in post.comments" :key="comment.id">
              {{ comment.username }}: {{ comment.content }}
              <hr />
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "SinglePostComponent",
  data() {
    return {
      post: null,
      formData: {
        username: "",
        content: "",
        post_id: "",
      },
    };
  },
  methods: {
    addComment() {
      axios
        .post("/api/comments", this.formData)
        .then((response) => {
          console.log(response);
          this.post.comments.push(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    console.log(this.$route.params.slug);
    const slug = this.$route.params.slug;
    axios
      .get(`/api/posts/${slug}`)
      .then((response) => {
        this.post = response.data;
        this.formData.post_id = this.post.id;
      })
      .catch((error) => {
        console.log("Show error notification!");
        // return Promise.reject(error);
        this.$router.push({ name: "page-404" });
      });
  },
  computed: {
    // formattazione data
    formatDate() {
      return this.post.updated_at.substr(0, 19).replace("T", ", ");
    },
  },
};
</script>

<style lang="scss" scoped>
ul {
  padding-left: 0 !important;
  margin-left: 0 !important;
}
.card {
  img {
    width: 250px;
    height: 300px;
  }
}
h1,
h2,
h3,
h4,
h5,
h6 {
  color: black;
}
</style>