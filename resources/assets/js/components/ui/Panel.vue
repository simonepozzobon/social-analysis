<template lang="html">
    <div class="panel">
        <h1>{{ this.title }}</h1>
    </div>
</template>

<script>
export default {
    name: 'Panel',
    props: {
        title: {
            default: 'Titolo',
            type: String
        }
    }
}
</script>

<style lang="scss">
.panel {
    > h1 {
        text-transform: uppercase;
        font-family: 'Raleway';
    }
}
</style>
