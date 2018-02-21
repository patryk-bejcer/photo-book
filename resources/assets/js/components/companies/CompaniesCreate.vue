<template>
    <form v-on:submit="saveForm()">
        <div class="row">
            <div class="col-12 form-group">
                <label class="control-label">Company name</label>
                <input type="text" v-model="company.name" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <label class="control-label">Company address</label>
                <input type="text" v-model="company.address" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <label class="control-label">Company website</label>
                <input type="text" v-model="company.website" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <label class="control-label">Company email</label>
                <input type="text" v-model="company.email" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group">
                <button class="btn btn-success">Create</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data: function () {
            return {
                company: {
                    name: '',
                    address: '',
                    website: '',
                    email: '',
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newCompany = app.company;
                axios.post('http://localhost/gallery-portal/public/api/v1/companies', newCompany)
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
