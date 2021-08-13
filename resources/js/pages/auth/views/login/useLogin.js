export const useLogin = (props) => {

    const auth = useSelector(state => state.auth)

    const handleAuth = () => {
        console.log('login', props)
        props.history.push({
            pathname: '/',
        })
    }

    return {
        auth,
        handleAuth
    }
}