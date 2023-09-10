<template>
    <div>
        <el-row>
            <el-loading v-if="loading" text="Loading...">
                <p>Searching...</p>
            </el-loading>

            <el-col :span="12">
                <el-form :model="searchForm" label-width="120px" @submit.native.prevent="searchListings"
                         v-if="!loading">
                    <el-form-item label="Name">
                        <el-input v-model="searchForm.name"/>
                    </el-form-item>
                    <el-form-item label="Bedrooms">
                        <el-input v-model="searchForm.bedrooms"/>
                    </el-form-item>
                    <el-form-item label="Bathrooms">
                        <el-input v-model="searchForm.bathrooms"/>
                    </el-form-item>
                    <el-form-item label="Storeys">
                        <el-input v-model="searchForm.storeys"/>
                    </el-form-item>
                    <el-form-item label="Garages">
                        <el-input v-model="searchForm.garages"/>
                    </el-form-item>
                    <el-form-item label="Price Range">
                        <el-slider
                            v-model="searchForm.priceRange"
                            :min="0"
                            :max="maxPrice || 1000000"
                            :step="10000"
                            show-stops
                            range
                        ></el-slider>
                    </el-form-item>

                    <!-- Add more input fields for other search criteria as needed -->

                    <el-form-item>
                        <el-button type="primary" native-type="submit">Search</el-button>
                    </el-form-item>
                </el-form>

            </el-col>
            <el-col :span="24">
                <el-table v-if="!loading && results.length > 0" :data="results">
                    <el-table-column prop="name" label="Name"></el-table-column>
                    <el-table-column prop="bedrooms" label="Bedrooms"></el-table-column>
                    <el-table-column prop="bathrooms" label="Bathrooms"></el-table-column>
                    <el-table-column prop="storeys" label="Storeys"></el-table-column>
                    <el-table-column prop="garages" label="Garages"></el-table-column>
                    <el-table-column prop="price" label="Price"></el-table-column>
                    <!-- Add more columns for other properties -->
                </el-table>

                <div v-if="!loading && results.length === 0">
                    No results found.
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            searchForm: {
                name: null,
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                priceRange: [0, this.maxPrice || 1000000], // Initialize the price range
                // Initialize other search criteria here
            },
            results: [],
            loading: false,
            maxPrice: null, // Set the maximum price range value
        };
    },
    methods: {
        async searchListings() {
            this.loading = true;

            try {
                // Replace '/api/listings' with your actual Laravel API endpoint
                const response = await axios.get('/api/listings', {
                    params: this.searchForm,
                });

                this.results = response.data;
            } catch (error) {
                console.error('Error searching listings:', error);
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

<style scoped>
/* Add your Element UI styling here */
</style>
