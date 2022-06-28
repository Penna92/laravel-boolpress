<template>
  <main class="container">
    <router-view></router-view>
  </main>
</template>
<script>
export default {
  name: "MainComponent",
  // data() {
  //   return {
  //     titolo: "Work In Progress",
  //     sottotitolo: "Sito in Costruzione",
  //     posts: [],
  //     detail: null,
  //   };
  // },
  // methods: {
  //   getDetail(slug) {
  //     axios.get("/api/posts/" + slug).then((response) => {
  //       // this.detail = response.data;
  //       this.posts[index].detail = response.data;
  //     });
  //   },
  // },
  // created() {
  //   axios.get("/api/posts").then((response) => {
  //     this.posts = response.data;
  //   });
  // },
};
</script>
<style lang="scss">
</style>
