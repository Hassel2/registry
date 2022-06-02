<template>
    <div>
        <div class="Licenses">Licenses</div>
        <div class="Content">Content</div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
.Licenses
{
    height: 600px;
    width: 23%;
    float: left;
    border: 3px solid;
}

.Content
{
    height: 600px;
    width: 77%;
    float: left;
    border: 3px solid;
}
</style>
