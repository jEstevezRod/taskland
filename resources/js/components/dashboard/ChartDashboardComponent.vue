
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
                htmlLegend: null
            }
        },
        mounted () {
            this.$axios.get('/tasks').then(response => this.tasks_list = response.data.tasks);
            this.$axios.get('/states').then(response => this.states_list = response.data.states);
            this.$axios.get('/projects').then(response => this.projects_list = response.data.projects);
            this.renderChart({
                labels: this.states_list,
                datasets: [
                    {
                        label: 'Tasks',
                        backgroundColor: 'rgba(52, 152, 219,0.7)',
                        data: [40, 39, 10, 40, 39, 80, 40]
                    },
                    {
                        label: 'Tasks in 2',
                        backgroundColor: 'rgba(231, 76, 60,0.7)',
                        data: [10, 69, 50, 35, 14, 40, 17]
                    },
                ]
            }, {responsive: true, maintainAspectRatio: false})
            this.htmlLegend = this.generateLegend()
        }


    }
</script>

<style scoped>

</style>