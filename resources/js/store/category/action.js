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
            fetch("/api/categories").then(res => res.json()).then(res => {
                dispatch(clearCategory())
                res.data.forEach(element => {
                    dispatch(addCategory(element))
                });
                
            })
        }

