<template>


    <div class="list-group">
        <a v-for="(user,key) in pagination.data" :key="key" href="#" @click.prevent="false"
            class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5>{{ user.name }}</h5>
                <small>Joined {{ user.joined_at }}</small>
            </div>

            <span class="small">Trainer Name: {{ user.trainer_name }}</span>


            <ul class="list-group mt-3">
                <li class="list-group-item">
                    <p><i class="fa fa-heart reaction-btn heart active" aria-hidden="true"></i> Favorite Pokemons</p>
                    <ul>
                        <li v-for="(favorite_pokemon,favKey) in user.favorite_pokemons" :key="favKey">
                            <pokemon :name="favorite_pokemon.pokemon_id"></pokemon>
                        </li>
                    </ul>
                </li>

                <li class="list-group-item">
                    <p><i class="fa fa-thumbs-up reaction-btn like active" aria-hidden="true"></i> Liked Pokemons</p>
                    <ul>
                        <li v-for="(liked_pokemon,favKey) in user.liked_pokemons" :key="favKey">
                            <pokemon :name="liked_pokemon.pokemon_id"></pokemon>
                        </li>
                    </ul>
                </li>

                <li class="list-group-item">
                    <p><i class="fas fa-angry reaction-btn hate active" aria-hidden="true"></i> Hated Pokemons</p>

                    <ul>
                        <li v-for="(hated_pokemon,favKey) in user.hated_pokemons" :key="favKey">
                            <pokemon :name="hated_pokemon.pokemon_id"></pokemon>
                        </li>
                    </ul>
                </li>
            </ul>
        </a>
    </div>
</template>

<script>
    import Pokemon from './pokemon';

    export default {
        components: {
            Pokemon
        },
        data() {
            return {
                pagination: {
                    data: [],
                }
            }
        },
        methods: {
            loadUsers() {
                axios.get('/community').then(response => {
                    this.pagination = response.data;
                });
            }
        },
        mounted() {
            this.loadUsers();
        },


    }

</script>
