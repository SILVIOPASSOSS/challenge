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
        <!-- <v-alert v-if="errors.length" dense outlined type="error">
          <ul>
            <li v-for="(error, index) in errors" :key="index">
              {{ error }}
            </li>
          </ul>
        </v-alert> -->
        <v-card class="pa-4">
          <v-form ref="form" @submit.prevent="saveRegister" class="pa-1">
            <v-text-field
              v-model="student.name"
              :counter="50"
              label="Name"
              placeholder="Informe o nome completo"
              :error-messages="nameErrors"
              @input="$v.student.name.$touch()"
              @blur="$v.student.name.$touch()"
              required
            ></v-text-field>
            <v-text-field
              v-model="student.email"
              label="E-mail"
              placeholder="Informe apenas um e-mail"
              :error-messages="emailErrors"
              @input="$v.student.email.$touch()"
              @blur="$v.student.email.$touch()"
              required
            ></v-text-field>
            <v-text-field
              v-model="student.academic_record"
              label="Registro Acadêmico"
              placeholder="Informe o registro acadêmico"
              type="number"
              maxlength="11"
              :error-messages="academicErrors"
              @input="$v.student.academic_record.$touch()"
              @blur="$v.student.academic_record.$touch()"
              required
            >
            </v-text-field>
            <v-text-field
              v-model="student.cpf"
              label="CPF"
              placeholder="Informe o número do documento"
              type="number"
              maxlength="11"
              :counter="11"
              :error-messages="cpfErrors"
              @input="$v.student.cpf.$touch()"
              @blur="$v.student.cpf.$touch()"
              required
              :mask="'###.###.###-##'"
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

//import useVuelidate from '@vuelidate/core'
import { required, maxLength, minLength, email } from 'vuelidate/lib/validators'

export default {

  validations: {
    student: {
      name: {
        required,
        minLength: minLength(3),
        maxLength: maxLength(50)
      },
      email: {
        required,
        email
      },
      academic_record: {
        required
      },
      cpf: {
        required
      }
    }
  },

  data() {
    return {
      student: {},
      name: '',
      email: '',
      academic_record: '',
      cpf: '',
      errors: [],
      
      /* msg notification  */
      snackbar: {
        show: false,
        message: null,
        color: null,
        timeout: null
      },
    }
  },

  computed: {
    nameErrors() {
      const errors = []
      if (!this.$v.student.name.$dirty) return errors
      !this.$v.student.name.minLength &&
        errors.push('O Nome deve conter no mínimo 3 caracteres.')
      !this.$v.student.name.maxLength &&
        errors.push('Nome só pode ter no máximo 50 caracteres.')
      !this.$v.student.name.required &&
        errors.push('Obrigatório fornecer um nome.')
      return errors
    },
    emailErrors() {
      const errors = []
      if (!this.$v.student.email.$dirty) return errors
      !this.$v.student.email.email && errors.push('Insira um e-mail válido.')
      !this.$v.student.email.required &&
        errors.push('Obrigatório fornecer um e-mail.')
      return errors
    },
    academicErrors() {
      const errors = []
      if (!this.$v.student.academic_record.$dirty) return errors
      !this.$v.student.academic_record.required &&
        errors.push('Obrigatório fornecer o nº de Registro.')
      return errors
    },
    cpfErrors() {
      const errors = []
      if (!this.$v.student.cpf.$dirty) return errors
      !this.$v.student.cpf.required &&
        errors.push('Obrigatório fornecer o número de documento.')
      return errors
    }
  },

  methods: {

    async saveRegister() {
      let url = API_BASE_URL + '/student/register'
      await axios
        .post(url, this.student)
        .then(() => {
            //alert("deletado com sucesso")
            this.snackbar ={
              message:  'Cadastrado com sucesso',
              color: 'success',
              show: true,
              timeout: 200
            }
            this.$refs.form.reset()
            this.$v.$reset()
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
  }   
}
</script>
<style scoped>
#register-page {
  margin-top: 20px !important;
}
</style>
