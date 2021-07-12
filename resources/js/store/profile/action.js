export const EDIT_PROFILE = 'PROFILE::EDIT_PROFILE';

export const editProfile = (email, token) => ({
    type: EDIT_PROFILE,
    email,
    token
});


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }

