<template>

    <v-app>
      <v-card>
        
        <v-card-title>
          Consulta de Alunos
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Pesquisar"
            single-line
            hide-details
          ></v-text-field>
          <!-- Component Register -->

          <template>
            <v-btn
              color="primary"
              dark
              class="mb-2"
              :to='{name:"registerStudent"}'
            >        
              Cadastrar Aluno
            </v-btn>
          </template>

        </v-card-title>
                
        <v-data-table
          :headers="headers"
          :items="students"
          :search="search"
        >
        <template v-slot:item.actions="{ item }">
            <v-btn icon
              :to='{name:"editStudent", params:{item}}'
            >
            <v-icon 
              small
              class="mr-2"
            >
              mdi-pencil
            </v-icon>
            </v-btn>
          
          <v-icon
            small
            @click="deleteStudent(item)"
          >
            mdi-delete
          </v-icon>
        </template>
        </v-data-table>

      </v-card>  
      </v-app>  

</template>

<script>
import axios from "axios"
import { API_BASE_URL } from '../config.js'


export default {
  name: "students",
    data () {
      return {
        search: '',
        students:[],
        headers: [
          {
            text: '',
            align: 'start',
            sortable: false,
          },
          { text: 'Registro Acadêmico', value: 'academic_record' },
          { text: 'Nome', value: 'name'},
          { text: 'CPF', value: 'cpf' },
          { text: 'Ações', value: 'actions', sortable: false },
        ],
      }
    },
    mounted(){
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

      deleteStudent(item){
        console.log(item.id)
        if(confirm("Deseja excluir o registro do acadêmico?")){
          axios.delete(API_BASE_URL + `/student/${item.id}`)
            .then(response=>{
              this.getStudents()
            })
            .catch(error=>{
              console.log(error)
            })
        }
      },
    },
}
</script>
<style>

</style>