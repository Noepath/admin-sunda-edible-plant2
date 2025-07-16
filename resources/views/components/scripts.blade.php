<script>
    // Firebase token from session
    const firebaseToken = @json(session('firebase_token'));

    // Make token globally available
    window.token = firebaseToken;

    // API Configuration
    const API_BASE_URL = 'https://stapin.site/api/v1';
    const headers = {
        'Authorization': `Bearer ${firebaseToken}`,
        'Content-Type': 'application/json'
    };

    // Show loading state
    function showLoading() {
        document.getElementById('loadingState').classList.remove('hidden');
    }

    // Hide loading state
    function hideLoading() {
        document.getElementById('loadingState').classList.add('hidden');
    }
</script>

<!-- API Client -->
<script src="{{ asset('js/api-client.js') }}"></script>

<script>
    // Fetch data from API
    async function fetchData(endpoint) {
        try {
            console.log(`Fetching from: ${API_BASE_URL}${endpoint}`);
            const response = await fetch(`${API_BASE_URL}${endpoint}`, {
                method: 'GET',
                headers: headers
            });

            console.log(`Response status: ${response.status}`);
            console.log(`Response headers:`, response.headers);

            if (!response.ok) {
                const errorText = await response.text();
                console.error(`HTTP error! status: ${response.status}, body: ${errorText}`);
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log(`Data received:`, data);
            return data;
        } catch (error) {
            console.error(`Error fetching ${endpoint}:`, error);
            return null;
        }
    }

    // Show error message
    function showErrorMessage(message) {
        // Create error notification
        const errorDiv = document.createElement('div');
        errorDiv.className = 'fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50';
        errorDiv.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(errorDiv);

        // Remove after 5 seconds
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }

    // Show success message
    function showSuccessMessage(message) {
        const successDiv = document.createElement('div');
        successDiv.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50';
        successDiv.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(successDiv);

        setTimeout(() => {
            successDiv.remove();
        }, 5000);
    }

    // Token management functions
    function copyToken() {
        const tokenTextarea = document.getElementById('firebase-token');
        if (!tokenTextarea) return;

        const copyStatus = document.getElementById('copy-status');

        // Select and copy the token
        tokenTextarea.select();
        tokenTextarea.setSelectionRange(0, 99999);

        try {
            document.execCommand('copy');

            // Show success message
            if (copyStatus) {
                copyStatus.classList.remove('hidden');
                setTimeout(() => {
                    copyStatus.classList.add('hidden');
                }, 3000);
            }

            // Use modern clipboard API if available
            if (navigator.clipboard) {
                navigator.clipboard.writeText(tokenTextarea.value).then(() => {
                    console.log('Token copied to clipboard using modern API');
                });
            }
        } catch (err) {
            console.error('Failed to copy token: ', err);
            alert('Failed to copy token. Please select and copy manually.');
        }
    }

    function selectAll() {
        const tokenTextarea = document.getElementById('firebase-token');
        if (!tokenTextarea) return;

        tokenTextarea.focus();
        tokenTextarea.select();
        tokenTextarea.setSelectionRange(0, 99999);
    }

    // Logout confirmation function
    function confirmLogout() {
        if (confirm('Are you sure you want to logout?')) {
            // Show loading state
            const loadingDiv = document.createElement('div');
            loadingDiv.id = 'logout-loading';
            loadingDiv.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loadingDiv.innerHTML = `
                <div class="bg-white p-6 rounded-lg shadow-xl text-center">
                    <svg class="animate-spin h-8 w-8 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="text-gray-600">Logging out...</p>
                </div>
            `;
            document.body.appendChild(loadingDiv);

            // Redirect to logout after short delay
            setTimeout(() => {
                window.location.href = '/logout';
            }, 1000);
        }
    }

    // Auto-select token when clicking on textarea
    document.addEventListener('DOMContentLoaded', function() {
        const tokenTextarea = document.getElementById('firebase-token');
        if (tokenTextarea) {
            tokenTextarea.addEventListener('click', function() {
                this.select();
            });
        }
    });
</script>
