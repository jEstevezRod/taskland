import { TASKLAND_CONFIG} from "../config";

export default {

    loadAppointments(data) {

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get(TASKLAND_CONFIG.API_URL + '/getAppointments', data.data)
    }
}