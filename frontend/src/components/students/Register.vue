<template>
    <v-container class="grey lighten-3" id="register-page">
        <v-alert
            v-if="errors.length"
            dense
            outlined
            type="error"
        >
        <ul>
            <li v-for="(error, index) in errors" :key="index">
                {{ error }}
            </li>
        </ul>
        </v-alert>

         <v-row class="d-flex justify-center">
            <v-col
                cols="6"
            >
            <v-form
                ref="form"
                @submit.prevent="saveRegister"
            >
            
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
                label="RA"
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
                type="numer"
                maxlength="11"
                :counter="11"
                required
                ></v-text-field>

            <v-btn
                color="error"
                class="mr-4"
                :to='{name:"home"}'
                >
                Cancelar
                </v-btn>

                <v-btn
                color="primary"
                type="submit"
                >
                Salvar
                </v-btn>
            </v-form>
           </v-col>
        </v-row>
    </v-container>
</template>


<script>
import axios from "axios";
import { API_BASE_URL } from '../../config.js'

  export default {
        data () {
            return {
                student: {},
                    name:'',
                    email:'',
                    academic_record: '' ,
                    cpf: '',
                    errors:[],
                


                valid: true,
                //name: '',
                nameRules: [
                    v => !!v || 'Nome é obrigatório',
                    v => (v && v.length <= 50) || 'Name must be less than 50 characters',
                ],
                //email: '',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                ],
                //academic_record: '',
                raRules:[
                    v => !!v || 'Registro Acadêmico é obrigatório',
                ],
                //cpf: '',
                cpfRules:[
                    v => !!v || 'O CPF é obrigatório'
                ]
                
            }
        },

    methods: {
      onSubmit(){
        this.register()
      },
    },

    methods:{
        /* Function for create of Register Student */
        saveRegister(){
            let url =(API_BASE_URL + '/student/register');
            
            axios.post(url, this.student).then(response=>{
                    this.$router.push({name:"home"})
                }).catch(error=>{
                    console.log(error)
                })
            
        }   
    
            /* const data = {
                body:JSON.stringify({
                    name: 
                })
            }  */
           /*  this.errors = []
            if(!this.student.name) {
                this.errors.push('Nome é RE QUE RI DO')
            }

           
        } */
    }, 
    mounted: function() {
        console.log('Component Carregado')
    } 
} 

</script>
<style scoped>
#register-page {
    margin-top: 20px !important;
}
</style>