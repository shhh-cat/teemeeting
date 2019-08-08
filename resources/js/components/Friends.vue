<template>
    <div class="row m-0 bg-white">

        <div class="col">
        </div>
        <div class="col-md-7 p-0">
            <h2 class="text-center my-3">Friends</h2>
            
            <div class="list-group list-group-horizontal" role="tablist">
                <a class="text-center list-group-item list-group-item-action list-group-item-dark bg-white text-dark active" id="pills-home-tab" data-toggle="pill" href="#pills-friendList" role="tab" aria-controls="pills-friendList" aria-selected="true">
                Friend List
                </a>
                <a class="text-center list-group-item list-group-item-action list-group-item-dark bg-white text-dark" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Friend Request</a>
                <!-- <a class="text-center list-group-item list-group-item-action list-group-item-dark" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a> -->
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-friendList" role="tabpanel" aria-labelledby="pills-friendList-tab">
                    <ul class="list-group">
                        <li class="list-group-item" v-if="!countFriendList">
                                <div class="mb-1 text-center">There are no friends</div>
                        </li>
                        <li class="list-group-item" v-for="friend, index in friendList" :id="'friendList-'+friend.id">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">{{friend.name}}</p>
                                <small>
                                    <div class="dropleft">
                                        <button class="btn btn-sm btn-outline-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item text-right" @click="responseRequest(friend.id,2)">
                                                <div class="float-left">Unfriend</div>
                                                <i class="fas fa-user-minus"></i>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item text-right" @click="responseRequest(friend.id,3)">
                                                <div class="float-left">Block</div>
                                                <i class="fas fa-user-slash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </small>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="list-group">
                        <li class="list-group-item" v-if="!counRequestList">
                                <div class="mb-1 text-center">There are no friend requests</div>
                        </li>
                        <li class="list-group-item" v-for="request, index in requestList" :id="'requestList-'+request.sender_id">
                           <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">{{request.name}}</p>

                                <small>
                                    <a href="#" class="badge badge-success mr-1" @click="responseRequest(request.sender_id,1)">Accept</a>
                                    <a href="#" class="badge badge-danger mr-1" @click="responseRequest(request.sender_id,0)">Deny</a>{{request.sent_at}}
                                </small>
                            </div>
                            <!-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> -->
                            
                        </li>
                    </ul>
                </div>
                <!-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div> -->
            </div>
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
        let app = this;
        //Get Friend List
        axios.get('/api/v1/user/getFriends', {
            headers: app.$headers
        })
        .then(function (resp) {
            app.friendList = resp.data;
            app.countFriendList = app.friendList.length;
        })
        .catch(function (resp) {
            console.log(resp);
            alert("Error");
        });
        //Get Pending Friend Ship
        axios.get('/api/v1/user/getFriendRequests', {
            headers: app.$headers
        })
        .then(function (resp) {
            app.requestList = resp.data;
            app.counRequestList = app.requestList.length;
        })
        .catch(function (resp) {
            console.log(resp);
            alert("Error Pending");
        });
    },
    methods: {
        beFriend(recipient) {
            let app = this;
            let data = {
                self: app.$userId,
                recipient: recipient
            };
            
            axios.post('/api/v1/user/beFriend',
                data,
            {
                headers: app.$headers
            })
            .then(function (resp) {
                $('#'+recipient).html('<i class="fas fa-user-check"></i>');
                $('#'+recipient).attr('class', 'btn btn-sm btn-success float-right');
                $('#'+recipient).prop('disabled', true);
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error");
            });
        },
        responseRequest(object,type){
            let app = this;
            let data = {
                self: app.$userId,
                object: object,
                type: type,
            };
            axios.post('/api/v1/user/responseRequest',
                data,
            {
                headers: app.$headers
            })
            .then(function (resp) {
                if (data.type == 2) {
                    $('#friendList-'+data.object).hide();
                    --app.countFriendList;
                } else {
                $('#requestList-'+data.object).hide();
                --app.counRequestList;
                }
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error");
            });
        }
    },
    data: function () {
        return {
            friendList: [],
            countFriendList: null,
            requestList: [],
            counRequestList: null,
            userId : this.$userId,
        }
    },
}
</script>



