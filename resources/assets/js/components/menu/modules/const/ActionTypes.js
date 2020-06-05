export const BASE_URL = process.env.MIX_APP_URL + 'services/';
export const API_GET_POST = BASE_URL + 'post/get-post' //Get all post in data variable post_type

//actions
export const GET_POST = 'GET_POST';
export const GET_POST_REQUESTED = 'GET_POST_REQUESTED';
export const GET_POST_SUCCEED = 'GET_POST_SUCCEED';
export const GET_POST_FAILED = 'GET_POST_FAILED';