<template>
  <v-container bg fill-height grid-list-md text-xs-center fluid class="fluid">
    <v-row class="d-flex justify-center">
      <v-col cols="7">
        <v-card class="pa-4">
          <v-form ref="form">
            <v-text-field
              v-model="students.name"
              outlined
              label="Name"
              readonly
            >
            </v-text-field>
            <v-text-field
              v-model="students.email"
              label="E-mail"
              outlined
              readonly
            >
            </v-text-field>
            <v-text-field
              v-model="students.academic_record"
              label="Registro Acadêmico"
              outlined
              readonly
            >
            </v-text-field>
            <v-text-field
              v-model="students.cpf"
              label="CPF"
              outlined
              placeholder="Informe o documento"
              readonly
            >
            </v-text-field>
            <v-template class="d-flex justify-center py-3">
              <v-btn color="error" class="mr-4" :to="{ name: 'home' }">
                Voltar
              </v-btn>
            </v-template>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../../config.js'

export default {
  name: 'edit-student',
  data() {
    return {
      students: {
        name: '',
        email: '',
        academic_record: '',
        cpf: ''
      }
    }
  },

  mounted() {
    this.getStudents()
  },

  methods: {
    async getStudents() {
      axios
        .get(API_BASE_URL + `/student/${this.$route.params.id}`) //.get(API_BASE_URL + `/student/${this.$route.params.id}`)
        .then(response => {
          this.students = response.data
          console.log(this.students)
        })
        .catch(error => {
          console.log(error)
        })
    }
  }
}
</script>
