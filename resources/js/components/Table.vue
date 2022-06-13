<template>
    <div>
         <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t, indice in titulos" :key="indice"> {{ t.titulo }} </th>
                     <th v-if="visualizar.visivel || atualizar.visivel  || remover.visivel "></th>
                </tr>
            </thead>
            <tbody>
                <!--Aula 368-->
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">{{ valor | formatDateTimeGlobal }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor" width="30px" height="30px">
                        </span>
                    </td>
                    <td v-if="visualizar.visivel || atualizar.visivel  || remover.visivel">

                        <button v-if="visualizar.visivel"
                            class="btn btn-outline-primary btn-sm"
                            :data-bs-toggle="visualizar.dataBsToggle"
                            :data-bs-target="visualizar.dataBsTarget"
                            @click="setStore(obj)"
                        >
                            Visualizar
                        </button>

                        <button v-if="atualizar.visivel "
                            class="btn btn-outline-primary btn-sm"
                            :data-bs-toggle="atualizar.dataBsToggle"
                            :data-bs-target="atualizar.dataBsTarget"
                            @click="setStore(obj)"
                        >
                            Atualizar
                        </button>

                        <button v-if="remover.visivel"
                            class="btn btn-outline-danger btn-sm"
                            :data-bs-toggle="remover.dataBsToggle"
                            :data-bs-target="remover.dataBsTarget"
                            @click="setStore(obj)"
                        >
                            Remover
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        // recebendo informações do componente marca via props
        props:['dados', 'titulos', 'visualizar', 'atualizar', 'remover'],
        computed:{
            dadosFiltados(){
                let campos = Object.keys(this.titulos)
                let dadosFiltadros = []

                this.dadosFiltados.map((chave, item) => {
                    let itemFiltado = {}

                    campos.forEach(campo => {
                        itemFiltado[campo] = item[campo] // Podemos sitar a sintaxe de array para adicionar valores ao objeto
                    })
                    dadosFiltadros.push(itemFiltado)
                })
                return dadosFiltadros
            }
        },
        methods: {
            setStore(obj){
                this.$store.state.item = obj
                this.$store.state.transacao.status = ''
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
            }
        }
    }
</script>
