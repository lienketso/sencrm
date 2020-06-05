import * as types from './../const/ActionTypes';
import _ from 'lodash';

let initialState = {
    pages: [],
}

let PageReducer = (state = initialState, action) => {
    switch (action.type) {
        case types.GET_POST_SUCCEED:
            console.log('state', action);
            return {
                ...state,
                pages: action.payload.data,
            };
        default:
            return state;
    }
}

export default PageReducer;