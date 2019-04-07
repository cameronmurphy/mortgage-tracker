import $ from 'jquery';
import Chart from 'chart.js';
import { map, toFinite } from 'lodash';

const DATA_URL = '/data.json';

const prepareData = data => {
  return map(data, record => ({
    t: new Date(record['date']),
    y: toFinite(record['remainingBalance'])
  }));
};

const render = data => {
  const element = document.getElementById('chart').getContext('2d');

  new Chart(element, {
    type: 'line',
    data: {
      datasets: [{
        borderColor: 'rgb(54, 162, 235)',
        data: prepareData(data),
        fill: false,
        label: 'Remaining balance',
        lineTension: 0.1,
        pointRadius: 0,
      }],
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            callback: label => label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','),
          },
        }],
        xAxes: [{
          type: 'time',
          unit: 'day',
          displayFormats: {
            quarter: 'DD/MMM'
          }
        }],
      },
    },
  });
};

$(() => {
  $.get(DATA_URL, render);
});
