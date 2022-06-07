<template>
    <div>
         <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t, indice in titulo" :key="indice"> {{ t }} </th>
                </tr>
            </thead>
            <tbody>
                <!--marcas e um varável auxiliar que irá armazenar as informações contidas em dados-->
                <tr v-for="marcas in dados" :key="marcas.id">
                    <th scope="row">{{ marcas.id }}</th>
                    <td>{{ marcas.nome }}</td>
                    <!--Adicionando a imagem utilizando a url que esta contida em marcas.imagem-->
                    <td><img :src="'/storage/'+marcas.imagem " width="30px" height="30px"></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        // recebendo informações do componente marca via props
        props:['dados', 'titulo']

    }
</script>
