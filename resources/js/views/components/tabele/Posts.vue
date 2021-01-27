<template>
  <div class="pageSize">
    <input type="text" v-model="search" placeholder="fragment tytułu" />
    <button type="button" class="btn btn-primary" @click="fetch()">
      Szukaj
    </button>
    <input type="text" v-model="filtr" placeholder="Index Użytkownika" />
    <button type="button" class="btn btn-primary" @click="filtruj()">
      Filtruj
    </button>
    <select type="text" v-model="sort">
      <option>Rosnąco</option>
      <option>Malejąco</option>
    </select>
    <button type="button" class="btn btn-primary" @click="Sortuj()">
      Sortuj
    </button>
    <router-link to="/nowypost">
      <button type="button" class="btn btn-primary">Dodaj</button>
    </router-link>
    <div v-if="showSearch == true || filtrShow == true">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID Użytkownika</th>
            <th scope="col">Tytuł</th>
            <th scope="col">Nick Użytkownika</th>
            <th scope="col">Zawartość posta</th>
            <th scope="col">Akcje</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(wynik, i) in wyniki" :key="i">
            <td>{{ wynik.id }}</td>
            <td>{{ wynik.user_ID }}</td>
            <td>{{ wynik.title }}</td>
            <td>{{ wynik.user_nickname }}</td>
            <td>{{ wynik.content }}</td>
            <td>
              <button
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#myModal2"
                @click="pobierzDane(wynik, i)"
              >
                Edytuj
              </button>
              <button
                type="button"
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#myModal3"
                @click="usunDane(wynik, i)"
              >
                Usuń
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="showSearch == false && filtrShow == false">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID Użytkownika</th>
            <th scope="col">Tytuł</th>
            <th scope="col">Nick Użytkownika</th>
            <th scope="col">Zawartość posta</th>
            <th scope="col">Akcje</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post, i) in posts" :key="i">
            <td>{{ post.id }}</td>
            <td>{{ post.user_ID }}</td>
            <td>{{ post.title }}</td>
            <td>{{ post.user_nickname }}</td>
            <td>{{ post.content }}</td>
            <td>
              <button
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#myModal2"
                @click="pobierzDane(post, i)"
              >
                Edytuj
              </button>
              <button
                type="button"
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#myModal3"
                @click="usunDane(post, i)"
              >
                Usuń
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edytuj Post</h4>
          </div>
          <div class="modal-body">
            <input v-model="dane.title" type="text" placeholder="Tytuł" />
            <textarea
              style="width: 400px; height: 250px"
              v-model="dane.content"
              rows="5"
              type="text"
              placeholder="Zawartosc"
            />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Zamknij
            </button>
            <button
              type="button"
              class="btn btn-info"
              data-dismiss="modal"
              @click="EdytujPost()"
            >
              Edytuj
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal3">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Usuń Post</h4>
          </div>
          <div class="modal-body">
            <p>Czy jesteś pewien, że chcesz usunąć ten post?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Nie
            </button>
            <button
              type="button"
              class="btn btn-info"
              data-dismiss="modal"
              @click="UsunPost()"
            >
              Tak
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        user_ID: "",
        title: "",
        user_nickname: "",
        content: "",
      },
      dane: {
        title: "",
        content: "",
      },
      users: [],
      posts: [],
      wyniki: [],
      search: "",
      showSearch: false,
      filtrShow: false,
      index: -1,
      obiekt: {},
      indexU: -1,
      filtr: "",
      sort: "",
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
    async Sortuj() {
      if (this.sort == "Rosnąco") {
        const [user, post] = await Promise.all([
          this.callApi("get", "/app/wyswietlUzytkownikow"),
          this.callApi("get", "/app/sortujPostyup"),
        ]);
        if (user.status === 200) {
          this.users = user.data;
          this.posts = post.data;
        } else {
          console.log(user);
        }
      }
      if (this.sort == "Malejąco") {
        const [user, post] = await Promise.all([
          this.callApi("get", "/app/wyswietlUzytkownikow"),
          this.callApi("get", "/app/sortujPostydown"),
        ]);
        if (user.status === 200) {
          this.users = user.data;
          this.posts = post.data;
        } else {
          console.log(user);
        }
      }
    },
    async filtruj() {
      const res = await this.callApi("get", "/app/filtrujPost?q=" + this.filtr);
      if (res.status === 200) {
        this.wyniki = res.data;
        this.filtr = "";
        this.filtrShow = true;
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
    pobierzDane(post, index) {
      let obj = {
        id: post.id,
        title: post.title,
        content: post.content,
      };
      this.dane = obj;
      this.index = index;
    },
    async EdytujPost() {
      const res = await this.callApi("post", "/app/edytujPost", this.dane);
      if (res.status === 200) {
        this.posts[this.index].title = this.dane.title;
        this.posts[this.index].content = this.dane.content;
      } else {
        console.log(res);
      }
    },
    usunDane(post, index) {
      (this.obiekt = post), (this.indexU = index);
    },
    async UsunPost() {
      const res = await this.callApi("post", "/app/usunPost", this.obiekt);
      if (res.status === 200) {
        this.posts.splice(this.indexU, 1);
      } else {
        console.log("Coś poszło nie tak");
      }
    },
    async fetch() {
      const res = await this.callApi(
        "get",
        "/app/szukajPostu?q=" + this.search
      );
      if (res.status === 200) {
        this.wyniki = res.data;
        this.search = "";
        this.showSearch = true;
      }
    },
  },
  watch: {
    keywords(after, before) {
      this.fetch();
    },
  },
  async created() {
    const [user, post] = await Promise.all([
      this.callApi("get", "/app/wyswietlUzytkownikow"),
      this.callApi("get", "/app/wyswietlPosty"),
    ]);
    if (user.status === 200) {
      this.users = user.data;
      this.posts = post.data;
    } else {
      console.log(user);
    }
  },
};
</script>