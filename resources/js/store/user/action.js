export const SET_USER = 'USER::SET_USER';
export const CLEAR_USER = 'USER::CLEAR_USER'

export const setUserWithThunk = (user) => (dispach, getState) => {
    dispach(setUser(user))
    localStorage.setItem('user', JSON.stringify(user));

}

export const setUser = ({name, email, role_id}) => ({
    type: SET_USER,
    name,
    email,
    role_id
});

export const clearUser = () => ({
    type: CLEAR_USER,
});


// export const fetchProfileWithThunk = () => (dispatch, getState) => {
//             fetch("https://reqres.in/api/users?id=2").then(res => res.json()).then(res => {
//                 dispatch(editProfile( res.data.first_name, res.data.last_name, res.data.email ))
//             })
//         }

