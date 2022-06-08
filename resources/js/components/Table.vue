<template>
    <div>
         <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t, indice in titulos" :key="indice"> {{ t.titulo }} </th>
                </tr>
            </thead>
            <tbody>
                <!--Objeto que irá armazenar as informações contidas em dados-->
                <!--Aula evitando dependência no componente Table-->
                <tr v-for="obj in dados" :key="obj.id">
                    <template v-for="(valor, chave) in obj">
                        <td v-if="titulo.includes(chave)"  :key="chave">
                            <span v-if="chave == 'imagem'">
                                <img :src="'/storage'+valor" width="30px" height="30px">
                            </span>
                            <span v-else>
                                {{ valor }}
                            </span>
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        // recebendo informações do componente marca via props
        props:['dados', 'titulos']

    }
</script>
