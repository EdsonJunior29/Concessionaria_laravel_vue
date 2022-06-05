<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!--Início do card de busca-->
                <card-component titulo="Busca de Marcas">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col mb-3">

                                <input-container-component
                                titulo="ID"
                                id="inputId"
                                id-help="idHelp"
                                texto-help="Opcional. Informe o Id da marca">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                                </input-container-component>

                            </div>
                            <div class="col mb-3">

                                <input-container-component
                                titulo="Nome da marca"
                                id="inputNome"
                                nome-help="nomeHelp"
                                texto-help="Opcional. Informe o Nome da Marca.">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome da marca">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm ">Pesquisar</button>
                    </template>
                </card-component>

                <!--Fim do card de busca-->

                <!--Início do card de Listagem de Marcas-->

                <card-component titulo="Listagem de Marcas">
                    <template v-slot:conteudo>
                        <table-component></table-component>
                    </template>

                    <template v-slot:rodape>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                    </template>
                </card-component>

                <!--Fim do card de Listagem de Marcas-->

            </div>
        </div>
        <modal-component id="modalMarca" titulo="Adicionar Marca">

            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes"
                    titulo="Cadastro Realizado com sucesso"
                    v-if="transacaoStatus == 'adicionado'">
                </alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes"
                   titulo="Erro ao tentar cadastrar a marca"
                    v-if="transacaoStatus == 'erro'">
                </alert-component>
            </template>

            <template v-slot:conteudoModal>

                <div class="form-group">
                    <input-container-component
                        titulo="Nome da marca"
                        id="novoNome"
                        id-help="novoNomeHelp"
                        texto-help="Informe o Nome da Marca."
                    >
                        <input type="text"
                            class="form-control"
                            id="novoNome"
                            aria-describedby="novoNomeHelp"
                            placeholder="Nome da marca"
                            v-model="nomeMarca"
                        >
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component
                        titulo="Imagem"
                        id="novoImagem"
                        id-help="novoImagemHelp"
                        texto-help="Selecione uma imagem no formato png."
                    >
                        <input type="file"
                            class="form-control-file"
                            id="novoImagem"
                            aria-describedby="novoImagemHelp"
                            placeholder="Selecione uma imagem."
                            @change="carregarImagem($event)"
                        >
                    </input-container-component>
                </div>

            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Fechar </button>
                <button type="button" class="btn btn-primary" @click="salvar()"> Salvar </button>
            </template>
        </modal-component>
    </div>
</template>

<script>
import axios from 'axios'

    export default{

        computed:{
            token(){
                let token = document.cookie.split(';').find(indice => {
                    return indice.startsWith('token=')
                })
                token = token.split('=')[1]
                token = 'Bearer ' + token

                return token
            }
        },
        data(){
            return{
                urlBase: 'http://localhost:8001/api/v1/marca',
                nomeMarca: '',
                arquivoImagem: [],
                transacaoStatus: '',
                transacaoDetalhes: []
            }
        },
        methods: {
            carregarImagem(e){
                this.arquivoImagem = e.target.files
            },
            salvar(){

                //Montando a requisição para o nosso Backend com o axios.

                let formData = new FormData();
                formData.append('nome', this.nomeMarca)
                formData.append('imagem', this.arquivoImagem[0])

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {         //then() -> recuperando a resposta da requisição
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = response
                        //console.log(response)
                    })
                    .catch(errors => {          //catch() -> recebe os erros da requisição.
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = errors.response
                        // console.log (errors.response.data.message)
                    })
            }
        }
    }
</script>
