<template>
    <div>
         <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t, indice in titulos" :key="indice"> {{ t.titulo }} </th>
                </tr>
            </thead>
            <tbody>
                <!--Aula 368-->
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                    <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span>
                    <span v-if="titulos[chaveValor].tipo == 'data'">{{  }}</span>
                    <span v-if="titulos[chaveValor].tipo == 'imagem'">
                        <img :src="'/storage/'+valor" width="30px" height="30px">
                    </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        // recebendo informações do componente marca via props
        props:['dados', 'titulos'],
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
        }

    }
</script>
