<template>
  <div>
    <div class="pageSize">
      <main>
        <div class="okno">
          <h3>Wpisz dane poniżej i załóż konto</h3>
          <form>
            <input
              type="text"
              class="form-control mb-2 mr-sm-2"
              v-model="data.nickname"
              placeholder="Wprowadź pseudonim"
            />
            <input
              type="email"
              class="form-control mb-2 mr-sm-2"
              v-model="data.email"
              placeholder="Wprowadź email"
            />
            <input
              type="password"
              class="form-control mb-2 mr-sm-2"
              v-model="data.password"
              placeholder="Wprowadż hasło"
            />

            <button
              type="submit"
              class="btn btn-primary mb-2"
              @click="DodajUzytkownika()"
            >
              Załóż konto
            </button>
            <router-link to="/">
              <button type="button" class="btn btn-danger mb-2">
                Wróć na stronę główną
              </button>
            </router-link>
          </form>
          <br />
          <br />
          <div class="text-center">
            <h3>Posiadasz już konto?</h3>
            <router-link class="text-center" to="/login">
              <button type="button" class="btn btn-info mb-2">
                Wróć do logowania
              </button>
            </router-link>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        nickname: "",
        email: "",
        password: "",
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

    async DodajUzytkownika() {
      if (this.data.nickname.trim() == "") {
        console.log("Proszę podać poprawny pseudonim");
      }
      if (this.data.email.trim() == "") {
        console.log("Proszę podać poprawny Email");
      }
      if (this.data.password.trim() == "") {
        console.log("Proszę uzupełnić poprawnie haslo");
      }
      const res = await this.callApi(
        "post",
        "/app/dodajUzytkownika",
        this.data
      );
      if (res.status === 200) {
        this.posts.unshift(res.data);
        this.data.nickname = "";
        this.data.email = "";
        this.data.password = "";
        window.location = "/login";
      } else {
        console.log(res);
      }
    },
  },
};
</script>