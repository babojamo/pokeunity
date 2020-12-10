<template>

    <div>
        {{ pokemon.name }}
        <img style="width:20px;" :src="pokemon.image" :alt="pokemon.name">

    </div>

</template>
<script>


    export default {
        props: {
            name: {
                required: true,
                type: String,
            }
        },
        data() {
            return {
                pokemon: {
                    name: '',
                    image: '',
                }
            }
        },
        methods: {

            fetchPokemon() {
                axios.get(`/pokemons/${this.name}`).then(response => {
                    this.pokemon = response.data.info;
                    this.user_reaction = response.data.user_reaction;
                });
            },

        },
        watch: {
            name() {
                this.fetchPokemon();
            }
        },
        mounted() {
            this.fetchPokemon();
        }
    }

</script>
