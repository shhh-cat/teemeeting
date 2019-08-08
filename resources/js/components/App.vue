<template>
    <div id="app-content" class="container-fluid">
        <div class="row justify-content-center">
                <div class="col-md-3 p-0 bg-white border border-right-0">
                    <h2 class="row align-items-center justify-content-center h-100" v-show="!backBtn">Meeting List</h2>
                    <button @click="back()" v-show="backBtn" class="p-0 btn btn-block btn-dark rounded-0 w-100 h-100">
                            <span style="font-size : 1rem;">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                    </button>
                </div>
                <div class="col-md-9 p-0">
                    <ul class="rounded-0 list-group list-group-horizontal bg-white">
                        <a type="button" class="list-group-item text-center flex-fill"
                        data-toggle="tooltip" title="User" @click="showUser()">
                            <span style="font-size : 1rem;">
                                <i class="fas fa-user"></i>
                            </span>
                        </a>
                        <a type="button" class="list-group-item text-center flex-fill"
                        data-toggle="tooltip" title="Friends" @click="showFriend()">
                            <span style="font-size : 1rem;">
                                <i class="fas fa-user-friends"></i>
                            </span>
                        </a>
                        <span style="margin-right: -1px;" data-toggle="tooltip" title="Search">
                        <a type="button" class="list-group-item text-center" data-toggle="modal" data-target="#finduserModal">
                            <span style="font-size : 1rem;">
                                <i class="fas fa-search"></i>
                            </span>
                        </a>
                        </span>
                        <a type="button" class="list-group-item text-center"
                        data-toggle="tooltip" title="Notification">
                            <span style="font-size : 1rem;"> <!-- class="text-danger" -->
                                <i class="fas fa-bell"></i>
                            </span>
                        </a>
                        <a type="button" class="list-group-item text-center"
                        data-toggle="tooltip" title="Settings">
                            <span style="font-size : 1rem;">
                                <i class="fas fa-cog"></i>
                            </span>
                        </a>
                    </ul>
                    <!-- MODAL -->
                    <div class="modal fade" id="finduserModal" tabindex="-1" role="dialog" aria-labelledby="finduserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Search</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="typeSearch">Search by:</label>
                                            <select class="form-control" id="typeSearch" v-model="findUserType">
                                                <option value="name">Name</option>
                                                <option value="id">ID</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="dataSearch">Search:</label>
                                            <input type="text" class="form-control" id="dataSearch" placeholder="ID or Name" v-model="findUserData" @input="findUser()" @change="findUser()">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="modal-title" v-show="findResult.length">Search Result</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" v-for="data, index in findResult">
                                        {{data.name}}
                                        <button :id="data.id" class="btn btn-sm btn-outline-dark float-right" @click="beFriend(data.id)"><i class="fas fa-user-plus"></i></button>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-primary"><span style="font-size : 1rem;"><i class="fas fa-search"></i></span></button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL -->
                </div>
                <div class="p-0 col-md-3" v-show="meetingList">
                    <ul v-for="meeting, index in meetings" class="list-group list-group-flush p-0 bg-white">
                        <li @click="showDetail(meeting.id)" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{meeting.meeting_name}}</h5>
                                <small>{{meeting.created_ago}}</small>
                            </div>
                            <!-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> -->
                            <small>Created by: <b>{{meeting.owner_name}}</b></small>
                        </li>
                     </ul>
                </div>
            <div class="p-0" v-bind:class="{ 'col-md-9': meetingList, 'col-md-12': !meetingList }">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App',
    data: function () {
        return {
            meetings : [],
            user_id : this.$userId,
            backBtn: false,
            meetingList: true,

            findResult : [],
            findUserType: 'name',
            findUserData: null,
        }
    },
    mounted() {
        var app = this;
        if (app.$router.currentRoute.path != '/') { app.backBtn = true; app.meetingList = false;} //show btn when reload page <> '/'
        axios.get('/api/v1/meetings/'+ app.user_id + '/owner',{
            headers: app.$headers
        })
            .then(function (resp) {
                app.meetings = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not load meetings");
            });
    },
    methods:{
        showDetail(meeting_id) {
            let id = meeting_id;
            this.$router.push({name:'meetingDetail', params:{
                id: id
            }});
            this.backBtn = true;
        },
        back() {
            this.$router.push({name:'dashboard'});
            this.backBtn = false;
            if (!this.meetingList) {
                this.meetingList = true;
            }
        },
        showUser() {
            this.$router.push({name:'user'});
            this.meetingList = false;
            this.backBtn = true;
        },
        showFriend() {
            this.$router.push({name:'friends'});
            this.meetingList = false;
            this.backBtn = true;
        },
        findUser() {
            let app = this;
            if (app.findUserData !== '') {
                axios.get('/api/v1/user/find-'+ app.findUserType +'-' + app.findUserData , {
                    headers: app.$headers
                })
                .then(function (resp) {
                    app.findResult = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error");
                });
            }
        },
    }
}
</script>
