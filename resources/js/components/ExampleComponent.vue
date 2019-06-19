<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
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
