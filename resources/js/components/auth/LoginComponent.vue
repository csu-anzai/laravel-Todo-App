<template>

</template>

<script>
    export default {
        mounted() {

        },
        methods: {
            recaptcha() {
                this.$recaptcha('login').then((token) => {
                    console.log(token) // Will print the token
                })
            }
        },
        template: '<button @click="recaptcha">Execute recaptcha</button>'
    }
</script>
