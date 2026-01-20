// ==========================================
// GLOBAL UTILITIES
// ==========================================

// Scroll to top on page load
window.addEventListener('load', function() {
    window.scrollTo(0, 0);
});

// Show Notification Function
function showNotification(message, type = 'error') {
    const existing = document.querySelector('.notification');
    if (existing) {
        existing.remove();
    }
    
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// ==========================================
// USER PROFILE DROPDOWN MENU
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    const userProfileContainer = document.querySelector('.user-profile-container');
    const userProfile = document.querySelector('.user-profile');
    const userDropdown = document.querySelector('.user-dropdown');
    const logoutBtn = document.getElementById('logoutBtn');
    
    if (userProfile && userDropdown) {
        // Toggle dropdown on profile click
        userProfile.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userProfileContainer.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
        
        // Handle logout button
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // SweetAlert confirmation
                Swal.fire({
                    title: 'Logout?',
                    text: 'Apakah Anda ingin logout dari sistem?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Logging out...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Send logout request
                        fetch('/logout', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json'
                            }
                        }).then(response => {
                            // Clear session and redirect
                            sessionStorage.clear();
                            window.location.href = '/login';
                        }).catch(error => {
                            console.error('Logout error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat logout'
                            });
                        });
                    }
                });
            });
        }
    }
});

// ==========================================
// LOGIN PAGE FUNCTIONALITY
// ==========================================

if (document.getElementById('loginForm')) {
    const loginForm = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const btnLogin = document.querySelector('.btn-login');

    // Form Submit Handler
    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();
        
        if (!username || !password) {
            showNotification('Username dan password harus diisi!', 'error');
            return;
        }
        
        // Show loading
        btnLogin.classList.add('loading');
        btnLogin.disabled = true;
        const originalText = btnLogin.textContent;
        btnLogin.textContent = 'Sedang login...';
        
        try {
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Send login request
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    username: username,
                    password: password
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showNotification(data.message, 'success');
                
                // Clear old session data
                sessionStorage.clear();
                
                // Redirect to dashboard
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 800);
            } else {
                showNotification(data.message, 'error');
                btnLogin.classList.remove('loading');
                btnLogin.disabled = false;
                btnLogin.textContent = originalText;
            }
        } catch (error) {
            console.error('Login error:', error);
            showNotification('Terjadi kesalahan saat login', 'error');
            btnLogin.classList.remove('loading');
            btnLogin.disabled = false;
            btnLogin.textContent = originalText;
        }
    });

    // Enter key navigation
    usernameInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            passwordInput.focus();
        }
    });

    passwordInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            loginForm.dispatchEvent(new Event('submit'));
        }
    });

    // Reset button on back
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            btnLogin.classList.remove('loading');
            btnLogin.disabled = false;
            btnLogin.textContent = 'Login';
        }
    });
}

// ==========================================
// DASHBOARD PAGE FUNCTIONALITY
// ==========================================

