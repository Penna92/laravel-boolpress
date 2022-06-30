<template>
  <section>
    <div class="my-5">
      <h1>BOOLPRESS</h1>
    </div>
    <div class="text-center">
      <h2>Il costruttore di siti</h2>
      <h2>più famoso al mondo.</h2>
      <p class="my-5">
        Il 43% dei siti web usa la tecnologia BoolPress. Blogger, piccole
        attività e grandi aziende nella lista Fortune 500 usano BoolPress più di
        tutte le alternative messe insieme. Unisciti ai milioni di utenti che
        hanno scelto BoolPress.com.
      </p>
    </div>
    <div class="row justify-content-between align-items-center">
      <div class="col-3">
        <nav>
          <ul class="p-0 my-2 d-flex flex-column justify-content-between">
            <li
              class="my-2 bg-dark p-1"
              v-for="(category, index) in categories"
              :key="index"
            >
              <router-link
                :to="{
                  name: 'category-posts',
                  params: { slug: category.slug },
                }"
                >{{ category.name }}</router-link
              >
            </li>
          </ul>
        </nav>
      </div>
      <div class="col-8">
        <carousel-component />
      </div>
    </div>
  </section>
</template>

<script>
import CarouselComponent from "../components/CarouselComponent.vue";
export default {
  name: "HomeComponent",
  components: {
    CarouselComponent,
  },
  data() {
    return {
      categories: [],
      posts: [],
    };
  },
  mounted() {
    axios
      .get("/api/categories")
      .then((res) => {
        this.categories = res.data;
      })
      .catch((error) => {
        console.log(error);
      });

    axios
      .get("/api/posts/")
      .then((res) => {
        this.posts = res.data.slice(0, 3);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style lang="scss">
</style>