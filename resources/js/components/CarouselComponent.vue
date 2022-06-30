<template>
  <agile>
    <div class="slide" v-for="n in 6" :key="n" :class="`slide--${n}`"></div>
    <template slot="prevButton"><i class="fas fa-chevron-left"></i></template>
    <template slot="nextButton">
      <i class="fas fa-chevron-right"></i>
    </template>
  </agile>
</template>

<script>
export default {
  name: "CarouselComponent",
  data() {
    return {
      categories: [],
      // posts: [],
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

    // axios
    //   .get("/api/posts/")
    //   .then((res) => {
    //     this.posts = res.data.slice(0, 1);
    //     // this.posts = res.data;
    //   })
    //   .catch((error) => {
    //     console.log(error);
    //   });
  },
};
</script>

<style lang="scss" scoped>
.agile {
  width: 80%;
}
.agile__actions {
  margin-top: 20px;
}
// .agile__nav-button {
//   background: transparent;
//   border: none;
//   color: #ccc;
//   cursor: pointer;
//   font-size: 24px;
//   transition-duration: 0.3s;
// }
// .agile__nav-button:hover {
//   color: #888;
// }
// .agile__dot {
//   margin: 0 10px;
// }
// .agile__dot button {
//   background-color: #eee;
//   border: none;
//   border-radius: 50%;
//   cursor: pointer;
//   display: block;
//   height: 10px;
//   font-size: 0;
//   line-height: 0;
//   margin: 0;
//   padding: 0;
//   transition-duration: 0.3s;
//   width: 10px;
// }
// .agile__dot--current button,
// .agile__dot:hover button {
//   background-color: green;
// }

.slide {
  align-items: center;
  color: #fff;
  display: flex;
  height: 300px;
  justify-content: center;
}

.slide--1 {
  background: url("https://magazine.giallozafferano.it/wp-content/uploads/2016/11/fettuccine-tartufo.jpg")
    center center no-repeat;
  background-size: contain;
}

.slide--2 {
  background: url("https://blog.giallozafferano.it/allacciateilgrembiule/wp-content/uploads/2019/05/risotto-allo-zafferano.jpg")
    center center no-repeat;
  background-size: contain;
}

.slide--3 {
  background: url("https://blog.giallozafferano.it/allacciateilgrembiule/wp-content/uploads/2020/02/crocchette-di-patate2.jpg")
    center center no-repeat;
  background-size: contain;
}

.slide--4 {
  background: url("https://www.giallozafferano.it/images/235-23503/Ciambella-alla-Nutella_780x520_wm.jpg")
    center center no-repeat;
  background-size: contain;
}

.slide--5 {
  background: url("https://www.giallozafferano.it/images/217-21730/Torta-margherita_650x433_wm.jpg")
    center center no-repeat;
  background-size: contain;
}

.slide--6 {
  background: url("https://www.giallozafferano.it/images/184-18442/Red-Velvet-Cake_780x520_wm.jpg")
    center center no-repeat;
  background-size: contain;
}
</style>