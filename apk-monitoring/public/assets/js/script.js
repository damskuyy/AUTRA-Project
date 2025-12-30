Chart.defaults.color = "#9aa4c7";
Chart.defaults.font.family = "Inter";
Chart.defaults.plugins.legend.display = false;

let tempValue = 30;
let lightValue = 500;
let humidityValue = 60;

const updateText = () => {
  document.getElementById("tempVal").innerText = tempValue.toFixed(1);
  document.getElementById("lightVal").innerText = Math.round(lightValue);
  document.getElementById("humVal").innerText = humidityValue.toFixed(1);
};

const genData = (base, range) =>
  base + (Math.random() * range - range / 2);

/* =====================
   TEMPERATURE CHART
===================== */
const tempChart = new Chart(document.getElementById("tempChart"), {
  type: "line",
  data: {
    labels: Array.from({ length: 12 }, (_, i) => `22.${27+i}`),
    datasets: [{
      data: Array.from({ length: 12 }, () => genData(30, 8)),
      borderColor: "#ff8a00",
      backgroundColor: "rgba(255,138,0,0.25)",
      fill: true,
      tension: 0.45,
      pointRadius: 0
    }]
  },
  options: {
    maintainAspectRatio: false,
    scales: {
      x: { grid: { borderDash: [5,5] }},
      y: { grid: { borderDash: [5,5] }}
    }
  }
});

/* =====================
   LIGHT CHART
===================== */
const lightChart = new Chart(document.getElementById("lightChart"), {
  type: "line",
  data: {
    labels: tempChart.data.labels,
    datasets: [{
      data: Array.from({ length: 12 }, () => genData(550, 300)),
      borderColor: "#ffd34e",
      backgroundColor: "rgba(255,211,78,0.2)",
      fill: true,
      tension: 0.45,
      pointRadius: 4,
      pointBackgroundColor: "#ffd34e"
    }]
  },
  options: {
    maintainAspectRatio: false,
    scales: {
      x: { grid: { borderDash: [5,5] }},
      y: { grid: { borderDash: [5,5] }}
    }
  }
});

/* =====================
   LIVE UPDATE LOOP
===================== */
setInterval(() => {
  tempValue = genData(30, 6);
  lightValue = genData(550, 250);
  humidityValue = genData(60, 10);

  updateText();

  tempChart.data.datasets[0].data.shift();
  tempChart.data.datasets[0].data.push(tempValue);

  lightChart.data.datasets[0].data.shift();
  lightChart.data.datasets[0].data.push(lightValue);

  tempChart.update();
  lightChart.update();
}, 2000);
