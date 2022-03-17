<template>
    <v-container class="py-8 px-6">
        <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
                v-model="name"
                :counter="10"
                :rules="nameRules"
                label="Name"
                required
            ></v-text-field>

            <v-textarea
                name="input-7-1"
                filled
                label="Description"
                auto-grow
                v-model="description"
                :rules="descriptionRules"
            ></v-textarea>

            <v-btn
                :disabled="!valid"
                color="success"
                class="mr-4"
                @click="save"
            >
                Add
            </v-btn>

            <v-btn color="error" class="mr-4" @click="reset"> Clear </v-btn>

            <v-btn color="warning" @click="resetValidation">
                Reset Validation
            </v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        valid: true,
        name: "",
        nameRules: [
            (v) => !!v || "Name is required",
            (v) => (v && v.length >= 5) || "Name must be greater than 5 characters",
            (v) => (v && v.length <= 60) || "Name too long!",
        ],
        checkbox: false,
        description: "",
        descriptionRules: [
            (v) => (v && v.length >= 20) || "Name must be greater than 5 characters",
            (v) => (v && v.length <= 240) || "Name too long!",
        ],
    }),

    methods: {
        async save() {
            this.$refs.form.validate();

            const response = await axios.api.post("/item/store", {
                item: {
                    name: this.name,
                    description: this.description,
                },
            });

            if (response.statusText == "Created") {
                this.$router.push("/");
            }

            console.log(response);
        },
        reset() {
            this.$refs.form.reset();
        },
        resetValidation() {
            this.$refs.form.resetValidation();
        },
    },
};
</script>
