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
              class="pa-0"
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

          <!-- Table -->
          <v-data-table
            :headers="headers"
            :items="students"
            :search="search"
            :footer-props="{
              'items-per-page-text': 'Alunos por página',
              pageText: '{0}-{1} de {2}',
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
                  <!-- Dialog for Confirm Delete Student -->
                  <v-dialog v-model="dialog" width="500" :retain-focus="false">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="red lighten-2"
                        dark
                        icon
                        v-bind="attrs"
                        v-on="on"
                      >
                        <v-icon small>mdi-delete</v-icon>
                      </v-btn>
                    </template>
                    <v-card>
                      <v-card-title
                        class="
                          d-flex
                          headline
                          red
                          lighten-2
                          justify-center
                          white--text
                        "
                        primary-title
                        dark
                        >Atenção!</v-card-title
                      >
                      <v-card-text class="pa-4 font-weight-bold"
                        >Tem certeza que deseja excluir esse
                        Registro?</v-card-text
                      >
                      <v-divider></v-divider>
                      <v-card-actions>
                        <v-btn
                          color="red lighten-2"
                          type="submit"
                          text
                          @click="closeDialog()"
                          >Cancelar</v-btn
                        >
                        <v-spacer></v-spacer>
                        <v-btn
                          color="secondary"
                          type="submit"
                          text
                          @click.prevent="deleteStudent(item)"
                        >
                          Sim
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </template>
                <span>Deletar usuário</span>
              </v-tooltip>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
      <!--  NOTIFICATIONS -->
      <div class="d-flex text-center justify-center">
        <v-snackbar
          v-model="snackbar.show"
          :timeout="timeout"
          :color="snackbar.color"
          vertical
        >
          {{ snackbar.message }}
         <v-btn dark text @click="snackbar = false">Fechar</v-btn>
        </v-snackbar>
      </div>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import { API_BASE_URL } from "../config.js";

export default {
  name: "students",

  data() {
    return {
      search: "",
      students: [],
      headers: [
        {
          text: "",
          align: "start",
          sortable: false,
        },
        { text: "REGISTRO ACADÊMICO", value: "academic_record" },
        { text: "NOME", value: "name" },
        { text: "CPF", value: "cpf" },
        { text: "Ações", value: "actions", sortable: false },
      ],
      snackbar: {
        show: false,
        message: null,
        color: null,
        timeout: "2000",
      },
      dialog: false,
    };
  },
  mounted() {
    this.getStudents();
  },
  methods: {
    async getStudents() {
      axios
        .get(API_BASE_URL + "/student")
        .then((response) => {
          this.students = response.data;
          console.log(students.snackbar);
        })
        .catch((error) => {
          
        });
    },

    deleteStudent(item) {
      axios
        .delete(API_BASE_URL + `/student/${item.id}`)
        .then(() => {
          this.snackbar = {
            message: "Deletado com sucesso",
            color: "success",
            show: true,
            timeout: 200,
          };
          this.dialog = false;
          this.getStudents();
        })
        .catch((error) => {
          this.snackbar = {
            message: "Ops! Ocorreu um erro",
            color: "error",
            show: true,
            timeout: 20,
          };
        });
    },
    closeDialog() {
      this.dialog = false;
      this.$refs.template.reset();
      this.getStudents();
    },
  },
};
</script>
