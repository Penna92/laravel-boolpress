<template>
  <section>
    <div class="card" v-if="post">
      <h1>Titolo: {{ post.title }}</h1>
      <p>Descrizione: {{ post.content }}</p>
      <ul v-if="post.tags">
        <li><h4>Tags:</h4></li>
        <li v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</li>
      </ul>
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

<style lang="scss">
</style>