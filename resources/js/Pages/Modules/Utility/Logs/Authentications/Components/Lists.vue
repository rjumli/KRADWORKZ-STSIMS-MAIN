<template>
    <b-row class="g-2 mb-2 mt-n2">
        <b-col lg>
            <div class="input-group mb-1">
                <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                <input type="text" v-model="filter.keyword" placeholder="Search User" class="form-control" style="width: 35%;">
                <b-button type="button" variant="primary">
                    <i class="bx bx-refresh search-icon"></i>
                </b-button>
            </div>
        </b-col>
    </b-row>
    <div class="table-responsive">
        <table class="table table-nowrap align-middle mb-0">
            <thead class="table-light">
                <tr class="fs-11">
                    <th></th>
                    <th style="width: 25%;">Browser</th>
                    <th style="width: 20%;" class="text-center">Login Date</th>
                    <th style="width: 20%;" class="text-center">Logout Date</th>
                    <th style="width: 17%;" class="text-center">User</th>
                    <th style="width: 15%;" class="text-center">Type</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(list,index) in lists" v-bind:key="index">
                    <td>
                        <div class="flex-shrink-0 avatar-xs">
                            <div class="avatar-title bg-light text-primary rounded-3 fs-15">
                                <i :class="'ri-'+list.type+'-fill '+list.attempt"></i>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5 class="fs-13 mb-0 text-dark">{{list.ip}} &nbsp;<span class="fs-12 text-muted">|</span>&nbsp; {{list.platform}} <span class="fs-12 text-muted">({{list.browser}})</span></h5>
                        <p v-if="list.location" class="fs-12 text-muted mb-0">{{ list.location.city }},  {{ list.location.state_name }}, {{ list.location.country }}</p>
                        <p v-else class="fs-12 text-muted mb-0">Not Available</p>
                    </td>
                    <td class="text-center fs-12">{{(list.login_at) ? list.login_at : 'n/a'}}</td>
                    <td class="text-center fs-12">{{(list.logout_at) ? list.logout_at : 'n/a'}}</td>
                    <td class="text-center">
                        <h5 class="fs-13 mb-0 text-dark">{{list.name}}</h5>
                        <span class="fs-12 text-muted">{{list.role}}</span>
                    </td>
                    <td class="text-center">
                        <span v-if="list.logout_at == 'n/a'" :class="(list.is_attempt) ? 'badge bg-success' : 'badge bg-danger'">
                            <span v-if="list.is_attempt">Login Successful</span>
                            <span v-else>Login Failed</span>
                        </span>
                        <span v-else class="badge bg-warning">Logout</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
    </div>
</template>
<script>
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination },
    data(){
        return {
            lists: [],
            meta: {},
            links: {},
            filter: {
                keyword: null
            }
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        fetch(page_url){
            page_url = page_url || '/utility/logs/authentications';
            axios.get(page_url,{
                params : {
                    keyword: this.filter.keyword,
                    counts: ((window.innerHeight-480)/60),
                    option: 'lists'
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data.data;
                    this.meta = response.data.meta;
                    this.links = response.data.links;          
                }
            })
            .catch(err => console.log(err));
        },
    }
}
</script>