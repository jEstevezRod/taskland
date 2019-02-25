<script>
import { Bar } from "vue-chartjs";

export default {
  name: "ChartDashboardComponent",
  extends: Bar,
  data() {
    return {
      tasks_list: [],
      states_list: [],
      projects_list: [],
      gradient: null,
      gradient2: null,
      user_id: 0,
      labels: [],
      dataLabels: [],
      options: {
        title: {
          display: true,
          text: "Projects with number of tasks"
        },
        responsive: true,
        maintainAspectRatio: false,
        scaleBeginAtZero: true,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                callback: value => {
                  if (Number.isInteger(value)) return value;
                },
                stepSize: 1
              },
              gridLines: {
                display: false
              }
            }
          ],
          xAxes: [
            {
              maxBarThickness: 200,
              gridLines: {
                display: false
              }
            }
          ]
        }
      }
    };
  },
  created() {
    this.$store.dispatch("loadID").then(response => {
      this.user_id = response.data;
      console.log(this.user_id);
      this.$store
        .dispatch("loadProjectsAndTaskChart", this.user_id)
        .then(response => {
          console.log(response);
          this.labels = response.labels;
          this.dataLabels = response.data;
          this.executeChart();
        });
    });
  },
  methods: {
    executeChart: function() {
      this.gradient = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
      this.gradient.addColorStop(1, "rgba(231, 76, 60,0.9)");
      this.renderChart(
        {
          labels: this.labels,
          datasets: [
            {
              label: "Tasks",
              borderColor: "transparent",
              pointBackgroundColor: "white",
              borderWidth: 1,
              pointBorderColor: "white",
              backgroundColor: this.gradient,
              hoverBackgroundColor: "rgba(30,144,255,0.4)",
              data: this.dataLabels
            }
          ]
        },
        this.options
      );
    }
  }
};
</script>

<style scoped>
.Chart {
  background: #212733;
  border-radius: 15px;
  box-shadow: 0 2px 15px rgba(25, 25, 25, 0.27);
  margin: 25px 0;
}

.Chart h2 {
  margin-top: 0;
  padding: 15px 0;
  color: rgba(255, 0, 0, 0.5);
  border-bottom: 1px solid #323d54;
}
</style>