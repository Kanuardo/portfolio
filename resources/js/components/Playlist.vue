<template>
    <div>
        <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item"><a class="page-link"
             href="#" @click="fetchPlaylists(pagination.prev_page_url)">Previous</a></li>

            <li class="page-item disabled"><a class="page-link text-dark"
             href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
            
            <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item"><a class="page-link"
             href="#" @click="fetchPlaylists(pagination.next_page_url)">Next</a></li>
        </ul>
        </nav>     
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th @click="sort('artist')">Artist name<span class="icon i-arrow float-right"></span></th>
                <th @click="sort('track')">Song<span class="icon i-arrow float-right"></span></th>
                <th @click="sort('genre')">Genre<span class="icon i-arrow float-right"></span></th>
                <th @click="sort('year')">Year<span class="icon i-arrow float-right"></span></th>
                <th @click="sort('duration')">Duration<span class="icon i-arrow float-right"></span></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="playlist in sortedPlaylist" v-bind:key="playlist.id">
                <td>{{ playlist.artist }}</td>
                <td>{{ playlist.track }}</td>
                <td>{{ playlist.genre }}</td>
                <td>{{ playlist.year }}</td>
                <td>{{ playlist.duration }}</td>
                </tr>
            </tbody>
        </table>
    
    </div>
</template>

<script>
export default{
    data(){
        return{
            playlists:[],
            playlist:{
                id:'',
                artist:'',
                track:'',
                genre:'',
                year:'',
                duration:''
            }, pagination:{},
                currentSort:'artist',
                currentSortDir:'asc'

        }
    },

    created(){
        this.fetchPlaylists();
    },
    methods:{
        fetchPlaylists(page_url){
            let vm=this;
            page_url= page_url || 'api/playlist'
            fetch(page_url)
            .then(res =>res.json())
            .then(res =>{
               // res.data.duration = res.data.duration.replace('.', ':');
                this.playlists = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err => console.log(err));
        },
        makePagination(meta, links){
            let pagination ={
                current_page:meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }
            this.pagination= pagination;
        },
            sort:function(s) {
                if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                }
                this.currentSort = s;
            }
    },

    computed:{
        sortedPlaylist:function() {
            return this.playlists.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    }

}

</script>

<style lang="scss" scoped>
.icon {
    display: block;
    &.i-arrow {
        width: 24px;
        height: 24px;
        background-image: url("/icons/arrow.svg");
        background-position: center;
        background-size: contain;
    }
}

</style>