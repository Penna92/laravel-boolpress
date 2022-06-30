<template>
  <div class="container d-flex flex-column my-3 gap-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2>Categoria: {{ category.name }}</h2>
          </div>
          <div class="card-body">
            <h4 v-if="category && category.posts.length > 0">Related posts</h4>
            <h4 class="text-danger" v-if="category.posts.length == 0">
              Nessun post trovato per questa categoria
            </h4>
            <hr>
            <ul v-if="category.posts">
              <li v-for="post in category.posts" :key="post.id">
                Titolo: {{ post.title }}
                <router-link
                  class="mx-2"
                  :to="{ name: 'single-post', params: { slug: post.slug } }"
                  >Visualizza Post</router-link
                >
                <hr />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CategoryPostsComponent",
  data() {
    return {
      category: null,
    };
  },
  mounted() {
    console.log(this.$route.params.slug);
    const slug = this.$route.params.slug;
    axios
      .get(`/api/categories/${slug}`)
      .then((response) => {
        this.category = response.data;
        // this.formData.post_id = this.post.id;
      })
      .catch((error) => {
        console.log("Show error notification!");
        // return Promise.reject(error);
        this.$router.push({ name: "page-404" });
      });
  },
  computed: {},
};
</script>

<style lang="scss" scoped>
ul {
  margin-left: 0 !important;
  padding-left: 0 !important;
}
</style>