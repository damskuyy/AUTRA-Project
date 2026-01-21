import './bootstrap';
import Chart from 'chart.js/auto';

// ==========================================
// LOGIN FORM HANDLER
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleLogin();
        });
    }
});

async function handleLogin() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Validasi input
    if (!username || !password) {
        showAlert('Username dan password harus diisi', 'danger');
        return;
    }

    try {
        // Disable button saat proses
        const submitBtn = document.querySelector('.btn-login');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sedang login...';

        const response = await window.axios.post('/api/login', {
            username: username,
            password: password
        }, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });

        if (response.data.success) {
            showAlert(response.data.message, 'success');
            // Redirect ke dashboard
            setTimeout(() => {
                window.location.href = response.data.redirect;
            }, 1000);
        } else {
            showAlert(response.data.message, 'danger');
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }

    } catch (error) {
        let errorMessage = 'Terjadi kesalahan saat login';
        
        if (error.response) {
            // Server responded with error
            if (error.response.data && error.response.data.message) {
                errorMessage = error.response.data.message;
            } else if (error.response.status === 403) {
                errorMessage = 'Akun Anda telah dinonaktifkan. Hubungi administrator.';
            } else if (error.response.status === 401) {
                errorMessage = 'Username atau password tidak sesuai';
            }
        } else if (error.request) {
            errorMessage = 'Tidak ada respons dari server';
        }

        showAlert(errorMessage, 'danger');
        
        const submitBtn = document.querySelector('.btn-login');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Login';
    }
}

/**
 * Show alert message (Bootstrap-styled)
 */
function showAlert(message, type = 'info') {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.login-alert');
    existingAlerts.forEach(alert => alert.remove());

    // Create alert element
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} login-alert`;
    alertDiv.role = 'alert';
    alertDiv.textContent = message;

    // Insert after form title
    const form = document.getElementById('loginForm');
    const subtitle = document.querySelector('.subtitle');
    
    if (subtitle && subtitle.parentNode) {
        subtitle.parentNode.insertBefore(alertDiv, form);
    } else {
        form.parentNode.insertBefore(alertDiv, form);
    }

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}
