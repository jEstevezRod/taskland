import { TASKLAND_CONFIG} from "../config";

export default {

    loadAllAppointments: function (data) 
    {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.get(TASKLAND_CONFIG.API_URL + '/getAppointments')
    },

    addAppointment: function (data) 
    {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;
        
        return axios.post( TASKLAND_CONFIG.API_URL + '/newAppointment', data.data)
    }

}