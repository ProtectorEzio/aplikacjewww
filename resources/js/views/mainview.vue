<template>
  <div>
        <Header/>
        <router-view></router-view>
        <Footer/>
    </div>
</template>

<script>
import Header from "./components/Header";
import Footer from "./components/Footer";

export default {
  props: ['user'],
  data(){
    return {
      isLoggedIn: false,
    }
  },
  components: {
    Header,
    Footer,
  },
  created(){
    this.$store.commit('setUpdateUser', this.user)
  }
};
</script>
<style>
@import "../../css/styles.css";
</style>