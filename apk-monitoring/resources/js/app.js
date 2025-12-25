import './bootstrap';
import Chart from 'chart.js/auto';

let tempChart, lightChart, humidityChart;

document.addEventListener('DOMContentLoaded', () => {

    tempChart = createLineChart(
        'tempChart',
        '#ff8a00',
        'rgba(255,138,0,0.15)'
    );

    lightChart = createLineChart(
        'lightChart',
        '#ffc700',
        'rgba(255,199,0,0.15)'
    );

    humidityChart = createLineChart(
        'humidityChart',
        '#3b82f6',
        'rgba(59,130,246,0.25)'
    );

    startRealtime();
});

/* ===============================
   CREATE CHART
================================ */
function createLineChart(id, border, bg) {
    const el = document.getElementById(id);
    if (!el) return null;

    return new Chart(el, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                data: [],
                borderColor: border,
                backgroundColor: bg,
                tension: 0.45,
                fill: true,
                pointRadius: 3
            }]
        },
        options: chartOptions()
    });
}

/* ===============================
   REALTIME ENGINE
================================ */
function startRealtime() {
    setInterval(async () => {
        try {
            const res = await fetch('/api/realtime');
            const data = await res.json();

            updateValue('tempVal', data.temperature);
            updateValue('lightVal', data.light);
            updateValue('humVal', data.humidity);

            pushData(tempChart, data.time, data.temperature);
            pushData(lightChart, data.time, data.light);
            pushData(humidityChart, data.time, data.humidity);

        } catch (e) {
            console.error('Realtime error:', e);
        }
    }, 2000);
}

/* ===============================
   HELPERS
================================ */
function pushData(chart, label, value) {
    if (!chart) return;

    chart.data.labels.push(label);
    chart.data.datasets[0].data.push(value);

    if (chart.data.labels.length > 12) {
        chart.data.labels.shift();
        chart.data.datasets[0].data.shift();
    }

    chart.update();
}

function updateValue(id, newValue) {
    const el = document.getElementById(id);
    if (!el) return;

    const old = parseFloat(el.textContent) || 0;
    const diff = newValue - old;
    const duration = 400;
    let start;

    function animate(ts) {
        if (!start) start = ts;
        const progress = Math.min((ts - start) / duration, 1);
        el.textContent = (old + diff * progress).toFixed(1);
        if (progress < 1) requestAnimationFrame(animate);
    }

    requestAnimationFrame(animate);
}

function chartOptions() {
    return {
        animation: {
            duration: 900,
            easing: 'easeOutQuart'
        },
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: {
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#9aa4bf' }
            },
            y: {
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#9aa4bf' }
            }
        }
    };
}

/* ===============================
   SIDEBAR ACTIVE
================================ */
// document.querySelectorAll('.menu-item').forEach(link => {
//     if (link.href === window.location.href) {
//         link.classList.add('active');
//     }
// });

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('page-enter');
    requestAnimationFrame(() => {
        document.body.classList.add('page-enter-active');
    });
});

window.addEventListener('scroll', () => {
    document.querySelector('.navbar')
        ?.classList.toggle('scrolled', window.scrollY > 10);
});

const toggle = document.getElementById('sidebarToggle');
const root = document.querySelector('.layout-root');

if (toggle && root) {
    toggle.addEventListener('click', () => {
        root.classList.toggle('collapsed');
    });
}

/* ===============================
CONTROL PAGE
================================ */
document.querySelectorAll('.toggle-switch').forEach(sw => {
    sw.addEventListener('click', () => {
        sw.classList.toggle('on');

        const status = sw.closest('.control-card')
            .querySelector('.status');

        if (sw.classList.contains('on')) {
            status.textContent = 'ON';
            status.className = 'status on';
        } else {
            status.textContent = 'OFF';
            status.className = 'status off';
        }
    });
});

const mode = document.getElementById('modeToggle');
if (mode) {
    mode.addEventListener('click', () => {
        mode.classList.toggle('active');
        mode.querySelector('.label').textContent =
            mode.classList.contains('active')
                ? 'Manual'
                : 'Auto';
    });
}
