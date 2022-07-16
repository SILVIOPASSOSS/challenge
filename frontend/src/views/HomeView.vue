<template>
  <v-container bg fill-height grid-list-md text-xl-center fluid class="fluid">
    <v-row class="d-flex justify-center" allign="center">
      <v-col cols="10">
        <v-card class="pa-4">
          <v-card-title>
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Pesquisar"
              single-line
              hide-details
            >
            </v-text-field>
            <!-- Component Register -->
            <template>
              <v-btn
                color="primary"
                dark
                class="mb-2"
                :to="{ name: 'registerStudent' }"
              >
                Cadastrar Aluno
              </v-btn>
            </template>
          </v-card-title>

          <v-data-table
            :headers="headers"
            :items="students"
            :search="search"
            :footer-props="{
              'items-per-page-text': 'Alunos por página',
              pageText: '{0}-{1} de {2}'
            }"
          >
            <template v-slot:item.actions="{ item }">
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    icon
                    :to="{ name: 'detailStudent', params: { id: item.id } }"
                    v-bind="attrs"
                    v-on="on"
                  >
                    <v-icon>mdi-eye</v-icon>
                  </v-btn>
                </template>
                <span>Detalhes</span>
              </v-tooltip>

              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    icon
                    color="blue"
                    :to="{ name: 'editStudent', params: { id: item.id } }"
                    v-bind="attrs"
                    v-on="on"
                  >
                    <v-icon small class="mr-2">mdi-pencil</v-icon>
                  </v-btn>
                </template>
                <span>Editar Usuário</span>
              </v-tooltip>

              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn icon color="red" v-bind="attrs" v-on="on">
                    <v-icon small @click="deleteStudent(item)"
                      >mdi-delete</v-icon
                    >
                  </v-btn>
                </template>
                <span>Deletar usuário</span>
              </v-tooltip>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config.js'

export default {
  name: 'students',
  data() {
    return {
      search: '',
      students: [],
      headers: [
        {
          text: '',
          align: 'start',
          sortable: false
        },
        { text: 'Registro Acadêmico', value: 'academic_record' },
        { text: 'Nome', value: 'name' },
        { text: 'CPF', value: 'cpf' },
        { text: 'Ações', value: 'actions', sortable: false }
      ]
    }
  },
  mounted() {
    this.getStudents()
  },
  methods: {
    getStudents() {
      axios
        .get(API_BASE_URL + '/student')
        .then(response => {
          this.students = response.data
          console.log(this.students)
        })
        .catch(error => {
          console.log(error)
        })
    },

    deleteStudent(item) {
      console.log(item.id)
      if (confirm('Deseja excluir o registro do acadêmico?')) {
        axios
          .delete(API_BASE_URL + `/student/${item.id}`)
          .then(response => {
            this.getStudents()
          })
          .catch(error => {
            console.log(error)
          })
      }
    }
  }
}
</script>
<style></style>
