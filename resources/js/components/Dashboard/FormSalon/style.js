import {makeStyles} from '@material-ui/core/styles';

const formSalon = makeStyles({
    root: {
        display: 'flex',
        flexWrap: 'wrap',
        width: '473px;',
        justifyContent: 'center'
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
    btns: {
        display: 'flex',
        flexDirection: 'column'
    }
});

export default formSalon;