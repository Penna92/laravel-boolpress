<template>
  <section>
    <!-- <h1 class="text-danger">{{ titolo }}</h1>
    <h2 class="text-danger">{{ sottotitolo }}</h2> -->
    <section>
      <h1>Lista Posts</h1>
      <ul v-if="posts.length > 0">
        <li v-for="(post, index) in posts" :key="post.id">
          {{ index }} - {{ post.title }}
          <router-link
            :to="{ name: 'single-post', params: { slug: post.slug } }"
            >Visualizza Post</router-link
          >
        </li>
      </ul>
    </section>
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
      detail: null,
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
    });
  },
};
</script>

<style lang="scss">
</style>