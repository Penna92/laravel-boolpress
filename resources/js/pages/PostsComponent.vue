<template>
  <section class="d-flex justify-content-between">
    <!-- <h1 class="text-danger">{{ titolo }}</h1>
    <h2 class="text-danger">{{ sottotitolo }}</h2> -->
    <section>
      <h1>Lista Posts</h1>
      <div class="card mb-5">
        <ul v-if="posts.length > 0">
          <li v-for="(post, index) in posts" :key="post.id">
            <!-- condizione che stampa solo i post pubblicati -->
            <span v-if="post.published == 1">
              {{ index }} - {{ post.title }}
              <router-link
                class="mx-2"
                :to="{ name: 'single-post', params: { slug: post.slug } }"
                >Visualizza Post</router-link
              >
              <hr />
            </span>
          </li>
        </ul>
      </div>
    </section>
    <aside>
      <h1>Categorie</h1>
      <div class="card mb-5">
        <ul>
          <li v-for="category in categories" :key="category.id">
            {{ category.id }} - {{ category.name }}
            <router-link
              class="mx-2"
              :to="{ name: 'category-posts', params: { slug: category.slug } }"
              >Visualizza post correlati</router-link
            >
            <hr />
          </li>
        </ul>
      </div>
    </aside>
  </section>
</template>

<script>
export default {
  name: "PostsComponent",
  data() {
    return {
      titolo: "Work In Progress",
      sottotitolo: "Sito in Costruzione",
      posts: [],
      categories: [],
      detail: null,
      date: null,
    };
  },
  methods: {
    // getDetail(slug) {
    //   axios.get("/api/posts/" + slug).then((response) => {
    //     // this.detail = response.data;
    //     this.posts[index].detail = response.data;
    //   });
    // },
  },
  created() {
    axios.get("/api/posts").then((response) => {
      this.posts = response.data;
      console.log(this.posts);
    });

    axios.get("/api/categories").then((response) => {
      this.categories = response.data;
      console.log(this.categories);
    });
  },
  computed: {
    // prova() {
    //   this.posts.foreach((el) => {
    //     // console.log(el.created_at.substr(0, 19).replace("T", ", "));
    //     return console.log(el);
    //   });
    // },
    // formattazione data
    // formatDate() {
    //   this.posts.foreach((el) => {
    //     let date = el.created_at.substr(0, 19).replace("T", ", ");
    //     return date;
    //   });
    // },
  },
};
</script>

<style lang="scss" scoped>
ul {
  margin-left: 0 !important;
  padding-left: 5px !important;
  padding-top: 20px;
}
</style>