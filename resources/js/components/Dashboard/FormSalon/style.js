import { makeStyles } from '@material-ui/core/styles';

const formSalon = makeStyles({
    root: {
        display: 'flex',
        flexWrap: 'wrap',
        width: '100%',
        justifyContent: 'center'
    },
    ava: {
        width: '100px',
        height: '100px'
    },
    item: {
        margin: '10px'
    },
    areal: {
        margin: '10px',
        width: '90%'
    },
    info: {
        'display': 'flex',
        'flex-direction': 'column',
        marginLeft: '40px'
    },
    spec: {
        margin: '10px 0 10px 0'
    },
    imageBox: {
        display: 'flex',
        alignItems: 'center',
        flexWrap: 'wrap',
        width: '100%',
    },
    imageBox__head: {
        width: '90%',
        margin: '10px auto',
        textAlign: 'center'
    },
    imageBox__left: {
        width: '30%',
        marginBottom: '10px',
    },
    imageBox__right: {
        width: '70%',
        marginBottom: '10px',
    },
    btns: {
        display: 'flex',
        flexDirection: 'column'
    }
});

export default formSalon;