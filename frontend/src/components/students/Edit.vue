<template>
  <v-container bg fill-height grid-list-md text-xs-center fluid class="fluid">
    <v-row class="d-flex justify-center">
      <v-col cols="7">
        <v-card class="pa-4">
          <v-form ref="form" @submit.prevent="updateStudent">
            <v-text-field
              v-model="students.name"
              :counter="50"
              outlined
              label="Name"
              placeholder="Informe o nome completo"
              required
            >
            </v-text-field>

            <v-text-field
              v-model="students.email"
              label="E-mail"
              outlined
              placeholder="Informe apenas um e-mail"
              maxlength="50"
              required
            >
            </v-text-field>

            <v-text-field
              v-model="students.academic_record"
              label="Registro Acadêmico"
              outlined
              placeholder="Informe o registro acadêmico"
              maxlength="11"
              type="number"
              required
              readonly
            >
            </v-text-field>

            <v-text-field
              v-model="students.cpf"
              label="CPF"
              outlined
              placeholder="Informe o documento"
              type="number"
              maxlength="11"
              :counter="11"
              readonly
              required
            >
            </v-text-field>
            <v-template class="d-flex justify-center py-3">
              <v-btn color="error" class="mr-4" :to="{ name: 'home' }">
                Cancelar
              </v-btn>
              <v-btn color="primary" type="submit"> Salvar </v-btn>
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
    },

    updateStudent() {
      axios
        .put(API_BASE_URL + `/student/${this.$route.params.id}`, this.students) //axios.put(`/api/student/${this.$route.params.id}`, this.student)
        .then(response => {
          this.$router.push({ name: 'home' })
        })
        .catch(error => {
          console.log(error)
        })
    }
  }
}
</script>
