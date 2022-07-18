<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h6"> Grupo A </v-list-item-title>
          <v-list-item-subtitle> Módulo Acadêmico </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list dense nav>
        <v-list-item v-for="item in items" :key="item.title" :to="item.to" link>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="indigo darken-2" dark prominent>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-spacer></v-spacer>
      <v-app-bar-title class="text-no-wrap">
        <div>
          {{ $route.meta.title || "Grupo A"}}
        </div>
        </v-app-bar-title>
      <v-spacer></v-spacer>
    </v-app-bar>
    <v-main>
        <router-view />
    </v-main>
    <Footer />
  </v-app>
</template>
<script>
import Footer from './components/Footer.vue';

export default {
  components: { Footer },

  data: () => ({
    drawer: null,
    items: [
      { title: 'Alunos', icon: 'mdi-account', to: '/' },
      { title: 'Sobre', icon: 'mdi-book', to: '/about' }
    ]
  })
}
</script>

