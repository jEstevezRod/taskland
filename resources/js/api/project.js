import { TASKLAND_CONFIG} from "../config";

export default  {

    addNewProject: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post( TASKLAND_CONFIG.API_URL + '/newProject', data.data)
    },

    loadAllProjects: function (token) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        return axios.get( TASKLAND_CONFIG.API_URL + '/loadProjects')

    },

    getName: function (data) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get( TASKLAND_CONFIG.API_URL + '/loadProjectName/' + data.data)

    }
}