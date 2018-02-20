<template>
    <div>
        <button v-on:click="test()" class="btn btn-success">Show images</button>
        <span>Message: {{ msg }}</span>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data(){
            return {
                msg: this.user
            }
        },
        methods: {
            test() {
                axios.get('http://localhost/gallery-portal/public/all-comments')
                    .then(function (response) {
                        console.log(response);
                        this.data.msg = 'xxxxxxxxxxxxxxxxxxxxxxxx';
                        console.log(this.msg);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
