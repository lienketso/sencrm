import * as types from './../const/ActionTypes';
import axios from 'axios'
import {BASE_URL, API_GET_POST} from "./../const/ActionTypes";

const getPostRequested = () => ({
    type: types.GET_POST_REQUESTED,
});

const getPostSuccess = (data) => ({
    type: types.GET_POST_SUCCEED,
    payload: data,
});

const getPostFailed = (error) => ({
    type: types.GET_POST_FAILED,
    payload: error,
});

export const getPost = () => {
    return (dispatch) => {
        dispatch(getPostRequested());
        return axios({
            method: 'GET',
            url: API_GET_POST,
            params: {
                post_type: 'page',
            }
        })
        .then(response => dispatch(getPostSuccess(response)))
        .catch(error => dispatch(getPostFailed(error)))
    }
}


