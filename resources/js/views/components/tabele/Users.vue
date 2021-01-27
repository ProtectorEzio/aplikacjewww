<template>
  <div class="pageSize">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Pseudonim</th>
          <th scope="col">E-mail</th>
          <th scope="col">Akcje</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, i) in users" :key="i">
          <td>{{ user.id }}</td>
          <td>{{ user.nickname }}</td>
          <td>{{ user.email }}</td>
          <td>
            <button
              type="button"
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#myModal2"
              @click="pobierzDane(user, i)"
            >
              Edytuj
            </button>
            <button
              type="button"
              class="btn btn-danger"
              data-toggle="modal"
              data-target="#myModal3"
              @click="usunDane(user, i)"
            >
              Usuń
            </button>
          </td>
        </tr>
      </tbody>
      <Page :total="PageInfo.total" :current="PageInfo.current_page" :page-size="parseInt(PageInfo.per_page)" @on-change="getResults" v-if="PageInfo"/>
    </table>
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edytuj Użytkownika</h4>
          </div>
          <div class="modal-body">
            <input
              v-model="dane.nickname"
              type="text"
              placeholder="Pseudonim"
            />
            <input v-model="dane.email" type="text" placeholder="E-mail" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Zamknij
            </button>
            <button
              type="button"
              class="btn btn-info"
              data-dismiss="modal"
              @click="EdytujUzytkownika()"
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
            <h4 class="modal-title">Usuń Użytkownika</h4>
          </div>
          <div class="modal-body">
            <p>Czy jesteś pewien, że chcesz usunąć tego użytkownika?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Nie
            </button>
            <button
              type="button"
              class="btn btn-info"
              data-dismiss="modal"
              @click="UsunUzytkownika()"
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
import pagination from "laravel-vue-pagination";
export default {
  data() {
    return {
      data: {
        nickname: "",
        email: "",
        password: "",
      },
      dane: {
        nickname: "",
        email: "",
        password: "",
      },
      users: [],
      index: -1,
      obiekt: {},
      indexU: -1,
      total: 1,
      PageInfo: null
    };
  },
  components: {
    pagination,
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
    async getResults(page = 1) {
      console.log(page);
      const res = await this.callApi("get", `/app/wyswietlUzytkownikow?page=${page}&total=${this.total}`);
      if (res.status === 200) {
        this.users = res.data.data;
        this.PageInfo=res.data;
      } else {
        console.log(res);
      }
    },
    pobierzDane(user, index) {
      let obj = {
        id: user.id,
        nickname: user.nickname,
        email: user.email,
      };
      this.dane = obj;
      this.index = index;
    },
    async EdytujUzytkownika() {
      const res = await this.callApi(
        "post",
        "/app/edytujUzytkownika",
        this.dane
      );
      if (res.status === 200) {
        this.users[this.index].nickname = this.dane.nickname;
        this.users[this.index].email = this.dane.email;
      } else {
        console.log(res);
      }
    },
    usunDane(user, index) {
      (this.obiekt = user), (this.indexU = index);
    },
    async UsunUzytkownika() {
      const res = await this.callApi(
        "post",
        "/app/usunUzytkownika",
        this.obiekt
      );
      if (res.status === 200) {
        this.users.splice(this.indexU, 1);
      } else {
        console.log("Coś poszło nie tak");
      }
    },
  },
  async created() {
    this.getResults();
  },
};
</script>