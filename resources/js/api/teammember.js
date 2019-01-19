import {TASKLAND_CONFIG} from "../config";

export default {

    addTeamMember: function (data) {

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

        return axios.post(TASKLAND_CONFIG.API_URL + '/addTeamMember?token=' + data.token,
            {
                team_id: data.team_id,
                token: data.token
            }
            )
    },


}