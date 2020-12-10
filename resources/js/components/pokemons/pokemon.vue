<template>

    <div class="card">
        <div class="card-header">
            <h4 class="my-0 fw-normal">{{ pokemon.name }}</h4>
        </div>
        <div class="card-body">
            <img style="width:85px;" :src="pokemon.image" :alt="pokemon.name">
        </div>
        <div class="card-footer">

            <a href="#" title="My favorite pokemon"
                :class="['reaction-btn','heart',(user_reaction===REACTIONS.HEART?'active':'')]"
                @click.prevent="heartPokemon()"><i class="fa fa-heart" aria-hidden="true"></i></a>

            <a href="#" title="I like this pokemon"
                :class="['reaction-btn','like',(user_reaction===REACTIONS.LIKE?'active':'')]"
                @click.prevent="likePokemon()"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
            <a href="#" title="I hate this pokemon"
                :class="['reaction-btn','hate',(user_reaction===REACTIONS.HATE?'active':'')]"
                @click.prevent="hatePokemon()"><i class="fas fa-angry"></i></a>
        </div>
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
                },
                REACTIONS: {
                    LIKE: 1,
                    HATE: 2,
                    HEART: 3,
                },
                user_reaction: null,
            }
        },
        methods: {

            fetchPokemon() {
                axios.get(`/pokemons/${this.name}`).then(response => {
                    this.pokemon = response.data.info;
                    this.user_reaction = response.data.user_reaction;
                });
            },
            likePokemon(name) {

                // Remove if already reacted
                if (this.user_reaction === this.REACTIONS.LIKE) {
                    this.removeReaction();
                    return;
                }


                // React to like
                this.updateReaction(this.REACTIONS.LIKE);
                axios.post(`/pokemons/${this.name}/like`).catch(error => {
                    // Reset reaction if fails
                    this.updateReaction(null);
                });

            },

            heartPokemon() {

                // Remove if already reacted
                if (this.user_reaction === this.REACTIONS.HEART) {
                    this.removeReaction();
                    return;
                }


                // React to heart
                this.updateReaction(this.REACTIONS.HEART);
                axios.post(`/pokemons/${this.name}/heart`).catch(error => {
                    // Reset reaction if fails
                    this.updateReaction(null);
                });
            },
            hatePokemon(name) {


                // Remove if already reacted
                if (this.user_reaction === this.REACTIONS.HATE) {
                    this.removeReaction();
                    return;
                }

                // React to hate
                this.updateReaction(this.REACTIONS.HATE);
                axios.post(`/pokemons/${this.name}/hate`).catch(error => {
                    // Reset reaction if fails
                    this.updateReaction(null);
                });
            },
            removeReaction() {
                this.updateReaction(null);
                axios.post(`/pokemons/${this.name}/remove-reaction`).catch(error => {
                    // if fail get the pokemon info from db to load the latest reaction
                    this.fetchPokemon();
                });
            },

            updateReaction(reaction) {
                this.user_reaction = reaction;
            }
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
