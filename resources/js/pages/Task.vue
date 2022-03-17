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
                    <v-card v-if="items.length">
                        <v-subheader>Today</v-subheader>
                        <v-list two-line>
                            <template v-for="(item, n) in items">
                                <v-list-item :key="n">
                                    <v-list-item-action>
                                        <v-checkbox
                                            @change="
                                                onCheckbox($event, item, n)
                                            "
                                            :key="item.id"
                                        ></v-checkbox>
                                    </v-list-item-action>

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

                    <v-alert v-if="!items.length" border="right" color="blue-grey" dark>
                        NO Task!
                    </v-alert>
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
        const { data } = await axios.api.get("items", {
            params: { status: "ongoing" },
        });
        this.items = data;
    },

    methods: {
        async onCheckbox(state, item, key) {
            const response = await axios.api.put(`/item/${item.id}`, {
                item: {
                    completed: state,
                },
            });

            this.items.splice(key, 1);
        },
    },
};
</script>
