
<script>
    import VueChart from 'vue-chartjs'
    import { Bar, Line } from 'vue-chartjs'


    export default {
        name: "ChartDashboardComponent",
        extends: VueChart.Line,
        data() {
            return {
                tasks_list: [],
                states_list: [],
                projects_list: [],
                htmlLegend: null,
                gradient: null,
                gradient2: null
            }
        },
        mounted () {
            // this.$axios.get('/tasks').then(response => this.tasks_list = response.data.tasks);
            // this.$axios.get('/states').then(response => this.states_list = response.data.states);
            // this.$axios.get('/projects').then(response => this.projects_list = response.data.projects);

            this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
            this.gradient2 = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)

            this.gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)')
            this.gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
            this.gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');

            this.gradient2.addColorStop(0, 'rgba(0, 231, 255, 0.9)')
            this.gradient2.addColorStop(0.5, 'rgba(0, 231, 255, 0.25)');
            this.gradient2.addColorStop(1, 'rgba(0, 231, 255, 0)');

            this.renderChart({
                labels: this.states_list,
                datasets: [
                    {
                        label: 'Data One',
                        borderColor: '#FC2525',
                        pointBackgroundColor: 'white',
                        borderWidth: 1,
                        pointBorderColor: 'white',
                        backgroundColor: this.gradient,
                        data: [0, 60, 10, 40, 39, 80, 100]
                    },
                    {
                        label: 'Data Two',
                        borderColor: '#05CBE1',
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'white',
                        borderWidth: 1,
                        backgroundColor: this.gradient2,
                        data: [0, 55, 32, 10, 2, 12, 53]
                    },
                ]
            }, {responsive: true, maintainAspectRatio: false})
            
        }


    }
</script>

<style scoped>
    .Chart {
        background: #212733;
        border-radius: 15px;
        box-shadow: 0px 2px 15px rgba(25, 25, 25, 0.27);
        margin:  25px 0;
    }

    .Chart h2 {
        margin-top: 0;
        padding: 15px 0;
        color:  rgba(255, 0,0, 0.5);
        border-bottom: 1px solid #323d54;
    }
</style>