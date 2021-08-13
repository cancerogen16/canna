import {makeStyles} from '@material-ui/core/styles';

const styleSalon = makeStyles({
    header: {
        display: 'flex',
        'justify-content': 'flex-start',
        'align-items': 'center'
    },
    ava: {
        marginRight: '10px'
    },
    info: {
        display: 'flex',
        justifyContent: 'space-between;'
    },
    img: {
        maxWidth: '850px',
        minWidth: '200px'
    },
    contact: {
        display: 'flex',
        flexDirection: 'column'
    },
    contactItem: {
        margin: '10px 0',
        fontSize: '24px',
        fontWeight: '600'
    }

});

export default styleSalon;