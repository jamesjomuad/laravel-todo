<template>
    <v-app>
        <v-navigation-drawer app absolute>
            <v-sheet color="grey lighten-4" class="pa-4 text-center">
                <v-avatar class="mb-4" color="grey darken-1" size="64">
                    <img src="https://placeimg.com/200/200/people" />
                </v-avatar>

                <div>{{ user.email }}</div>
            </v-sheet>

            <v-divider></v-divider>

            <v-list>
                <v-list-item
                    v-for="[icon, text, to] in links"
                    :key="icon"
                    link
                    :to="to"
                >
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
            <router-view></router-view>
        </v-main>

        <form ref="logout" action="/logout" method="POST">
            <input type="hidden" name="_token" :value="csrf" />
        </form>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        user: null,
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        cards: ["Today", "Yesterday"],
        links: [
            ["mdi-format-list-bulleted", "Tasks", "/"],
            ["mdi-check-bold", "Completed", "/completed"],
            ["mdi-inbox-arrow-down", "Archive", "/archive"],
        ],
    }),

    created() {
        this.user = user;
    },
};
</script>
