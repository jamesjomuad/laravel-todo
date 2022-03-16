<template>
    <v-app>
        <v-navigation-drawer app absolute>
            <v-sheet color="grey lighten-4" class="pa-4">
                <v-avatar class="mb-4" color="grey darken-1" size="64"></v-avatar>

                <div>john@vuetifyjs.com</div>
            </v-sheet>

            <v-divider></v-divider>

            <v-list>
                <v-list-item v-for="[icon, text] in links" :key="icon" link>
                    <v-list-item-icon>
                        <v-icon>{{ icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ text }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link @click="$refs.logout.submit()">
                    <v-list-item-icon>
                        <v-icon>mdi-chevron-double-left</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <v-container class="py-8 px-6">
                <v-row>
                    <v-col cols="12">
                        <v-card>
                            <v-subheader>Today</v-subheader>
                            <v-list two-line>
                                <template v-for="(item, n) in items">
                                    <v-list-item :key="n">
                                        <v-list-item-avatar color="grey darken-1">
                                            <img src="https://picsum.photos/200" alt="">
                                        </v-list-item-avatar>

                                        <v-list-item-content>
                                            <v-list-item-title>{{item.name}}</v-list-item-title>

                                            <v-list-item-subtitle v-if="item.description">
                                                {{item.description}}
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item>

                                    <v-divider v-if="n !== items.length-1" :key="`divider-${n}`" inset></v-divider>
                                </template>
                            </v-list>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>

        <form ref="logout" action="/logout" method="POST" ><input type="hidden" name="_token" :value="csrf"></form>

    </v-app>
</template>

<script>
    export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            cards: ['Today', 'Yesterday'],
            links: [
                ['mdi-file', 'New'],
                ['mdi-format-list-bulleted', 'Tasks'],
                ['mdi-check-bold', 'Completed'],
                ['mdi-inbox-arrow-down', 'Archive'],
            ],
            items: []
        }),

        async created() {
            const {
                data
            } = await axios.api.get('items');
            this.items = data
        },
    }

</script>
