<template>
  <div>
    <div class="pageSize">
      <main>
        <div class="okno">
          <h1>Zaloguj się</h1>
          <form>
            <input
              type="email"
              class="form-control mb-2 mr-sm-2"
              v-model="data.email"
              placeholder="Wprowadź email"
              id="email"
            />
            <input
              type="password"
              class="form-control mb-2 mr-sm-2"
              v-model="data.password"
              placeholder="Wprowadż hasło"
              id="pwd"
              name="pswd"
            />
            

            <button type="submit" class="btn btn-primary mb-2" @click="login()">Zaloguj</button>
            <router-link to="/">
              <button type="button" class="btn btn-danger mb-2">Wróć na stronę główną</button>
            </router-link>
          </form>
          <br />
          <br />
          <div class="text-center">
            <h2>Nie posiadasz konta?</h2>
            <router-link to="/register">
              <button type="button" class="btn btn-info mb-2">Załóż konto</button>
            </router-link>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      data:{
        email: '',
        password: '',
      }
    }
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
    async login(){
      if(this.data.email.trim()=='') return console.log('Email is required')
            if(this.data.password.trim()=='') return console.log('Password is required')
            if(this.data.password.length < 6) return console.log('Incorrect login details')
      const res = await this.callApi('post','/login', this.data)
      console.log(res);
      if(res.status===200){
        window.location = '/'
      }
    }
  }
}
</script>