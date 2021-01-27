<template>
  <div class="container-fluid">
    <div class="fill" style="text-align: center">
      <h2>Role</h2>
    </div>
    <router-link class="btn btn-info" to="/panel">Wróć</router-link>
    <div class="container-fluid">
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#myModal"
      >
        Dodaj
      </button>
    </div>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Akcje</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(Rola, i) in Role" :key="i">
            <td>{{ Rola.id }}</td>
            <td>{{ Rola.Nazwa }}</td>
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
            </td>
          </tr>
        </tbody>
      </table>
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Dodaj Rolę</h4>
          </div>
          <div class="modal-body">
            <input
              v-model="data.Nazwa"
              type="text"
              placeholder="Nazwa Roli"
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
              @click="Dodaj()"
            >
              Dodaj
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edytuj Role</h4>
          </div>
          <div class="modal-body">
            <input
              v-model="dane.Nazwa"
              type="text"
              placeholder="Nazwa Roli"
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
              @click="Edytuj()"
            >
              Edytuj
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
        Nazwa: "",
      },
      dane: {
        Nazwa: "",
      },
      Role: [],
      index: -1,
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

    async Dodaj() {
      if (this.data.Nazwa.trim() == "") {
        console.log("Proszę uzupełnić poprawnie dane");
      }
      const res = await this.callApi("post", "/app/dodajRole", this.data);
      if (res.status === 200) {
        this.Role.unshift(res.data);
        this.data.Nazwa = "";
      } else {
        console.log(res);
      }
    },
    pobierzDane(Rola, index) {
      let obj = {
        id: Rola.id,
        Nazwa: Rola.Nazwa,
      };
      this.dane = obj;
      this.index = index;
    },
    async Edytuj() {
      const res = await this.callApi("post", "/app/edytujRole", this.dane);
      if (res.status === 200) {
        this.Role[this.index].Nazwa = this.dane.Nazwa;
      } else {
        console.log(res);
      }
    },
  },
  async created() {
    const res = await this.callApi("get", "/app/wyswietlRole");
    if (res.status === 200) {
      this.Role = res.data;
    } else {
      console.log(res);
    }
  },
};
</script>