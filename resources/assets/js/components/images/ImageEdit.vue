<template>
    <div class="row">

                    <div class="col-md-5 no-padding" >
                        <form v-on:submit="saveForm()" class="no-padding" style="padding-left:5px;">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Tytuł</label>
                                    <input placeholder="Tytuł zdjęcia" type="text" v-model="image.title" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Alternatywny tytuł</label>
                                    <input placeholder="Tytuł alternatywny" type="text" v-model="image.alt" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Opis zdjęcia</label>
                                    <textarea placeholder="Krótki opis zdjęcia" style="height:90px; padding:5px;" type="text" v-model="image.description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Dostępność:</label>
                                    <input type="text" v-model="image.visible_level" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Zezwalam na:</label>
                                    <input type="text" v-model="image.permission" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <button class="btn btn-success">Zapisz ustawienia zdjęcia</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-7">
                        <div class="form-group mb-5">
                            <router-link to="/" class="btn btn-default pull-right">Powrót</router-link>
                        </div>
                        <img class="mt-2 img-fluid" :src="imageFullPath + image.path" alt="">
                    </div>
                </div>
</template>
<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.imageFullPath = 'http://localhost/gallery-portal/public/storage/users/1/images/';
            app.imageId = id;
            axios.get('http://localhost/gallery-portal/public/api/v1/images/' + id)
                .then(function (resp) {
                    app.image = resp.data;
                })
                .catch(function () {
                    alert("Could not load your image")
                });

        },
        data: function () {
            return {
                imageId: null,
                image: {
                    title: '',
                    alt: '',
                    description: '',
                    path: '',
                    visible_level: '',
                },
                imageFullPath: '',
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newImage = app.image;
                axios.patch('http://localhost/gallery-portal/public/api/v1/images/' + app.imageId, newImage)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        alert("Could not create your image");
                    });
            }
        }
    }
</script>
