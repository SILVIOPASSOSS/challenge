<template>
  <v-container
    bg
    fill-height
    grid-list-md
    text-xs-center
    fluid
    class="fluid"
    color="#3553D8"
  >
    <v-row class="d-flex justify-center" allign="center">
      <v-col cols="7">
        <v-alert v-if="errors.length" dense outlined type="error">
          <ul>
            <li v-for="(error, index) in errors" :key="index">
              {{ error }}
            </li>
          </ul>
        </v-alert>
        <v-card class="pa-4">
          <v-form ref="form" @submit.prevent="saveRegister" class="pa-1">
            <v-text-field
              v-model="student.name"
              :counter="50"
              :rules="nameRules"
              label="Name"
              placeholder="Informe o nome completo"
              required
            ></v-text-field>
            <v-text-field
              v-model="student.email"
              :rules="emailRules"
              label="E-mail"
              placeholder="Informe apenas um e-mail"
              required
            ></v-text-field>
            <v-text-field
              v-model="student.academic_record"
              :rules="raRules"
              label="Registro Acadêmico"
              placeholder="Informe o registro acadêmico"
              type="number"
              maxlength="11"
              required
            ></v-text-field>
            <v-text-field
              v-model="student.cpf"
              :rules="cpfRules"
              label="CPF"
              placeholder="Informe o número do documento"
              type="number"
              maxlength="11"
              :counter="11"
              required
            ></v-text-field>
            <v-template class="d-flex justify-center py-2">
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
  data() {
    return {
      student: {},
      name: '',
      email: '',
      academic_record: '',
      cpf: '',
      errors: [],

      valid: true,
      //name: '',
      nameRules: [
        v => !!v || 'Nome é obrigatório',
        v => (v && v.length <= 50) || 'Name must be less than 50 characters'
      ],
      //email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v =>
          !v ||
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          'E-mail invlido'
      ],
      //academic_record: '',
      raRules: [v => !!v || 'Registro Acadêmico é obrigatório'],
      //cpf: '',
      cpfRules: [v => !!v || 'O CPF é obrigatório']
    }
  },

  methods: {
    onSubmit() {
      this.register()
    }
  },

  methods: {
    /* Function for create of Register Student */
    saveRegister() {
      let url = API_BASE_URL + '/student/register'

      axios
        .post(url, this.student)
        .then(response => {
          this.$router.push({ name: 'home' })
        })
        .catch(error => {
          console.log(error)
        })

      this.errors = []
      if (!this.student.name) {
        this.errors.push('Nome é obrigatório')
      }

      this.errors = []
      if (!this.student.email) {
        this.errors.push('Email é obrigatório')
      }
    }
  },
  mounted: function () {
    console.log('Component Carregado')
  }
}
</script>
<style scoped>
#register-page {
  margin-top: 20px !important;
}
</style>
