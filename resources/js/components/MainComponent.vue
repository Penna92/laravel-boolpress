<template>
  <div>
    <h1 class="text-danger">{{ titolo }}</h1>
    <h2 class="text-danger">{{ sottotitolo }}</h2>
    <section>
      <div class="my-5">
        <h1>BOOLPRESS</h1>
      </div>
      <div class="text-center">
        <h2>Il costruttore di siti</h2>
        <h2>più famoso al mondo.</h2>
        <p class="my-5">
          Il 43% dei siti web usa la tecnologia BoolPress. Blogger, piccole
          attività e grandi aziende nella lista Fortune 500 usano BoolPress più
          di tutte le alternative messe insieme. Unisciti ai milioni di utenti
          che hanno scelto BoolPress.com.
        </p>
      </div>
      <h2>Lista Posts</h2>
      <ul>
        <li v-for="post in posts" :key="post.id">
          {{ post.title }}
          <a href="#" @click="getDetail(post.slug)">Vedi dettaglio</a>
          <!-- <span v-if="post.detail">
            {{ post.detail.slug }}
          </span> -->
          <!-- <p v-if="post.category">
            <strong>Categoria:</strong> {{ post.category.name }}
          </p>
          <div v-if="post.tags && post.tags.length > 0">
            <strong>Tags</strong>
            <ul>
              <li v-for="tag in post.tags" :key="tag.id">
                {{ tag.name }}
              </li>
            </ul>
          </div>
          <p v-html="post.content"></p> -->
        </li>
      </ul>
    </section>
  </div>
</template>
<script>
export default {
  name: "MainComponent",
  data() {
    return {
      titolo: "Work In Progress",
      sottotitolo: "Sito in Costruzione",
      posts: [],
      detail: null,
    };
  },
  methods: {
    getDetail(slug) {
      axios.get("/api/posts/" + slug).then((response) => {
        // this.detail = response.data;
        this.posts[index].detail = response.data;
      });
    },
  },
  created() {
    axios.get("/api/posts").then((response) => {
      this.posts = response.data;
    });
  },
};
</script>
<style lang="scss">
</style>
