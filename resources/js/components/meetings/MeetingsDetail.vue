<template>
    <div class="row m-0 bg-white">
        <div class="col-md-6"></div>
        <div class="col-md-3 p-0 rounded-0 card border-dark" style="width: 18rem;">
            <div class="card-header rounded-0 text-white bg-dark">
            Member
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" v-for="detail, index in meetingDetail">{{detail.name}}</li>
            </ul>
        </div>
        <div class="col-md-9"></div>
        <div >

        </div>
    </div>

</template>
<script>
export default {
    name: 'MeetingDetail',
    watch: {
        '$route.params.id': function (id) {
            this.getData(id)
        }
    },
    mounted() {
        this.getData(this.$route.params.id)
    },
    methods: {
        getData(meeting_id) {
            let app = this;
            let id = id;
            app.meeting_id = meeting_id;
            axios.get('/api/v1/meetings/'+ app.meeting_id + '/detail',{
                headers: app.$headers
            })
                .then(function (resp) {
                    app.meetingDetail = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load meeting detail");
                });
        }
    },
    data: function () {
        return {
            meetingDetail : [],
            meeting_id : null,
        }
    },
}
</script>



