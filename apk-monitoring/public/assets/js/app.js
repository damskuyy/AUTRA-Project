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
// LOGIN PAGE FUNCTIONALITY
// ==========================================

if (document.getElementById('loginForm')) {
    const loginForm = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const btnLogin = document.querySelector('.btn-login');

    // Form Submit Handler
    loginForm.addEventListener('submit', function(e) {
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
        
        // Simulate API call
        setTimeout(() => {
            // Store session
            sessionStorage.setItem('isLoggedIn', 'true');
            sessionStorage.setItem('username', username);
            sessionStorage.setItem('loginTime', new Date().toISOString());
            
            showNotification('Login berhasil! Mengalihkan ke dashboard...', 'success');
            
            setTimeout(() => {
                window.location.href = '/dashboard';
            }, 1200);
            
        }, 1500);
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

    // Check if already logged in
    window.addEventListener('DOMContentLoaded', function() {
        const isLoggedIn = sessionStorage.getItem('isLoggedIn');
        if (isLoggedIn === 'true') {
            window.location.href = '/dashboard';
        }
    });

    // Reset button on back
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            btnLogin.classList.remove('loading');
            btnLogin.disabled = false;
        }
    });
}

// ==========================================
// DASHBOARD PAGE FUNCTIONALITY
// ==========================================

if (document.querySelector('.dashboard-page')) {
    
    // Check authentication
    window.addEventListener('DOMContentLoaded', function() {
        const isLoggedIn = sessionStorage.getItem('isLoggedIn');
        if (isLoggedIn !== 'true') {
            window.location.href = '/login';
            return;
        }

        // Set username
        const username = sessionStorage.getItem('username') || 'Admin User';
        const userNameElement = document.querySelector('.user-name');
        if (userNameElement) {
            userNameElement.textContent = username;
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

    // User Profile Click (Logout)
    const userProfile = document.querySelector('.user-profile');
    if (userProfile) {
        userProfile.addEventListener('click', function() {
            const confirmed = confirm('Apakah Anda ingin logout?');
            if (confirmed) {
                sessionStorage.clear();
                window.location.href = '/login';
            }
        });
    }
}

// ==========================================
// CONTROL PAGE FUNCTIONALITY
// ==========================================

if (document.querySelector('.control-grid')) {
    
    // Check authentication
    const isLoggedIn = sessionStorage.getItem('isLoggedIn');
    if (isLoggedIn !== 'true') {
        window.location.href = '/login';
    }

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

    // User Profile Click (Logout)
    const userProfile = document.querySelector('.user-profile');
    if (userProfile) {
        userProfile.addEventListener('click', function() {
            const confirmed = confirm('Apakah Anda ingin logout?');
            if (confirmed) {
                sessionStorage.clear();
                window.location.href = '/login';
            }
        });
    }
}

// ================= MODAL MANAGE USER =================

// buat fungsi GLOBAL (WAJIB)
window.openAddUserModal = function () {
    const userModal = document.getElementById('userModal');
    const modalTitle = document.getElementById('modalTitle');
    const userForm = document.getElementById('userForm');

    if (!userModal || !modalTitle || !userForm) {
        console.error('Modal element tidak ditemukan');
        return;
    }

    modalTitle.innerText = 'Tambah User';
    userForm.reset();
    userModal.classList.add('active');
};

window.openEditUserModal = function (name, email, role, status) {
    const userModal = document.getElementById('userModal');
    const modalTitle = document.getElementById('modalTitle');

    if (!userModal || !modalTitle) return;

    modalTitle.innerText = 'Edit User';
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('role').value = role;
    document.getElementById('status').value = status;

    userModal.classList.add('active');
};

window.closeUserModal = function () {
    const userModal = document.getElementById('userModal');
    if (userModal) userModal.classList.remove('active');
};

// klik backdrop
document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'userModal') {
        closeUserModal();
    }
});

window.openAddUserModal = function () {
    console.log('BUTTON CLICKED');

    const userModal = document.getElementById('userModal');

    if (!userModal) {
        console.error('userModal tidak ditemukan di DOM');
        return;
    }

    userModal.classList.add('active');
};
