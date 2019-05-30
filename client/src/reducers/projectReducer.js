import { UPDATE_PROJECTS, UPDATE_PROJECT , ADD_PROJECT_MODAL , ADD_KEYWORD_MODAL , UPDATE_PROJECT_LOADING_STATE , UPDATE_KEYWORD} from '../types/projectTypes';

const initialState = {
    projects : {} ,
    addProjectModal  : false,
    project: {},
    addKeywordModal : false,
    projectLoadingState: false
}


export default function projectReducer(state = initialState, { type, payload }) {

    switch(type){
        case UPDATE_PROJECTS:
            return {...state , projects : payload.projects} ;
        case ADD_PROJECT_MODAL:
            return {...state , addProjectModal : payload.addProjectModal}
        case ADD_KEYWORD_MODAL:
            return {...state , addKeywordModal : payload.addKeywordModal}
        case UPDATE_PROJECT_LOADING_STATE:
            state.project[payload.id] = { ...state.project[payload.id] , bestPosition : "Loading..." , lastPosition : {position : "Loading..." , date : "Loading..."} }
            return {...state}
        case UPDATE_PROJECT:
            return {...state , project : payload.project}
        case UPDATE_KEYWORD:
            state.project[payload.project.id] = payload.project;
            return {...state }
        default:
            return state;
    }
}