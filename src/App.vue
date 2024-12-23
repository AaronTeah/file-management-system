<template>
  <div id="app">
    <nav>
      <router-link to="/">File List</router-link>
      <router-link to="/upload">Upload File</router-link>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
nav {
  margin-bottom: 20px;
}
nav a {
  margin-right: 10px;
}
</style>
