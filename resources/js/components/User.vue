<template>
    <div class="row m-0 bg-white">

        <div class="col">
            
        </div>
        <div class="col-md-7 p-0">
            <h2 class="text-center my-3">User Information</h2>
            <ul class="list-group">
                <li class="list-group-item"><b>Name: </b>{{userData.name}}</li>
                <li class="list-group-item"><b>Email: </b>{{userData.email}}</li>
                <li class="list-group-item"><b>Created at: </b>{{userData.created_at}}</li>
            </ul>
        </div>
        <div class="col"></div>
        <div >

        </div>
    </div>

</template>
<script>
export default {
    name: 'User',
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            let app = this;
            axios.get('/api/v1/auth/getSelf', {
                headers: app.$headers
            })
                .then(function (resp) {
                    app.userData = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load meeting detail");
                });
        }
    },
    data: function () {
        return {
            userData : [],
            userId : this.$userId,
        }
    },
}
</script>



