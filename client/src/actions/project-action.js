import axios from "axios";
import { UPDATE_PROJECTS, ADD_PROJECT_MODAL , UPDATE_PROJECT , ADD_KEYWORD_MODAL, UPDATE_PROJECT_LOADING_STATE,  UPDATE_KEYWORD } from  '../types/projectTypes';

export function  getProjects() {

    return dispatch => {
        axios({
            method: 'get',
            url: 'http://localhost:8000/api/project',
            headers: {'Authorization': `bearer ${localStorage.getItem('token')}`}
        })
            .then( response => {
                dispatch(updateProjects(response.data))
            })

    }
}

export function  getProject(url) {

    return dispatch => {
        axios({
            method: 'get',
            url: 'http://localhost:8000/api/project/' + url,
            headers: {'Authorization': `bearer ${localStorage.getItem('token')}`}
        })
            .then( response => {
                dispatch(updateProject(response.data))
            })

    }
}


export function addProject(url) {
    return async dispatch => {
        await axios({
            method: 'post',
            data: { url },
            url: 'http://localhost:8000/api/project',
            headers: {'Authorization': `bearer ${localStorage.getItem('token')}`}
        });

        dispatch(changeAddProjectModal(false));
        dispatch(getProjects());

    }
}

export function  updateProjects(projects) {
    return {
        type : UPDATE_PROJECTS,
        payload : {
         projects : projects
        }
    }
}

export function  updateProject(project) {
    return {
        type : UPDATE_PROJECT,
        payload : {
            project : project
        }
    }
}

export function  updateKeyword(project) {
    return {
        type : UPDATE_KEYWORD,
        payload : {
            project
        }
    }
}


export function  changeAddProjectModal(value) {
    return {
        type : ADD_PROJECT_MODAL,
        payload : {
            addProjectModal : value
        }
    }

}

export function changeAddKeywordModal(value) {
    return {
        type : ADD_KEYWORD_MODAL,
        payload : {
            addKeywordModal : value
        }
    }

}

export function addKeyword(keyword,country,website){
    return async dispatch => {
        await axios({
        method: 'post',
        data: {keyword , country, website},
        url: 'http://localhost:8000/api/keyword',
        headers: {'Authorization': `bearer ${localStorage.getItem('token')}`}
        });

        dispatch(getProject(website));
        dispatch(changeAddKeywordModal(false));


    }}

export function updateProjectLoadingState(id) {
    return {
        type : UPDATE_PROJECT_LOADING_STATE,
        payload : {
            id
        }
    }

}

export function doUpdateKeyword(id) {
    return async dispatch => {
        dispatch(updateProjectLoadingState(id))
        const data =  axios({
            method: 'post',
            data : {id},
            url: 'http://localhost:8000/api/updatekeyword',
            headers: {'Authorization': `bearer ${localStorage.getItem('token')}`}
        })
        data.then((response => {
            dispatch(updateKeyword(response.data))
        })

        )
        }
}