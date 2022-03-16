<template>
    <div>
        <v-container class="py-8 px-6">
            <v-row>
                <v-col>
                    <v-btn class="mx-2" fab dark color="indigo" to="/create">
                        <v-icon dark> mdi-plus </v-icon>
                    </v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <v-subheader>Today</v-subheader>
                        <v-list two-line>
                            <template v-for="(item, n) in items">
                                <v-list-item :key="n">
                                    <v-list-item-avatar color="grey darken-1">
                                        <img
                                            src="https://picsum.photos/200"
                                            alt=""
                                        />
                                    </v-list-item-avatar>

                                    <v-list-item-content>
                                        <v-list-item-title>{{
                                            item.name
                                        }}</v-list-item-title>

                                        <v-list-item-subtitle
                                            v-if="item.description"
                                        >
                                            {{ item.description }}
                                        </v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <v-divider
                                    v-if="n !== items.length - 1"
                                    :key="`divider-${n}`"
                                    inset
                                ></v-divider>
                            </template>
                        </v-list>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    data: () => ({
        items: [],
    }),

    async created() {
        const { data } = await axios.api.get("items");
        this.items = data;
    },
};
</script>