if (document.querySelector('.dashboard-page')) {
    
    // Note: Authentication is handled by backend middleware
    // If user reaches this page, they are already authenticated
    
    // Get username from page or set default
    window.addEventListener('DOMContentLoaded', function() {
        const userNameElement = document.querySelector('.user-name');
        // Username will be set by the backend view if authenticated
        if (!userNameElement?.textContent?.trim()) {
            userNameElement.textContent = 'User';
        }
    });

    // Sensor Data Storage
    let sensorData = {
        suhu: [],
        cahaya: [],
        kelembapan: [],
        kelembapanCurrent: 60.2,
        timestamps: []
    };

    // Initialize with data
    function initializeData() {
        const now = new Date();
        for (let i = 30; i >= 0; i--) {
            const time = new Date(now.getTime() - i * 60000);
            sensorData.timestamps.push(formatTime(time));
            sensorData.suhu.push(27 + Math.random() * 9);
            sensorData.cahaya.push(300 + Math.random() * 500);
            sensorData.kelembapan.push(50 + Math.random() * 20);
        }
    }

    // Format time
    function formatTime(date) {
        return date.getHours().toString().padStart(2, '0') + '.' + 
               date.getMinutes().toString().padStart(2, '0');
    }

    // Update sensor values
    function updateSensorValues() {
        const latestSuhu = sensorData.suhu[sensorData.suhu.length - 1];
        const latestCahaya = sensorData.cahaya[sensorData.cahaya.length - 1];
        
        const suhuEl = document.getElementById('suhuValue');
        const cahayaEl = document.getElementById('cahayaValue');
        const kelembapanEl = document.getElementById('kelembapanValue');
        
        if (suhuEl) suhuEl.textContent = latestSuhu.toFixed(1);
        if (cahayaEl) cahayaEl.textContent = Math.round(latestCahaya);
        if (kelembapanEl) kelembapanEl.textContent = sensorData.kelembapanCurrent.toFixed(1);
    }

    // Generate new data
    function generateNewData() {
        sensorData.timestamps.push(formatTime(new Date()));
        sensorData.timestamps.shift();
        
        const lastSuhu = sensorData.suhu[sensorData.suhu.length - 1];
        const newSuhu = lastSuhu + (Math.random() - 0.5) * 2;
        sensorData.suhu.push(Math.max(25, Math.min(38, newSuhu)));
        sensorData.suhu.shift();
        
        const lastCahaya = sensorData.cahaya[sensorData.cahaya.length - 1];
        const newCahaya = lastCahaya + (Math.random() - 0.5) * 150;
        sensorData.cahaya.push(Math.max(200, Math.min(900, newCahaya)));
        sensorData.cahaya.shift();
        
        const lastKelembapan = sensorData.kelembapan[sensorData.kelembapan.length - 1];
        const newKelembapan = lastKelembapan + (Math.random() - 0.5) * 3;
        sensorData.kelembapan.push(Math.max(40, Math.min(80, newKelembapan)));
        sensorData.kelembapan.shift();
        
        sensorData.kelembapanCurrent += (Math.random() - 0.5) * 1;
        sensorData.kelembapanCurrent = Math.max(50, Math.min(70, sensorData.kelembapanCurrent));
        
        updateSensorValues();
        updateCharts();
    }

    // Chart.js variables
    let suhuChart, cahayaChart, kelembapanChart;

    // Custom Tooltip Handler (seperti di screenshot)
    const getOrCreateTooltip = (chart) => {
        let tooltipEl = chart.canvas.parentNode.querySelector('div.chartjs-tooltip');

        if (!tooltipEl) {
            tooltipEl = document.createElement('div');
            tooltipEl.className = 'chartjs-tooltip';
            tooltipEl.style.cssText = `
                background: rgba(30, 41, 59, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid #374151;
                border-radius: 8px;
                color: white;
                opacity: 0;
                pointer-events: none;
                position: absolute;
                transform: translate(-50%, -100%);
                transition: all 0.2s ease;
                padding: 10px 14px;
                font-size: 13px;
                font-weight: 500;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            `;

            const table = document.createElement('div');
            table.style.margin = '0px';
            tooltipEl.appendChild(table);
            chart.canvas.parentNode.appendChild(tooltipEl);
        }

        return tooltipEl;
    };

    const externalTooltipHandler = (context) => {
        const {chart, tooltip} = context;
        const tooltipEl = getOrCreateTooltip(chart);

        if (tooltip.opacity === 0) {
            tooltipEl.style.opacity = 0;
            return;
        }

        if (tooltip.body) {
            const titleLines = tooltip.title || [];
            const bodyLines = tooltip.body.map(b => b.lines);

            const tableRoot = tooltipEl.querySelector('div');
            tableRoot.innerHTML = '';

            // Title (time)
            titleLines.forEach(title => {
                const titleDiv = document.createElement('div');
                titleDiv.style.cssText = 'color: #94a3b8; margin-bottom: 4px; font-size: 12px;';
                titleDiv.textContent = title;
                tableRoot.appendChild(titleDiv);
            });

            // Body (value with label)
            bodyLines.forEach((body, i) => {
                const colors = tooltip.labelColors[i];
                const bodyDiv = document.createElement('div');
                bodyDiv.style.cssText = 'display: flex; align-items: center; gap: 6px; margin-top: 2px;';
                
                // Color indicator dot
                const dot = document.createElement('span');
                dot.style.cssText = `
                    width: 8px;
                    height: 8px;
                    border-radius: 50%;
                    background: ${colors.backgroundColor};
                `;
                
                // Value text
                const text = document.createElement('span');
                text.style.cssText = 'color: #ffffff; font-weight: 600;';
                text.textContent = body;

                bodyDiv.appendChild(dot);
                bodyDiv.appendChild(text);
                tableRoot.appendChild(bodyDiv);
            });
        }

        const {offsetLeft: positionX, offsetTop: positionY} = chart.canvas;

        tooltipEl.style.opacity = 1;
        tooltipEl.style.left = positionX + tooltip.caretX + 'px';
        tooltipEl.style.top = positionY + tooltip.caretY - 10 + 'px';
    };

    // Initialize Temperature Chart
    function initSuhuChart() {
        const ctx = document.getElementById('suhuChart');
        if (!ctx) return;
        
        suhuChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: sensorData.timestamps,
                datasets: [{
                    label: 'Suhu',
                    data: sensorData.suhu,
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.2)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#f97316',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: false,
                        external: externalTooltipHandler,
                        callbacks: {
                            label: function(context) {
                                return 'Suhu: ' + context.parsed.y.toFixed(1) + ' °C';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 11 },
                            maxRotation: 0,
                            autoSkipPadding: 20
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 11 }
                        },
                        beginAtZero: false,
                        min: 0,
                        max: 36
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Initialize Light Chart
    function initCahayaChart() {
        const ctx = document.getElementById('cahayaChart');
        if (!ctx) return;
        
        cahayaChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: sensorData.timestamps,
                datasets: [{
                    label: 'Intensitas Cahaya',
                    data: sensorData.cahaya,
                    borderColor: '#fbbf24',
                    backgroundColor: 'rgba(251, 191, 36, 0.1)',
                    borderWidth: 2.5,
                    fill: false,
                    tension: 0.4,
                    pointRadius: 3,
                    pointBackgroundColor: '#fbbf24',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: false,
                        external: externalTooltipHandler,
                        callbacks: {
                            label: function(context) {
                                return 'light : ' + Math.round(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 11 },
                            maxRotation: 0,
                            autoSkipPadding: 20
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 11 }
                        },
                        beginAtZero: false,
                        min: 0,
                        max: 800
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Initialize Humidity Chart
    function initKelembapanChart() {
        const ctx = document.getElementById('kelembapanChart');
        if (!ctx) return;
        
        kelembapanChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: sensorData.timestamps,
                datasets: [{
                    label: 'Kelembapan',
                    data: sensorData.kelembapan,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#3b82f6',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: false,
                        external: externalTooltipHandler,
                        callbacks: {
                            label: function(context) {
                                return 'Kelembapan: ' + context.parsed.y.toFixed(1) + ' %';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 11 },
                            maxRotation: 0,
                            autoSkipPadding: 20
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            font: { size: 11 }
                        },
                        beginAtZero: false,
                        min: 0,
                        max: 80
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Update charts
    function updateCharts() {
        if (suhuChart) {
            suhuChart.data.labels = sensorData.timestamps;
            suhuChart.data.datasets[0].data = sensorData.suhu;
            suhuChart.update('none');
        }
        
        if (cahayaChart) {
            cahayaChart.data.labels = sensorData.timestamps;
            cahayaChart.data.datasets[0].data = sensorData.cahaya;
            cahayaChart.update('none');
        }

        if (kelembapanChart) {
            kelembapanChart.data.labels = sensorData.timestamps;
            kelembapanChart.data.datasets[0].data = sensorData.kelembapan;
            kelembapanChart.update('none');
        }
    }

    // Initialize dashboard
    initializeData();
    updateSensorValues();

    // Initialize charts after DOM loaded
    setTimeout(() => {
        initSuhuChart();
        initCahayaChart();
        initKelembapanChart();
    }, 100);

    // Update data every 3 seconds
    setInterval(generateNewData, 3000);
}

// ==========================================
// CONTROL PAGE FUNCTIONALITY
// ==========================================

if (document.querySelector('.control-grid')) {
    
    // Note: Authentication is handled by backend middleware
    // If user reaches this page, they are already authenticated

    // Update time for each device (WIB - UTC+7)
    function updateDeviceTimes() {
        const now = new Date();
        
        // Convert to WIB (UTC+7)
        const wibOffset = 7 * 60; // 7 hours in minutes
        const localOffset = now.getTimezoneOffset(); // Local offset in minutes
        const wibTime = new Date(now.getTime() + (wibOffset + localOffset) * 60 * 1000);
        
        const hours = String(wibTime.getHours()).padStart(2, '0');
        const minutes = String(wibTime.getMinutes()).padStart(2, '0');
        const seconds = String(wibTime.getSeconds()).padStart(2, '0');
        const timeStr = `${hours}:${minutes}:${seconds}`;
        
        document.querySelectorAll('.device-time').forEach(el => {
            el.textContent = timeStr;
        });
    }

    // Initial time update and interval
    updateDeviceTimes();
    setInterval(updateDeviceTimes, 1000);

    // Handle ON/OFF buttons
    document.querySelectorAll('.btn-control').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.control-card');
            const action = this.dataset.action;
            const slider = card.querySelector('.power-slider');
            const sliderFill = card.querySelector('.slider-fill');
            const powerPercentage = card.querySelector('.power-percentage');
            const buttons = card.querySelectorAll('.btn-control');
            
            // Remove active from all buttons in this card
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // Add active to clicked button
            this.classList.add('active');
            
            if (action === 'on') {
                // Turn ON - enable slider
                slider.disabled = false;
                const currentValue = parseInt(slider.value);
                if (currentValue === 0) {
                    slider.value = 50;
                    sliderFill.style.width = '50%';
                    powerPercentage.textContent = '50';
                }
                
                // Add glowing border to card
                card.classList.add('device-active');
                
                // Update status badge
                const statusBadge = card.querySelector('.status-badge');
                statusBadge.classList.remove('offline');
                statusBadge.classList.add('online');
                statusBadge.innerHTML = '<i class="fa-solid fa-circle"></i> Online';
                
            } else {
                // Turn OFF - disable slider and set to 0
                slider.disabled = true;
                slider.value = 0;
                sliderFill.style.width = '0%';
                powerPercentage.textContent = '0';
                
                // Remove glowing border from card
                card.classList.remove('device-active');
                
                // Update status badge
                const statusBadge = card.querySelector('.status-badge');
                statusBadge.classList.remove('online');
                statusBadge.classList.add('offline');
                statusBadge.innerHTML = '<i class="fa-solid fa-circle"></i> Offline';
            }
        });
    });

    // Handle slider changes
    document.querySelectorAll('.power-slider').forEach(slider => {
        slider.addEventListener('input', function() {
            const card = this.closest('.control-card');
            const value = this.value;
            const sliderFill = card.querySelector('.slider-fill');
            const powerPercentage = card.querySelector('.power-percentage');
            
            // Update fill width and percentage
            sliderFill.style.width = value + '%';
            powerPercentage.textContent = value;
            
            // Update label highlighting based on value
            const labels = card.querySelectorAll('.slider-labels span');
            labels.forEach(label => {
                label.style.fontWeight = 'normal';
                label.style.color = '#64748b';
            });
            
            if (value < 33) {
                labels[0].style.fontWeight = '600';
                labels[0].style.color = '#10b981';
            } else if (value < 66) {
                labels[1].style.fontWeight = '600';
                labels[1].style.color = '#fbbf24';
            } else {
                labels[2].style.fontWeight = '600';
                labels[2].style.color = '#f97316';
            }
        });
    });

    // Emergency Stop Button
    const emergencyBtn = document.getElementById('emergencyStop');
    if (emergencyBtn) {
        emergencyBtn.addEventListener('click', function() {
            const confirmed = confirm('⚠️ PERINGATAN!\n\nEmergency Stop akan mematikan SEMUA device.\nApakah Anda yakin?');
            
            if (confirmed) {
                // Turn off all devices
                document.querySelectorAll('.control-card').forEach(card => {
                    const offButton = card.querySelector('.btn-off');
                    const onButton = card.querySelector('.btn-on');
                    const slider = card.querySelector('.power-slider');
                    const sliderFill = card.querySelector('.slider-fill');
                    const powerPercentage = card.querySelector('.power-percentage');
                    const statusBadge = card.querySelector('.status-badge');
                    
                    // Set button states
                    onButton.classList.remove('active');
                    offButton.classList.add('active');
                    
                    // Disable slider and set to 0
                    slider.disabled = true;
                    slider.value = 0;
                    sliderFill.style.width = '0%';
                    powerPercentage.textContent = '0';
                    
                    // Remove glowing border
                    card.classList.remove('device-active');
                    
                    // Update status
                    statusBadge.classList.remove('online');
                    statusBadge.classList.add('offline');
                    statusBadge.innerHTML = '<i class="fa-solid fa-circle"></i> Offline';
                });
                
                // Show notification
                showNotification('Emergency Stop diaktifkan! Semua device telah dimatikan.', 'error');
                
                // Add animation effect
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            }
        });
    }
}

// ==========================================
// MANAGE USER PAGE - DEDICATED JAVASCRIPT WITH CRUD
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    
    // Check if we're on manage-user page
    if (!document.querySelector('.user-table-section')) {
        return;
    }

    // ========== ELEMENTS ==========
    const btnAddUser = document.getElementById('btnAddUser');
    const userModal = document.getElementById('userModal');
    const btnCloseModal = document.getElementById('btnCloseModal');
    const btnCancel = document.getElementById('btnCancel');
    const userForm = document.getElementById('userForm');
    const modalTitle = document.getElementById('modalTitle');
    const searchInput = document.getElementById('searchInput');
    const togglePassword = document.getElementById('togglePassword');
    const userPassword = document.getElementById('userPassword');
    const passwordGroup = document.getElementById('passwordGroup');
    
    let isEditMode = false;
    let currentUserId = null;

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ========== MODAL FUNCTIONS ==========
    
    // Open Modal for Add User
    function openModalAdd() {
        isEditMode = false;
        currentUserId = null;
        modalTitle.textContent = 'Tambah User Baru';
        userForm.reset();
        document.getElementById('userId').value = '';
        document.getElementById('formMethod').value = 'POST';
        
        // Show password field for new user
        passwordGroup.style.display = 'block';
        userPassword.required = true;
        
        userModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Open Modal for Edit User
    function openModalEdit(userId) {
        isEditMode = true;
        currentUserId = userId;
        modalTitle.textContent = 'Edit User';
        document.getElementById('formMethod').value = 'PUT';
        
        // Hide password field for edit (optional)
        passwordGroup.style.display = 'block';
        userPassword.required = false;
        userPassword.placeholder = 'Kosongkan jika tidak ingin mengubah password';
        
        // Get user data from server
        fetch(`/manage-user/${userId}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const user = data.data;
                
                // Extract email prefix (before @autra.com)
                const emailPrefix = user.email.replace('@autra.com', '');
                
                // Fill form
                document.getElementById('userId').value = user.id;
                document.getElementById('userName').value = user.name;
                document.getElementById('userEmail').value = emailPrefix;
                document.getElementById('userRole').value = user.role;
                document.getElementById('userStatus').value = user.status;
                
                userModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Gagal mengambil data user', 'error');
        });
    }

    // Close Modal
    function closeModal() {
        userModal.classList.remove('active');
        document.body.style.overflow = 'auto';
        userForm.reset();
        isEditMode = false;
        currentUserId = null;
        userPassword.placeholder = 'Masukkan password';
    }

    // ========== EVENT LISTENERS ==========
    
    // Open Add User Modal
    if (btnAddUser) {
        btnAddUser.addEventListener('click', openModalAdd);
    }

    // Close Modal Events
    if (btnCloseModal) {
        btnCloseModal.addEventListener('click', closeModal);
    }

    if (btnCancel) {
        btnCancel.addEventListener('click', closeModal);
    }

    // Close modal when clicking outside
    userModal.addEventListener('click', function(e) {
        if (e.target === userModal) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && userModal.classList.contains('active')) {
            closeModal();
        }
    });

    // Toggle Password Visibility
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = userPassword.type === 'password' ? 'text' : 'password';
            userPassword.type = type;
            
            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    }

    // ========== FORM SUBMIT (CREATE & UPDATE) ==========
    
    if (userForm) {
        userForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = {
                name: document.getElementById('userName').value,
                email_prefix: document.getElementById('userEmail').value,
                role: document.getElementById('userRole').value,
                status: document.getElementById('userStatus').value,
                password: document.getElementById('userPassword').value
            };

            // Validation
            if (!formData.name || !formData.email_prefix || !formData.role || !formData.status) {
                showNotification('Mohon lengkapi semua field yang wajib diisi!', 'error');
                return;
            }

            // Password validation for new user
            if (!isEditMode && (!formData.password || formData.password.length < 8)) {
                showNotification('Password minimal 8 karakter!', 'error');
                return;
            }

            // Password validation for edit (if filled)
            if (isEditMode && formData.password && formData.password.length < 8) {
                showNotification('Password minimal 8 karakter!', 'error');
                return;
            }

            // Show loading on submit button
            const btnSubmit = document.getElementById('btnSubmit');
            const originalText = btnSubmit.innerHTML;
            btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Menyimpan...</span>';
            btnSubmit.disabled = true;

            // Determine URL and method
            const url = isEditMode ? `/manage-user/${currentUserId}` : '/manage-user';
            const method = isEditMode ? 'PUT' : 'POST';

            // Send request
            fetch(url, {
                method: 'POST', // Always POST, Laravel will handle _method
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': method // Laravel method override
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                btnSubmit.innerHTML = originalText;
                btnSubmit.disabled = false;

                if (data.success) {
                    showNotification(data.message, 'success');
                    closeModal();
                    
                    // Reload page to show updated data
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification(data.message || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btnSubmit.innerHTML = originalText;
                btnSubmit.disabled = false;
                showNotification('Terjadi kesalahan pada server', 'error');
            });
        });
    }

    // ========== DELETE USER ==========
    
    function deleteUser(userId) {
        const confirmed = confirm('Apakah Anda yakin ingin menghapus user ini?');
        
        if (confirmed) {
            const row = document.querySelector(`button[data-id="${userId}"]`).closest('tr');
            
            // Add fade out animation
            row.style.animation = 'fadeOut 0.3s ease-out';
            
            // Send delete request
            fetch(`/manage-user/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    setTimeout(() => {
                        row.remove();
                        updateUserCount();
                        showNotification(data.message, 'success');
                    }, 300);
                } else {
                    row.style.animation = '';
                    showNotification(data.message || 'Gagal menghapus user', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                row.style.animation = '';
                showNotification('Terjadi kesalahan pada server', 'error');
            });
        }
    }

    // ========== TABLE FUNCTIONS ==========
    
    // Update User Count
    function updateUserCount() {
        const tbody = document.getElementById('userTableBody');
        const count = tbody.querySelectorAll('tr').length;
        const counterElement = document.getElementById('userCount');
        if (counterElement) {
            counterElement.textContent = count;
        }
    }

    // Attach Event Listeners to Action Buttons
    function attachActionListeners() {
        // Edit buttons
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                openModalEdit(userId);
            });
        });

        // Delete buttons
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                deleteUser(userId);
            });
        });
    }

    // Initial attachment of action listeners
    attachActionListeners();

    // ========== SEARCH FUNCTION ==========
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTableBody tr');
            
            let visibleCount = 0;
            
            rows.forEach(row => {
                // Skip empty state row
                if (row.querySelector('.empty-state')) {
                    return;
                }
                
                const name = row.querySelector('.user-name-table')?.textContent.toLowerCase() || '';
                const email = row.cells[2]?.textContent.toLowerCase() || '';
                const role = row.querySelector('.role-badge')?.textContent.toLowerCase() || '';
                
                if (name.includes(searchTerm) || email.includes(searchTerm) || role.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show "tidak ditemukan" message if no results
            if (visibleCount === 0 && searchTerm !== '') {
                showNoResults();
            } else {
                removeNoResults();
            }
        });
    }

    // Show no results message
    function showNoResults() {
        const tbody = document.getElementById('userTableBody');
        const existingMessage = tbody.querySelector('.no-results-row');
        
        if (!existingMessage) {
            const noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = `
                <td colspan="6" class="empty-state">
                    <i class="fa-solid fa-search"></i>
                    <p>User tidak ditemukan</p>
                </td>
            `;
            tbody.appendChild(noResultsRow);
        }
    }

    // Remove no results message
    function removeNoResults() {
        const noResultsRow = document.querySelector('.no-results-row');
        if (noResultsRow) {
            noResultsRow.remove();
        }
    }

    // ========== UTILITY FUNCTIONS ==========
    
    // Show notification
    function showNotification(message, type = 'success') {
        // Check if global notification function exists
        if (typeof window.showNotification === 'function') {
            window.showNotification(message, type);
            return;
        }

        // Local notification implementation
        const existing = document.querySelector('.notification-toast');
        if (existing) {
            existing.remove();
        }
        
        const toast = document.createElement('div');
        toast.className = `notification-toast notification-toast-${type}`;
        toast.textContent = message;
        
        toast.style.cssText = `
            position: fixed;
            top: 24px;
            right: 24px;
            padding: 14px 20px;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            animation: slideInRight 0.3s ease-out;
            max-width: 400px;
        `;
        
        if (type === 'error') {
            toast.style.background = '#dc2626';
        } else if (type === 'success') {
            toast.style.background = '#16a34a';
        } else {
            toast.style.background = '#3b82f6';
        }
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Add CSS animations if not already added
    if (!document.getElementById('manage-user-animations')) {
        const style = document.createElement('style');
        style.id = 'manage-user-animations';
        style.textContent = `
            @keyframes fadeOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100px);
                }
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    console.log('Manage User page with CRUD initialized');
});

// ==========================================
// NOTIFIKASI PAGE - DEDICATED JAVASCRIPT
// ==========================================

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Check if we're on notification page
    if (!document.querySelector('.notifications-list')) {
        return;
    }

    // Show notification function (local version)
    function showNotificationMessage(message, type = 'success') {
        // Remove existing notification
        const existing = document.querySelector('.notification-toast');
        if (existing) {
            existing.remove();
        }
        
        // Create notification element
        const toast = document.createElement('div');
        toast.className = `notification-toast notification-toast-${type}`;
        toast.textContent = message;
        
        // Styling
        toast.style.cssText = `
            position: fixed;
            top: 24px;
            right: 24px;
            padding: 14px 20px;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            animation: slideInRight 0.3s ease-out;
            max-width: 400px;
        `;
        
        // Set background color based on type
        if (type === 'error') {
            toast.style.background = '#dc2626';
        } else if (type === 'success') {
            toast.style.background = '#16a34a';
        } else if (type === 'info') {
            toast.style.background = '#3b82f6';
        } else {
            toast.style.background = '#2563eb';
        }
        
        // Add to page
        document.body.appendChild(toast);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }

    // Mark single notification as read
    document.querySelectorAll('.btn-mark-read').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const notifId = this.dataset.id;
            const card = this.closest('.notification-card');
            
            markAsRead(notifId, card);
        });
    });

    // Mark all notifications as read
    const markAllBtn = document.getElementById('markAllRead');
    if (markAllBtn) {
        markAllBtn.addEventListener('click', function() {
            const unreadCards = document.querySelectorAll('.notification-card.unread');
            
            if (unreadCards.length === 0) {
                showNotificationMessage('Semua notifikasi sudah dibaca', 'info');
                return;
            }
            
            const confirmed = confirm(`Tandai ${unreadCards.length} notifikasi sebagai sudah dibaca?`);
            
            if (confirmed) {
                unreadCards.forEach(card => {
                    const notifId = card.dataset.id;
                    markAsRead(notifId, card, true); // true = skip individual notification
                });
                
                showNotificationMessage('Semua notifikasi ditandai sebagai dibaca', 'success');
            }
        });
    }

    // Delete notification
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const notifId = this.dataset.id;
            const card = this.closest('.notification-card');
            
            const confirmed = confirm('Apakah Anda yakin ingin menghapus notifikasi ini?');
            
            if (confirmed) {
                deleteNotification(notifId, card);
            }
        });
    });

    // Function to mark as read
    function markAsRead(notifId, card, skipNotification = false) {
        // In production, you would make an AJAX call here:
        // fetch(`/notifikasi/${notifId}/read`, { method: 'POST' })
        
        // For now, we'll just update the UI
        
        // Remove unread class
        card.classList.remove('unread');
        card.classList.add('read');
        
        // Remove "Baru" badge
        const badge = card.querySelector('.badge-new');
        if (badge) {
            badge.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(() => badge.remove(), 300);
        }
        
        // Remove check button
        const checkBtn = card.querySelector('.btn-mark-read');
        if (checkBtn) {
            checkBtn.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(() => checkBtn.remove(), 300);
        }
        
        // Update counter
        updateUnreadCount();
        
        // Add animation
        card.style.animation = 'markRead 0.5s ease-out';
        setTimeout(() => {
            card.style.animation = '';
        }, 500);
        
        // Show notification (skip if marking all)
        if (!skipNotification) {
            showNotificationMessage('Notifikasi ditandai sebagai dibaca', 'success');
        }
    }

    // Function to delete notification
    function deleteNotification(notifId, card) {
        // In production, you would make an AJAX call here:
        // fetch(`/notifikasi/${notifId}`, { method: 'DELETE' })
        
        // Add fade out animation
        card.style.animation = 'fadeOut 0.3s ease-out';
        
        setTimeout(() => {
            const wasUnread = card.classList.contains('unread');
            card.remove();
            
            if (wasUnread) {
                updateUnreadCount();
            }
            
            // Check if list is empty
            const remainingCards = document.querySelectorAll('.notification-card');
            if (remainingCards.length === 0) {
                showEmptyState();
            }
            
            showNotificationMessage('Notifikasi berhasil dihapus', 'success');
        }, 300);
    }

    // Update unread counter
    function updateUnreadCount() {
        const unreadCount = document.querySelectorAll('.notification-card.unread').length;
        const counter = document.getElementById('unreadCount');
        
        if (counter) {
            counter.textContent = unreadCount;
            
            // Update subtitle text
            const subtitle = counter.parentElement;
            if (subtitle) {
                if (unreadCount === 0) {
                    subtitle.innerHTML = '<span id="unreadCount">0</span> notifikasi belum dibaca';
                } else {
                    subtitle.innerHTML = `<span id="unreadCount">${unreadCount}</span> notifikasi belum dibaca`;
                }
            }
        }
    }

    // Show empty state
    function showEmptyState() {
        const listContainer = document.querySelector('.notifications-list');
        if (listContainer) {
            listContainer.innerHTML = `
                <div class="empty-notifications">
                    <i class="fa-solid fa-bell-slash"></i>
                    <h3>Tidak ada notifikasi</h3>
                    <p>Semua notifikasi akan muncul di sini</p>
                </div>
            `;
        }
    }

    // Add CSS animations if not already added
    if (!document.getElementById('notif-animations')) {
        const style = document.createElement('style');
        style.id = 'notif-animations';
        style.textContent = `
            @keyframes fadeOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100px);
                }
            }
            
            @keyframes markRead {
                0% { transform: scale(1); }
                50% { transform: scale(0.98); }
                100% { transform: scale(1); }
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    console.log('Notifikasi page initialized');
});

