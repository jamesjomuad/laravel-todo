<template>
    <div>
        <v-container class="py-8 px-6">
            <v-row>
                <v-col cols="12">
                    <v-card v-if="items.length">
                        <!-- <v-subheader>Today</v-subheader> -->
                        <v-list two-line color="#64B5F6">
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
                    <v-alert v-if="!items.length" border="right" color="blue-grey" dark>
                        No task completed!
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
            params: { status: "completed" },
        });
        this.items = data;
    },
};
</script>
