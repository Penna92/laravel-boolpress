<template>
  <section>
    <div class="card container mb-5" v-if="post">
      <h1>Titolo: {{ post.title }}</h1>
      <span>
        <h2>Descrizione:</h2>
        <!-- metodo per formattare l'html su vue -->
        <p v-html="post.content"></p>
      </span>
      <div v-if="post.tags">
        <h4>Tags:</h4>
        <p v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</p>
      </div>
      <img :src="`/storage/${post.image}`" alt="" />
    </div>
  </section>
</template>

<script>
export default {
  name: "SinglePostComponent",
  data() {
    return {
      post: null,
    };
  },
  mounted() {
    console.log(this.$route.params.slug);
    const slug = this.$route.params.slug;
    axios.get(`/api/posts/${slug}`).then((response) => {
      this.post = response.data;
    });
  },
};
</script>

<style lang="scss" scoped>
.card {
  img {
    width: 250px;
    height: 300px;
  }
}
</style>