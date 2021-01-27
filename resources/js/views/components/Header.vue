<template>
  <div>
    <header id="header">
      <nav class="navbar navbar-expand-md navbar-light">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <router-link class="nav-link topMenuLinks" to="/">Strona główna</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link topMenuLinks" to="/posts">Posty</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link topMenuLinks" to="/users">Użytkownicy</router-link>
          </li>
        </ul>
        <div class="text-right">
          <ul class="navbar-nav mx-auto">
            <li>
              <router-link class="nav-link topMenuLinks" to="/login">Zaloguj</router-link>
            </li>
            <li>
              <router-link class="nav-link topMenuLinks" to="/register">Zarejestruj</router-link>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <hr class="greenbar" />
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>


