<template>
    <div>
        <v-container class="py-8 px-6">
            <v-row>
                <v-col cols="12">
                    <v-card v-if="items.length">
                        <!-- <v-subheader>Today</v-subheader> -->
                        <v-list two-line color="grey">
                            <template v-for="(item, n) in items">
                                <v-list-item :key="n">
                                    <v-list-item-content>
                                        <v-list-item-title class="font-weight-bold">{{
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
                                ></v-divider>
                            </template>
                        </v-list>
                    </v-card>

                    <!-- No data alert -->
                    <v-alert
                        v-if="!items.length"
                        border="right"
                        color="blue-grey"
                        dark
                    >
                        Empty!
                    </v-alert>
                </v-col>
            </v-row>

            <v-snackbar v-model="snackbar.state">
                {{ snackbar.message }}

                <template v-slot:action="{ attrs }">
                    <v-btn
                        color="blue"
                        text
                        v-bind="attrs"
                        @click="snackbar.state = false"
                    >
                        Close
                    </v-btn>
                </template>
            </v-snackbar>
        </v-container>
    </div>
</template>

<script>
export default {
    data: () => ({
        items: [],
        snackbar:{
            state: null,
            message: null,
        }
    }),

    async created() {
        const { data } = await axios.api.get("items", {
            params: { status: "deleted" },
        });
        this.items = data;
    },

    methods: {
        async onTrash(item, key) {
            const res = await axios.api.delete(`/item/${item.id}`);
            if (res.status == 200) {
                this.items.splice(key, 1);
                this.snackbar.state = true
                this.snackbar.message = "Deleted successfully!"
            }
        },
    },
};
</script>
