/**
 * Centralized API Client for Admin Dashboard
 * Handles all API calls with proper error handling and fallbacks
 * Uses the same flow as dashboard
 */

// Global API client
window.api = {
    // Base configuration
    baseURL: 'https://stapin.site/api/v1',

    // Get token from session (same as dashboard)
    getToken() {
        return window.token || '{{ $token ?? "" }}';
    },

    // Generic fetch function with error handling (same as dashboard)
    async fetch(endpoint, options = {}) {
        try {
            const token = this.getToken();
            if (!token) {
                console.error('No token available for API request');
                return null;
            }

            console.log(`Making API request to: ${this.baseURL}${endpoint}`);

            const response = await fetch(`${this.baseURL}${endpoint}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    ...options.headers
                },
                ...options
            });

            console.log(`API response status: ${response.status}`);

            if (!response.ok) {
                const errorText = await response.text();
                console.error(`HTTP error! status: ${response.status}, message: ${errorText}`);
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log(`API response data for ${endpoint}:`, data);
            return data;
        } catch (error) {
            console.error(`Error fetching ${endpoint}:`, error);
            return null;
        }
    },

    // Generic POST request
    async post(endpoint, body, isFormData = false) {
        const token = this.getToken();
        if (!token) {
            console.error('No token available for API POST request');
            alert('Session expired or not logged in. Please login again.');
            return null;
        }
        let options = {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        };
        if (isFormData) {
            options.body = body;
            // Do NOT set Content-Type for FormData, browser will handle it
        } else {
            options.body = JSON.stringify(body);
            options.headers['Content-Type'] = 'application/json';
        }
        return this.fetch(endpoint, options);
    },

    // Get plants data (same logic as dashboard)
    async getPlants() {
        try {
            console.log('Fetching plants data...');
            const tanamanData = await this.fetch('/plants/?limit=100');
            console.log('Plants data response:', tanamanData);

            if (tanamanData) {
                // Handle different possible response formats - same as dashboard
                if (tanamanData.plants && Array.isArray(tanamanData.plants)) {
                    return tanamanData.plants.map(plant => ({
                        ...plant,
                        category: plant.category || 'Sayuran' // Default category if not specified
                    }));
                } else if (tanamanData.data && Array.isArray(tanamanData.data)) {
                    return tanamanData.data.map(plant => ({
                        ...plant,
                        category: plant.category || 'Sayuran'
                    }));
                } else if (Array.isArray(tanamanData)) {
                    return tanamanData.map(plant => ({
                        ...plant,
                        category: plant.category || 'Sayuran'
                    }));
                } else {
                    console.warn('Unexpected plants data structure:', tanamanData);
                    return [];
                }
            } else {
                return [];
            }
        } catch (error) {
            console.error('Error fetching plants:', error);
            return this.getMockPlants();
        }
    },

    // Get plant categories data
    async getPlantCategories() {
        try {
            console.log('Fetching plant categories data...');
            const categoriesData = await this.fetch('/plant-categories/?limit=100');
            console.log('Plant categories data response:', categoriesData);

            if (categoriesData) {
                // Handle different possible response formats
                if (categoriesData.categories && Array.isArray(categoriesData.categories)) {
                    return categoriesData.categories;
                } else if (categoriesData.data && Array.isArray(categoriesData.data)) {
                    return categoriesData.data;
                } else if (Array.isArray(categoriesData)) {
                    return categoriesData;
                } else {
                    console.warn('Unexpected categories data structure:', categoriesData);
                    return [];
                }
            } else {
                return [];
            }
        } catch (error) {
            console.error('Error fetching plant categories:', error);
            return this.getMockCategories();
        }
    },

    // Create a new plant category
    async createPlantCategory(formData) {
        try {
            console.log('Creating new plant category...');
            // The third argument `true` indicates that we are sending FormData
            const response = await this.post('/plant-categories', formData, true);
            console.log('Create category response:', response);
            return response;
        } catch (error) {
            console.error('Error creating plant category:', error);
            return null;
        }
    },

    // Get diseases data
    async getDiseases() {
        try {
            console.log('Fetching diseases data...');
            const hamaData = await this.fetch('/diseases/?limit=100');
            console.log('Diseases data response:', hamaData);

            if (hamaData) {
                // Handle different possible response formats - same as dashboard
                if (hamaData.diseases && Array.isArray(hamaData.diseases)) {
                    return hamaData.diseases.map(disease => ({
                        ...disease,
                        type: disease.type || 'Disease' // Default type if not specified
                    }));
                } else if (hamaData.data && Array.isArray(hamaData.data)) {
                    return hamaData.data.map(disease => ({
                        ...disease,
                        type: disease.type || 'Disease'
                    }));
                } else if (Array.isArray(hamaData)) {
                    return hamaData.map(disease => ({
                        ...disease,
                        type: disease.type || 'Disease'
                    }));
                } else {
                    console.warn('Unexpected diseases data structure:', hamaData);
                    return [];
                }
            } else {
                return [];
            }
        } catch (error) {
            console.error('Error fetching diseases:', error);
            return this.getMockDiseases();
        }
    },

    // Mock data fallbacks
    getMockPlants() {
        return [
            { id: 1, name: 'Tomat', latin_name: 'Solanum lycopersicum', category: 'Sayuran', common_name: 'Tomat' },
            { id: 2, name: 'Sirih', latin_name: 'Piper betle', category: 'Herbal', common_name: 'Sirih' },
            { id: 3, name: 'Cabai', latin_name: 'Capsicum annuum', category: 'Sayuran', common_name: 'Cabai' },
            { id: 4, name: 'Jahe', latin_name: 'Zingiber officinale', category: 'Herbal', common_name: 'Jahe' },
            { id: 5, name: 'Mangga', latin_name: 'Mangifera indica', category: 'Buah', common_name: 'Mangga' },
            { id: 6, name: 'Bayam', latin_name: 'Amaranthus', category: 'Sayuran', common_name: 'Bayam' },
            { id: 7, name: 'Kunyit', latin_name: 'Curcuma longa', category: 'Herbal', common_name: 'Kunyit' },
            { id: 8, name: 'Pisang', latin_name: 'Musa', category: 'Buah', common_name: 'Pisang' },
            { id: 9, name: 'Sawi', latin_name: 'Brassica rapa', category: 'Sayuran', common_name: 'Sawi' },
            { id: 10, name: 'Temulawak', latin_name: 'Curcuma xanthorrhiza', category: 'Herbal', common_name: 'Temulawak' },
            { id: 11, name: 'Wortel', latin_name: 'Daucus carota', category: 'Sayuran', common_name: 'Wortel' },
            { id: 12, name: 'Lengkuas', latin_name: 'Alpinia galanga', category: 'Rempah', common_name: 'Lengkuas' },
            { id: 13, name: 'Pepaya', latin_name: 'Carica papaya', category: 'Buah', common_name: 'Pepaya' },
            { id: 14, name: 'Kangkung', latin_name: 'Ipomoea aquatica', category: 'Sayuran', common_name: 'Kangkung' },
            { id: 15, name: 'Kencur', latin_name: 'Kaempferia galanga', category: 'Herbal', common_name: 'Kencur' }
        ];
    },

    getMockCategories() {
        console.log('Using mock categories data');
        return [{
                id: 1,
                nama_kategori: 'Tanaman Umum (Mock)'
            },
            {
                id: 2,
                nama_kategori: 'Tanaman Pangan (Mock)'
            },
            {
                id: 3,
                nama_kategori: 'Tanaman Buah (Mock)'
            },
        ];
    },

    getMockDiseases() {
        return [
            { id: 1, name: 'Wereng Coklat', latin_name: 'Nilaparvata lugens', type: 'Pest', common_name: 'Brown Planthopper', plants_listed: ['Padi', 'Jagung'] },
            { id: 2, name: 'Blast Padi', latin_name: 'Pyricularia oryzae', type: 'Disease', common_name: 'Rice Blast', plants_listed: ['Padi'] },
            { id: 3, name: 'Penggerek Batang', latin_name: 'Scirpophaga incertulas', type: 'Pest', common_name: 'Yellow Stem Borer', plants_listed: ['Padi', 'Tebu'] },
            { id: 4, name: 'Ulat Grayak', latin_name: 'Spodoptera litura', type: 'Pest', common_name: 'Armyworm', plants_listed: ['Tomat', 'Cabai', 'Bayam'] },
            { id: 5, name: 'Layu Bakteri', latin_name: 'Ralstonia solanacearum', type: 'Disease', common_name: 'Bacterial Wilt', plants_listed: ['Tomat', 'Terong', 'Kentang'] }
        ];
    },

    // Utility functions (same as dashboard)
    showLoading() {
        const loading = document.getElementById('loadingIndicator');
        if (loading) {
            loading.style.display = 'flex';
        }
    },

    hideLoading() {
        const loading = document.getElementById('loadingIndicator');
        if (loading) {
            loading.style.display = 'none';
        }
    },

    showError(message) {
        console.error('API Error:', message);
        alert(`Error: ${message}`);
    }
};

// Initialize API client when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('API Client initialized');
});
