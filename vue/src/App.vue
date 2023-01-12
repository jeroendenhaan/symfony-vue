<template>
  <img alt="Vue logo" src="./assets/logo.png">
  <p>Characters:</p>
  <div v-for="character in characters" :key="character.id">
    {{ character.id }}: {{ character.name }} ({{ character.race }}, {{ character.age }})
  </div>
</template>

<script>
import { getAllCharacters } from "@/services/CharacterService";

export default {
  name: 'App',
  data() {
    return {
      characters: [],
    }
  },
  mounted() {
    getAllCharacters().then(
        (response) => {
          this.characters = response;
        }
    );
  },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
