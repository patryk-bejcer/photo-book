
<template>
    <div class="row">
        <!--<div class="form-group">-->
            <!--<router-link :to="{name: 'createCompany'}" class="btn btn-success">Create new image</router-link>-->
        <!--</div>-->
                    <div class="col-md-3 no-padding" v-for="image, index in images" style="padding:5px;">
                        <img class="img-fluid" :src="imagePath + image.path" alt="">
                        <router-link style="position: absolute;top: -1px;right: 35px;padding: 6px 12px;font-size: 12px;" :to="{name: 'editImage', params: {id: image.id}}" class="btn btn-xs btn-default">
                            Edycja
                        </router-link>
                        <a href="#"
                           class="btn btn-xs btn-danger" style="position: absolute;top: -1px;right: -1px;padding: 6px 12px;font-size: 12px;"
                           v-on:click="deleteEntry(image.id, index)">
                            X
                        </a>
                    </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: function () {
            return {
                images: [],
                imagePath: ''
            }
        },
        mounted() {
            var app = this;
            let userid = app.user;
            app.imagePath = 'http://localhost/gallery-portal/public/storage/users/' + userid + '/images/thumb-';
            axios.get('http://localhost/gallery-portal/public/api/v1/users/' + userid + '/images')
                .then(function (resp) {
                    app.images = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load images");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Jesteś pewien że chcesz usunąc to zdjęcie?")) {
                    var app = this;
                    axios.delete('http://localhost/gallery-portal/public/api/v1/images/' + id)
                        .then(function (resp) {
                            app.images.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete image");
                        });
                }
            }
        }
    }
</script>
