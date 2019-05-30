import { USER_LOGIN} from '../types/userTypes';
import axios from "axios";

export function  changeLoginStatus(status) {
    return {
        type : USER_LOGIN,
        payload : {
            login : status
        }
    }
}

export function checkTokenIsValid(){

    return async dispatch => {
         await axios({
            method: 'post',
            url: 'http://localhost:8000/api/checkToken',
            headers: {'Authorization': `bearer ${localStorage.getItem('token')}`}
        })
            .then( (res)=> {
                if(res.data === true){
                    dispatch(changeLoginStatus(true));
                    return res;
                }
            })
    .catch((res) =>  res)


    }}