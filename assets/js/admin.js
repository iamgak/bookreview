// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById("sidebar");

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add("sidebar-responsive");
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove("sidebar-responsive");
    sidebarOpen = false;
  }
}

// ---------- CHARTS ----------

// BAR CHART
const barChartOptions = {
  series: [
    {
      data: user["comment"],
    },
  ],
  chart: {
    type: "bar",
    height: 350,
    toolbar: {
      show: false,
    },
  },
color: function(context) {
    const index = context.dataIndex;
    const value = context.dataset.data[index];
    return value < 0 ? 'red' :  // draw negative values in red
        index % 2 ? 'blue' :    // else, alternate values in blue and green
        'green';
},
borderColor: function(context, options) {
    const color = options.color; // resolve the value of another scriptable option: 'red', 'blue' or 'green'
    return Chart.helpers.color(color).lighten(0.2);
}
,  plotOptions: {
    bar: {
      distributed: true,
      borderRadius: 4,
      horizontal: false,
      columnWidth: "40%",
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  xaxis: {
    categories: user["comment_month"],
  },
  yaxis: {
    title: {
      text: "Count",
    },
  },
};

// const barChart = new ApexCharts(
//   document.querySelector("#bar-chart"),
//   barChartOptions
// );
// barChart.render();

// AREA CHART

new Chart("myChart13", {
  type: "line",
  data: {
    labels: user["uid"],
    datasets: [{ 
      data: user["logged"],
      borderColor: "green",
      fill: false
    }, { 
      data: user["logged_out"] ? user["logged_out"] : [0, 0],
      borderColor: "red",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
const areaChartOptions = {
  series: [
    {
      name: "Logged In",
      data: user["logged"],
    },
    {
      name: "Logged Out",
      data: user["logged_out"] ? user["logged_out"] : [0, 0],
    },
  ],
  chart: {
    height: 350,
    type: "area",
    toolbar: {
      show: false,
    },
  },color: function(context) {
    const index = context.dataIndex;
    const value = context.dataset.data[index];
    return value < 0 ? 'red' :  // draw negative values in red
        index % 2 ? 'blue' :    // else, alternate values in blue and green
        'green';
},
borderColor: function(context, options) {
    const color = options.color; // resolve the value of another scriptable option: 'red', 'blue' or 'green'
    return Chart.helpers.color(color).lighten(0.2);
}
,
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: "smooth",
  },
  labels: user["uid"],
  markers: {
    size: 0,
  },
  yaxis: [
    {
      title: {
        text: "No of times user Logged",
      },
    },
  ],
  tooltip: {
    shared: true,
    intersect: false,
  },
};

// const areaChart = new ApexCharts(
//   document.querySelector("#area-chart"),
//   areaChartOptions
// );
// areaChart.render();

new Chart("myChart", {
  type: "pie",
  data: {
    labels: user['new_user_month'],
    datasets: [{
      backgroundColor: generateChartColors(user['new_user_month'].length),
      data: user['new_user']
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
}); 
function generateChartColors(numOfColors) {
  const colors = [];

  // Generate colors with HSL color model
for (let i = 0; i < numOfColors; i++) {
    const hue = (360 / numOfColors) * i;
    const lightness = (50 + (Math.random() * 10)) + "%";
    const saturation = (50 + (Math.random() * 10)) + "%";
    const color = `hsl(${hue}, ${saturation}, ${lightness})`;

    colors.push(color);
  }

  return colors;
}

new Chart("contact_us", {
  type: "bar",
  data: {
    labels: user['contact_us_month'],
    datasets: [{
      backgroundColor: generateChartColors(user['contact_us_month'].length),
      data: user['contact_us']
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
}); 

function generateChartColors(numOfColors) {
  const colors = [];

  // Generate colors with HSL color model
for (let i = 0; i < numOfColors; i++) {
    const hue = (360 / numOfColors) * i;
    const lightness = (50 + (Math.random() * 10)) + "%";
    const saturation = (50 + (Math.random() * 10)) + "%";
    const color = `hsl(${hue}, ${saturation}, ${lightness})`;

    colors.push(color);
  }

  return colors;
}

const xValues = [50,60,70,80,90,100,110,120,130,140,150];
const yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart12", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
// const xValues = [100,200,300,400,500,600,700,800,900,1000];