// ==========================================
// LAPORAN PAGE - CLIENT SIDE EXPORT
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    
    // Check if we're on laporan page
    if (!document.querySelector('.table-section')) {
        return;
    }

    // ========== EXPORT FUNCTIONS ==========
    
    // Get current filters for export
    function getCurrentFilters() {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        
        const params = new URLSearchParams();
        
        if (searchInput && searchInput.value) {
            params.append('search', searchInput.value);
        }
        
        if (statusFilter && statusFilter.value) {
            params.append('status', statusFilter.value);
        }
        
        return params.toString();
    }

    // Export to Excel (Server-side)
    const exportExcelBtn = document.getElementById('exportExcel');
    if (exportExcelBtn) {
        exportExcelBtn.addEventListener('click', function() {
            const filters = getCurrentFilters();
            const url = `/laporan/export-excel${filters ? '?' + filters : ''}`;
            
            // Show loading
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Exporting...</span>';
            this.disabled = true;
            
            // Create temporary link and trigger download
            const link = document.createElement('a');
            link.href = url;
            link.download = ''; // Let server determine filename
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Reset button after 2 seconds
            setTimeout(() => {
                this.innerHTML = originalHTML;
                this.disabled = false;
                showNotification('Data berhasil diexport ke Excel!', 'success');
            }, 2000);
        });
    }

    // Export to PDF (Server-side)
    const exportPdfBtn = document.getElementById('exportPdf');
    if (exportPdfBtn) {
        exportPdfBtn.addEventListener('click', function() {
            const filters = getCurrentFilters();
            const url = `/laporan/export-pdf${filters ? '?' + filters : ''}`;
            
            // Show loading
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Exporting...</span>';
            this.disabled = true;
            
            // Create temporary link and trigger download
            const link = document.createElement('a');
            link.href = url;
            link.download = ''; // Let server determine filename
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Reset button after 2 seconds
            setTimeout(() => {
                this.innerHTML = originalHTML;
                this.disabled = false;
                showNotification('Data berhasil diexport ke PDF!', 'success');
            }, 2000);
        });
    }

    // ========== SEARCH & FILTER ==========
    
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                applyFilters();
            }, 500);
        });
    }

    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            applyFilters();
        });
    }

    function applyFilters() {
        const search = searchInput.value;
        const status = statusFilter.value;
        
        const url = new URLSearchParams(window.location.search);
        
        if (search) {
            url.set('search', search);
        } else {
            url.delete('search');
        }
        
        if (status) {
            url.set('status', status);
        } else {
            url.delete('status');
        }
        
        url.delete('page'); // Reset to first page
        
        window.location.href = `${window.location.pathname}?${url.toString()}`;
    }

    // ========== STATISTICS (Optional) ==========
    
    // Load statistics if needed
    function loadStatistics() {
        fetch('/laporan/statistics')
            .then(response => response.json())
            .then(data => {
                console.log('Statistics:', data);
                // You can display these stats in a dashboard or modal
            })
            .catch(error => {
                console.error('Error loading statistics:', error);
            });
    }

    // Uncomment to load stats on page load
    // loadStatistics();

    // ========== AUTO REFRESH (Optional) ==========
    
    // Auto refresh every 30 seconds (optional)
    let autoRefreshEnabled = false;
    let autoRefreshInterval;

    function toggleAutoRefresh() {
        autoRefreshEnabled = !autoRefreshEnabled;
        
        if (autoRefreshEnabled) {
            autoRefreshInterval = setInterval(() => {
                window.location.reload();
            }, 30000); // 30 seconds
            
            showNotification('Auto-refresh diaktifkan (30 detik)', 'success');
        } else {
            clearInterval(autoRefreshInterval);
            showNotification('Auto-refresh dinonaktifkan', 'info');
        }
    }

    // Add auto-refresh button if needed
    // const autoRefreshBtn = document.getElementById('toggleAutoRefresh');
    // if (autoRefreshBtn) {
    //     autoRefreshBtn.addEventListener('click', toggleAutoRefresh);
    // }

    // ========== UTILITY FUNCTIONS ==========
    
    // Show notification
    function showNotification(message, type = 'success') {
        // Check if global notification function exists
        if (typeof window.showNotification === 'function') {
            window.showNotification(message, type);
            return;
        }

        // Local notification implementation
        const existing = document.querySelector('.notification-toast');
        if (existing) {
            existing.remove();
        }
        
        const toast = document.createElement('div');
        toast.className = `notification-toast notification-toast-${type}`;
        toast.textContent = message;
        
        toast.style.cssText = `
            position: fixed;
            top: 24px;
            right: 24px;
            padding: 14px 20px;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            animation: slideInRight 0.3s ease-out;
            max-width: 400px;
        `;
        
        if (type === 'error') {
            toast.style.background = '#dc2626';
        } else if (type === 'success') {
            toast.style.background = '#16a34a';
        } else if (type === 'info') {
            toast.style.background = '#3b82f6';
        } else {
            toast.style.background = '#2563eb';
        }
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Format number
    function formatNumber(num, decimals = 2) {
        return parseFloat(num).toFixed(decimals);
    }

    // Format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        
        return `${day}-${month}-${year} ${hours}:${minutes}`;
    }

    // Add CSS animations if not already added
    if (!document.getElementById('laporan-animations')) {
        const style = document.createElement('style');
        style.id = 'laporan-animations';
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    console.log('Laporan page with server-side export initialized');
});