<template>
  <section>
    <div class="card mb-5" v-if="post">
      <div class="card-header">
        <h1>Titolo: {{ post.title }}</h1>
      </div>
      <div class="card-body">
        <small class="mr-3">Creato il: {{ formatDate }}</small>
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
    };
  },
  mounted() {
    console.log(this.$route.params.slug);
    const slug = this.$route.params.slug;
    axios.get(`/api/posts/${slug}`).then((response) => {
      this.post = response.data;
    });
  },
  computed: {
    // formattazione data
    formatDate() {
      return this.post.created_at.substr(0, 19).replace("T", ", ");
    },
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
h1,
h2,
h3,
h4,
h5,
h6 {
  color: black;
}
</style>