<template>
    <div class="form-group">
        <label :for="id" class="form-label">{{ titulo }}</label>
            <slot></slot> <!--Pega o conteúdo interno passado pelo componente.-->
        <div :id="idHelp" class="form-text">{{ textoHelp }}</div>
    </div>
</template>

<script>
    export default {
        props:[
            'id',
            'titulo',
            'idHelp',
            'textoHelp'
            ]
    }
</script>
