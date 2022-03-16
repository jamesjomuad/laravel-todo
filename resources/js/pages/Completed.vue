<template>
    <div>
        <v-container class="py-8 px-6">
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <!-- <v-subheader>Today</v-subheader> -->
                        <v-list two-line>
                            <template v-for="(item, n) in items">
                                <v-list-item :key="n">
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
        const { data } = await axios.api.get("items", { params: { status: "completed" } });
        this.items = data;
    },

};
</script>
