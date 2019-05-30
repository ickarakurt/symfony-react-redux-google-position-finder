import { USER_LOGIN } from '../types/userTypes';

const initialState = {
    login : false
}

export default function userReducer(state = initialState, { type, payload }) {
    switch(type){
        case USER_LOGIN:
            return {...state , login : payload.login};
        default:
            return state;
    }
}