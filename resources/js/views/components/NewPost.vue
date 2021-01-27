<template>
  <div>
    <div class="pageSize" style="text-align: center">
      <h3>Utwórz nowy post</h3>
      <input v-model="data.title" type="text" placeholder="Tytuł" />
      <textarea
        style="width: 300px; height: 250px"
        v-model="data.content"
        rows="5"
        type="text"
        placeholder="Zawartosc"
      />

      <router-link to="/posts"
        ><button
          type="submit"
          class="btn btn-primary mb-2"
          @click="DodajPost()"
        >
          Dodaj
        </button>
      </router-link>
      <router-link to="/posts"
        ><button
          type="submit"
          class="btn btn-danger mb-2"
        >
          Wróć
        </button>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        user_ID: 1,
        title: "",
        user_nickname: "Chlorek",
        content: "",
      },
    };
  },
  methods: {
    async callApi(method, url, dataObj) {
      try {
        return await axios({
          method: method,
          url: url,
          data: dataObj,
        });
      } catch (error) {
        console.log(error.message);
      }
    },

    async DodajPost() {
      if (this.data.user_ID.trim() == "") {
        console.log("Proszę uzupełnić poprawnie dane");
      }
      if (this.data.title.trim() == "") {
        console.log("Proszę uzupełnić poprawnie dane");
      }
      if (this.data.user_nickname.trim() == "") {
        console.log("Proszę uzupełnić poprawnie dane");
      }
      if (this.data.content.trim() == "") {
        console.log("Proszę uzupełnić poprawnie dane");
      }
      const res = await this.callApi("post", "/app/dodajPost", this.data);
      if (res.status === 200) {
        this.posts.unshift(res.data);
        this.data.user_ID = "";
        this.data.title = "";
        this.data.user_nickname = "";
        this.data.content = "";
      } else {
        console.log(res);
      }
    },
  },
  async created() {
    const post = await this.callApi("get", "/app/wyswietlPosty");
    if (post.status === 200) {
      this.posts = post.data;
    } else {
      console.log(post);
    }
  },
};
</script>