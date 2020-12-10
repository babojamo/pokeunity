<template>
    <div>

        <div class="input-group mb-3">
            <input @keydown.enter.prevent="listPokemons()" v-model="search_keyword" type="text" class="form-control"
                placeholder="Find pokemon by name" aria-label="Pokemon's name">
            <button @click.prevent="listPokemons()" class="btn btn-outline-secondary" type="button">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>


        <div class="row row-cols-1 row-cols-md-3 mb-3" v-for="(newlist,key) in chunked" :key="key">
            <div class="col" v-for="(pokemon,pokeIndex) in newlist" :key="pokeIndex">
                <pokemon-info :name="pokemon.name"></pokemon-info>
            </div>
        </div>



        <paginate :click-handler="pageChange" prev-link-class="page-link" prev-class="page-item"
            next-link-class="page-link" next-class="page-item" page-class="page-item" page-link-class="page-link"
            :value="pagination.current_page" :page-count="pagination.last_page">
        </paginate>

    </div>
</template>
<script>
    import _ from 'lodash';
    import PokemonInfo from './pokemon';
    import Paginate from '../pagination';


    export default {
        components: {
            PokemonInfo,
            Paginate
        },
        data() {
            return {
                search_keyword: '',
                pagination: {
                    current_page: 1,
                    data: [],
                    last_page: 75,
                    to: null,
                    total: 1118,
                },
                submitted: false,
            }
        },
        computed: {
            chunked() {
                return _.chunk(this.pagination.data, 3)
            },
        },

        methods: {
            pageChange(page) {
                this.pagination.current_page = page;
                this.listPokemons();
            },
            listPokemons() {
                if (this.submitted === false) {
                    this.submitted = true;
                    this.pagination.data = [];
                    axios.get(`/pokemons?q=${this.search_keyword}&page=${this.pagination.current_page}`).then(
                        response => {
                            
                            this.pagination = response.data;

                        }).finally(() => {
                        this.submitted = false;
                    });

                }

            },
        },
        mounted() {
            this.listPokemons();
        }
    }

</script>
