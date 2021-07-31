import HTTP from '../HTTP';

export const ADD_CATEGORY = 'CATEGORY::ADD_CATEGORY';
export const CLEAR_CATEGORY = 'CATEGORY::CLEAR_CATEGORY';

export const addCategory = ({id, title, slug}) => ({
    type: ADD_CATEGORY,
    id,
    title,
    slug
});
export const clearCategory = () => ({
    type: CLEAR_CATEGORY,
});


export const fetchCategoryAll = () => (dispatch, getState) => {
            HTTP.get("/api/categories").then(res => {
                dispatch(clearCategory())
                console.log(res);
                res.data.categories.forEach(element => {
                    dispatch(addCategory(element))
                });
                
            })
        }


