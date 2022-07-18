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
              :error-messages="nameErrors"
              @input="$v.students.name.$touch()"
              @blur="$v.students.name.$touch()"
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
              :error-messages="emailErrors"
              @input="$v.students.email.$touch()"
              @blur="$v.students.email.$touch()"
            >
            </v-text-field>

            <v-text-field
              v-model="students.academic_record"
              label="Registro Acadêmico"
              outlined
              readonly
            >
            </v-text-field>

            <v-text-field v-model="students.cpf" label="CPF" outlined readonly>
            </v-text-field>
            <v-template class="d-flex justify-center py-3">
              <v-btn color="error" class="mr-4" :to="{ name: 'home' }">
                Cancelar
              </v-btn>
              <v-btn color="primary" type="submit" :disabled="$v.$invalid"> Salvar </v-btn>
            </v-template>
          </v-form>
        </v-card>
      </v-col>
      <!--  NOTIFICATIONS -->
      <v-snackbar v-model="snackbar.show" :timeout="timeout" :color="snackbar.color" vertical>
        {{snackbar.message}}
        <v-btn dark text @click="snackbar = false">Fechar</v-btn>
      </v-snackbar>
      <!-- END  NOTIFICATIONS -->
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../../config.js'

import { required, maxLength, minLength, email } from 'vuelidate/lib/validators'

export default {
  name: 'edit-student',

  validations: {
    students: {
      name: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(50)
      },
      email: {
        required,
        email
      }, 
    }
  },

  data() {
    return {
      students: {
        name: '',
        email: '',
        academic_record: '',
        cpf: ''
      },
    /* msg notification  */
      snackbar: {
        show: false,
        message: null,
        color: null,
        timeout: null
      },
    }
  },
  mounted() {
    this.getStudents()
  },
  methods: {
    async getStudents() {
      await axios
        .get(API_BASE_URL + `/student/${this.$route.params.id}`) //.get(API_BASE_URL + `/student/${this.$route.params.id}`)
        .then(response => {
          this.students = response.data
        })
        .catch(error => {
          console.log(error.message)
        })
    },

    updateStudent() {
      this.$v.$touch()
      if (this.$v.$invalid){
        return
      } 
      axios
        .put(API_BASE_URL + `/student/${this.$route.params.id}`, this.students) //axios.put(`/api/student/${this.$route.params.id}`, this.student)
        .then(() => {
            //alert("deletado com sucesso")
            this.snackbar ={
              message:  'Cadastrado com sucesso',
              color: 'success',
              show: true,
              timeout: 200
            }
            this.$router.push({ name: 'home' })
        })
        .catch(error => {
          this.snackbar = {
                        message: 'Ops! Ocorreu um erro, tente novamente',
                        color: 'error',
                        show: true,
                        timeout: 200
          }
        })
    }
  },
  computed: {
    nameErrors() {
      const errors = []
      if (!this.$v.students.name.$dirty) return errors
      !this.$v.students.name.minLength &&
        errors.push('O Nome deve conter no mínimo 3 caracteres.')
      !this.$v.students.name.maxLength &&
        errors.push('Nome só pode ter no máximo 50 caracteres.')
      !this.$v.students.name.required &&
        errors.push('Obrigatório fornecer um nome.')
      return errors
    },
    emailErrors() {
      const errors = []
      if (!this.$v.students.email.$dirty) return errors
      !this.$v.students.email.email && 
        errors.push('Insira um e-mail válido.')
      !this.$v.students.email.required &&
        errors.push('Obrigatório fornecer um e-mail.')
      return errors
    }
  },

}
</script>
