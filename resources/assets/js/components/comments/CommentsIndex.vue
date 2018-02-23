
<template>
    <div class="row">
        <!--<div class="form-group">-->
        <!--<router-link :to="{name: 'createCompany'}" class="btn btn-success">Create new image</router-link>-->
        <!--</div>-->
        <div  class="col-md-12" v-for="comment, index in comments" >
            <p>Autor:{{comment.user_id}}</p>
            <p>Treść komentarza:{{comment.body}}</p>
        </div>

        <form v-on:submit="saveForm()">
            <div class="row">
                <div class="col-12 form-group">
                    <label class="control-label">Treść koemntarza</label>
                    <input type="text" v-model="comment.body" class="form-control">
                </div>
            </div>
            <input type="submit">
        </form>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                comments: [],
                comment: {
                    user_id: '1',
                    image_id: '1',
                    album_id: '1',
                    type: 'image',
                    body: ''
                },
                imagePath: '',
                imageURL: '',
                user_id: window.Laravel.user_id,
                author_id: window.Laravel.author_id,
                image_id: window.Laravel.image_id
            }
        },
        mounted() {
            var app = this;
            let userid = app.user;
            let imageid = app.image_id;
            console.log('actuall logged user id: ' + this.user_id);
            console.log('author id ' + this.author_id);
            // console.log(checkIfAuthor());
            axios.get('http://localhost/gallery-portal/public/api/v1/images/' + imageid + '/comments')
                .then(function (resp) {
                    app.comments = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load comments");
                });
            // console.log(this.checkIfAuthor());
        },
        methods: {
            saveForm() {
                console.log(this.comment);
                event.preventDefault();
                var app = this;
                var newComment = app.comment;
                axios.post('http://localhost/gallery-portal/public/api/v1/comment', newComment)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your company");
                    });
            }
        }
    }
</script>
