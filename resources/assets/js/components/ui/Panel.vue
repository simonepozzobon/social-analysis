<template lang="html">
    <div class="panel bg-light p-4">
        <h3>{{ this.title }}</h3>
        <slot></slot>
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
    > h3 {
        text-transform: uppercase;
        // font-family: 'Raleway';
    }
}
</style>
