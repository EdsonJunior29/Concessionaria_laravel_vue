<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!--Início do card de busca-->
            <div class="card mb-5">
                <div class="card-header">Busca de Marcas</div>

                <div class="card-body">
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
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm ">Pesquisar</button>
                </div>
            </div>
            <!--Fim do card de busca-->

            <!--Início do card de Listagem de Marcas-->
             <div class="card">
                <div class="card-header">Listagem de Marcas</div>

                <div class="card-body">
                    <table-component></table-component>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-sm ">Adicionar</button>
                </div>
            </div>
            <!--Fim do card de Listagem de Marcas-->

        </div>
    </div>
</div>
</template>
