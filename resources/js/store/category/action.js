export const ADD_CATEGORY = 'CATEGORY::ADD_CATEGORY';

export const addCategory = ({id, title, slug}) => ({
    type: ADD_CATEGORY,
    id,
    title,
    slug
});


export const fetchCategoryAll = () => (dispatch, getState) => {
            fetch("/api/categories").then(res => res.json()).then(res => {
                
                res.data.forEach(element => {
                    dispatch(addCategory(element))
                });
                
            })
        }

