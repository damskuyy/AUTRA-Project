// ========================================
// Chart.js Configuration - FINAL VERSION
// ========================================

// Common Chart Options
const commonChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false
        },
        tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.9)',
            titleColor: '#fff',
            bodyColor: '#fff',
            borderColor: 'rgba(255, 152, 0, 0.3)',
            borderWidth: 1,
            padding: 12,
            displayColors: false,
            titleFont: {
                size: 13,
                weight: '600'
            },
            bodyFont: {
                size: 12
            }
        }
    },
    interaction: {
        intersect: false,
        mode: 'index'
    }
};

// Generate time labels (HH:MM format)
function generateTimeLabels(count = 25) {
    const labels = [];
    const now = new Date();
    for (let i = count - 1; i >= 0; i--) {
        const time = new Date(now - i * 60000);
        const hours = String(time.getHours()).padStart(2, '0');
        const minutes = String(time.getMinutes()).padStart(2, '0');
        labels.push(`${hours}:${minutes}`);
    }
    return labels;
}

// Generate smooth trend data
function generateSmoothData(baseValue, variance, count = 25, smoothness = 0.7) {
    const data = [];
    let current = baseValue;
    
    for (let i = 0; i < count; i++) {
        const target = baseValue + (Math.random() - 0.5) * variance * 2;
        current = current * smoothness + target * (1 - smoothness);
        data.push(Number(current.toFixed(1)));
    }
    return data;
}

// ========================================
// Temperature Chart
// ========================================
const tempCanvas = document.getElementById('tempChart');
if (tempCanvas) {
    const tempCtx = tempCanvas.getContext('2d');
    const tempLabels = generateTimeLabels(25);
    const tempData = generateSmoothData(32, 3, 25);

    const temperatureChart = new Chart(tempCtx, {
        type: 'line',
        data: {
            labels: tempLabels,
            datasets: [{
                data: tempData,
                borderColor: '#FF6347',
                backgroundColor: 'rgba(255, 99, 71, 0.15)',
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointRadius: 0,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#FF6347',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            ...commonChartOptions,
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.03)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 10
                        },
                        maxRotation: 0,
                        autoSkipPadding: 20
                    }
                },
                y: {
                    min: 18,
                    max: 39,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.03)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 10
                        },
                        stepSize: 9
                    }
                }
            }
        }
    });

    // Update temperature chart
    setInterval(() => {
        tempLabels.shift();
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        tempLabels.push(`${hours}:${minutes}`);
        
        const lastValue = tempData[tempData.length - 1];
        const newValue = lastValue + (Math.random() - 0.5) * 2;
        const clampedValue = Math.max(28, Math.min(38, newValue));
        
        tempData.shift();
        tempData.push(Number(clampedValue.toFixed(1)));
        
        temperatureChart.update('none');
        
        // Update display
        document.getElementById('temp-display').textContent = tempData[tempData.length - 1].toFixed(1);
    }, 3000);
}

// ========================================
// Light Intensity Chart
// ========================================
const lightCanvas = document.getElementById('lightIntensityChart');
if (lightCanvas) {
    const lightCtx = lightCanvas.getContext('2d');
    const lightLabels = generateTimeLabels(25);
    const lightData = generateSmoothData(450, 150, 25);

    const lightChart = new Chart(lightCtx, {
        type: 'line',
        data: {
            labels: lightLabels,
            datasets: [{
                data: lightData,
                borderColor: '#FFA500',
                backgroundColor: 'rgba(255, 165, 0, 0.15)',
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointRadius: 0,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#FFA500',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            ...commonChartOptions,
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.03)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 10
                        },
                        maxRotation: 0,
                        autoSkipPadding: 20
                    }
                },
                y: {
                    min: 200,
                    max: 800,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.03)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 10
                        },
                        stepSize: 200
                    }
                }
            }
        }
    });

    // Update light intensity chart
    setInterval(() => {
        lightLabels.shift();
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        lightLabels.push(`${hours}:${minutes}`);
        
        const lastValue = lightData[lightData.length - 1];
        const newValue = lastValue + (Math.random() - 0.5) * 80;
        const clampedValue = Math.max(250, Math.min(750, newValue));
        
        lightData.shift();
        lightData.push(Number(clampedValue.toFixed(0)));
        
        lightChart.update('none');
        
        // Update display
        document.getElementById('light-display').textContent = Math.round(lightData[lightData.length - 1]);
    }, 3000);
}

// ========================================
// Update Humidity Value
// ========================================
function updateHumidity() {
    const humidityDisplay = document.getElementById('humidity-display');
    if (humidityDisplay) {
        const currentValue = parseFloat(humidityDisplay.textContent);
        const newValue = currentValue + (Math.random() - 0.5) * 2;
        const clampedValue = Math.max(50, Math.min(70, newValue));
        humidityDisplay.textContent = clampedValue.toFixed(1);
    }
}

// Update humidity every 3 seconds
setInterval(updateHumidity, 3000);

// ========================================
// Initialize on load
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('%c Dashboard Monitoring Active ', 'background: #FF9800; color: #fff; font-size: 14px; padding: 8px; font-weight: bold;');
    console.log('%c Real-time updates running every 3 seconds ', 'color: #4CAF50; font-size: 12px;');
});